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
                    <h3 class="card-title">Category</h3>
                    <div class="card-tools">
                        {{-- <button type="button" class="btn btn-xs" onClick="javascript:void(0);" id="adduser"><i class="fas fa-plus"></i> Add</button> --}}
                        <a class="btn btn-sm pull-right" href="{{ route('category.create') }}">
                            <i class="fas fa-plus"></i> Add New Category
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover dataTable" id="categoryTable">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Sub Category</th>
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
    @include('admin.category.delete-model')
@endsection
@section('js-footer')
    <script type="text/javascript">
        page_load();  

        function page_load() {
            console.log(AdminUrl);
            var table = $("#categoryTable").DataTable({
                responsive: true,
                paging: true,
                processing: true,
                serverSide: true,
                lengthMenu: [15],
                saveState: true,
                defaultContent: "-",
                bDestroy: true,
                ajax: {
                    url: AdminUrl+"getCategoryList",
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
                        data: "name",
                        orderable: true
                    },
                    {
                        width: "13%",
                        data: "image",
                        orderable: true
                    },   
                    {
                        width: "13%",
                        orderable: false
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
                        targets: [2],
                        render: function(a, b, data, d) {
                            var imageUrl="{{ url('public/image/category')}}";
                            imageUrl+="/"+data.image;
                            return '<img src="'+imageUrl+'" width="50" height="50">'
                        }
                    },  
                    { 
                        // sub category
                        targets: [3],
                        render: function(a, b, data, d) {
                           var subCat='';
                            for (const iterator of data.sub_categories) {
                                subCat+=iterator.name+",";
                            }
                            subCat = subCat.substring(0, subCat.length - 1);
                            // for (const key in data.sub_categories) {
                            //     const element = data.sub_categories[key]+", ";
                            //     subCat+=element;
                            // }
                            return subCat;
                        }
                    },  
                    {
                        // edit
                        targets: [4],
                        render: function(a, b, data, d) {
                            var url =AdminUrl+"category/"+data.id+"/edit";
                            return '<a href="'+url+'" data-id="'+data.id+'" class="editUser"><i class="fa fa-edit"></i> Edit</a>';
                        }
                    },
                    {
                        // delete
                        targets: [5],
                        render: function(a, b, data, d) {
                            return '<a href="#" data-id="'+data.id+'" class="deleteCategory"><i class="fas fa-trash-alt"></i> Delete</a>';
                        }
                    }
                ],
                order: [[0, "desc"]],
            });
        }


         // delete user record with ajax call
    $("#category-delete").on("click",function(e){
        e.preventDefault();
        var id=  $("#delete-category-model #categoryId").val();
        $.ajax({
            url: AdminUrl+"deleteCategory",
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
    $(document).on("click",".deleteCategory",function(e){
        e.preventDefault();
        var id=$(this).data('id');
        $("#delete-category-model #categoryId").remove();
        $("<input>").attr({
            name: "id",
            id: "categoryId",
            type: "hidden",
            value: id
        }).appendTo("#delete-category-model");

        $("#delete-category-model").modal('show'); 

    });

    </script>
@endsection
