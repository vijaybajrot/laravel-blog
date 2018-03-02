<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;

class PostController extends Controller
{
    //Per Page Record Limit
    protected $limit = 20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //\DB::enableQueryLog();
        $posts = Post::with('categories')->latest()->paginate($this->limit);
        //dd(\DB::getQueryLog());
        return view("admin.post.list",compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $categories = array_pluck($categories->toArray(), 'name','id');
        return view("admin.post.add",compact("categories"));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validator($request);

        $post = new Post;
        $post->slug = str_slug($request->title);
        if(!is_null($post->whereSlug(str_slug($request->title))->first())){
            flashMessage("Post Slug Allready Used , try another", "error");
            return back();
        }
        $post->published_at = $request->publish==true ? \Carbon\Carbon::now() : null;
        $post->fill($request->except('_token','categories'));
        $post->save();
        // Save Post Categories
        $post->categories()->attach($request->categories);

        flashMessage("Post Created Successfully", "success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view("admin.post.show",compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $categories = array_pluck($categories->toArray(), 'name','id');

        if (\Gate::denies('admin.edit-post,test.edit-post',\Auth::user())) {
            abort(403,"Cannot Acssess !");
        }

        return view("admin.post.edit",compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->validator($request);
        if(is_null($post->published_at) && $request->publish!=$post->publish){
            $post->published_at = $request->publish==true ? \Carbon\Carbon::now() : null;
        }
        if ($request->user()->cannot('admin.edit_post')) {
            abort(403);
        }

        $post->fill($request->except('_token','categories'));
        $post->save();
        // Update Post Categories
        if(!empty($request->categories)){
            $post->categories()->sync($request->categories);    
        }
        
        flashMessage("Post informations updated successfully", "success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->categories()->detach();
        $post->delete();
        flashMessage("Post deleted from database", "success");
        return back();
    }

    public function validator($request)
    {
        $this->validate($request,[
            "title" => "required|max:100",
            "content" => "required",
            "excerpt" => "required",
        ]);
    }

     public function updateStatus(Request $request, Post $post)
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
                return redirect()->route('admin-panel.post.index');
            }
            $post->publish = $status;
            $post->published_at = $status==true ? \Carbon\Carbon::now() : null;
            $post->save();
            flashMessage("Post {$responseMessage} Successfully ","success");
            return redirect()->route('admin-panel.post.index');
        }
    }

    public function search(Request $request)
    {
        if($request->has('q')){
            $searchKeyword = $request->get('q');
            $posts = Post::latest()->search($searchKeyword)->paginate($this->limit);
            return view("admin.post.list",compact('posts')); 
        }else{
            flashMessage("Search Keyword not found, try again", "error");
            return back();
        }
    }
}
