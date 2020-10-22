@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Units</div>
    
                    <div class="card-body">
                        <div class="row">
                            @foreach ($tags as $tag)
                                    <div class="col-md-3">
                                        <div class="alert alert-primary" role="alert">
                                            <p>{{$tag->tag}}</p>
                                            <p></p>
                                        </div>    
                                    </div>
                                
                            @endforeach 
                            {{$tags->links()}}
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
@endsection