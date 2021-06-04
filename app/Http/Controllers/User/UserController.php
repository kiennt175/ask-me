<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Jobs\NewPassword;

class UserController extends Controller
{
    public function show($userId)
    {
        $user = User::find($userId);
        
        return view('user_profile', compact('user'));
    }

    public function showBy($username)
    {
        $user = User::where('username', $username)->first();

        return view('user_profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('edit_profile', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, 
            [
                'name' => ['required', 'string', 'max:255']
            ],			
            [
                'username' => ['string', 'max:255']
            ],			
            [
                'name.required' => 'You have to fill out this field!',
            ]
	    );
        $avatarFile = $request->file('avatar');
        if ($avatarFile) {
            $this->validate($request, 
                [
                    'avatar' => 'image|mimes:jpg,jpeg,png,gif|max:2048', // 2048 = 2M
                ],
            );
            $avatar = time() . '_' . $avatarFile->getClientOriginalName();
            $destinationPath = public_path('images/avatars');
            $avatarFile->move($destinationPath, $avatar);
            $avatar = "http://localhost:8000/images/avatars/$avatar" ;
        }
        if ($request->website_link) {
            $request->website_link = str_ireplace('https://', '', $request->website_link);
        }
        $user = Auth::user();
        $user->update([
            'avatar' => isset($avatar) ? $avatar : $user->avatar,
            'bio' => $request->bio,
            'name' => $request->name,
            'website_link' => $request->website_link
        ]);
        if (!$user->username) {
            $user->update([
                'username' => $request->username
            ]);

            return response()->json(['website_link' => $request->website_link, 'name' => $request->name, 'username' => $request->username]);
        }

        return response()->json(['website_link' => $request->website_link, 'name' => $request->name]);
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, 
            [
                'old_password' => ['required', 'string', 'min:8'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
        );
        $user = Auth::user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return response()->json(['response' => 1]);
        }

        return response()->json(['response' => 0]);
    }

    public function sendResetPasswordLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('email-error', 'The e-mail does not exist!');
        }
        $token = Str::random(8);
        $hashedToken = sha1($token); 
        $user->update([
            'reset_password_token' => $hashedToken
        ]);
        $data = [
            'token' => $token,
            'userId' => $user->id
        ];
        dispatch(new NewPassword($data, $request->email));
           
        return redirect()->route('login')->with('mail-successfully', true);
    }

    public function newPassword(Request $request)
    {
        $userId = $request->route('userId');

        return view('new_password', compact('userId'));
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, 
            [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
        );
        $user = User::find($request->route('userId'));
        $user->update([
            'password' => Hash::make($request->password),
            'reset_password_token' => null
        ]);

        return redirect()->route('login')->with('new-password', true);
    }

    public function newsfeed($id)
    {
        $user = User::find($id);
        $questions = Question::with(['content', 'tags', 'answers.content'])->where('user_id', $user->id)->where('status', 1)->orderBy('created_at', 'desc')->paginate(10);
        
        return view('newsfeed', compact(['questions', 'user']));
    }

    public function view($tab)
    {
        if ($tab == 'points') {
            $users = User::orderBy('points', 'desc')->paginate(66);
        }
        if ($tab == 'name') {
            $users = User::orderBy('name', 'asc')->paginate(66);
        }
        if ($tab == 'newest') {
            $users = User::orderBy('id', 'desc')->paginate(66);
        }
        
        return view('users', compact(['users', 'tab']));
    }

    public function search($searchText, $tab)
    {
        if ($tab == 'points') {
            $users = User::where('name', 'like', '%' . $searchText . '%')->orWhere('username', 'like', '%' . $searchText . '%')->orderBy('points', 'desc')->paginate(66);
        }
        if ($tab == 'name') {
            $users = User::where('name', 'like', '%' . $searchText . '%')->orWhere('username', 'like', '%' . $searchText . '%')->orderBy('name', 'asc')->paginate(66);
        }
        if ($tab == 'newest') {
            $users = User::where('name', 'like', '%' . $searchText . '%')->orWhere('username', 'like', '%' . $searchText . '%')->orderBy('id', 'desc')->paginate(66);
        }

        return view('users', compact(['users', 'tab', 'searchText']));
    }
}
