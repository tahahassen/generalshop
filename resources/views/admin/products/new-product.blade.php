@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {!! !is_null($product) ? 'Update Product <span class="product-header-title">'.$product->title."</span>" : 'New Product' !!}
                </div>

                <div class="card-body">
                    <form action="{{ route('new-product')}}" enctype="multipart/form-data" class="row" method="POST">
                        @csrf
                             @if (!is_null($product))
                                 <input type="hidden" name="_method" value="put">
                                 <input type="hidden" name="product_id" value="{{$product->id}}">
                             @endif
                        
                            <div class="form-group col-md-6">
                                <label for="product_title">Product titel</label>
                                <input type="text" name="product_title" class="form-control" id="product_title" placeholder="product title" 
                            value="{{ !is_null($product) ? $product->title : ''}}" required>
                                
                            </div>

                            <div class="form-group col-md-12">
                                <label for="product_description">Product description</label>
                                <textarea  rows="10" name="product_description" class="form-control" id="product_description" placeholder="product description" required>
                                    {{ !is_null($product) ? $product->description : ''}}
                                </textarea>
                                
                            </div>
                        
                            <div class="form-group col-md-12">
                                <label for="product_category">Product category</label>
                                <select name="product_category" id="product_category" class="form-control" required>
                                    <option >Select a category</option>
                                    @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                    {{ (!is_null($product) && ($product->category->id === $category->id)) ? 'selected' : ''}}
                                    >{{$category->name}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            <div class="form-group col-md-12">
                                <label for="product_unit">Product unit</label>
                                <select name="product_unit" id="product_unit" class="form-control" required>
                                    <option >Select a unit</option>
                                    @foreach ($units as $unit)
                                <option value="{{$unit->id}}"
                                    {{ (!is_null($product) && ($product->has_unit->id === $unit->id)) ? 'selected' : ''}}
                                    >{{$unit->formatted()}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            <div class="form-group col-md-6">
                                <label for="product_discount">Product Discount</label>
                                <input type="number" class="form-control" id="product_discount" name="product_discount" placeholder="Product_discount"
                            value="{{ (!is_null($product)) ? $product->discount : ''}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="product_price">Product price</label>
                                <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Product_price"
                            value="{{ (!is_null($product)) ? $product->price : ''}}">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="product_price">Product Total</label>
                                <input type="number" class="form-control" id="product_total" name="product_total" placeholder="Product_total"
                            value="{{ (!is_null($product)) ? $product->total : ''}}">
                            </div>
                            
                            {{-- Options --}}
                            <div class="form-group col-md-12">
                                <table id="option-table" class="table table-striped">
                                    @if (!is_null($product))
                                        @if(!is_null($product->options))
                                            @foreach ($product->jsonOptions() as $optionKey => $options)
                                                @foreach ($options as $option)
                                                    <tr>
                                                        <td>
                                                            {{$optionKey}}
                                                        </td>
                                                        <td>
                                                            {{$option}}
                                                        </td>
                                                        <td>
                                                            <a href="" class="remove-option"><i class="fas fa-minus-circle"></i></a>
                                                            <input type="hidden" name="{{$optionKey}}[]" value="{{$option}}">
                                                        </td>
                                                        <td><input type="hidden" name="options[]" value="{{$optionKey}}"></td>
                                                    </tr>
                                                @endforeach    
                                            @endforeach
                                        @endif
                                    @endif
                                </table>
                                <a href="" class="btn btn-primary add-option-btn">Add Option</a>
                            
                            </div>

                            {{-- //Options --}}
                            
                            {{-- Images--}}
                            <div class="form-group col-md-12">
                                <div class="row">
                                    @for ($i = 0; $i < 6; $i++)
                                        <div class="col-md-4 col-sd-12 mb-4">
                                            <div class="card image-card-upload">   
                                                
                                                @if (!is_null($product))
                                                    @if(!is_null($product->images))
                                                        @if(count($product->images)>$i)
                                            <a href=""  data-imageid="{{$product->images[$i]->id}}" data-fileid="image-{{$i}}" data-removeid="remove-image-upload-{{$i}}" id="remove-image-upload-{{$i}}" class="remove-image-upload"><i class="fas fa-minus-circle"></i></a>
                                                        @else
                                                            <a href="" data-fileid="image-{{$i}}" style="display: none;" class="remove-image-upload"><i class="fas fa-minus-circle"></i></a>
                                                            
                                                        @endif
                                                    @endif    
                                                @else    
                                                    <a href="" style="display: none;"  data-fileid="image-{{$i}}" class="remove-image-upload"><i class="fas fa-minus-circle"></i></a>
                                                @endif

                                                <a href="#" class="activate-image-upload " data-fileid="image-{{$i}}">
                                                
                                                    @if (!is_null($product))
                                                        @if(!is_null($product->images))
                                                            @if(count($product->images)>$i)
                                                                <img id="iimage-{{$i}}" src="{{asset($product->images[$i]->url)}}" class="card-img-top">
                                                                <div class="card-body  image-{{$i}}" style="text-align: center;">
                                                                    <i style="display: none;" class="fas fa-image"></i>
                                                                </div>
                                                            @else
                                                                <div class="card-body  image-{{$i}}" style="text-align: center">
                                                                    <i class="fas fa-image"></i>
                                                                </div>
                                                            @endif
                                                        @endif    
                                                    @else    
                                                        <div class="card-body  image-{{$i}}" style="text-align: center">
                                                            <i class="fas fa-image"></i>
                                                        </div>
                                                    @endif
                                                </a>
                                                <input type="file" class="form-control-file image-file-upload" id="image-{{$i}}" name="product_images[]" size = '7000000'>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                                    
                            
                            {{-- //Images--}}

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Save New product</button>
                            </div>
                        
                        </form>
                    </div>
</div>
</div>
</div>

    <div class="modal option-window" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">New Option</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
                <div class="modal-body row">
                        <p id="edit-message"></p>
                        
                        <div class="form-group col-md-6">
                            <label for="option_name">Option name</label>
                            <input type="text" name="option_name" class="form-control" id="option_name" placeholder="option name" required>
                            
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="option_value">Option value</label>
                            <input type="text" name="option_value" class="form-control" id="option_value" placeholder="option value" required>
                            
                        </div>
                        
                        
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add-option-button">Add Option</button>
                </div>
            
          </div>
        </div>
    </div>

    <div class="modal image-window" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Image</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
                <div class="modal-body row">
                        <p id="delete-message">Are You Sure To Delete This Image  </p>
                        
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary remove-image-button">Delete Image</button>
                </div>
            
          </div>
        </div>
    </div>
</div>
    
    
@endsection

@section('scripts')
    <script>
         var optionNamesList = [];
         var imageDelete = '{{route('delete-image')}}';
    </script>
    @if (!is_null($product))
        @if(!is_null($product->options))
            @foreach ($product->jsonOptions() as $optionKey => $options)
                <script>
                    optionNamesList.push('{{ $optionKey}}');
                    console.log(optionNamesList);
                </script>
            @endforeach
        @endif
    @endif
    <script>

        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });
            var $optionWindow = $('.option-window');
            var $imageWindow = $('.image-window');
            var $addOptionBtn = $('.add-option-btn');
            var $optionTable  = $('#option-table');
            var $activatImageUpload = $('.activate-image-upload');
           
            var optionNamesRow = '';
            $addOptionBtn.on('click' , function(e){
                e.preventDefault();
                $optionWindow.modal('show');
            })

            $(document).on('click','.remove-option',function(e){
                e.preventDefault();
                $(this).parent().parent().remove();
            });
            
            $(document).on('click','.add-option-button',function(e){
                e.preventDefault();
                
                var $optionName = $('#option_name'); 
                var optionName = $optionName.val();
                if(optionName === ''){
                    alert('Option name is Required');
                    return false;
                }
                
                var $optionValue = $('#option_value');
                var optionValue = $('#option_value').val();
                if(optionValue === ''){
                    alert('Option value is Required');
                    return false;
                }

                if(!optionNamesList.includes($optionName.val())){
                    console.log(optionNamesList);
                    console.log($optionName.val());
                    optionNamesList.push($optionName.val());
                    optionNamesRow = '<td><input type="hidden" name="options[]" value="'+$optionName.val()+'"></td>'
                }

                var optionrow = '<tr>'+
                    '<td>'+
                        optionName+
                    '</td>'+
                    '<td>'+
                        optionValue+
                    '</td>'+
                    '<td>'+
                        '<a href="" class="remove-option"><i class="fas fa-minus-circle"></i></a>' +
                        '<input type="hidden" name="'+$optionName.val()+'[]" value="'+$optionValue.val()+'">'+
                    '</td>'+
                '</tr>';
                    $optionTable.append(optionrow);
                    $optionTable.append(optionNamesRow);
                    $optionValue.val('');
                
                

            });
            function resetFileUpload(fileUploadID,imageID,$eI){
                $('#'+imageID).attr('src','');
                $eI.fadeIn();
                $(fileUploadID).val('');
                
            }
            function readURL(input , imageID){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#'+imageID).attr('src', e.target.result)
                    }

                    reader.readAsDataURL(input.files[0]);
                   /// if ( $('#'+imageID).attr('src')  === "") {
                   // input.find('#'+imageID).remove();
                // }
                }
            }
            $activatImageUpload.on('click',function(e){
                e.preventDefault(); 
                var fileUploadID = $(this).data('fileid');
                $('#'+fileUploadID).trigger('click');
                var imagetag = '<img id="i'+fileUploadID+'" src="" class="card-img-top">';
                var me = $(this);
                
                $(this).append(imagetag);
                $('#'+fileUploadID).on('change', function(e){
                    readURL(this,'i'+fileUploadID);
                    me.find('i').fadeOut();
                    var $removeThisImage = me.parent().find('.remove-image-upload');
                    $removeThisImage.fadeIn();
                    $removeThisImage.on('click' , function(e){
                        e.preventDefault();
                        resetFileUpload('#'+fileUploadID , 'i'+fileUploadID , me.find('i'));
                        $removeThisImage.fadeOut();
                    })
                });
                
               
                
            });
            $('.remove-image-upload').on('click', function(e){
                e.preventDefault(); 
                var fileUploadID = $(this).data('fileid');
                var imageID = $(this).data('imageid');
                var $eI = $(this).parent().find('.activate-image-upload').find('i');
                var removeid =  $(this).data('removeid')
               // resetFileUpload('#'+fileUploadID , 'i'+fileUploadID , $eI);
                //$(this).fadeOut();
                $('.remove-image-button').data('fileUploadID', fileUploadID);
                $('.remove-image-button').data('imageid', imageID);
                $('.remove-image-button').data('removeid', removeid);
                $imageWindow.modal('show');
               
            });

            $(document).on('click','.remove-image-button',function(e){
                e.preventDefault();
                var imageID = $(this).data('imageid');
                var removeid = $(this).data('removeid');
                var fileUploadID = $(this).data('fileUploadID');
                $eI = $('.'+fileUploadID).find('i');
                resetFileUpload('#'+fileUploadID , 'i'+fileUploadID , $eI);
                $('#'+removeid).fadeOut();
                $.ajax({
                    url : imageDelete,
                    data : {image_id : imageID},
                    dataType : 'json',
                    method : 'post',
                });

                $imageWindow.modal('hide');


            });
        });
    </script>
    
@endsection