@extends('admin.layouts.admin')

@section('content')

<div id="mainDivAdmin" class="container-fluid d-none">
    <div class="row">
        <div class="col-md-12 p-2">
            <button id="addbtnAdmin" class="btn btn-sm btn-danger my-3">Add New</button>
            <table id="AdminDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Sl.</th>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Eamil</th>

                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="Admin_table">


                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="loadDivAdmin" class="container">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <img class="loding-icon m-5" src="{{ asset('loader.svg') }}" alt="">

        </div>
    </div>
</div>
<div id="wrongDivAdmin" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <h3>Something Went Wrong!</h3>
        </div>
    </div>
</div>



<!--  admin add -->
<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ml-5">Add New Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body  text-center">
                <div class="container">
                    <div class="row">

                        <input id="AdminName" type="text" id="" class="form-control mb-3" placeholder="Admin Name">
                        <input id="AdminEmail" type="text" id="" class="form-control mb-3" placeholder="Admin Eamil">

                        <input id="AdminPassword" type="text" id="" class="form-control mb-3" placeholder="Admin Password">



                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                <button id="AdminAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
            </div>
        </div>
    </div>
</div>

<!--  admin add -->


<!-- Modal  admin Delete -->
<div class="modal fade" id="deleteModalAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body p-3 text-center">
                <h5 class="mt-4">Do you want to Delete</h5>
                <h5 id="AdminDeleteId" class="mt-4 d-none "></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                <button data-id="" id="confirmDeleteAdmin" type="button" class="btn btn-sm btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal  admin Delete -->




<!--  admin update -->
<div class="modal fade" id="updateAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body  text-center">
                <div id="AdminEditForm" class="container d-none ">
                    <h5 id="AdminEditId" class="mt-4 d-none"></h5>
                    <div class="row">
                        <div class="col-md-12">
                            <input id="AdminNameIdUpdate" type="text" id="" class="form-control mb-3" placeholder="Admin Name">
                            <input id="AdminEmailIdUpdate" type="text" id="" class="form-control mb-3" placeholder="Admin Email">
                           <input id="AdminPasswordIdUpdate" type="text" id="" class="form-control mb-3" placeholder="Input Admin New Password">

                        </div>

                    </div>
                </div>
                <img id="AdminLoader" class="loding-icon m-5 d-none" src="{{ asset('loader.svg') }}" alt="">
                <h3 id="AdminwrongLoader" class="d-none">Something Went Wrong!</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                <button id="AdminupdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
            </div>
        </div>
    </div>
</div>


<!--  admin update -->



