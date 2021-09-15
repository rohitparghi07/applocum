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
        @include('admin.layout.page-header')

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
                    <h3 class="card-title">Product</h3>
                    <div class="card-tools">
                        <a class="btn btn-sm pull-right" href="{{ route('products.create') }}">
                            <i class="fas fa-plus"></i> Add New Product
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover dataTable" id="productTable">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('admin.product.delete-model')
@endsection
@section('js-footer')
    <script type="text/javascript">
        page_load();  

        function page_load() {
            console.log(AdminUrl);
            var table = $("#productTable").DataTable({
                responsive: true,
                paging: true,
                processing: true,
                serverSide: true,
                lengthMenu: [15],
                saveState: true,
                defaultContent: "-",
                bDestroy: true,
                ajax: {
                    url: AdminUrl+"getProductList",
                    type: "get",
                    dataType: "json",
                    dataSrc: function(res) {
                        return res["data"];
                    }
                },
                lengthChange: false,
                searching: true,
                info: true,
                autoWidth: false,
                language: {
                    emptyTable: "No data available"
                },
                columns: [
                    {
                        width: "5%",
                        data: "id",
                        orderable: true
                    },
                    {
                        width: "20%",
                        data: "category_name",
                        orderable: true
                    },
                    {
                        width: "20%",
                        data: "product_name",
                        orderable: true
                    },
                    {
                        width: "20%",
                        data: "description",
                        orderable: true
                    },
                    {
                        width: "13%",
                        data: "image",
                        orderable: true
                    },   
                    {
                        width: "6%",
                        orderable: false
                    },
                    {
                        width: "6%",
                        orderable: false
                    }
                ],
                columnDefs: [
                    { 
                        targets: [4],
                        render: function(a, b, data, d) {
                            var imageUrl="{{ url('public/image/product')}}";
                            imageUrl+="/"+data.image;
                            return '<img src="'+imageUrl+'" width="50" height="50">'
                        }
                    },  
                    {
                        // edit
                        targets: [5],
                        render: function(a, b, data, d) {
                            var url =AdminUrl+"products/"+data.id+"/edit";
                            return '<a href="'+url+'" data-id="'+data.id+'" class=""><i class="fa fa-edit"></i> Edit</a>';
                        }
                    },
                    {
                        // delete
                        targets: [6],
                        render: function(a, b, data, d) {
                            return '<a href="#" data-id="'+data.id+'" class="deleteProduct"><i class="fas fa-trash-alt"></i> Delete</a>';
                        }
                    }
                ],
                order: [[0, "desc"]],
            });
        }


         // delete user record with ajax call
    $("#product-delete").on("click",function(e){
        e.preventDefault();
        var id=  $("#delete-product-model #productId").val();
        $.ajax({
            url: AdminUrl+"deleteProduct",
            type: "post",
            dataType: "json",
            data: {
                id:id, 
                _token:postToken
            },
            success: function (response) {
                page_load();  
                $('#headerMsg').html("<div class='alert alert-success'><h4><i class='icon fa fa-check'></i> Success </h4> " + response.message + "</div>");
                setTimeout(() => {
                    $("#headerMsg").empty();
                }, 5000);
            },
            error: function (response) {
              
            }
        });
    });


    // delete user confirm message show 
    $(document).on("click",".deleteProduct",function(e){
        e.preventDefault();
        var id=$(this).data('id');
        $("#delete-product-model #productId").remove();
        $("<input>").attr({
            name: "id",
            id: "productId",
            type: "hidden",
            value: id
        }).appendTo("#delete-product-model");

        $("#delete-product-model").modal('show'); 

    });

    </script>
@endsection
