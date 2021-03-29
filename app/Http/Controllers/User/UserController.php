<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show($userId)
    {
        $user = User::find($userId);
        
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
}
