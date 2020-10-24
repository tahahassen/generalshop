@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Units</div>
    
                    <div class="card-body">
                        <div class="row">
                            @foreach ($countries as $country)
                                    <div class="col-md-3">
                                        <div class="alert alert-primary" role="alert">
                                            <p>{{$country->name}}</p>
                                            <p>Currency : {{$country->currency}}</p>
                                            <p>Capital  : {{$country->capital}}</p>
                                            <p></p>
                                        </div>    
                                    </div>
                                
                            @endforeach 
                            {{$countries->links()}}
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
@endsection