@extends('admin.layouts.admin')
@section('css')
    <style>


.select-wrapper input.select-dropdown {margin: -5px 0 -0rem;}

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
                                    <th>Status</th>
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

                                <select name="Categories" id="Categories" class="form-control my-5">

                                </select>

                                <select name="" id="catStatus">
                                    <option value="1" selected>Publish</option>
                                    <option value="0">Panding</option>
                                </select>

                            </div>
                            <div class="col-md-6">

                                <label for="imageCategory">Category Image</label>
                                <input type="file" id="imageCategory" class="form-control" name="text-input">
                                <img id="addCategoryImagePreview" style="height: 100px !important;" class="imgPreview mt-3 "
                                    src="{{ asset('images/default-image.png') }}" />
                                    <div></div>
                                <label for="iconCategory">Category Icon</label>
                                <input type="file" id="iconCategory" class="form-control" name="text-input">
                                <img id="addCategoryIconPreview" style="height: 100px !important;" class="imgPreview mt-3 "
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

    <!-- Category Update -->
    <div class="modal fade" id="updateCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ml-5">Update New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <h5 id="CategoryEditId" class="mt-4 d-none"></h5>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="CategoryUpdateName" type="text" id="" class="form-control my-5"
                                    placeholder="Category Name">
                                    <select name="CategoriesUpdate" id="CategoriesUpdate" class="form-control my-5">
                                    </select>

                                    <select name="" id="catEditStatus">
                                        <option value="1" selected>Publish</option>
                                        <option value="0">Panding</option>
                                    </select>
                            </div>
                            <div class="col-md-6">

                                <label for="imageUpdateCategory">Category Image</label>
                                <input type="file" id="imageUpdateCategory" class="form-control" name="text-input">
                                <img id="updateCategoryImagePreview" style="height: 100px !important;"
                                    class="imgPreview mt-3 " src="{{ asset('images/default-image.png') }}" />
                                    <div></div>
                                <label for="iconUpdateCategory">Category Image</label>
                                <input type="file" id="iconUpdateCategory" class="form-control" name="text-input">
                                <img id="updateCategoryIconPreview" style="height: 100px !important;"
                                    class="imgPreview mt-3 " src="{{ asset('images/default-image.png') }}" />
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="CategoryUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Update -->

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
                            console.log(dataJSON[i].status);
                            var statusCat='';
                            if (dataJSON[i].status == 1) {
                                statusCat='Publish';
                            }else{
                                statusCat='Panding';
                            }

                            $('<tr class="text-center">').html(
                                "<td>" + count++ + " </td>" +
                                "<td>" + dataJSON[i].name + " </td>" +
                                "<td>" + statusCat + " </td>" +
                                "<td><img width='200px' height='80' class='table-img' src=" + dataJSON[i]
                                .banner_image + "> </td>" +
                                "<td><img width='200px' height='80' class='table-img' src=" + dataJSON[i]
                                .icon + "> </td>" +
                                "<td><a class='CategoryEditIcon' data-id=" + dataJSON[i].id +
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


         // Material Select Initialization
         $(document).ready(function() {
            $('#catStatus').material_select();

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
            var catStatus = $('#catStatus').val();
            var icon = $('#iconCategory').prop('files')[0];
            var image = $('#imageCategory').prop('files')[0];
            CategoryAdd(name, categories, icon, image, catStatus);
        })

        function CategoryAdd(name, categories, icon, image, catStatus) {
            if (name.length == 0) {
                toastr.error('Category Title is empty!');
            } else {
                $('#CategoryAddConfirmBtn').html(
                    "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
                my_data = [{
                    name: name,
                    catStatus: catStatus,
                    categories: categories,
                    catStatus: catStatus,
                }];
                var fm = new FormData();
                fm.append('data', JSON.stringify(my_data));
                fm.append('photo', image);
                fm.append('icon', icon);
                fm.getAll('photo');

                axios.post("{{ route('admin.addCategory' )}}", fm, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function(response) {

                    $('#CategoryAddConfirmBtn').html("Save");
                    if (response.status = 200) {
                        if (response.data == 1) {
                            $('#addCategoryModal').modal('hide');
                            toastr.success('Add New Success .');
                            $('#CategoryName').val("");
                            $('#Categories').val("");
                            $('#imageCategory').val("");
                            $('#iconCategory').val("");
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
                    }  else {
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
            axios.post("{{ route('admin.deleteCategory') }}", {
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





        // category Update

        // Material Select Initialization
        $(document).ready(function() {
            $('#CategoriesUpdate').material_select();

        });

 // Material Select Initialization
 $(document).ready(function() {
            $('#catEditStatus').material_select();

        });


        // Add Category List
        axios.get("{{ route('admin.getCategoriesData') }}")
            .then(function(response) {

                var dataJSON = response.data;
                $('#CategoriesUpdate').empty();
                $('#CategoriesUpdate').append(
                    `<option  selected class='p-5 m-5' value='0'>Parent Category</option>`);
                $.each(dataJSON, function(i, item) {
                    $('#CategoriesUpdate').append(
                        `<option value="${dataJSON[i].id}"> ${dataJSON[i].name} </option>`);

                    $('#CategoriesUpdate').material_select('refresh');
                });
            }).catch(function(error) {
                alert("There are no Category")
            });


        //image Preview

        $('#iconUpdateCategory').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#updateCategoryIconPreview').attr('src', ImgSource)
            }
        })

        //image Preview

        $('#imageUpdateCategory').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#updateCategoryImagePreview').attr('src', ImgSource)
            }
        })



        function CategoryUpdateDetails(id) {
            axios.post("{{ route('admin.getEditCategoryData') }}", {
                    id: id
                })
                .then(function(response) {
                    console.log(response.data);
                    if (response.status == 200) {
                        $('#loadDivCategory').addClass('d-none');
                        $('#CategoryEditForm').removeClass('d-none');

                        var jsonData = response.data;
                        $('#CategoryUpdateName').val(jsonData[0].name);

                        $('#catEditStatus option[value=' + jsonData[0].status + ']').attr(
                            'selected', 'selected');

                        $('#CategoriesUpdate option[value=' + jsonData[0].parent_id + ']').prop('selected', 'true');
                        var iconSource = (jsonData[0].icon);
                        $('#updateCategoryIconPreview').attr('src', iconSource)

                        var ImgSource = (jsonData[0].banner_image);
                        $('#updateCategoryImagePreview').attr('src', ImgSource)

                    } else {
                        $('#loadDivCategory').addClass('d-none');
                        $('#wrongDivCategory').removeClass('d-none');
                    }
                }).catch(function(error) {
                    $('#loadDivCategory').addClass('d-none');
                    $('#wrongDivCategory').removeClass('d-none');
                });
        }




          //Category update modal save button
          $('#CategoryUpdateConfirmBtn').click(function() {
            var idUpdate = $('#CategoryEditId').html();
            var nameUpdate = $('#CategoryUpdateName').val();

            var CategoriesEdit = $('#CategoriesUpdate').val();
            var catEditStatus = $('#catEditStatus').val();
            var img = $('#imageUpdateCategory').prop('files')[0];
            var icon = $('#iconUpdateCategory').prop('files')[0];
            CategoryUpdate(idUpdate, nameUpdate, CategoriesEdit, img, icon, catEditStatus);
        })
        //update Category data using modal
        function CategoryUpdate(idUpdate, nameUpdate, CategoriesEdit, img, icon, catEditStatus) {
            console.log(catEditStatus);
            if (nameUpdate.length == 0) {
                toastr.error('Category name is empty!');
            }  else {
                $('#CategoryUpdateConfirmBtn').html(
                    "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
                updateData = [{
                    id: idUpdate,
                    name: nameUpdate,
                    catEditStatus: catEditStatus,
                    products_category_id: CategoriesEdit
                }];
                var formData = new FormData();
                formData.append('data', JSON.stringify(updateData));
                formData.append('photo', img);
                formData.append('icon', icon);
                axios.post("{{ route('admin.updateCategory') }}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function(response) {
                    console.log(response.data);
                    $('#CategoryUpdateConfirmBtn').html("Update");
                    if (response.status = 200) {
                        if (response.data == 1) {
                            $('#updateCategoryModal').modal('hide');
                            toastr.success('Update Success.');
                            getCategorydata();
                        } else {
                            $('#updateCategoryModal').modal('hide');
                            toastr.error('Update Failed');
                            getCategorydata();
                        }
                    } else {
                        $('#updateCategoryModal').modal('hide');
                        toastr.error('Something Went Wrong');
                    }
                }).catch(function(error) {
                    $('#updateCategoryModal').modal('hide');
                    toastr.error('Something Went Wrong');
                });
            }
        }

    </script>



@endsection
