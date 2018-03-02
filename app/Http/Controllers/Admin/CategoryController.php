<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    protected $limit;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //\DB::enableQueryLog();
        $categories = Category::withCount("posts")->latest()->paginate($this->limit);
        //dd(\DB::getQueryLog());
        return view("admin.category.list",compact('categories'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        if(!is_null(Category::whereSlug(str_slug($request->name))->first())){
            flashMessage("Slug is Allready Used Try Again", "error");
            return back();
        }
        $category->slug = str_slug($request->name);
        $category->fill($request->all());
        $category->save();

        flashMessage("Category Added Successfully", "success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        dd($category->posts()->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            "name"=>"required"
        ]);
        $category->fill($request->all());
        $category->save();

        flashMessage("Category Updated Successfully", "success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        flashMessage("Category Deleted Successfully", "success");
        return back();
    }
}
