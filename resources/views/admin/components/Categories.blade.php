@extends('admin.layouts.admin')
@section('css')
    <style>
        .dropdown-content {
            margin: -10px;
        }

    </style>
@endsection
@section('content')

    <div class="row mt-5">
        <div class="col-md-10 offset-md-1 border border-dark">
            <div id="mainDivCategory" class="container-fluid d-none">
                <div class="row">
                    <div class="col-md-12 p-2">
                        <button id="addBtnCategory" class="btn btn-sm btn-danger my-3">Add New</button>
                        <table id="CategoryDataTable" class="table table-striped table-bordered" width="100%">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>Image</th>
                                    <th>Icon</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="Category_Table">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="loadDivCategory" class="container">
                <div class="row">
                    <div class="col-md-12 p-5 text-center">
                        <img class="loding-icon m-5" src="{{ asset('loader.svg') }}" alt="">

                    </div>
                </div>
            </div>
            <div id="wrongDivCategory" class="container d-none">
                <div class="row">
                    <div class="col-md-12 p-5 text-center">
                        <h3>Something Went Wrong!</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category add -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ml-5">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="CategoryName" type="text" id="" class="form-control my-5"
                                    placeholder="Category Name">

                                <input type="file" id="iconCategory" class="form-control" name="text-input">
                                <img id="addCategoryIconPreview" style="height: 100px !important;" class="imgPreview mt-3 "
                                    src="{{ asset('images/default-image.png') }}" />
                            </div>
                            <div class="col-md-6">
                                <select name="Categories" id="Categories" class="form-control my-5">

                                </select>


                                <input type="file" id="imageCategory" class="form-control" name="text-input">
                                <img id="addCategoryImagePreview" style="height: 100px !important;" class="imgPreview mt-3 "
                                    src="{{ asset('images/default-image.png') }}" />
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="CategoryAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Category add -->
    <!-- Modal Category Delete -->
    <div class="modal fade" id="deleteModalCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body p-3 text-center">
                    <h5 class="mt-4">Do you want to Delete</h5>
                    <h5 id="CategoryDeleteId" class="mt-4 d-none "></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button data-id="" id="confirmDeleteCategory" type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Category Delete -->

@endsection


