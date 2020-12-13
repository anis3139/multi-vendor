@extends('admin.layouts.admin')

@section('content')
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1 border border-dark">
            <div id="mainDivBrands" class="container-fluid d-none">
                <div class="row">
                    <div class="col-md-12 p-2">
                        <button id="addBtnBrands" class="btn btn-sm btn-danger my-3">Add New</button>
                        <table id="BrandsDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th class="th-sm">Sl.</th>
                                    <th class="th-sm">Brand Name</th>
                                    <th class="th-sm">Category Name</th>
                                    <th class="th-sm">Images</th>
                                    <th class="th-sm">Edit</th>
                                    <th class="th-sm">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="Brands_table">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="loadDivBrands" class="container">
                <div class="row">
                    <div class="col-md-12 p-5 text-center">
                        <img class="loding-icon m-5" src="{{ asset('loader.svg') }}" alt="">

                    </div>
                </div>
            </div>
            <div id="wrongDivBrands" class="container d-none">
                <div class="row">
                    <div class="col-md-12 p-5 text-center">
                        <h3>Something Went Wrong!</h3>
                    </div>
                </div>
            </div>


            <!-- Brands add -->
            <div class="modal fade" id="addBrandsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title ml-5">Add New Brands</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body  text-center">
                            <div class="container">
                                <div class="row">

                                    <input id="BrandName" type="text" id="" class="form-control mb-3"
                                        placeholder="Brands Name">

                                    <select name="Categories" id="Categories" class="form-control mb-3">

                                    </select>

                                    <input type="file" id="imageBrand" class="form-control mb-3" name="text-input">
                                    <img id="addBrandImagePreview" style="height: 100px !important;"
                                        class="imgPreview mt-3 " src="{{ asset('images/default-image.png') }}" />


                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                            <button id="BrandsAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Brands add -->

            <!-- Modal Brands Delete -->
            <div class="modal fade" id="deleteModalBrands" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-body p-3 text-center">
                            <h5 class="mt-4">Do you want to Delete</h5>
                            <h5 id="BrandsDeleteId" class="mt-4 d-none "></h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                            <button data-id="" id="confirmDeleteBrands" type="button"
                                class="btn btn-sm btn-danger">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Brands Delete -->



            <!-- Brands Edit data -->
            <div class="modal fade" id="editBrandsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title ml-5">Edit Brands</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body  text-center">
                            <div id="BrandsEditForm" class="container d-none ">
                                <h5 id="BrandsEditId" class="mt-4 d-none"></h5>
                                <div class="container">
                                    <div class="row">
                                        <input id="BrandNameEdit" type="text" id="" class="form-control mb-3">
                                        <select name="CategoriesEdit" id="CategoriesEdit" class="form-control mb-3">
                                        </select>
                                        <input type="file" id="imageBrandEdit" class="form-control mb-3" name="text-input">
                                        <img id="editBrandImagePreview" style="height: 100px !important;"
                                            class="imgPreview mt-3 " src="{{ asset('images/default-image.png') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                            <button id="BrandsEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Brands add -->

        </div>
    </div>

@endsection


