@extends('admin.layouts.admin')

@section('content')

<div id="mainDivVendor" class="container-fluid d-none">
    <div class="row">
        <div class="col-md-12 p-2">
            <button id="addbtnVendor" class="btn btn-sm btn-danger my-3">Add New</button>
            <table id="VendorDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Sl.</th>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Eamil</th>
                        <th class="th-sm">Mobile</th>
                        <th class="th-sm">Status</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="Vendor_table">


                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="loadDivVendor" class="container">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <img class="loding-icon m-5" src="{{ asset('loader.svg') }}" alt="">

        </div>
    </div>
</div>
<div id="wrongDivVendor" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <h3>Something Went Wrong!</h3>
        </div>
    </div>
</div>



<!--  Vendor add -->
<div class="modal fade" id="addVendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ml-5">Add New Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body  text-center">
                <div class="container">
                    <div class="row">

                        <input id="VendorName" type="text" id="" class="form-control mb-3" placeholder="Vendor Name">
                        <input id="VendorEmail" type="text" id="" class="form-control mb-3" placeholder="Vendor Eamil">
                        <input id="phone_number" type="text" id="" class="form-control mb-3" placeholder="Vendor Mobile">
                        <select name="status" id="status"  class="browser-default custom-select form-control mb-3">
                            <option selected disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <input id="VendorPassword" type="text" id="" class="form-control mb-3" placeholder="Vendor Password">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                <button id="VendorAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
            </div>
        </div>
    </div>
</div>

<!--  Vendor add -->


<!-- Modal  Vendor Delete -->
<div class="modal fade" id="deleteModalVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body p-3 text-center">
                <h5 class="mt-4">Do you want to Delete</h5>
                <h5 id="VendorDeleteId" class="mt-4 d-none "></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                <button data-id="" id="confirmDeleteVendor" type="button" class="btn btn-sm btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal  Vendor Delete -->




<!--  Vendor update -->
<div class="modal fade" id="updateVendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body  text-center">
                <div id="VendorEditForm" class="container d-none ">
                    <h5 id="VendorEditId" class="mt-4 d-none"></h5>
                    <div class="row">
                        <div class="col-md-12">
                            <input id="VendorNameIdUpdate" type="text" id="" class="form-control mb-3" placeholder="Vendor Name">
                            <input id="VendorEmailIdUpdate" type="text" id="" class="form-control mb-3" placeholder="Vendor Email">
                            <input id="phone_number_edit" type="text" id="" class="form-control mb-3" placeholder="Vendor Mobile">
                            <select name="status_edit" id="status_edit"  class="browser-default custom-select form-control mb-3">
                                <option selected disabled>Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                           
                        </div>

                    </div>
                </div>
                <img id="VendorLoader" class="loding-icon m-5 d-none" src="{{ asset('loader.svg') }}" alt="">
                <h3 id="VendorwrongLoader" class="d-none">Something Went Wrong!</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                <button id="VendorupdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
            </div>
        </div>
    </div>
</div>


<!--  Vendor update -->



