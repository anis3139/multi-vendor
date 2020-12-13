@extends('admin.layouts.admin')
@section('content')
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1 border border-dark">
            <div id="mainDivSlider" class="container-fluid d-none">
                <div class="row">
                    <div class="col-md-12 p-2">
                        <button id="addbtnSlider" class="btn btn-sm btn-danger my-3">Add New</button>
                        <table id="SliderDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="th-sm">Sl.</th>
                                    <th class="th-sm">Image</th>
                                    <th class="th-sm">Name</th>
                                    <th class="th-sm">Description</th>
                                    <th class="th-sm">Edit</th>
                                    <th class="th-sm">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="Slider_table">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="loadDivSlider" class="container">
                <div class="row">
                    <div class="col-md-12 p-5 text-center">
                        <img class="loding-icon m-5" src="{{ asset('loader.svg') }}" alt="">

                    </div>
                </div>
            </div>
            <div id="wrongDivSlider" class="container d-none">
                <div class="row">
                    <div class="col-md-12 p-5 text-center">
                        <h3>Something Went Wrong!</h3>
                    </div>
                </div>
            </div>



            <!-- Slider add -->
            <div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title ml-5">Add New Slider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body  text-center">
                            <div class="container">
                                <div class="row">

                                    <input id="SliderName" type="text" id="" class="form-control mb-3"
                                        placeholder="Slider Name">
                                    <input id="SliderDes" type="text" id="" class="form-control mb-3"
                                        placeholder="Slider Description">
                                    <input type="file" id="Sliderimg" class="form-control mb-3" name="text-input">
                                    <img id="addimagepreview" style="height: 100px !important;" class="imgPreview mt-3 "
                                        src="{{ asset('images/default-image.png') }}" />


                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                            <button id="SliderAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slider add -->

            <!-- Modal Slider Delete -->
            <div class="modal fade" id="deleteModalSlider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-body p-3 text-center">
                            <h5 class="mt-4">Do you want to Delete</h5>
                            <h5 id="SliderDeleteId" class="mt-4 d-none "></h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                            <button data-id="" id="confirmDeleteSlider" type="button"
                                class="btn btn-sm btn-danger">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Slider Delete -->




            <!-- Slider update -->
            <div class="modal fade" id="updateSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update Slider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body  text-center">
                            <div id="SliderEditForm" class="container d-none ">
                                <h5 id="SliderEditId" class="mt-4 d-none"></h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="SliderNameIdUpdate" type="text" id="" class="form-control mb-3"
                                            placeholder="Slider Name">
                                        <input id="SliderDesIdUpdate" type="text" id="" class="form-control mb-3"
                                            placeholder="Slider Description">

                                    </div>
                                    <div class="col-md-6">

                                        <input class="form-control" id="SliderimgUpdate" type="file">
                                        <img id="imagepreview" style="height: 100px !important;" class="imgPreview mt-3 "
                                            src="" />
                                    </div>
                                </div>
                            </div>
                            <img id="SliderLoader" class="loding-icon m-5 d-none" src="{{ asset('loader.svg') }}" alt="">
                            <h3 id="SliderwrongLoader" class="d-none">Something Went Wrong!</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                            <button id="SliderupdateConfirmBtn" type="button"
                                class="btn  btn-sm  btn-danger">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Slider update -->



