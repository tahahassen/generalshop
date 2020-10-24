@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Units</div>
    
                    <div class="card-body">
                        <div class="row">
                            @foreach ($tickets as $ticket)
                                    <div class="col-md-3">
                                        <div class="alert alert-primary" role="alert">
                                            <p>{{$ticket->title}}</p>
                                            <p>{{$ticket->ticket_type->type}}</p>
                                            <p>{{$ticket->user->formatedName()}}</p>
                                            <p>{{$ticket->order_id}}</p>
                                            <p>{{$ticket->message}}</p>
                                            <p>{{$ticket->status}}</p>
                                            <p></p>
                                        </div>    
                                    </div>
                                
                            @endforeach 
                            {{$tickets->links()}}
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
@endsection