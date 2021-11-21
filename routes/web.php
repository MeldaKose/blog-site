<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------

*/

Route::get('/admin/login', 'back\authcontroller@login')->middleware('isLogin')->name('admin.login');
Route::post('/admin/loginpost', 'back\authcontroller@loginPost')->name('login.post');
Route::get('/admin/categorylist', 'back\dashboard@categoryList')->name('category.list');

Route::prefix('/admin')->middleware('isAdmin')->group(function () {
    Route::get('/panel', 'back\dashboard@index')->name('admin.dashboard');

    //Category
    Route::get('/kategori', 'back\CategoryController@index')->name('category.index');
    Route::post('/kategori/ekle', 'back\CategoryController@create')->name('category.create');
    Route::get('/kategori/getdata', 'back\CategoryController@getData')->name('category.getdata');
    Route::post('/kategori/update', 'back\CategoryController@update')->name('category.update');
    Route::post('/kategori/delete', 'back\CategoryController@delete')->name('category.delete');
    Route::get('/kategori/status','back\CategoryController@switch')->name('category.switch');
//Article
    Route::get('/makaleler/silinenler', 'back\ArticleController@trashed')->name('article.trashed');
    Route::resource('/makaleler', 'back\ArticleController');
    Route::get('/deletearticle/{id}', 'back\ArticleController@delete')->name('delete.article');
    Route::get('/recoverarticle/{id}', 'back\ArticleController@recover')->name('recover.article');
    Route::get('/harddeletearticle/{id}', 'back\ArticleController@hardDelete')->name('hard.delete.article');
    Route::get('/switch', 'back\ArticleController@switch')->name('article.switch');
//Pages
    Route::get('/sayfalar/liste', 'back\PageController@index')->name('pages.list');
    Route::get('/sayfalar/olustur', 'back\PageController@create')->name('pages.create');
    Route::post('/sayfalar/olustur', 'back\PageController@store')->name('pages.create.post');
    Route::get('/sayfalar/guncelle/{id}', 'back\PageController@update')->name('pages.update');
    Route::post('/sayfalar/guncelle/{id}', 'back\PageController@updatePost')->name('pages.update.post');
    Route::get('/sayfalar/sil/{id}', 'back\PageController@delete')->name('pages.delete');
    Route::get('/sayfalar/siralama', 'back\PageController@orders')->name('pages.orders');
    Route::get('/sayfalar/status', 'back\PageController@switch')->name('pages.switch');
//config
    Route::get('/ayarlar', 'back\ConfigController@index')->name('config.index');
    Route::post('/ayarlar','back\ConfigController@update')->name('config.update');


    Route::get('/cikis', 'back\authcontroller@logout')->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'front\Homepage@index')->name('homepage');
Route::get('/contact', 'Front\Homepage@contact')->name('contact');
Route::post('contact', 'Front\Homepage@contactPost')->name('contactpost');
Route::get('/category/{slug}', 'front\Homepage@category')->name('category');
Route::get('/blog/{slug}', 'front\Homepage@single')->name('single');
Route::get('/{pages}', 'front\Homepage@page')->name('pages');
