<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;



class CategoryController extends Controller
{
    public function index(){
        $categories=Category::orderBy('created_at','ASC')->get();
        return view('back.categories.category', compact('categories'));
    }
    public function switch(Request $request){
        $categories=Category::findOrFail($request->id);
        $categories->status=$request->statu=="true" ? 1 : 0;
        $categories->save();
        return back();
    }
    public function create(Request $request){
        $request->validate([
            'name'=>'bail|required|unique:categories|min:2',
        ]);
        $slug=Str::slug($request->name);
        $category=new Category();
        $category->name=$request->name;
        $category->slug=$slug;
        $category->save();
        toastr()->success('Başarılı','Kategori başarıyla eklendi');
        return redirect()->route('category.index');
    }
    public function getData(Request $request){
        $category=Category::findOrFail($request->id);
        return response()->json($category);
    }
    public function update(Request $request){
        $slug=Str::slug($request->slug);
        $isSlug=Category::whereSlug($slug)->whereNotIn('id',[$request->id])->first();
        $isName=Category::whereName($request->category)->whereNotIn('id',[$request->id])->first();
        if($isSlug or $isName){
            toastr()->error($request->category."adında kategori zaten mevcut");
            return back();
        }
        $category=Category::find($request->id);
        $category->name=$request->category;
        $category->slug=$slug;
        $category->save();
        toastr()->success('Kategori başarıyla düzenlendi');
        return back();
    }
    public function delete(Request $request){
        $category=Category::findOrFail($request->id);
        if($category->id==1){
            toastr()->error('Silinemez');
            return back();
        }
        $message=' ';
        $count=$category->articleCount();
        if($count>0){
            Article::where('category_id',$category->id)->update(['category_id'=>1]);
            $defaultCategory=Category::find(1);
            $message='Bu kategoriye ait'. $count .'makale'. $defaultCategory->name .'kategorisine taşındı.';
        }
        $category->delete();
        toastr()->success('Kategori başarıyla silindi',$message);
        return back();
    }
}
