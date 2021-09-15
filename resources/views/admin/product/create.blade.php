@php
    $dashboard="Dashboard";
    $displayMasterName = "Products";
    $routeFrom="product";
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
                    <h3 class="card-title">Add Product</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}"  id="category-forms"  enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="required" for="category_id">Category Name</label>
                                    <select class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                                        <option value="" selected> Select Category </option>
                                        @foreach($categories as $id => $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category_id'))
                                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                    @endif
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="required" for="name">Product Name</label>
                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}" required>
                                    @if($errors->has('name')) 
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    <span class="help-block"></span>
                                </div>
                            </div>
                          
                        </div>	
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="required" for="name">Image</label>
                                    <input type="file" name="image" class="form-control" placeholder="" required>
                                    @if($errors->has('image')) 
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                    <span class="help-block"></span>
                                </div>
                            </div>
                          
                        </div>	
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="required" for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="8" required>{{ old('description') }}</textarea>
                                    @if($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                    <span class="help-block"></span>
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
    
    </script>
@endsection
