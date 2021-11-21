<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'ASC')->get();
        return view('back\articles\index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $request->validate([
            'title' => 'bail|required|min:3',
            'image' => 'bail|required|image|mimes:jpeg,png,jpg|max:2048',
            'message' => 'required|min:5',
            'category' => 'bail|required',
        ]);

            $slug = Str::slug($request->title);
            $article = new Article();
            $article->title = $request->title;
            $article->content = $request->message;
            $article->category_id = $request->category;
            $article->slug = $slug;
            if ($request->hasfile('image')) {
                $imageName = $slug . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads'), $imageName);
                $article->image = $imageName;
            }
            $article->save();
            toastr()->success('Başarılı', 'Makale başarıyla oluşturuldu.');
            return redirect()->route('makaleler.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articles=Article::findOrFail($id);
        $categories=Category::all();
        return view('back.articles.update',compact('categories','articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'text' => 'min:5',
            'category' => 'required',
        ]);
        //$validator=Validator::make($request->post(),$rules);

        $slug = Str::slug($request->title);
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->content = $request->message;
        $article->category_id = $request->category;
        $article->slug = $slug;
        if ($request->hasfile('image')) {
            $imageName = $slug. '.' .$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = $imageName;
        }
        $article->save();
        toastr()->success('Başarılı', 'Makale başarıyla güncellendi.');
        return redirect()->route('makaleler.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function trashed(){
        $articles=Article::onlyTrashed()->orderBy('deleted_at','ASC')->get();
        return view('back.articles.trashed',compact('articles'));
    }
    public function delete($id){
        Article::find($id)->delete();
        toastr()->success('Başarılı','Makale başarıyla silinenlere taşındı');
        return redirect()->route('makaleler.index');
    }
    public function recover($id){
        Article::onlyTrashed()->find($id)->restore();
        toastr()->success('Başarılı','Makale başarıyla kurtarıldı');
        return redirect()->route('makaleler.index');
    }
    public function hardDelete($id)
    {
        $article=Article::onlyTrashed()->find($id)->forceDelete();
        if(File::exists($article->image)){
            File::delete(public_path($article->image));
        }
        toastr()->success('Başarılı','Makale başarıyla silindi');
        return redirect()->route('makaleler.index');
    }
    public function switch(Request $request){
        $article=Article::findOrFail($request->id);
        $article->status=$request->statu=="true" ? 1 : 0;
        $article->save();
        toastr()->success('Başarıyla'.$article->status."yapıldı");
        return back();
    }
}
