@extends('admin.layouts.admin')

@section('content')

<div id="mainDivReview" class="container-fluid d-none">
    <div class="row">
        <div class="col-md-12 p-2">
            <table id="ReviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Sl.</th>
                        <th class="th-sm">Product Name</th>
                        <th class="th-sm">User Name</th>
                        <th class="th-sm">Seller Name</th>
                        <th class="th-sm">Rating</th>
                        <th class="th-sm">Review</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="Review_table">


                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="loadDivReview" class="container">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <img class="loding-icon m-5" src="{{ asset('loader.svg') }}" alt="">

        </div>
    </div>
</div>
<div id="wrongDivReview" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <h3>Something Went Wrong!</h3>
        </div>
    </div>
</div>
<!-- Modal  review Delete -->
<div class="modal fade" id="deleteModalReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body p-3 text-center">
                <h5 class="mt-4">Do you want to Delete</h5>
                <h5 id="ReviewDeleteId" class="mt-4 d-none "></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                <button data-id="" id="confirmDeleteReview" type="button" class="btn btn-sm btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal  review Delete -->
@endsection

@section('script')
<script type="text/javascript">
    getReviewdata();

    // for Review table

    function getReviewdata() {


        axios.get("{{route('admin.getReviewdata')}}")
            .then(function(response) {
                console.log(response.data);
                if (response.status = 200) {

                    $('#mainDivReview').removeClass('d-none');
                    $('#loadDivReview').addClass('d-none');

                    $('#ReviewDataTable').DataTable().destroy();
                    $('#Review_table').empty();
                    var count = 1;
                    var dataJSON = response.data;

                    $.each(dataJSON, function(i, item) {
                        var seller= dataJSON[i].vendor == null ? "admin" :dataJSON[i].vendor.name;
                        $('<tr>').html(
                            "<td>" + count++ + " </td>" +
                            "<td>" + dataJSON[i].product.product_title + " </td>" +
                            "<td>" + dataJSON[i].user.name + " </td>" +
                            "<td>" + seller + " </td>" +
                            "<td>" + dataJSON[i].star_reating + " </td>" +
                            "<td>" + dataJSON[i].product_review + " </td>" +
                            "<td><a class='ReviewDeleteIcon' data-id=" + dataJSON[i].id +
                            " ><i class='fas fa-trash-alt'></i></a> </td>"
                        ).appendTo('#Review_table');
                    });


                    //Review click on delete icon

                    $(".ReviewDeleteIcon").click(function() {
                        var id = $(this).data('id');
                        $('#ReviewDeleteId').html(id);
                        $('#deleteModalReview').modal('show');

                    })

                    $('#ReviewDataTable').DataTable({
                        "order": false
                    });
                    $('.dataTables_length').addClass('bs-select');


                } else {
                    $('#wrongDivReview').removeClass('d-none');
                    $('#loadDivReview').addClass('d-none');

                }
            }).catch(function(error) {

                $('#wrongDivReview').removeClass('d-none');
                $('#loadDivReview').addClass('d-none');
            });


    }


    //  Review delete modal yes button

    $('#confirmDeleteReview').click(function() {
        var id = $('#ReviewDeleteId').html();
        // var id = $(this).data('id');
        DeleteDataReview(id);

    })


    //delete  review function

    function DeleteDataReview(id) {
        $('#confirmDeleteReview').html(
            "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation

        axios.post("{{route('admin.deleteReview')}}", {
                id: id
            })
            .then(function(response) {
                $('#confirmDeleteReview').html("Yes");

                if (response.status == 200) {


                    if (response.data == 1) {
                        $('#deleteModalReview').modal('hide');
                        toastr.error('Delete Success.');
                        getReviewdata();
                    } else {
                        $('#deleteModalReview').modal('hide');
                        toastr.error('Delete Failed');
                        getReviewdata();
                    }

                } else {
                    $('#deleteModalReview').modal('hide');
                    toastr.error('Something Went Wrong');
                }

            }).catch(function(error) {

                $('#deleteModalReview').modal('hide');
                toastr.error('Something Went Wrong');

            });

    }
</script>
@endsection
