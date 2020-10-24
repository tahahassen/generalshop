<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    //

    public function index()
    {
        $tags = Tag::paginate(env('PAGINATE_COUNT'));

        return view('admin.tags.tags')->with([
            'tags' => $tags,
            'showLinks' => true,
        ]); 
    }

   
    private function tagNameExists($tagName){
        $tag= tag::where('tag','=',$tagName)->first();
        if(!is_null($tag)){
            Session::flash('message','tag Name '.$tag->tag.' already exists');
            return true;
        }
        return false;
    }

    
    
    public function showAdd()
    {
        return view('admin.tags.add_edit');
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tag_name' => 'required',
            
        ]);
        
        
        $tagName=$request->input('tag_name');
       

        if($this->tagNameExists($tagName)){ 
             return redirect()->back();
        }
        
        
        
        $tag = new Tag();
        $tag->tag = $request->input('tag_name');
        
        $tag->save();
        Session::flash('message', 'the tag '.$tag->tag.' has been added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(tag $tag)
    {
        //
    }
    public function search(Request $request){
        
        $request->validate([
            'tag_search' => 'required'
        ]);
        $searchTerm = $request->input('tag_search');

        $tags=tag::where(
            'tag' , 'LIKE' , '%'.$searchTerm.'%'
        )->get();
        if(count($tags) > 0) {
            return view('admin.tags.tags')->with([
                'tags' => $tags,
                'showLinks' => false,
            ]); 
        }
        Session::flash('message','Nothing Found !!');
        return redirect()->back();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tag $tag)
    {
        //
        
        $request->validate([
            'tag_id' => 'required',
            'tag_name' => 'required',
        ]);

        $tagName=$request->input('tag_name');

        if($this->tagNameExists($tagName)){ 
            return redirect()->back();
       }
       
        $tagID = intval($request->input('tag_id'));
        $tag = tag::find($tagID);

        $tag->tag_name = $request->input('tag_name');
        
        $tag->save();
        Session::flash('message','tag '.$tag->tag_name.' has been apdated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        if( is_null($request->input('tag_id')) || empty($request->input('tag_id')) ){
            Session::flash('message','tag ID is required');
            return redirect()->back();  
        }
        
        $id=$request->input('tag_id');
        tag::destroy($id);
        Session::flash('message', 'the tag has been deleted');
        return redirect()->back();
    }
}

