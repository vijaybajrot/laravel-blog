<?php

Route::get('/', function () {
    echo route('admin-panel.page.create');die;
    return view('welcome');
});

Route::get('/{page_slug}.html', function ($slug) {
	$slug = str_replace(".html","",$slug);
    $page = \App\Page::whereSlug($slug)->first();
    if(!is_null($page)){
    	 return view('page',array('page'=>$page));
    }
    else{
		return view('welcome');
    }
});

Route::auth();

Route::post('/admin-authenticate', 'Admin\LoginController@authenticate');
Route::get('/admin-logout', 'Admin\LoginController@logout');

Route::get('/admin-panel/login', function () {
    redirect()->to("login");
});

Route::group(['middleware' => 'auth','namespace'=>'Admin','prefix'=>'admin-panel','name'=>'AdminUrl'], function() {
	Route::get('dashboard', function () {
	    return view('admin.dashboard');
	})->name('dashboard');
    //page 
    
    Route::get('page/update-status/{page}',['uses'=>'PageController@updateStatus','as'=>'admin-panel.page.updateStatus']);
    Route::get('page/search',['uses'=>'PageController@search','as'=>'admin-panel.page.search']);
    Route::resource('page','PageController');
    //post
    Route::get('post/update-status/{post}',['uses'=>'PostController@updateStatus','as'=>'admin-panel.post.updateStatus']);
    Route::get('post/search',['uses'=>'PostController@search','as'=>'admin-panel.post.search']);
    Route::resource('post','PostController');

    //post categories
    Route::get('category/search',['uses'=>'CategoryController@search','as'=>'admin-panel.category.search']);
    Route::resource('category', 'CategoryController');
    //role 
    Route::get('role/assign-roles', 'RoleController@assignRoles')->name("admin.assign-roles");
    Route::post('role/assign', 'RoleController@assign')->name("admin.assign");
    Route::resource('role', 'RoleController');
});

Route::get('/test',function (){
});
Route::get('/home', 'HomeController@index');
