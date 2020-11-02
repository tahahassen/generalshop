@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">Products <a href="{{route('new-product')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i></a></div>
    
                    <div class="card-body">
                        <div class="row">
                            @foreach ($products as $product)
                                    <div class="col-md-4">
                                        <div class="alert alert-primary" role="alert">
                                            <h5>{{$product->title}}</h5>
                                            <p>Category: {{ $product->category->name}}</p>
                                            <p>Price: {{$currency_code}}{{$product->price}}</p>
                                            {!!(count($product->images)>0) ? '<img class="img_thumbnail card-img" src="'.$product->images[0]->url.'"/>' : ''!!}
                                            @if(!is_null($product->options))
                                                    @foreach ($product->jsonOptions() as $optionKey => $options)
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="{{$optionKey}}">{{$optionKey}}</label>
                                                            </div>
                                                            <select type="text" name="{{$optionKey}}" id="{{$optionKey}}" class="form-control">
                                                                @foreach ($options as $option)
                                                                    <option value="{{$option}}">{{$option}}</option>
                                                                @endforeach    
                                                            </select>
                                                        </div>
                                                        
                                                        
                                                    @endforeach
                                            @endif
                                            <a href="{{route('update-product',[ 'id' => $product->id ])}}" class="btn btn-primary"> Update Product</a>
                                        </div>    
                                    </div>
                                
                            @endforeach 
                            <div class="row ml-4">
                                {{(!is_null($showLinks) && $showLinks) ? $products->links() : ''}}
                            </div>
    
                        <form action="{{route('search-products')}}" method="get">
                            @csrf
                            <div class="row ml-2">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="product_search" name="product_search" placeholder="Search">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            @if(Session::has('message'))
                <div class="toast" style="position: absolute; top: 20px; right: 20px;">
                <div class="toast-header">
                    <img src="..." class="rounded mr-2" alt="...">
                    <strong class="mr-auto">Bootstrap</strong>
                    <small>11 mins ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    
                    {{  Session::get('message')}}
                   
                </div>
                </div>
            @endif
    </div>
@endsection
@section('scripts')
    
    @if(Session::has('message'))
        <script>
            $(document).ready(function($){
            var $toast=$('.toast').toast({
            autohide : false
            });
            $toast.toast('show');
            })
        </script> 
    @endif   
@endsection