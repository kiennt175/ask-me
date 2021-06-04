<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function view($tab)
    {
        if ($tab == 'popular') {
            $tags = Tag::withCount('questions')->orderBy('questions_count', 'desc')->paginate(60);
        }
        if ($tab == 'name') {
            $tags = Tag::withCount('questions')->orderBy('tag', 'asc')->paginate(60);
        }
        if ($tab == 'newest') {
            $tags = Tag::withCount('questions')->orderBy('id', 'desc')->paginate(60);
        }

        return view('tags', compact(['tags', 'tab']));
    }

    public function search($searchText, $tab)
    {
        if ($tab == 'popular') {
            $tags = Tag::withCount('questions')->where('tag', 'like', '%' . $searchText . '%')->orderBy('questions_count', 'desc')->paginate(60);
        }
        if ($tab == 'name') {
            $tags = Tag::withCount('questions')->where('tag', 'like', '%' . $searchText . '%')->orderBy('tag', 'asc')->paginate(60);
        }
        if ($tab == 'newest') {
            $tags = Tag::withCount('questions')->where('tag', 'like', '%' . $searchText . '%')->orderBy('id', 'desc')->paginate(60);
        }

        return view('tags', compact(['tags', 'tab', 'searchText']));
    }
}
