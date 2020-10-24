@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Units</div>
    
                    <div class="card-body">
                        <form action="{{route('tags')}}" class="row" method="POST">
                            @csrf
                        
                            
                                <div class="form-group col-md-6">
                                    <label for="unit_name">tag name</label>
                                    <input type="text" name="tag_name" class="form-control" id="tag_name" placeholder="tag name" required>
                                    
                                </div>
                            

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary">Save New Tag</button>
                                </div>
                            
                        </div>
                    </form>
                        <div class="row ml-2 mr-2">
                            @foreach ($tags as $tag)
                                    <div class="col-md-3">
                                        <div class="alert alert-primary" role="alert">
                                            <span class="buttons-span">
                                                <span><a  class="edit-tag" data-tagId="{{$tag->id}}" data-tagName="{{$tag->tag}}" ><i class="fas fa-edit"></i></a></span>
                                                <span><a  class="delete-tag" data-tagId="{{$tag->id}}" data-tagName="{{$tag->tag}}"><i class="fas fa-trash-alt"></i></a></span>
                                            </span>
                                            <p>{{$tag->tag}}</p>
                                            <p></p>
                                        </div>    
                                    </div>
                                
                            @endforeach 
                            
                        </div>
                        <div class="row ml-4">
                            {{(!is_null($showLinks) && $showLinks) ? $tags->links() : ''}}
                        </div>

                        <form action="{{route('search-tags')}}" method="get">
                        @csrf
                        <div class="row ml-2">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="tag_search" name="tag_search" placeholder="Search">
                                </div>
                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal edit-window" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete Unit</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{route('tags')}}" method="POST" >
                        <div class="modal-body row">
                                <p id="edit-message"></p>
                                @csrf
                                <div class="form-group col-md-6">
                                    <label for="tag_name">Tag name</label>
                                    <input type="text" name="tag_name" class="form-control" id="edit_tag_name" placeholder="tag name" required>
                                    
                                </div>
                            
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="tag_id" value="" id="edit_tag_id">
                                
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal delete-window" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{route('tags')}}" method="POST" >
                        <div class="modal-body">
                                <p id="delete-message"></p>
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="tag_id" value="" id="delete_tag_id">
                                
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
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
    <script>
        $(document).ready(function(){
            
            var $deleteTag = $('.delete-tag');
            var $deleteWindow = $('.delete-window');
            var $deleteTagId = $('#delete_tag_id');
            var $deleteMessage = $('#delete-message');
            $deleteTag.on('click',function(e){
                e.preventDefault();
                var tagID = $(this).data('tagid');
                var tagName =  $(this).data('tagname');
                

                $deleteMessage.text('Are you sure you want to delete the tag '+tagName);
                $deleteTagId.val(tagID);
                $deleteWindow.modal('show');
            });
            
            var $editTag = $('.edit-tag');
            var $editWindow = $('.edit-window');
            var $editTagId = $('#edit_tag_id');
            var $editMessage = $('#edit-message');
            var $edit_tag_name = $('#edit_tag_name');
            

            $editTag.on('click',function(e){
                console.log('111111111111');
                e.preventDefault();
                var tagID = $(this).data('tagid');
                var tagName =  $(this).data('tagname');
                

                $edit_tag_name.val(tagName);
                $editTagId.val(tagID);

                $editMessage.text('Are you sure you want to edit the tag '+tagName);
                $editWindow.modal('show');
            });

            
        });
    </script>
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