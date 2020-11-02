<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Product;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //

    public function index(){
        $products=Product::with(['category','images'])->paginate(env('PAGINATE_COUNT'));
        $currencyCode=env("CURRENCY_CODE","DZ");
        return view('admin.products.products')->with([
            'products'=>$products,
            'currency_code'=>$currencyCode,
            'showLinks' => true,
         
            ]);
    }

    public function newProduct($id=null){
        $product=null;
        $units=Unit::All();
        $categories=Category::All();
        if(!is_null($id)){
            $product=Product::with(['has_unit','category'])->find($id);
           
            
        }

        return view('admin.products.new-product')->with([
            'product'       => $product,
            'units'         =>$units,
            'categories'    =>$categories,
        ]);
    }

    public function delete(){

    }

    public function update(Request $request){
        
        $request->validate([
            'product_title' => 'required',
            'product_description' => 'required',
            'product_unit' => 'required',
            'product_price' => 'required',
            'product_discount' => 'required',
            'product_total' => 'required',
            'product_category' => 'required',
        ]);
        
        $productID = $request->input('product_id');
        $product = Product::find($productID);
        $this->writProduct($request,$product);    
            Session::flash('message','Product has been updated');
            return redirect(route('products'));

    }

    private function writProduct(Request $request, Product $product){
        $product->title       = $request->input('product_title');
            $product->description = $request->input('product_description');
            $product->unit        = intval($request->input('product_unit'));
            $product->price       = doubleval($request->input('product_price'));
            $product->discount    = doubleval($request->input('product_discount'));
            $product->total       = doubleval($request->input('product_tiproduct_totaltle'));
            $product->category_id    = intval($request->input('product_category'));

            if($request->has('options')){
                $optionArray = [];
                $options = array_unique($request->input('options'));
                foreach($options as $option){
                    $actualOptions = $request->input($option);
                    $optionArray[$option] =[];
                    foreach($actualOptions as $actualOption){
                        array_push($optionArray[$option],$actualOption);
                    } 
                }
                $product->options = json_encode($optionArray);
            }
            $product->save();
            if($request->hasFile('product_images')){
                
                $images = $request->file('product_images');
                foreach($images as $image){
                    $path = $image->store('public');
                    $image = new Image();
                    $image->url = $path;
                    $image->product_id = $product->id;
                    $image->save();
                }
            }
            return $product;

    }
    public function store(Request $request){
        
        $request->validate([
            'product_title' => 'required',
            'product_description' => 'required',
            'product_unit' => 'required',
            'product_price' => 'required',
            'product_discount' => 'required',
            'product_total' => 'required',
            'product_category' => 'required',
        ]);
           
        $product = new Product();
        $this->writProduct($request,$product);    
            Session::flash('message','Product has been added');
            return redirect(route('products'));

    }

    public function search(Request $request){
        
        $request->validate([
            'product_search' => 'required'
        ]);
        $searchTerm = $request->input('product_search');
        $currencyCode=env("CURRENCY_CODE","DZ");
        $products=Product::where(
            'title' , 'LIKE' , '%'.$searchTerm.'%'
        )->get();
        if(count($products) > 0) {
            return view('admin.products.products')->with([
                'products' => $products,
                'currency_code'=>$currencyCode,
                'showLinks' => false,
            ]); 
        }
        Session::flash('message','Nothing Found !!');
        return redirect()->back();
    }

    public function deleteImage(Request $request){
        $imageID=$request->input('image_id');
        Image::destroy($imageID);
    }
}
