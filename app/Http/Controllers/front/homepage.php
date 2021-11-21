<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;


class homepage extends Controller
{
//    public function __construct(){
//        view()->share('pages',"Page::orderBy(order','ASC')->get()");
//        view()->share('categories',"Category::inRandomOrder()->get()");
//
//}
    public function index(){
        $categories=Category::where('status',1)->inRandomOrder()->get();
        $articles=Article::join('categories',"categories.id","=","articles.category_id")->where('categories.status',1)->orderBy('articles.created_at','DESC')->paginate(2);
//        $articles=Article::with('getCategory')->where('status',1)->hasQuery(['getCategory',function($query){
//            $query->where('status',1);
//        }])->orderBy('created_at','DESC')->paginate(2);
        $pages=Page::where('status',1)->orderBy('order','ASC')->get();
        return view('front.homepage',compact('categories','articles','pages'));
    }
    public function single($slug){
        $article=Article::whereSlug($slug)->first()??abort(403,'Boyle bir yazı bulunamadı');
        $article->increment('hit');
        $data['articles']=$article;
        $data['categories']=Category::where('status',1)->inRandomOrder()->get();
        $data['pages']=Page::where('status',1)->orderBy('order','ASC')->get();
        return view('front.single',$data);
    }
    public function category($slug){
        $category=Category::whereSlug($slug)->first()??abort(403,'Boyle bir kategori bulunamadı');
        $data['articles']=Article::whereCategory_id($category->id)->where('status',1)->orderBy('created_at','DESC')->paginate(2);
        $data['category']=$category;
        $data['pages']=Page::where('status',1)->orderBy('order','ASC')->get();
        $data['categories']=Category::where('status',1)->inRandomOrder()->get();
        return view('front.category',$data);
    }
    public function page($slug){
        $page=Page::whereSlug($slug)->first()??abort(403,'Böyle bir sayfa bulunamadı');
        $data['page']=$page;
        $data['pages']=Page::where('status',1)->orderBy('order','ASC')->get();
        return view('front.page',$data);
    }
    public function contact(){
        $data['pages']=Page::where('status',1)->orderBy('order','ASC')->get();
        return view('front.contact',$data);
    }
    public function contactPost(Request $request){
        $rules=[
          'name'=>'required|min:2',
          'surname'=>'required|min:2',
          'email'=>'required|email',
          'topic'=>'required',
          'message'=>'required|min:10',
        ];
        $validate=Validator::make($request->post(),$rules);
        if($validate->fails()){
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }
        else {
            Contact::insert([
                'name'=>$request->name,
                'surname'=>$request->surname,
                'email'=>$request->email,
                'topic'=>$request->topic,
                'message'=>$request->message,//tek fark updated at i ve created at i otomatik oluşturmadı
                'updated_at'=>now(),
                'created_at'=>now()

            ]);
//            $contact = new Contact();
//            $contact->name = $request->name;
//            $contact->surname = $request->surname;
//            $contact->email = $request->email;
//            $contact->topic = $request->topic;
//            $contact->message = $request->message;
//            $contact->save();
            return redirect()->route('contact')->with('success', 'Mesajınız bize iletildi. Teşekkürler');
        }
    }
}
