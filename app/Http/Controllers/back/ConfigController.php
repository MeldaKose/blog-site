<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $config=Config::find(1);
        return view('back.config.index',compact('config'));
    }
    public function update(Request $request){
        $config=Config::find(1);
        $config->title=$request->title;
        $config->active=$request->active;
        $config->facebook=$request->facebook;
        $config->twitter=$request->twitter;
        $config->github=$request->github;
        $config->linkedin=$request->linkedin;
        $config->youtube=$request->youtube;
        $config->instagram=$request->instagram;
        if($request->hasFile('logo')){
            $logoName=Str::slug($request->title).'-logo'.'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'),$logoName);
            $config->logo=$logoName;
        }
        if($request->hasFile('favicon')){
            $faviconName=Str::slug($request->title).'-favicon'.'.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads'),$faviconName);
            $config->favicon=$faviconName;
        }
        $config->save();
        toastr()->success('Ayarlar başarıyla güncellendi.');
        return back();
    }
}
