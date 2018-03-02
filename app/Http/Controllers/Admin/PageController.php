<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Page;
use App\Http\Controllers\TestController;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('admin.page.list',compact('pages'));
    }

    public function search(Request $request)
    {
        if($request->has("q")){
            $searchQuery = $request->get("q");
            $pages = Page::search($searchQuery)->latest()->paginate(10);
            return view('admin.page.list',compact('pages'));
        }else{
            flashMessage("Search keyword not found","error");
            return redirect()->route('admin-panel.page.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->vlaidator($request);

       $page = new Page();
       $slug = str_slug($request->title);
       $hasPage  = Page::whereSlug($slug)->first();
       
       if(!is_null($hasPage)){
            flashMessage("Page Slug allready used, try another.","error");
            return redirect()->back();
       }

       $page->slug = $slug;
       $page->fill($request->all());
       $page->published_at =  \Carbon\Carbon::now();
       $page->save();
       
       flashMessage("Page created successfully","success");
       return back();
    }

    public function checkSlug($slug)
    {
       $page  = Page::whereSlug($slug)->first();
       if(!is_null($page)){
            flashMessage("Page Slug allready used, try another.","error");
            return redirect()->to('admin-panel.page.create');
       }
       return $slug;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);
        dd($page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.page.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
         $this->vlaidator($request);

         $page->fill($request->all());
         $page->save();

         flashMessage("Page information updated successfully","success");
         return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        flashMessage("Page deleted successfully","success");
        return back();
    }

    public function vlaidator($request)
    {
        $this->validate($request,array(
            "title" => "required|max:100",
            "content" => "required",
        ));        
    }

    public function updateStatus(Request $request, Page $page)
    {
        $status = false;
        $responseMessage = "Unpublished";

        if($request->has('action')){
            $action = $request->input('action');
            if($action=='publish'){
                $status = true;
                $responseMessage = "Published";
            }elseif($action=='unpublish'){
                $status = false;
                $responseMessage = "Unpublished";
            }
            else{
                flashMessage("Un-authorised action given,try again","danger");
                return redirect()->route('admin-panel.page.index');
            }
            $page->publish = $status;
            $page->save();
            flashMessage("Page {$responseMessage} Successfully ","success");
            return redirect()->route('admin-panel.page.index');
 
        }
        else{
            flashMessage("Page action not found ","danger");
            return redirect()->route('admin-panel.page.index');
        }
        
        
    }
}
