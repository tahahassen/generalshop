@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Categories</div>
    
                    <div class="card-body">
                        <form action="{{route('categories')}}" class="row" method="POST">
                            @csrf
                        
                            
                                <div class="form-group col-md-6">
                                    <label for="category_name">category name</label>
                                    <input type="text" name="category_name" class="form-control" id="category_name" placeholder="category name" required>
                                    
                                </div>
                            

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary">Save New category</button>
                                </div>
                            
                        </div>
                        </form>
                        <div class="row">
                            @foreach ($categories as $category)
                                    <div class="col-md-3">
                                        <div class="alert alert-primary" role="alert">
                                            <span class="buttons-span">
                                                <span><a  class="edit-category" data-categoryId="{{$category->id}}" data-categoryName="{{$category->name}}" ><i class="fas fa-edit"></i></a></span>
                                                <span><a  class="delete-category" data-categoryId="{{$category->id}}" data-categoryName="{{$category->name}}"><i class="fas fa-trash-alt"></i></a></span>
                                            </span>
                                            <p>{{$category->name}}</p>
                                            <p></p>
                                        </div>    
                                    </div>
                                
                            @endforeach 
                        </div>
                        <div class="row ml-4">
                            {{(!is_null($showLinks) && $showLinks) ? $categories->links() : ''}}
                        </div>

                    <form action="{{route('search-categories')}}" method="get">
                        @csrf
                        <div class="row ml-2">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="category_search" name="category_search" placeholder="Search">
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
                      <h5 class="modal-title">Delete category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{route('categories')}}" method="POST" >
                        <div class="modal-body row">
                                <p id="edit-message"></p>
                                @csrf
                                <div class="form-group col-md-6">
                                    <label for="category_name">category name</label>
                                    <input type="text" name="category_name" class="form-control" id="edit_category_name" placeholder="category name" required>
                                    
                                </div>
                            
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="category_id" value="" id="edit_category_id">
                                
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
                    <form action="{{route('categories')}}" method="POST" >
                        <div class="modal-body">
                                <p id="delete-message"></p>
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="category_id" value="" id="delete_category_id">
                                
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
            
            var $deleteCategory = $('.delete-category');
            var $deleteWindow = $('.delete-window');
            var $deleteCategoryId = $('#delete_category_id');
            var $deleteMessage = $('#delete-message');
            $deleteCategory.on('click',function(e){
                e.preventDefault();
                var categoryID = $(this).data('categoryid');
                var categoryName =  $(this).data('categoryname');
                

                $deleteMessage.text('Are you sure you want to delete the category '+categoryName);
                $deleteCategoryId.val(categoryID);
                $deleteWindow.modal('show');
            });
            
            var $editCategory = $('.edit-category');
            var $editWindow = $('.edit-window');
            var $editCategoryId = $('#edit_category_id');
            var $editMessage = $('#edit-message');
            var $edit_category_name = $('#edit_category_name');
            

            $editCategory.on('click',function(e){
                console.log('111111111111');
                e.preventDefault();
                var categoryID = $(this).data('categoryid');
                var categoryName =  $(this).data('categoryname');
                

                $edit_category_name.val(categoryName);
                $editCategoryId.val(categoryID);

                $editMessage.text('Are you sure you want to edit the category '+categoryName);
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