@endsection
@section('script')
<script type="text/javascript">
    getAdmindata();

    // for Admin table

    function getAdmindata() {


        axios.get("{{route('admin.getAdmindata')}}")
            .then(function(response) {

                if (response.status = 200) {

                    $('#mainDivAdmin').removeClass('d-none');
                    $('#loadDivAdmin').addClass('d-none');

                    $('#AdminDataTable').DataTable().destroy();
                    $('#Admin_table').empty();
                    var count = 1;
                    var dataJSON = response.data;

                    $.each(dataJSON, function(i, item) {
                        $('<tr>').html(
                            "<td>" + count++ + " </td>" +

                            "<td>" + dataJSON[i].name + " </td>" +

                            "<td>" + dataJSON[i].email + " </td>" +

                            "<td><a class='AdminEditIcon' data-id=" + dataJSON[i].id +
                            "><i class='fas fa-edit'></i></a> </td>" +

                            "<td><a class='AdminDeleteIcon' data-id=" + dataJSON[i].id +
                            " ><i class='fas fa-trash-alt'></i></a> </td>"
                        ).appendTo('#Admin_table');
                    });


                    //Admin click on delete icon

                    $(".AdminDeleteIcon").click(function() {

                        var id = $(this).data('id');
                        $('#AdminDeleteId').html(id);
                        $('#deleteModalAdmin').modal('show');

                    })



                    //Admin edit icon click

                    $(".AdminEditIcon").click(function() {

                        var id = $(this).data('id');
                        $('#AdminEditId').html(id);

                        $('#updateAdminModal').modal('show');
                        AdminUpdateDetails(id);

                    })




                    $('#AdminDataTable').DataTable({
                        "order": false
                    });
                    $('.dataTables_length').addClass('bs-select');


                } else {
                    $('#wrongDivAdmin').removeClass('d-none');
                    $('#loadDivAdmin').addClass('d-none');

                }
            }).catch(function(error) {

                $('#wrongDivAdmin').removeClass('d-none');
                $('#loadDivAdmin').addClass('d-none');
            });


    }




    //add button modal show for add new entity

    $('#addbtnAdmin').click(function() {
        $('#addAdminModal').modal('show');
    });


    //Admin Add modal save button

    $('#AdminAddConfirmBtn').click(function() {


        var name = $('#AdminName').val();
        var email = $('#AdminEmail').val();

        var password = $('#AdminPassword').val();




        adminAdd(name, email, password);

    })

    // admin Add Method


    function adminAdd(name, email, password) {



        if (name.length == 0) {

            toastr.error('Admin name is empty!');

        } else if (email == 0) {

            toastr.error('Admin Email is empty!');
        } else if (password == 0) {

            toastr.error('Admin Password is empty!');
        } else {

            $('#AdminAddConfirmBtn').html(
                "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation

            axios.post("{{route('admin.adminAdd')}}", {
                name: name,
                email: email,

                password: password
            }).then(function(response) {

                $('#AdminAddConfirmBtn').html("Save");

                if (response.status = 200) {
                    if (response.data == 1) {
                        $('#addAdminModal').modal('hide');
                        toastr.success('Add New Success .');
                        $('#AdminNameIdUpdate').val("");
                         $('#AdminEmailIdUpdate').val("");
                         $('#AdminPasswordIdUpdate').val("");
                        getAdmindata();

                    } else {
                        $('#addAdminModal').modal('hide');
                        toastr.error('Add New Failed');
                        getAdmindata();
                    }
                } else {
                    $('#addAdminModal').modal('hide');
                    toastr.error('Something Went Wrong');
                }


            }).catch(function(error) {

                $('#addAdminModal').modal('hide');
                toastr.error('Something Went Wrong');

            });

        }

    }



    //  Admin delete modal yes button

    $('#confirmDeleteAdmin').click(function() {
        var id = $('#AdminDeleteId').html();
        // var id = $(this).data('id');
        DeleteDataAdmin(id);

    })


    //delete  admin function

    function DeleteDataAdmin(id) {
        $('#confirmDeleteAdmin').html(
            "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation

        axios.post("{{route('admin.adminDelete')}}", {
                id: id
            })
            .then(function(response) {
                $('#confirmDeleteAdmin').html("Yes");

                if (response.status == 200) {


                    if (response.data == 1) {
                        $('#deleteModalAdmin').modal('hide');
                        toastr.error('Delete Success.');
                        getAdmindata();
                    } else {
                        $('#deleteModalAdmin').modal('hide');
                        toastr.error('Delete Failed');
                        getAdmindata();
                    }

                } else {
                    $('#deleteModalAdmin').modal('hide');
                    toastr.error('Something Went Wrong');
                }

            }).catch(function(error) {

                $('#deleteModalAdmin').modal('hide');
                toastr.error('Something Went Wrong');

            });

    }


    //Admin Details data show for edit

    function AdminUpdateDetails(id) {

        axios.post("{{route('admin.adminDetailEdit')}}", {
                id: id
            })
            .then(function(response) {

                if (response.status == 200) {
                    $('#AdminLoader').addClass('d-none');
                    $('#AdminEditForm').removeClass('d-none');
                    var jsonData = response.data;
                    $('#AdminNameIdUpdate').val(jsonData[0].name);
                    $('#AdminEmailIdUpdate').val(jsonData[0].email);
                    $('#AdminPasswordIdUpdate').val(jsonData[0].password);

                } else {

                    $('#AdminLoader').addClass('d-none');
                    $('#AdminwrongLoader').removeClass('d-none');
                }

            }).catch(function(error) {

                $('#AdminLoader').addClass('d-none');
                $('#AdminwrongLoader').removeClass('d-none');

            });

    }







    // admin update modal save button

    $('#AdminupdateConfirmBtn').click(function() {


        var idUpdate = $('#AdminEditId').html();
        var nameUpdate = $('#AdminNameIdUpdate').val();
        var emailUpdate = $('#AdminEmailIdUpdate').val();
        var PasswordUpdate = $('#AdminPasswordIdUpdate').val();



        AdminUpdate(idUpdate, nameUpdate, emailUpdate, PasswordUpdate);

    })





    //update Admin data using modal

    function AdminUpdate(idUpdate, nameUpdate, emailUpdate,  PasswordUpdate) {



        if (emailUpdate.length == 0) {

            toastr.error(' Email is empty!');

        } else if (PasswordUpdate == 0) {

            toastr.error('Password is empty!');

        } else {
            $('#AdminupdateConfirmBtn').html(
                "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation


            axios.post("{{route('admin.adminDataUpdate')}}", {
                id: idUpdate,
                name: nameUpdate,
                email: emailUpdate,
                password: PasswordUpdate
            }).then(function(response) {

                $('#AdminupdateConfirmBtn').html("Update");

                if (response.status = 200) {
                    if (response.data == 1) {
                        $('#updateAdminModal').modal('hide');
                        toastr.success('Update Success.');
                        getAdmindata();

                    } else {
                        $('#updateAdminModal').modal('hide');
                        toastr.error('Update Failed');
                        getAdmindata();

                    }
                } else {
                    $('#updateAdminModal').modal('hide');
                    toastr.error('Something Went Wrong');
                }


            }).catch(function(error) {

                $('#updateAdminModal').modal('hide');
                toastr.error('Something Went Wrong');

            });
        }
    }
</script>

@endsection