@endsection
@section('script')
<script type="text/javascript">
    getVendordata();

    // for Vendor table

    function getVendordata() {


        axios.get("{{route('admin.getVendordata')}}")
            .then(function(response) {

                if (response.status = 200) {

                    $('#mainDivVendor').removeClass('d-none');
                    $('#loadDivVendor').addClass('d-none');

                    $('#VendorDataTable').DataTable().destroy();
                    $('#Vendor_table').empty();
                    var count = 1;
                    var dataJSON = response.data;

                    $.each(dataJSON, function(i, item) {

                        var status=" "
                            if(dataJSON[i].status==0) {
                                status="Inactive";
                            }else{
                                status="Active";
                            }
                        $('<tr>').html(
                            "<td>" + count++ + " </td>" +

                            "<td>" + dataJSON[i].name + " </td>" +

                            "<td>" + dataJSON[i].email + " </td>" +
                            "<td>" + dataJSON[i].phone_number + " </td>" +
                            "<td>" + status+ " </td>" +

                            "<td><a class='VendorEditIcon' data-id=" + dataJSON[i].id +
                            "><i class='fas fa-edit'></i></a> </td>" +

                            "<td><a class='VendorDeleteIcon' data-id=" + dataJSON[i].id +
                            " ><i class='fas fa-trash-alt'></i></a> </td>"
                        ).appendTo('#Vendor_table');
                    });


                    //Vendor click on delete icon

                    $(".VendorDeleteIcon").click(function() {

                        var id = $(this).data('id');
                        $('#VendorDeleteId').html(id);
                        $('#deleteModalVendor').modal('show');

                    })



                    //Vendor edit icon click

                    $(".VendorEditIcon").click(function() {

                        var id = $(this).data('id');
                        $('#VendorEditId').html(id);

                        $('#updateVendorModal').modal('show');
                        VendorUpdateDetails(id);

                    })




                    $('#VendorDataTable').DataTable({
                        "order": false
                    });
                    $('.dataTables_length').addClass('bs-select');


                } else {
                    $('#wrongDivVendor').removeClass('d-none');
                    $('#loadDivVendor').addClass('d-none');

                }
            }).catch(function(error) {

                $('#wrongDivVendor').removeClass('d-none');
                $('#loadDivVendor').addClass('d-none');
            });


    }




    //add button modal show for add new entity

    $('#addbtnVendor').click(function() {
        $('#addVendorModal').modal('show');
    });


    //Vendor Add modal save button

    $('#VendorAddConfirmBtn').click(function() {


        var name = $('#VendorName').val();
        var email = $('#VendorEmail').val();
        var phone_number = $('#phone_number').val();
        var status = $('#status').val();
        var password = $('#VendorPassword').val();




        vendorAdd(name, email, password,phone_number,status);

    })

    // vendor Add Method


    function vendorAdd(name, email, password,phone_number, status) {



        if (name.length == 0) {

            toastr.error('Vendor name is empty!');

        } else if (email.length == 0) {

            toastr.error('Vendor Email is empty!');
        } else if (phone_number.length == 0) {
            toastr.error('Mobile is empty!');
        } else if (status.length == 0) {
            toastr.error('Status is empty!');
        } else if (password == 0) {

            toastr.error('Vendor Password is empty!');
        } else {

            $('#VendorAddConfirmBtn').html(
                "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation

            axios.post("{{route('admin.vendorAdd')}}", {
                name: name,
                email: email,
                phone_number: phone_number,
                status: status,
                password: password
            }).then(function(response) {

                $('#VendorAddConfirmBtn').html("Save");

                if (response.status = 200) {
                    if (response.data == 1) {
                        $('#addVendorModal').modal('hide');
                        toastr.success('Add New Success .');
                        $('#VendorName').val("");
                         $('#VendorEmail').val("");
                         $('#phone_number').val("");
                         $('#status option').prop('selected', function() {
                                     return this.defaultSelected;
                            });

                        getVendordata();

                    } else {
                        $('#addVendorModal').modal('hide');
                        toastr.error('Add New Failed');
                        getVendordata();
                    }
                } else {
                    $('#addVendorModal').modal('hide');
                    toastr.error('Something Went Wrong');
                }


            }).catch(function(error) {

                $('#addVendorModal').modal('hide');
                toastr.error('Something Went Wrong');

            });

        }

    }



    //  Vendor delete modal yes button

    $('#confirmDeleteVendor').click(function() {
        var id = $('#VendorDeleteId').html();
        // var id = $(this).data('id');
        DeleteDataVendor(id);

    })


    //delete  vendor function

    function DeleteDataVendor(id) {
        $('#confirmDeleteVendor').html(
            "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation

        axios.post("{{route('admin.vendorDelete')}}", {
                id: id
            })
            .then(function(response) {
                $('#confirmDeleteVendor').html("Yes");

                if (response.status == 200) {


                    if (response.data == 1) {
                        $('#deleteModalVendor').modal('hide');
                        toastr.error('Delete Success.');
                        getVendordata();
                    } else {
                        $('#deleteModalVendor').modal('hide');
                        toastr.error('Delete Failed');
                        getVendordata();
                    }

                } else {
                    $('#deleteModalVendor').modal('hide');
                    toastr.error('Something Went Wrong');
                }

            }).catch(function(error) {

                $('#deleteModalVendor').modal('hide');
                toastr.error('Something Went Wrong');

            });

    }


    //Vendor Details data show for edit

    function VendorUpdateDetails(id) {

        axios.post("{{route('admin.vendorDetailEdit')}}", {
                id: id
            })
            .then(function(response) {

                if (response.status == 200) {
                    $('#VendorLoader').addClass('d-none');
                    $('#VendorEditForm').removeClass('d-none');
                    var jsonData = response.data;
                    $('#VendorNameIdUpdate').val(jsonData[0].name);
                    $('#VendorEmailIdUpdate').val(jsonData[0].email);
                    $('#phone_number_edit').val(jsonData[0].phone_number);
                    $('#status_edit option[value=' + jsonData[0].status + ']').prop('selected','true');
                    $('#VendorPasswordIdUpdate').val(jsonData[0].password);

                } else {

                    $('#VendorLoader').addClass('d-none');
                    $('#VendorwrongLoader').removeClass('d-none');
                }

            }).catch(function(error) {

                $('#VendorLoader').addClass('d-none');
                $('#VendorwrongLoader').removeClass('d-none');

            });

    }







    // vendor update modal save button

    $('#VendorupdateConfirmBtn').click(function() {


        var idUpdate = $('#VendorEditId').html();
        var nameUpdate = $('#VendorNameIdUpdate').val();
        var emailUpdate = $('#VendorEmailIdUpdate').val();
        var phone_number_edit = $('#phone_number_edit').val();
        var status_edit = $('#status_edit').val();



        VendorUpdate(idUpdate, nameUpdate, emailUpdate, phone_number_edit, status_edit );

    })





    //update Vendor data using modal

    function VendorUpdate(idUpdate, nameUpdate, emailUpdate, phone_number_edit, status_edit) {



        if (emailUpdate.length == 0) {

            toastr.error(' Email is empty!');

        } else if (nameUpdate.length == 0) {
                 toastr.error('Vendor name is empty!');
        }else if (phone_number_edit.length == 0) {
                 toastr.error('Vendor Mobile Number is empty!');
        }else if (status_edit.length == 0) {
                 toastr.error('Status is empty!');
        }else {
            $('#VendorupdateConfirmBtn').html(
                "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation


            axios.post("{{route('admin.vendorDataUpdate')}}", {
                id: idUpdate,
                name: nameUpdate,
                email: emailUpdate,
                phone_number_edit: phone_number_edit,
                status_edit: status_edit
            }).then(function(response) {
                    console.log(response.data);
                $('#VendorupdateConfirmBtn').html("Update");

                if (response.status = 200) {
                    if (response.data == 1) {
                        $('#updateVendorModal').modal('hide');
                        toastr.success('Update Success.');
                        getVendordata();

                    } else {
                        $('#updateVendorModal').modal('hide');
                        toastr.error('Update Failed');
                        getVendordata();

                    }
                } else {
                    $('#updateVendorModal').modal('hide');
                    toastr.error('Something Went Wrong');
                }


            }).catch(function(error) {

                $('#updateVendorModal').modal('hide');
                toastr.error('Something Went Wrong');

            });
        }
    }
</script>

@endsection
