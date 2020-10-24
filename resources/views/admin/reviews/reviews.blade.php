

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Units</div>
    
                    <div class="card-body">
                        <div class="row">
                            @foreach ($reviews as $review)
                                    <div class="col-md-3">
                                        <div class="alert alert-primary" role="alert">
                                            <p>Product  : {{$review->product->title}}</p>
                                            <p>Customer : {{$review->customer->formatedName()}}</p>
                                            <p>{{$review->review}}</p>
                                            <p>stars :
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i<$review->stars)
                                                    <i class="fas fa-star"></i>
                                                    @else
                                                    <i class="far fa-star"></i>  
                                                    @endif
                                                @endfor
                                                
                                            </p>
                                            <p>date :{{$review->humanFormattedDate()}}</p>
                                        </div>    
                                    </div>
                                
                            @endforeach 
                            {{$reviews->links()}}
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
@endsection