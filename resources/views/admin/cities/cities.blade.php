@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Units</div>
    
                    <div class="card-body">
                        <div class="row">
                            @foreach ($cities as $city)
                                    <div class="col-md-3">
                                        <div class="alert alert-primary" role="alert">
                                            <p>{{$city->name}}</p>
                                            <p>State : {{$city->country->name}}</p>
                                            <p>Country  : {{$city->state->name}}</p>
                                            <p></p>
                                        </div>    
                                    </div>
                                
                            @endforeach 
                            {{$cities->links()}}
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
@endsection