<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Callout;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartjsController extends Controller
{
    public function index(Content $content)
    {   
        // dd(DB::table('users')
        //     ->select(DB::raw('sum(total) as total'),DB::raw('date(created_at) as dates'))
        //     ->groupBy('dates')
        //     ->orderBy('dates','desc')
        //     ->get());

        // dd(User::all()->groupBy(function($date) {
        //     return \Carbon\Carbon::parse($date->created_at)->format('d-m-Y');
        // })->sortBy('created_at'));
//         $data = [];
//         $posts = User::orderBy('created_at')->get()->groupBy(function($item) {
//             return $item->created_at->format('Y-m-d');
//        })->toArray();
//        foreach($posts as $key => $post){

//         $day = $key;
//         $totalCount = count($post);
//         array_push($data, [$day => $totalCount] );
//         }
// dd($data->flatten);
//         dd(DB::table('users')
//             ->select(DB::raw('count(*) as user_count'), DB::raw('date(created_at) as dates'))
//             ->groupBy('dates')
//             ->get()->toArray());

        return $content
            ->header('Analysis')
            ->body(new Box('Users Chart', view('admin.chartjs')));
    }
}