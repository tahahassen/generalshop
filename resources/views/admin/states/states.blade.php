@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Units</div>
    
                    <div class="card-body">
                        <div class="row">
                            @foreach ($states as $state)
                                    <div class="col-md-3">
                                        <div class="alert alert-primary" role="alert">
                                            <p>{{$state->name}}</p>
                                            <p>Country  : {{$state->country->name}}</p>
                                            
                                        </div>    
                                    </div>
                                
                            @endforeach 
                            {{$states->links()}}
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
@endsection