@section('script')

    <script>
        getCategorydata();

        function getCategorydata() {
            axios.get("{{ route('admin.getCategoriesData') }}")

                .then(function(response) {
                    console.log(response.data);
                    if (response.status = 200) {

                        $('#mainDivCategory').removeClass('d-none');
                        $('#loadDivCategory').addClass('d-none');
                        $('#CategoryDataTable').DataTable().destroy();
                        $('#Category_Table').empty();
                        var count = 1;
                        var dataJSON = response.data;

                        // var html='';


                        $.each(dataJSON, function(i, item) {
                            $('<tr class="text-center">').html(
                                "<td>" + count++ + " </td>" +
                                "<td>" + dataJSON[i].name + " </td>" +
                                "<td><img width='200px' height='80' class='table-img' src=" + dataJSON[i]
                                .banner_image + "> </td>" +
                                "<td><img width='200px' height='80' class='table-img' src=" + dataJSON[i]
                                .icon + "> </td>" +
                                "<td><a class='CategoryDeleteIcon' data-id=" + dataJSON[i].id +
                                "><i class='fas fa-edit'></i></a> </td>" +
                                "<td><a class='CategoryDeleteIcon' data-id=" + dataJSON[i].id +
                                "><i class='fas fa-trash-alt'></i></a> </td>"
                            ).appendTo('#Category_Table');
                        });
                        //Category click on delete icon
                        $(".CategoryDeleteIcon").click(function() {
                            var id = $(this).data('id');
                            $('#CategoryDeleteId').html(id);
                            $('#deleteModalCategory').modal('show');
                        })
                        //Category edit icon click
                        $(".CategoryEditIcon").click(function() {
                            var id = $(this).data('id');
                            $('#CategoryEditId').html(id);
                            $('#updateCategoryModal').modal('show');
                            CategoryUpdateDetails(id);
                        })
                        $('#CategoryDataTable').DataTable({
                            "order": true
                        });
                        $('.dataTables_length').addClass('bs-select');
                    } else {
                        $('#wrongDivCategory').removeClass('d-none');
                        $('#loadDivCategory').addClass('d-none');
                    }
                }).catch(function(error) {
                    $('#wrongDivCategory').removeClass('d-none');
                    $('#loadDivCategory').addClass('d-none');
                });
        }



        $('#addBtnCategory').click(function() {
            CategoryDropDownPush();
            $('#addCategoryModal').modal('show');

        });




        // Material Select Initialization
        $(document).ready(function() {
            $('#Categories').material_select();

        });

        function CategoryDropDownPush() {
            // Add Category List
            axios.get("{{ route('admin.getCategoriesData') }}")
                .then(function(response) {

                    var dataJSON = response.data;
                    $('#Categories').empty();
                    $('#Categories').append(
                        `<option  selected class='p-5 m-5' value='0'>Select Parent Category</option>`);
                    $.each(dataJSON, function(i, item) {
                        $('#Categories').append(
                            `<option value="${dataJSON[i].id}"> ${dataJSON[i].name} </option>`);

                        $('#Categories').material_select('refresh');
                    });
                }).catch(function(error) {
                    alert("There are no Category")
                });

        }


        //image Preview

        $('#iconCategory').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#addCategoryIconPreview').attr('src', ImgSource)
            }
        })

        //image Preview

        $('#imageCategory').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#addCategoryImagePreview').attr('src', ImgSource)
            }
        })




        //Category Add
        $('#CategoryAddConfirmBtn').click(function() {
            var name = $('#CategoryName').val();
            var categories = $('#Categories').val();
            var icon = $('#iconCategory').prop('files')[0];
            var image = $('#imageCategory').prop('files')[0];
            CategoryAdd(name, categories, icon, image);
        })

        function CategoryAdd(name, categories, icon, image) {
            if (name.length == 0) {
                toastr.error('Category Title is empty!');
            } else {
                $('#CategoryAddConfirmBtn').html(
                    "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
                my_data = [{
                    name: name,
                    categories: categories
                }];
                var fm = new FormData();
                fm.append('data', JSON.stringify(my_data));
                fm.append('photo', image);
                fm.append('icon', icon);
                fm.getAll('photo');

                axios.post("/admin/addCategory", fm, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function(response) {
                    console.log(response.data);
                    $('#CategoryAddConfirmBtn').html("Save");
                    if (response.status = 200) {
                        if (response.data == 1) {
                            $('#addCategoryModal').modal('hide');
                            toastr.success('Add New Success .');
                            $('#CategoryName').val("");
                            $('#Categories').val("");
                            $('#imageCategory').val("");
                            document.getElementById("addCategoryImagePreview").src = window.location.protocol +
                                "//" +
                                window.document.location.host + "/images/default-image.png";

                            document.getElementById("addCategoryIconPreview").src = window.location.protocol +
                                "//" +
                                window.document.location.host + "/images/default-image.png";
                            getCategorydata();
                        } else {
                            $('#addCategoryModal').modal('hide');
                            toastr.error('Add New Failed');
                            getCategorydata();
                        }
                    } else {
                        $('#addCategoryModal').modal('hide');
                        toastr.error('Something Went Wrong');
                    }
                }).catch(function(error) {
                    $('#addCategoryModal').modal('hide');
                    toastr.error('Something Went Wrong');
                });
            }
        }





        //  Category delete modal yes button
        $('#confirmDeleteCategory').click(function() {
            var id = $('#CategoryDeleteId').html();
            // var id = $(this).data('id');
            DeleteDataCategory(id);
        })
        //delete Category function
        function DeleteDataCategory(id) {
            $('#confirmDeleteCategory').html(
                "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
            axios.post("/admin/deleteCategory", {
                    id: id
                })
                .then(function(response) {
                    console.log(response.data);
                    $('#confirmDeleteCategory').html("Yes");
                    if (response.status == 200) {
                        if (response.data == 1) {
                            $('#deleteModalCategory').modal('hide');
                            toastr.error('Delete Success.');
                            getCategorydata();
                        } else {
                            $('#deleteModalCategory').modal('hide');
                            toastr.error('Delete Failed');
                            getCategorydata();
                        }
                    } else {
                        $('#deleteModalCategory').modal('hide');
                        toastr.error('Something Went Wrong');
                    }
                }).catch(function(error) {
                    $('#deleteModalCategory').modal('hide');
                    toastr.error('Something Went Wrong');
                });
        }

    </script>



@endsection
