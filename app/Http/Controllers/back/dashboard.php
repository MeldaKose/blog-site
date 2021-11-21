<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;

class dashboard extends Controller
{
    public function index(){
        $article=Article::all()->count();
        $hit=Article::sum('hit');
        $category=Category::all()->count();
        $page=Page::all()->count();
        return view('back.dashboard',compact('article','hit','category','page'));
    }
//    public function categoryList(){
//        $data['categories']=Category::orderBy('id','ASC')->get();
//        return view('back/categorylist',$data);
//    }
}
