<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function create()
    {
        $avatar = Auth::user()->avatar;

        return view('ask_question', compact('avatar'));
    }

    public function store(Request $request)
    {   
        $this->validate($request, 
            [
                'title' => ['required', 'string', 'max:255'],
                'tags' => ['required'],
                'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
                'medias.*' => 'mimetypes:audio/mpeg,video/webm|max:3072'
            ]
	    ); 
        if (!$request->content) {
            return response()->json(['response' => 0]); 
        } 
        $tags = explode(",", $request->tags);
        DB::transaction(function () use ($request) {
            // save question
            $question = Question::create([
                'user_id' => Auth::id(),
                'title' => $request->title
            ]);
            // save content
            $question->content()->create([
                'content' => $request->content,
                'updated' => 0
            ]);
            // save images
            if ($request->images) {
                foreach ($request->images as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $whereToSaveImage = public_path('images/uploads');
                    $image->move($whereToSaveImage, $imageName);
                    $url = "http://localhost:8000/images/uploads/$imageName" ;
                    $question->images()->create([
                        'url' => $url
                    ]);
                }
            } 
            // save medias
            if ($request->medias) {
                foreach ($request->medias as $media) {
                    $mediaName = time() . '_' . $media->getClientOriginalName();
                    $whereToSaveMedia = public_path('medias');
                    $media->move($whereToSaveMedia, $mediaName);
                    $url = "http://localhost:8000/medias/$mediaName" ;
                    $question->medias()->create([
                        'url' => $url
                    ]);
                }
            } 
        });

        return response()->json(['response' => 1]);
    }
}
