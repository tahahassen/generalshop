<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories=Category::paginate(env('PAGINATE_COUNT'));
        return view('admin.categories.categories')->with([
            'categories'=>$categories,
            'showLinks' => true,
            ]);
    }

    private function categoryNameExists($categoryName){
        $category= category::where('name','=',$categoryName)->first();
        if(!is_null($category)){
            Session::flash('message','category Name '.$category->name.' already exists');
            return true;
        }
        return false;
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
            'category_name' => 'required',
        ]);
        
        
        $categoryName=$request->input('category_name');
      

        if($this->categoryNameExists($categoryName)){ 
             return redirect()->back();
        }
       
        
        
        $category = new category();
        $category->name = $request->input('category_name');
      
        $category->save();
        Session::flash('message', 'the category '.$category->name.' has been added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }
    public function search(Request $request){
        
        $request->validate([
            'category_search' => 'required'
        ]);
        $searchTerm = $request->input('category_search');

        $categories=category::where(
            'name' , 'LIKE' , '%'.$searchTerm.'%'
        )->get();
        if(count($categories) > 0) {
            return view('admin.categories.categories')->with([
                'categories' => $categories,
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
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
        
        $request->validate([
            'category_id' => 'required',
            'category_name' => 'required',
        ]);

        $categoryName=$request->input('category_name');
      

        if($this->categoryNameExists($categoryName)){ 
            return redirect()->back();
       }
       
        $categoryID = intval($request->input('category_id'));
        $category = category::find($categoryID);

        $category->name = $request->input('category_name');
       
        $category->save();
        Session::flash('message','category '.$category->name.' has been apdated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        if( is_null($request->input('category_id')) || empty($request->input('category_id')) ){
            Session::flash('message','category ID is required');
            return redirect()->back();  
        }
        
        $id=$request->input('category_id');
        category::destroy($id);
        Session::flash('message', 'the category has been deleted');
        return redirect()->back();
    }
}
