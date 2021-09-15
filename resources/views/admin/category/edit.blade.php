@php
    $dashboard="Dashboard";
    $displayMasterName = "Categories";
    $routeFrom="category";
@endphp

@extends('admin.layout.app')

<script type="text/javascript">
</script>

@section('content-header')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{-- @include('admin.layout.page-header') --}}

        <!-- Main content -->
        <section class="content">

            <div id="headerMsg" class="error_msg">
                @if(session()->has("error") || session()->has("success"))
                    <div class="alert {{session()->has('error') ? 'alert-danger' : 'alert-success' }}">
                        <h4><i class='icon fa fa-check'></i>{{session()->has('error') ? 'Warning' : 'Success'}}</h4>
                        {{session()->has('error') ? session()->get('error') : session()->get('success') }}
                    </div>
                @endif
            </div><br>

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Edit Category</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('category.update',[$category->id]) }}"  id="category-forms"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{  $category->id}}">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="required" for="name">Name</label>
                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name',$category->name? $category->name:'') }}" required>
                                    @if($errors->has('name')) 
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    <span class="help-block"></span>
                                </div>
                            </div>
                          
                        </div>	
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Old Category Image</strong>
                                    @if($category->image)
                                        <img id="original" src="{{ url('public/image/category/'.$category->image) }}" height="70" width="70">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="required" for="name">Image</label>
                                    
                                    <input type="file" name="image" class="form-control" placeholder="" >
                                    @if($errors->has('image')) 
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>	

                        <br><br>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="" for="n">
                                        <a class="btn btn-lg pull-right addSubCat" >
                                            <i class="fas fa-plus"></i> Add Sub Category
                                        </a>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="listSubCategory">
                                        @foreach ($category->subCategories as $item)
                                            <input type="text" class="form-control" name="sub-category-name[]" value="{{ $item->name}}">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                          
                        </div>	
                       

                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                              Submit
                            </button>
                        </div> 
                    </form>
                    
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js-footer')
    <script type="text/javascript">
     $(document).ready(function () {
            

            $(document).on('click','.addSubCat',function(e){
                $("<input>").attr({
                    name: "sub-category-name[]",
                    type: "text",
                    class:'form-control',
                    placeholder:'Sub Category'
                }).appendTo(".listSubCategory");
            })
        });
    </script>
@endsection