@endsection
@section('script')
    <script type="text/javascript">
        getSliderdata();
        function getSliderdata() {
            axios.get('/admin/getsliderdata')
                .then(function(response) {
                    if (response.status = 200) {
                        $('#mainDivSlider').removeClass('d-none');
                        $('#loadDivSlider').addClass('d-none');
                        $('#SliderDataTable').DataTable().destroy();
                        $('#Slider_table').empty();
                        var count = 1;
                        var dataJSON = response.data;
                        console.log(dataJSON);
                        $.each(dataJSON, function(i, item) {
                            $('<tr>').html(
                                "<td>" + count++ + " </td>" +
                                "<td><img width='200px' height='80' class='table-img' src=" + dataJSON[i]
                                .image + "> </td>" +
                                "<td>" + dataJSON[i].title + " </td>" +
                                "<td>" + dataJSON[i].sub_title + " </td>" +
                                "<td><a class='SliderEditIcon' data-id=" + dataJSON[i].id +
                                "><i class='fas fa-edit'></i></a> </td>" +
                                "<td><a class='SliderDeleteIcon' data-id=" + dataJSON[i].id +
                                " ><i class='fas fa-trash-alt'></i></a> </td>"
                            ).appendTo('#Slider_table');
                        });
                        //Slider click on delete icon
                        $(".SliderDeleteIcon").click(function() {
                            var id = $(this).data('id');
                            $('#SliderDeleteId').html(id);
                            $('#deleteModalSlider').modal('show');
                        })
                        //Slider edit icon click
                        $(".SliderEditIcon").click(function() {
                            var id = $(this).data('id');
                            $('#SliderEditId').html(id);
                            $('#updateSliderModal').modal('show');
                            SliderUpdateDetails(id);
                        })
                        $('#SliderDataTable').DataTable({
                            "order": false
                        });
                        $('.dataTables_length').addClass('bs-select');
                    } else {
                        $('#wrongDivSlider').removeClass('d-none');
                        $('#loadDivSlider').addClass('d-none');
                    }
                }).catch(function(error) {
                    $('#wrongDivSlider').removeClass('d-none');
                    $('#loadDivSlider').addClass('d-none');
                });
        }
        //add button modal show for add new entity
        $('#addbtnSlider').click(function() {
            $('#addSliderModal').modal('show');
        });


        //Slider Add modal save button
        $('#SliderAddConfirmBtn').click(function() {
            var name = $('#SliderName').val();
            var des = $('#SliderDes').val();
            var img = $('#Sliderimg').prop('files')[0];
            SliderAdd(name, des, img);
        })
        $('#Sliderimg').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#addimagepreview').attr('src', ImgSource)
            }
        })
        //slider Add Method
        function SliderAdd(name, des, img) {
            if (name.length == 0) {
                toastr.error('Slider name is empty!');
            } else if (des == 0) {
                toastr.error('Slider description is empty!');
            } else {
                $('#SliderAddConfirmBtn').html(
                    "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
                my_data = [{
                        name: name,
                        description: des
                    }
                ];
                var formData = new FormData();
                formData.append('data', JSON.stringify(my_data));
                formData.append('photo', img);
                axios.post('/admin/addslider', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function(response) {
                    $('#SliderAddConfirmBtn').html("Save");
                    if (response.status = 200) {
                        if (response.data == 1) {
                            $('#addSliderModal').modal('hide');
                            toastr.success('Add New Success .');
                            $('#SliderName').val("");
                            $('#SliderDes').val("");
                            $('#Sliderimg').val("");
                            document.getElementById("addimagepreview").src = window.location.protocol + "//" +
                                window.document.location.host + "/images/default-image.png";
                            getSliderdata();
                        } else {
                            $('#addSliderModal').modal('hide');
                            toastr.error('Add New Failed');
                            getSliderdata();
                        }
                    } else {
                        $('#addSliderModal').modal('hide');
                        toastr.error('Something Went Wrong');
                    }
                }).catch(function(error) {
                    $('#addSliderModal').modal('hide');
                    toastr.error('Something Went Wrong');
                });
            }
        }
        //each Slider  Details data show for edit
        function SliderUpdateDetails(id) {
            axios.post('/admin/sliderdetails', {
                    id: id
                })
                .then(function(response) {
                    if (response.status == 200) {
                        $('#SliderLoader').addClass('d-none');
                        $('#SliderEditForm').removeClass('d-none');
                        var jsonData = response.data;
                        $('#SliderNameIdUpdate').val(jsonData[0].title);
                        $('#SliderDesIdUpdate').val(jsonData[0].sub_title);
                        var ImgSource = (jsonData[0].image);
                        $('#imagepreview').attr('src', ImgSource)
                    } else {
                        $('#SliderLoader').addClass('d-none');
                        $('#SliderwrongLoader').removeClass('d-none');
                    }
                }).catch(function(error) {
                    $('#SliderLoader').addClass('d-none');
                    $('#SliderwrongLoader').removeClass('d-none');
                });
        }
        $('#SliderimgUpdate').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#imagepreview').attr('src', ImgSource)
            }
        })
        //Slider update modal save button
        $('#SliderupdateConfirmBtn').click(function() {
            var idUpdate = $('#SliderEditId').html();
            var nameUpdate = $('#SliderNameIdUpdate').val();
            var desUpdate = $('#SliderDesIdUpdate').val();
            var img = $('#SliderimgUpdate').prop('files')[0];
            SliderUpdate(idUpdate, nameUpdate, desUpdate, img);
        })
        //update Slider data using modal
        function SliderUpdate(idUpdate, nameUpdate, desUpdate, imgUpdate) {
            if (nameUpdate.length == 0) {
                toastr.error('Proejct name is empty!');
            } else if (desUpdate == 0) {
                toastr.error('Proejct description is empty!');
            } else {
                $('#SliderupdateConfirmBtn').html(
                    "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
                updateData = [{
                        id: idUpdate,
                        name: nameUpdate,
                        description: desUpdate
                    }
                ];
                var formData = new FormData();
                formData.append('data', JSON.stringify(updateData));
                formData.append('photo', imgUpdate);
                axios.post('/admin/sliderupdate', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function(response) {
                    $('#SliderupdateConfirmBtn').html("Update");
                    if (response.status = 200) {
                        if (response.data == 1) {
                            $('#updateSliderModal').modal('hide');
                            toastr.success('Update Success.');
                            getSliderdata();
                        } else {
                            $('#updateSliderModal').modal('hide');
                            toastr.error('Update Failed');
                            getSliderdata();
                        }
                    } else {
                        $('#updateSliderModal').modal('hide');
                        toastr.error('Something Went Wrong');
                    }
                }).catch(function(error) {
                    $('#updateSliderModal').modal('hide');
                    toastr.error('Something Went Wrong');
                });
            }
        }
          //  slider delete modal yes button
          $('#confirmDeleteSlider').click(function() {
            var id = $('#SliderDeleteId').html();
            // var id = $(this).data('id');
            DeleteDataSlider(id);
        })
        //delete Slider function
        function DeleteDataSlider(id) {
            $('#confirmDeleteSlider').html(
                "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
            axios.post('/admin/sliderdelete', {
                    id: id
                })
                .then(function(response) {
                    $('#confirmDeleteSlider').html("Yes");
                    if (response.status == 200) {
                        if (response.data == 1) {
                            $('#deleteModalSlider').modal('hide');
                            toastr.error('Delete Success.');
                            getSliderdata();
                        } else {
                            $('#deleteModalSlider').modal('hide');
                            toastr.error('Delete Failed');
                            getSliderdata();
                        }
                    } else {
                        $('#deleteModalSlider').modal('hide');
                        toastr.error('Something Went Wrong');
                    }
                }).catch(function(error) {
                    $('#deleteModalSlider').modal('hide');
                    toastr.error('Something Went Wrong');
                });
        }
    </script>

@endsection
