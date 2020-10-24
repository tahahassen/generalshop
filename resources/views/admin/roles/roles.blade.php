@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Units</div>
    
                    <div class="card-body">
                        <div class="row">
                            @foreach ($roles as $role)
                                    <div class="col-md-3">
                                        <div class="alert alert-primary" role="alert">
                                            <h5>{{$role->role}}</h5>
                                            @foreach ($role->users as $item)
                                            <p> {{$item->formatedName()}}</p>
                                            @endforeach
                                            
                                        </div>    
                                    </div>
                                
                            @endforeach 
                            {{$roles->links()}}
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
@endsection