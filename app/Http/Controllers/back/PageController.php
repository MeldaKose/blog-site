<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('order','asc')->get();
        return view('back.pages.index', compact('pages'));
    }
    public function orders(Request $request){
        foreach ($request->get('page') as $key=>$order){
            Page::where('id',$order)->update(['order'=>$key]);
        }
    }
    public function switch(Request $request){
        $page=Page::findOrFail($request->id);
        $page->status=$request->statu=="true"?1:0;
        $page->save();
        return back();
    }
    public function create()
    {
        return view('back.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required|min:2',
            'image' => 'bail|required|mimes:jpg,jpeg,png|max:2048',
            'message' => 'bail|required|min:5',
        ]);
        $last = Page::latest()->first();
        $slug = Str::slug($request->title);
        $pages = new Page();
        $pages->title = $request->title;
        $pages->content = $request->message;
        $pages->slug = $slug;
        $pages->order = $last->order + 1;
        if ($request->hasFile('image')) {
            $imageName = $slug . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $pages->image = $imageName;
        }
        $pages->save();
        toastr()->success('Sayfa başarıyla oluşturuldu');
        return redirect()->route('pages.list');
    }

    public function update($id)
    {
        $pages = Page::findOrFail($id);
        return view('back.pages.update', compact('pages'));
    }

    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'title' => 'bail|required|min:2',
            'image' => 'bail|required|mimes:jpg,jpeg,png|max:2048',
            'message' => 'bail|required|min:5',
        ]);
        $slug = Str::slug($request->title);
        $pages = Page::findOrFail($id);
        $pages->title = $request->title;
        $pages->content = $request->message;
        $pages->slug = $slug;
        if ($request->hasFile('image')) {
            $imageName = $slug . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $pages->image = $imageName;
        }
        $pages->save();
        toastr()->success('Sayfa başarıyla güncellendi');
        return redirect()->route('pages.list');
    }

    public function delete($id)
    {
        $page=Page::findOrFail($id);
        if(File::exists($page->image)){
            File::delete(public_path('uploads'),$page->image);
        }
        $page->delete();
        toastr()->success('Sayfa başarıyla silindi.');
        return back();
    }
}