@section('script')

    <script>
        // for brand table
        getBranddata();

        function getBranddata() {
            axios.get("{{ route('admin.getBrandsData') }}")
                .then(function(response) {
                    console.log(response.data);

                    if (response.status = 200) {
                        $('#mainDivBrands').removeClass('d-none');
                        $('#loadDivBrands').addClass('d-none');
                        $('#BrandsDataTable').DataTable().destroy();
                        $('#Brands_table').empty();
                        var count = 1;
                        var dataJSON = response.data;

                        $.each(dataJSON, function(i, item) {
                            $('<tr class="text-center">').html(
                                "<td>" + count++ + " </td>" +
                                "<td>" + dataJSON[i].brandName + " </td>" +
                                "<td>" + dataJSON[i].categoryName + " </td>" +
                                "<td><img width='200px' height='80' class='table-img' src=" + dataJSON[i]
                                .image + "> </td>" +
                                "<td><a class='brandEditIcon' data-id=" + dataJSON[i].id +
                                "><i class='fas fa-edit'></i></a> </td>" +
                                "<td><a class='brandDeleteIcon' data-id=" + dataJSON[i].id +
                                " ><i class='fas fa-trash-alt'></i></a> </td>"
                            ).appendTo('#Brands_table');
                        });
                        //Brands click on delete icon
                        $(".brandDeleteIcon").click(function() {
                            var id = $(this).data('id');
                            $('#BrandsDeleteId').html(id);
                            $('#deleteModalBrands').modal('show');
                        })
                        //Brands edit icon click
                        $(".brandEditIcon").click(function() {
                            var id = $(this).data('id');
                            $('#BrandsEditId').html(id);
                            $('#editBrandsModal').modal('show');
                            BrandsUpdateDetails(id);
                        })
                        $('#BrandsDataTable').DataTable({
                            "order": false
                        });
                        $('.dataTables_length').addClass('bs-select');
                    } else {
                        $('#wrongDivBrands').removeClass('d-none');
                        $('#loadDivBrands').addClass('d-none');
                    }
                }).catch(function(error) {
                    $('#wrongDivBrands').removeClass('d-none');
                    $('#loadDivBrands').addClass('d-none');
                });
        }




        //add button modal show for add new entity

        $('#addBtnBrands').click(function() {
            $('#addBrandsModal').modal('show');
        });
















        // Material Select Initialization
        $(document).ready(function() {
            $('#Categories').material_select();
        });


        // Add Category List
        axios.get("{{ route('admin.getCategoriesData') }}")
            .then(function(response) {
                var dataJSON = response.data;

                $('#Categories').empty();
                $('#Categories').append(`<option disabled selected>Select Category</option>`);
                $.each(dataJSON, function(i, item) {
                    $('#Categories').append(
                        `<option value="${dataJSON[i].id}"> ${dataJSON[i].name} </option>`);

                    $('#Categories').material_select('refresh');
                });
            }).catch(function(error) {
                alert("There are no Category")
            });

        //image Preview

        $('#imageBrand').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#addBrandImagePreview').attr('src', ImgSource)
            }
        })

        //Brand Add
        $('#BrandsAddConfirmBtn').click(function() {
            var name = $('#BrandName').val();
            var categories = $('#Categories').val();
            var image = $('#imageBrand').prop('files')[0];
            BrandAdd(name, categories, image);
        })

        function BrandAdd(name, categories, image) {
            if (name.length == 0) {
                toastr.error('Brand Title is empty!');
            } else if (categories == 0) {
                toastr.error('Brand description is empty!');
            } else {
                $('#BrandAddConfirmBtn').html(
                    "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
                my_data = [{
                    name: name,
                    categories: categories
                }];
                var formData = new FormData();
                formData.append('data', JSON.stringify(my_data));
                formData.append('photo', image);
                // brand.store
                axios.post("{{ route('brand.store') }}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function(response) {

                    $('#BrandAddConfirmBtn').html("Save");
                    if (response.status = 200) {
                        if (response.data == 1) {
                            $('#addBrandsModal').modal('hide');
                            toastr.success('Add New Success .');
                            $('#BrandName').val("");
                            $('#Categories').val("");
                            $('#imageBrand').val("");
                            document.getElementById("addBrandImagePreview").src = window.location.protocol + "//" +
                                window.document.location.host + "/images/default-image.png";
                            getBranddata();
                        } else {
                            $('#addBrandsModal').modal('hide');
                            toastr.error('Add New Failed');
                            getBranddata();
                        }
                    } else {
                        $('#addBrandsModal').modal('hide');
                        toastr.error('Something Went Wrong');
                    }
                }).catch(function(error) {
                    $('#addBrandsModal').modal('hide');
                    toastr.error('Something Went Wrong');
                });
            }
        }




















        //  Brands delete modal yes button
        $('#confirmDeleteBrands').click(function() {
            var id = $('#BrandsDeleteId').html();
            // var id = $(this).data('id');
            DeleteDataBrands(id);
        })
        //delete Brands function
        function DeleteDataBrands(id) {
            $('#confirmDeleteBrands').html(
                "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
            axios.post("/admin/BrandDelete", {
                    id: id
                })
                .then(function(response) {

                    $('#confirmDeleteBrands').html("Yes");
                    if (response.status == 200) {
                        if (response.data == 1) {
                            $('#deleteModalBrands').modal('hide');
                            toastr.error('Delete Success.');
                            getBranddata();
                        } else {
                            $('#deleteModalBrands').modal('hide');
                            toastr.error('Delete Failed');
                            getBranddata();
                        }
                    } else {
                        $('#deleteModalBrands').modal('hide');
                        toastr.error('Something Went Wrong');
                    }
                }).catch(function(error) {
                    $('#deleteModalBrands').modal('hide');
                    toastr.error('Something Went Wrong');
                });
        }














        //each Brands  Details data show for edit
        // Material Select Initialization
        $(document).ready(function() {
            $('#CategoriesEdit').material_select();
        });
        // Add Category List
        axios.get("{{ route('admin.getCategoriesData') }}")
            .then(function(response) {
                var dataJSON = response.data;
                $('#CategoriesEdit').empty();
                $.each(dataJSON, function(i, item) {
                    $('#CategoriesEdit').append(
                        `<option value="${dataJSON[i].id}"> ${dataJSON[i].name} </option>`);

                });
            }).catch(function(error) {
                alert("There are no Category")
            });









        function BrandsUpdateDetails(id) {
            axios.post('/admin/getBrandEditData', {
                    id: id
                })
                .then(function(response) {
                    // $('#CategoriesEdit option').props('selectedIndex', 0);
                    if (response.status == 200) {


                        $('#loadDivBrands').addClass('d-none');
                        $('#BrandsEditForm').removeClass('d-none');
                        var jsonData = response.data;
                        $('#BrandNameEdit').val(jsonData[0].name);

                        $('#CategoriesEdit option[value='+ jsonData[0].producrts_category_models_id +']').attr('selected','selected');

                        var ImgSource = (jsonData[0].image);
                        $('#editBrandImagePreview').attr('src', ImgSource)
                    } else {
                        $('#loadDivBrands').addClass('d-none');
                        $('#wrongDivBrands').removeClass('d-none');
                    }
                }).catch(function(error) {
                    $('#loadDivBrands').addClass('d-none');
                    $('#wrongDivBrands').removeClass('d-none');
                });
        }
        $('#imageBrandEdit').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#editBrandImagePreview').attr('src', ImgSource)
            }
        })




        //Brands update modal save button
        $('#BrandsEditConfirmBtn').click(function() {
            var idUpdate = $('#BrandsEditId').html();
            var nameUpdate = $('#BrandNameEdit').val();
            var CategoriesEdit = $('#CategoriesEdit').val();
            var img = $('#imageBrandEdit').prop('files')[0];
            BrandsUpdate(idUpdate, nameUpdate, CategoriesEdit, img);
        })
        //update Brands data using modal
        function BrandsUpdate(idUpdate, nameUpdate, CategoriesEdit, imgUpdate) {
            if (nameUpdate.length == 0) {
                toastr.error('Brands name is empty!');
            } else if (CategoriesEdit == 0) {
                toastr.error('Brands Category is empty!');
            } else {
                $('#BrandsEditConfirmBtn').html(
                    "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
                updateData = [{
                    id: idUpdate,
                    name: nameUpdate,
                    products_category_models_id: CategoriesEdit
                }];
                var formData = new FormData();
                formData.append('data', JSON.stringify(updateData));
                formData.append('photo', imgUpdate);
                axios.post('/admin/updateBrand', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function(response) {
                    console.log(response.data);
                    $('#BrandsEditConfirmBtn').html("Update");
                    if (response.status = 200) {
                        if (response.data == 1) {
                            $('#editBrandsModal').modal('hide');
                            toastr.success('Update Success.');
                            getBranddata();
                        } else {
                            $('#editBrandsModal').modal('hide');
                            toastr.error('Update Failed');
                            getBranddata();
                        }
                    } else {
                        $('#editBrandsModal').modal('hide');
                        toastr.error('Something Went Wrong');
                    }
                }).catch(function(error) {
                    $('#editBrandsModal').modal('hide');
                    toastr.error('Something Went Wrong');
                });
            }
        }

    </script>

@endsection
