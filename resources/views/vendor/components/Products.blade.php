@extends('vendor.layouts.vendor')
@section('title', 'Products')
@section('css')
    <style>
        .modal-dialog-full-width {
            width: 90% !important;
            height: 90% !important;

            padding: 20px !important;
            max-width: none !important;
            margin: 0px auto;

        }

        .modal-content-full-width {
            height: auto !important;
            min-height: 100% !important;
            border-radius: 0 !important;
            background-color: #ececec !important
        }

        .modal-header-full-width {
            border-bottom: 1px solid #9ea2a2 !important;
        }

        .modal-footer-full-width {
            border-top: 1px solid #9ea2a2 !important;
        }

    </style>
@endsection

@section('content')
    @include('vendor.partials.productPartisal')

@endsection

@section('script')

    <script>
        getProductsdata();


        // for Products table

        function getProductsdata() {


            axios.get("{{ route('vendor.getProductData') }}")
                .then(function(response) {

                    if (response.status = 200) {

                        $('#mainDivProducts').removeClass('d-none');
                        $('#loadDivProducts').addClass('d-none');

                        $('#productDataTable').DataTable().destroy();
                        $('#product_table').empty();
                        var dataJSON = response.data;

                        var count = 1;
                        $.each(dataJSON, function(i, item) {
                            var pdStatus=""
                            if ( dataJSON[i].product_active==1) {
                                pdStatus="Publish"
                            }else{
                                pdStatus="Panding"
                            }
                            $('<tr class="text-center">').html(
                                "<td>" + count++ + " </td>" +
                                "<td>" + dataJSON[i].product_title + " </td>" +
                                "<td>" + dataJSON[i].product_price + " </td>" +
                                "<td>" + dataJSON[i].product_selling_price + " </td>" +
                                "<td>" + dataJSON[i].product_quantity + " </td>" +
                                "<td>" + dataJSON[i].get_category.name + " </td>" +
                                "<td>" + dataJSON[i].get_brand.name + " </td>" +
                                "<td>" +pdStatus + " </td>" +
                                "<td><a class='productView' data-id=" + dataJSON[i].id +
                                "><i class='fas fa-eye'></i></a></td>" +
                                "<td><a class='productEdit' data-id=" + dataJSON[i].id +
                                "><i class='fas fa-edit'></i></a> </td>" +
                                "<td><a class='productDeleteIcon' data-id=" + dataJSON[i].id +
                                " ><i class='fas fa-trash-alt'></i></a> </td>"
                            ).appendTo('#product_table');
                        });

                        //Products click on delete icon

                        $(".productDeleteIcon").click(function() {

                            var id = $(this).data('id');
                            $('#productDeleteId').html(id);
                            $('#productModalDelete').modal('show');

                        })


                        //Products edit icon click

                        $(".productView").click(function() {
                            var id = $(this).data('id');
                            $('#productsViewId').html(id);
                            $('#viewProductModal').modal('show');
                            ProductsViewDetails(id);


                        })

                        //Products edit icon click

                        $(".productEdit").click(function() {
                            var id = $(this).data('id');
                            $('#productEditId').html(id);

                            $('#updateProductModal').modal('show');
                            ProductsEditDetails(id);

                        })


                        $('#productDataTable').DataTable({
                            "order": false
                        });
                        $('.dataTables_length').addClass('bs-select');

                    } else {
                        $('#wrongDivProducts').removeClass('d-none');
                        $('#loadDivProducts').addClass('d-none');

                    }
                }).catch(function(error) {

                    $('#wrongDivProducts').removeClass('d-none');
                    $('#loadDivProducts').addClass('d-none');
                });

        }




        //add button modal show for add new entity

        $('#addBtnproduct').click(function() {
            $('#addProductModal').modal('show');
        });




        // Add Category List
        axios.get("{{ route('admin.getCategoriesData') }}")
            .then(function(response) {
                var dataJSON = response.data;
                $('#pdCategory').empty();
                $('#pdCategory').append(`<option disabled selected value="0">Select Category</option>`);
                $.each(dataJSON, function(i, item) {

                    $('#pdCategory').append(
                        `<option value="${dataJSON[i].id}"> ${dataJSON[i].name} </option>`);

                    $('#pdCategory').material_select('refresh');
                });
            }).catch(function(error) {
                alert("There are no Category")
            });





        // Add Category List
        axios.get("{{ route('admin.getBrandsData') }}")
            .then(function(response) {
                var dataJSON = response.data;

                $('#pdBrand').empty();
                $('#pdBrand').append(`<option disabled selected >Select Brand</option>`);
                $.each(dataJSON, function(i, item) {

                    $('#pdBrand').append(
                        `<option value="${dataJSON[i].id}"> ${dataJSON[i].brandName} </option>`);

                    $('#pdBrand').material_select('refresh');
                });
            }).catch(function(error) {
                alert("There are no Brand")
            });





        $('#productImageOne').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#productImageOnePreview').attr('src', ImgSource)
            }
        })

        $('#productImageTwo').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#productImageTwoPreview').attr('src', ImgSource)
            }
        })

        $('#productImageThree').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#productImageThreePreview').attr('src', ImgSource)
            }
        })

        $('#productImageFour').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#productImageFourPreview').attr('src', ImgSource)
            }
        })

        $('#productImageFive').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#productImageFivePreview').attr('src', ImgSource)
            }
        })



        //Product Add
        $('#productAddConfirmBtn').click(function() {
            var product_title = $('#pdName').val();
            var product_discription = $('#pdDescription').val();
            var product_price = $('#pdPrice').val();
            var product_saving = $('#pdSaving').val();
            var product_selling_price = $('#pdOffer').val();
            var product_quantity = $('#pdQuantity').val();
            var product_category_id = $('#pdCategory').val();
            var product_brand_id = $('#pdBrand').val();
            var product_in_stock = $('#pdStock').val();
            var feture_products = $('#pdFeature').val();
            var product_active = $('#pdActive').val();
            var pdTax = $('#pdTax').val();
            var deliveryCharge = $('#deliveryCharge').val();
            var product_delivary_charge_type = $('#product_delivary_charge_type').val();
            var images = [];
            $("input[name='productImage[]']").each(function() {
                if ($(this).prop('files')[0] !== undefined) {
                    images.push($(this).prop('files')[0]);
                }
            });

            var selectedmesermentId =  $('#pdmeserment').val();

            // Producr Color Add
            var product_colors=$("input[name='pdcolor[]']").map(function(){return $(this).val();}).get();


            if (selectedmesermentId == 1) {
                pdmesermentValue=[];
                var pdmesermentValue=$("input[name='sizeValue[]']").map(function(){return $(this).val();}).get();
            } else if(selectedmesermentId == 2){
                var wightMesermentValue=$("input[name='WightmesermentValue[]']").map(function(){return $(this).val();}).get();
                var wightMesermentType=$("input[name='WightmesermentType[]']").map(function(){return $(this).val();}).get();
                pdmesermentValue=[];
                for (let m = 0; m < wightMesermentValue.length; m++) {
                    const element = (wightMesermentValue[m]).toString()+'-'+(wightMesermentType[m]).toString();
                    pdmesermentValue.push(element);
                }

            }else{
                pdmesermentValue=[];
                var diamentionValue=$("input[name='pdmesermentValue[]']").map(function(){return $(this).val();}).get();
                var diamentiontype=$("input[name='diamentionInput[]']").map(function(){return $(this).val();}).get();
                for (let d = 0; d < diamentionValue.length; d++) {
                    const element = (diamentionValue[d]).toString() +'-'+ diamentiontype[d].toString();
                    pdmesermentValue.push(element);
                }
            }




            productAdd(product_title, product_discription, product_price,product_saving,product_selling_price, product_quantity,
                product_category_id, product_brand_id, product_in_stock, feture_products, product_active,
                images,selectedmesermentId,pdmesermentValue,product_colors, pdTax, deliveryCharge, product_delivary_charge_type);
        });

        function productAdd(product_title, product_discription, product_price,product_saving, product_selling_price, product_quantity,
            product_category_id, product_brand_id, product_in_stock, feture_products, product_active, images,selectedmesermentId,pdmesermentValue ,product_colors, pdTax, deliveryCharge, product_delivary_charge_type) {

            if (product_title.length == 0) {
                toastr.error('Product Title is empty!');
                $('#pdName').focus();
                $('#pdName').css('border', '1px solid red');
            } else if (product_discription.length == 0) {
                toastr.error('Product Description is empty!');
            } else if (product_price.length == 0) {
                toastr.error('Product Price is empty!');
            } else if (product_quantity.length == 0) {
                toastr.error('Product Quantity is empty!');
            } else if (product_saving.length == 0) {
                toastr.error('Discount is empty! Please input minimum 0');
            }else if (product_selling_price.length == 0) {
                toastr.error('Selling Price is empty!');
            } else if (pdTax.length == 0) {
                toastr.error('Tax is empty! Please input minimum 0');
            }  else if (deliveryCharge.length == 0) {
                toastr.error('Delivery Charge is empty!');
            } else {
                $('#productAddConfirmBtn').html(
                    "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
                my_data = [{
                    product_title: product_title,
                    product_discription: product_discription,
                    product_price: product_price,
                    product_saving:product_saving,
                    product_selling_price: product_selling_price,
                    product_quantity: product_quantity,
                    product_category_id: product_category_id,
                    product_brand_id: product_brand_id,
                    product_in_stock: product_in_stock,
                    feture_products: feture_products,
                    product_active: product_active,
                    pdmesermentValue: pdmesermentValue,
                    product_colors: product_colors,
                    selectedmesermentId: selectedmesermentId,
                    pdTax: pdTax,
                    deliveryCharge: deliveryCharge,
                    product_delivary_charge_type: product_delivary_charge_type,
                }];
                var fm = new FormData();
                fm.append('data', JSON.stringify(my_data));
                let TotalImages = images.length; //Total Images
                images.forEach(images => {
                    fm.append('images[]', images);
                })


                axios.post("{{ route('vendor.productAdd') }}", fm, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function(response) {


                    $('#productAddConfirmBtn').html("Save");
                    if (response.status = 200) {
                        if (response.data == 1) {
                            $('#addProductModal').modal('hide');
                            toastr.success('Add New Success .');

                            $('#pdName').val("");
                            $('#pdDescription').val("");
                            $('#pdPrice').val("");
                            $('#pdOffer').val("");
                            $('#pdQuantity').val("1");
                            $('#pdTax').val("");
                            $('#deliveryCharge').val("");
                            $('#pdSaving').val("0");
                            $('#product_delivary_charge_type option').prop('selected', function() {
                                     return this.defaultSelected;
                            });

                            $('#pdCategory option').prop('selected', function() {
                                     return this.defaultSelected;
                            });
                            $('#pdBrand option').prop('selected', function() {
                                     return this.defaultSelected;
                            });
                            $('#pdStock option').prop('selected', function() {
                                     return this.defaultSelected;
                            });
                            $('#pdFeature option').prop('selected', function() {
                                     return this.defaultSelected;
                            });
                            $('#pdActive option').prop('selected', function() {
                                     return this.defaultSelected;
                            });
                            $('#pdmeserment option').prop('selected', function() {
                                     return this.defaultSelected;
                            });
                            $('.meserment_input').html("");
                            $('#append_tbody').html("");

                            var image_path=['One','Two', 'Three', 'Four', 'Five' ];
                            for (let index = 0; index < image_path.length; index++) {
                            $('#productImage'+image_path[index]+'Preview').attr('src',  window.location.protocol +
                                "//" +  window.document.location.host + "/admin/images/default-image.png");
                            $('#productImage'+image_path[index]).val("");
                            };

                            getProductsdata();

                        } else {
                            $('#addProductModal').modal('hide');
                            toastr.error('Add New Failed');
                            getProductsdata();
                        }
                    } else {
                        $('#addProductModal').modal('hide');
                        toastr.error('Something Went Wrong');
                    }
                }).catch(function(error) {
                    $('#addProductModal').modal('hide');
                    toastr.error('Something Went Wrong.....');
                });
            }
        }

        //  Brands delete modal yes button
        $('#confirmDeleteproduct').click(function() {
            var id = $('#productDeleteId').html();
            // var id = $(this).data('id');
            DeleteProductsData(id);
        });

        //delete Brands function
        function DeleteProductsData(id) {
            $('#confirmDeleteproduct').html(
                "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
            axios.post("{{ route('vendor.delete') }}", {
                    id: id
                })
                .then(function(response) {

                    $('#confirmDeleteproduct').html("Yes");
                    if (response.status == 200) {
                        if (response.data == 1) {
                            $('#productModalDelete').modal('hide');
                            toastr.error('Delete Success.');
                            getProductsdata();
                        } else {
                            $('#productModalDelete').modal('hide');
                            toastr.error('Delete Failed');
                            getProductsdata();
                        }
                    } else {
                        $('#productModalDelete').modal('hide');
                        toastr.error('Something Went Wrong');
                    }
                }).catch(function(error) {
                    $('#productModalDelete').modal('hide');
                    toastr.error('Something Went Wrong');
                });
        }





// Product Details View
        function ProductsViewDetails(id) {
            axios.post("{{ route('vendor.getEditProductsData') }}", {
                    id: id
                })
                .then(function(response) {
                    if (response.status == 200) {
                        $('#loadDivProducts').addClass('d-none');
                        $('#ProductsEditForm').removeClass('d-none');

                        var dataJSON = response.data;

                        var productOwner=" ";
                        if (dataJSON[0].product_owner_id==0) {
                            productOwner="vendor";
                        }else{
                            productOwner=dataJSON[0].vendor.name;
                        }

                        var delivary_charge_type="";
                        if (  dataJSON[0].product_delivary_charge_type==0) {
                            delivary_charge_type="Group Product";
                        }else{
                            delivary_charge_type="Per Product";
                        }


                        $('#pdNameShow').html(dataJSON[0].product_title)
                        $('#pdDesShow').html(dataJSON[0].product_discription)
                        $('#pdPriceShow').html(dataJSON[0].product_price)
                        $('#pdSellPrice').html(dataJSON[0].product_selling_price)
                        $('#pdDiscount').html(dataJSON[0].product_saving+" %")
                        $('#product_quantity').html(dataJSON[0].product_quantity)
                        $('#pdViewTax').html(dataJSON[0].product_tax+" %")
                        $('#deliveryViewCharge').html(dataJSON[0].product_delivary_charge)
                        $('#product_category_id').html(dataJSON[0].get_category.name)
                        $('#product_brand_id').html(dataJSON[0].get_brand.name)
                        $('#product_if_has_color').html(dataJSON[0].product_if_has_color)
                        $('#product_meserment_type').html(dataJSON[0].product_meserment_type)
                        $('#product_owner_id').html(productOwner);
                        $('#product_delivary_charge_type_view').html(delivary_charge_type);




                        var imageViewHtml="";
                        for (let index = 0; index < dataJSON[0].image.length; index++) {
                            const element = dataJSON[0].image[index];
                            imageViewHtml+='<div class="border border-secondary text-center">';
                            imageViewHtml+='<img clsss="mx-auto d-block" style="width:200px;height:100px"  src="'+element.image_path+'" alt="">';
                            imageViewHtml+='</div>';
                            $('.ImageView').html(imageViewHtml);
                        }

                        var masermentHtml="";
                        for (let index = 0; index < dataJSON[0].maserment.length; index++) {
                            const element = dataJSON[0].maserment[index];
                            masermentHtml+='<li class="border border-secondary text-center p-2 m-1">';
                            masermentHtml+=element.meserment_value;

                            masermentHtml+='</li>';
                            $('#product_meserment_type').html(masermentHtml);
                        }


                        var colortHtml="";
                        for (let index = 0; index < dataJSON[0].color.length; index++) {
                            const element = dataJSON[0].color[index];
                            colortHtml+='<li class="border border-secondary text-center p-2 m-1" style="border-radius:50%; width:40px; height:40px; background-color:'+element.product_color_code+'">';
                            colortHtml+='</li>';
                            $('#product_if_has_color').html(colortHtml);
                        }

                        getProductsdata();

                    } else {
                        $('#loadDivProducts').addClass('d-none');
                        $('#wrongDivProducts').removeClass('d-none');
                        getProductsdata();
                    }
                }).catch(function(error) {
                    $('#loadDivProducts').addClass('d-none');
                    $('#wrongDivProducts').removeClass('d-none');
                });
        }






        // Add Category List
        axios.get("{{ route('admin.getCategoriesData') }}")
            .then(function(response) {

                var dataJSON = response.data;
                $('#pdEditCategory').empty();
                $('#pdEditCategory').append(
                    `<option  selected class='p-5 m-5' value='0'>Parent Category</option>`);
                $.each(dataJSON, function(i, item) {
                    $('#pdEditCategory').append(
                        `<option value="${dataJSON[i].id}"> ${dataJSON[i].name} </option>`);

                    $('#pdEditCategory').material_select('refresh');
                });
            }).catch(function(error) {
                alert("There are no Category")
            });





        // Add Category List
        axios.get("{{ route('admin.getBrandsData') }}")
            .then(function(response) {
                var dataJSON = response.data;

                $('#pdEditBrand').empty();
                $('#pdEditBrand').append(`<option disabled selected >Select Brand</option>`);
                $.each(dataJSON, function(i, item) {

                    $('#pdEditBrand').append(
                        `<option value="${dataJSON[i].id}"> ${dataJSON[i].brandName} </option>`);

                    $('#pdEditBrand').material_select('refresh');
                });
            }).catch(function(error) {
                alert("There are no Brand")
            });




        $('#productEditImageOne').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#productEditImageOnePreview').attr('src', ImgSource)
            }
        })

        $('#productEditImageTwo').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#productEditImageTwoPreview').attr('src', ImgSource)
            }
        })

        $('#productEditImageThree').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#productEditImageThreePreview').attr('src', ImgSource)
            }
        })

        $('#productEditImageFour').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#productImageEditFourPreview').attr('src', ImgSource)
            }
        })

        $('#productEditImageFive').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#productImageEditFivePreview').attr('src', ImgSource)
            }
        })


        var colorExistCount=0;
        var mesermenExitCount=0;
        function ProductsEditDetails(id) {
            axios.post("{{ route('vendor.getEditProductsData') }}", {
                    id: id
                })
                .then(function(response) {

                    $('#product_id_edit').val(id);


                    if (response.status == 200) {
                        $('#loadDivProducts').addClass('d-none');
                        $('#CategoryEditForm').removeClass('d-none');

                        var jsonData = response.data;
                         colorExistCount=jsonData[0].color.length;
                        $('#addEditColorInput').html("")


                            for (let x = 0; x < jsonData[0].color.length ; x++) {
                                const element = jsonData[0].color[x];


                            var html7='';
                                html7+= '<tr id="rowid' + x + '">';
                                html7+='<td>';
                                html7+='<div id="inputEdit' + x + '" class="input-group" name="colorInputEdit" title="Using input value">';
                                html7+='<input type="text" class="form-control input-lg" name="pdcolorEdit[]" value="'+element.product_color_code+'"/>';
                                html7+='<span class="input-group-append">';
                                html7+='<span class="input-group-text colorpicker-input-addon"><i></i></span>';
                                html7+='</span>';
                                html7+='</div>';
                                html7+='</td>';
                                html7 +='<td class="text-center p-0"> <button onclick="removeColorInput(' + x + ');" class="btn  btn-danger btn-sm p-o"><i class="fas fa-minus-circle fa-2x"></i></button></td>';
                                html7 +='</tr>';

                                $('#addEditColorInput').append(html7);
                            }

                        for (let y = 0; y < colorExistCount; y++) {

                            $('#inputEdit'+y).colorpicker();

                        }


                        mesermenExitCount=jsonData[0].maserment.length;



                        var html9="";



                            if (jsonData[0].product_meserment_type == 1) {
                                html9+='<table class="table table-bordered"><thead clss="text-center"><tr><th>Entry</th><th>Meserments</th><th class="text-center"><button class="btn btn-success btn-sm ml-auto" onclick="addMoreBtnForMesermrntSizeEdit();">Add More</button></th></tr></thead><tbody id="MesermrntSizeEdit">';

                        for (let mesermentExist = 0; mesermentExist < jsonData[0].maserment.length; mesermentExist++) {
                            const element2 = jsonData[0].maserment[mesermentExist];
                            html9+='<tr class="sizedivEdit'+mesermentExist+'">';
                            html9+='<td colspan="2">';
                            html9+='<select id="pdmesermentValueEdit'+mesermentExist+'" onChange="sizeOnChangeEdit('+size+')" name="pdmesermentValueEdit[]" style="margin-bottom: 10px;" class="browser-default custom-select">';
                            html9+='<option selected>Select Type</option>';
                            html9+='<option '+(element2.meserment_value == "xsm" ? 'selected' : '')+' value="xsm" seclected>Extra Small</option>';
                            html9+='<option '+(element2.meserment_value == "sm" ? 'selected' : '')+' value="xsm" seclected> Small</option>';
                            html9+='<option '+(element2.meserment_value == "md" ? 'selected' : '')+' value="md">Medium</option>';
                            html9+='<option '+(element2.meserment_value == "lg" ? 'selected' : '')+' value="lg">Large</option>';
                            html9+='<option '+(element2.meserment_value == "xl" ? 'selected' : '')+' value="xl">Extra Large</option>';
                            html9+='<option '+(element2.meserment_value == "xxl" ? 'selected' : '')+' value="xxl">Dubble Extra Large</option>';
                            html9+='</select><input type="hidden" id="sizeValueEdit'+mesermentExist+'" value="'+ element2.meserment_value +'" name="sizeValueEdit[]" />';
                            html9+='</td>';
                            html9+='<td class="text-center">';
                            html9+='<button class="btn btn-danger btn-sm mt-0" onclick="SizeRemoveEdit('+mesermentExist+');"><i class="fas fa-minus-circle"></i></button>';
                            html9+='</td>';
                            html9+='</tr>';
                        }
                        }else if (jsonData[0].product_meserment_type == 2) {

                        html9+='<table class="table table-bordered"><thead clss="text-center"><tr><th>Entry</th><th>Meserments</th><th class="text-center"><button class="btn btn-success btn-sm ml-auto" onclick="addMoreBtnForMesermrntWeightEdit();">Add More</button></th></tr></thead><tbody id="MesermrntWeightEdit">';

                        for (let mesermentExist = 0; mesermentExist < jsonData[0].maserment.length; mesermentExist++) {
                            var splitValueForWightMesermrnt=[];
                            const element2 = jsonData[0].maserment[mesermentExist];
                            splitValueForWightMesermrnt=(element2.meserment_value).split('-');

                            html9 += '<tr id="WightdivEdit'+mesermentExist+'">';
                            html9 += '<td>';
                            html9 += '<input id="WightmesermentValueEdit" name="WightmesermentValueEdit[]" value="'+splitValueForWightMesermrnt[0]+'" type="text" class="form-control" placeholder="Product Wight"/>';
                            html9 += '</td>';
                            html9 += '<td>';
                            html9 += '<select id="WightmesermentTypeEdit'+mesermentExist+'" onChange="setWightInputValueEdit('+mesermentExist+');"  style="margin-bottom: 10px;" class="browser-default custom-select">';

                            html9 += '<option">Select Type</option>';
                            html9 += '<option '+(splitValueForWightMesermrnt[1] == "mg" ? 'selected' : '' )+' value="mg">Mg</option>';
                            html9 += '<option '+(splitValueForWightMesermrnt[1] == "gm" ? 'selected' : '' )+' value="gm">Gm</option>';
                            html9 += '<option '+(splitValueForWightMesermrnt[1] == "kg" ? 'selected' : '' )+' value="kg">Kg</option>';
                            html9 += '<option '+(splitValueForWightMesermrnt[1] == "galon" ? 'selected' : '' )+' value="galon">Galon</option>';
                            html9 += '<input type="hidden" id="wightValueEdit'+mesermentExist+'" value="'+splitValueForWightMesermrnt[1]+'" name="WightmesermentTypeEdit[]"/></td>';
                            html9 += '<td class="text-center">';
                            html9 += '<button class="btn btn-danger btn-sm mt-0" onclick="WightrowRemoveEdit('+mesermentExist+')"><i class="fas fa-minus-circle"></i></button>';
                            html9 += '</td>';
                            html9 += '</tr>';
                        }

                    }else if (jsonData[0].product_meserment_type == 3) {
                        html9+='<table class="table table-bordered"><thead clss="text-center"><tr><th>Entry</th><th>Meserments</th><th class="text-center"><button class="btn btn-success btn-sm ml-auto" onclick="addMoreBtnForMesermrntDiamentionEdit();">Add More</button></th></tr></thead><tbody id="MesermrntDimentionEdit">';

                        for (let mesermentExist = 0; mesermentExist < jsonData[0].maserment.length; mesermentExist++) {
                            var splitValueForWightMesermrnt=[];
                            const element2 = jsonData[0].maserment[mesermentExist];
                            splitValueForWightMesermrnt=(element2.meserment_value).split('-');
                        html9 += '<tr class="DiamentionRowedit'+mesermentExist+'">';
                        html9 += '<td>';
                        html9 += '<input  name="diamentionValueInputEdit[]" type="text" value="'+splitValueForWightMesermrnt[0]+'" class="form-control" placeholder="Product Dimension"/>';
                        html9 += '</td>';
                        html9 += '<td>';
                        html9 += '<select id="DiamentionmesermentEdit'+mesermentExist+'" onchange="setDiamentionInputValueEdit('+mesermentExist+')" style="margin-bottom: 10px;" class="browser-default custom-select">';
                        html9 += '<option>Select Type</option>';
                        html9 += '<option '+(splitValueForWightMesermrnt[1] == "metter" ? 'selected' : '' )+' value="metter">Metter</option>';
                        html9 += '<option '+(splitValueForWightMesermrnt[1] == "cm" ? 'selected' : '' )+' value="cm">Centi Metter</option>';
                        html9 += '<option '+(splitValueForWightMesermrnt[1] == "inc" ? 'selected' : '' )+' value="inc">Inch</option>';
                        html9 += '<option '+(splitValueForWightMesermrnt[1] == "feet" ? 'selected' : '' )+' value="feet">feet</option>';
                        html9 += '</select><input type="hidden" id="diamentionValueEdit'+mesermentExist+'" value="'+splitValueForWightMesermrnt[1]+'" name="diamentionInputEdit[]" /></td>';
                        html9 += '<td class="text-center">';
                        html9 += '<button class="btn btn-danger btn-sm mt-0" onclick="diamentionRowRemoveEdit('+mesermentExist+');"><i class="fas fa-minus-circle"></i></button>';
                        html9 += '</td>';
                        html9 += '</tr>';

                        }

                    }

                        html9+='</tbody><table>';
                        $('.meserment_edit').html(html9);

                        $('#pdEditName').val(jsonData[0].product_title);

                        $('#pdEditDescription').val(jsonData[0].product_discription);

                        $('#pdEditPrice').val(jsonData[0].product_price);

                        $('#pdEditSaving').val(jsonData[0].product_saving);

                        $('#pdEditOffer').val(jsonData[0].product_selling_price);


                        $('#pdEditQuantity').val(jsonData[0].product_quantity);
                        $('#pdEditTax').val(jsonData[0].product_tax);
                        $('#deliveryEditCharge').val(jsonData[0].product_delivary_charge);

                        $('#product_delivary_charge_type_edit option[value=' + jsonData[0].product_delivary_charge_type + ']').prop('selected','true');

                        $('#pdEditCategory option[value=' + jsonData[0].product_category_id + ']').prop('selected','true');

                        $('#pdEditBrand option[value=' + jsonData[0].product_brand_id + ']').prop('selected', 'true');

                        $('#pdEditStock option[value=' + jsonData[0].product_in_stock + ']').prop('selected', 'true');

                        $('#pdEditFeature option[value=' + jsonData[0].feture_products + ']').prop('selected', 'true');

                        $('#pdEditStatus option[value=' + jsonData[0].product_active + ']').prop('selected', 'true');


                        $('#pdmesermentEdit option[value=' + jsonData[0].product_meserment_type + ']').prop('selected', 'true');


                        var image_path=['One','Two', 'Three', 'Four', 'Five' ]

                        for (let index = 0; index < jsonData[0].image.length; index++) {
                            var ImgSource = (jsonData[0].image[index].image_path);

                        $('#productEditImage'+image_path[index]+'Preview').attr('src', ImgSource)
                        }




                    } else {
                        $('#loadDivProducts').addClass('d-none');
                        $('#wrongDivProducts').removeClass('d-none');
                    }
                }).catch(function(error) {
                    $('#loadDivProducts').addClass('d-none');
                    $('#wrongDivProducts').removeClass('d-none');

                });
        }




        // Update Product
        $('#productEditConfirmBtn').click(function () {

            var slelctedmesermentEdit=$('#pdmesermentEdit').val();
            if (slelctedmesermentEdit == 1) {
                var pdmesermentValueEdit=[];
                var pdmesermentValueEdit=$("input[name='sizeValueEdit[]']").map(function(){return $(this).val();}).get();


            }else if(slelctedmesermentEdit == 2){
                var pdmesermentValueEdit=[];
                var editedValueOfWeight=$("input[name='WightmesermentValueEdit[]']").map(function(){return $(this).val();}).get();
                var editedValueOfWeightType=$("input[name='WightmesermentTypeEdit[]']").map(function(){return $(this).val();}).get();



                for (let a = 0; a < editedValueOfWeight.length; a++) {
                    const element = (editedValueOfWeight[a]).toString()+'-'+(editedValueOfWeightType[a]).toString();
                    pdmesermentValueEdit.push(element);

                }



            }else if(slelctedmesermentEdit == 3){
                var pdmesermentValueEdit=[];
                var editedValueOfDiamention=$("input[name='diamentionValueInputEdit[]']").map(function(){return $(this).val();}).get();
                var editedValueOfDiamentionType=$("input[name='diamentionInputEdit[]']").map(function(){return $(this).val();}).get();
                for (let b = 0; b < editedValueOfDiamention.length; b++) {
                    const element = (editedValueOfDiamention[b]).toString()+'-'+(editedValueOfDiamentionType[b]).toString();
                    pdmesermentValueEdit.push(element);
                }



            }


            console.log(pdmesermentValueEdit);


        var editedValueOfColor=$("input[name='pdcolorEdit[]']").map(function(){return $(this).val();}).get();
        var pdEditName=$('#pdEditName').val();
        var pdEditDescription=$('#pdEditDescription').val();
        var pdEditPrice=$('#pdEditPrice').val();
        var pdEditSaving=$('#pdEditSaving').val();
        var pdEditOffer=$('#pdEditOffer').val();
        var pdEditQuantity=$('#pdEditQuantity').val();
        var pdEditTax=$('#pdEditTax').val();
        var deliveryEditCharge=$('#deliveryEditCharge').val();
        var pdEditCategory=$('#pdEditCategory').val();
        var pdEditBrand=$('#pdEditBrand').val();
        var pdEditStock=$('#pdEditStock').val();
        var pdEditFeature=$('#pdEditFeature').val();
        var pdEditStatus=$('#pdEditStatus').val();
        var product_delivary_charge_type_edit=$('#product_delivary_charge_type_edit').val();

        var editImagesValue=[];

        $("input[name='productEditImage[]']").each(function() {
            if ($(this).prop('files')[0] !== undefined) {
                editImagesValue.push($(this).prop('files')[0]);
            }
        });

        var product_id_edit=$('#product_id_edit').val();



        productUpadate(product_id_edit, pdEditName, pdEditDescription, pdEditPrice,pdEditSaving, pdEditOffer, pdEditQuantity, pdEditCategory, pdEditBrand, pdEditStock, pdEditFeature, pdEditStatus, editImagesValue, pdmesermentValueEdit, editedValueOfColor,slelctedmesermentEdit, pdEditTax, deliveryEditCharge, product_delivary_charge_type_edit)


        });


        function productUpadate(product_id_edit, pdEditName, pdEditDescription, pdEditPrice,pdEditSaving, pdEditOffer, pdEditQuantity, pdEditCategory, pdEditBrand, pdEditStock, pdEditFeature, pdEditStatus, editImagesValue, pdmesermentValueEdit, editedValueOfColor,slelctedmesermentEdit, pdEditTax, deliveryEditCharge, product_delivary_charge_type_edit) {
            if (pdEditName.length == 0) {
                toastr.error('Product Title is empty!');
                $('#pdName').focus();
                $('#pdName').css('border', '1px solid red');
            } else if (pdEditDescription.length == 0) {
                toastr.error('Product Description is empty!');
            } else if (pdEditPrice.length == 0) {
                toastr.error('Product Price is empty!');
            } else if (pdEditQuantity.length == 0) {
                toastr.error('Product Quantity is empty!');
            }else if (pdEditTax.length == 0) {
                toastr.error('Product Tax is empty!');
            }else if (pdEditSaving.length == 0) {
                toastr.error('Discount is empty! Please input minimum 0');
            }else if (pdEditOffer.length == 0) {
                toastr.error('Selling Price is empty!');
            }else if (deliveryEditCharge.length == 0) {
                toastr.error('Delivery is empty!');
            } else {
                $('#productEditConfirmBtn').html(
                    "<div class='spinner-border spinner-border-sm text-primary' role='status'></div>"); //animation
                my_data = [{
                    product_id_edit: product_id_edit,
                    pdEditName: pdEditName,
                    pdEditDescription: pdEditDescription,
                    pdEditPrice: pdEditPrice,
                    pdEditSaving: pdEditSaving,
                    pdEditOffer: pdEditOffer,
                    pdEditQuantity: pdEditQuantity,
                    pdEditCategory: pdEditCategory,
                    pdEditBrand: pdEditBrand,
                    pdEditStock: pdEditStock,
                    pdEditFeature: pdEditFeature,
                    pdEditStatus: pdEditStatus,
                    editedValueOfColor: editedValueOfColor,
                    pdmesermentValueEdit: pdmesermentValueEdit,
                    slelctedmesermentEdit:slelctedmesermentEdit,
                    pdEditTax:pdEditTax,
                    deliveryEditCharge:deliveryEditCharge,
                    product_delivary_charge_type_edit:product_delivary_charge_type_edit,
                }];
                var fm = new FormData();
                fm.append('data', JSON.stringify(my_data));
                let TotalImages = editImagesValue.length; //Total Images
                editImagesValue.forEach(editImagesValue => {
                    fm.append('images[]', editImagesValue);
                })

                axios.post("{{ route('vendor.productsUpdate') }}", fm, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function(response) {
                    console.log(response.data);

                    $('#productEditConfirmBtn').html("Save");
                    if (response.status = 200) {
                        if (response.data == 1) {
                            $('#updateProductModal').modal('hide');
                            toastr.success('Update Success .');

                            getProductsdata();
                        } else {
                            $('#updateProductModal').modal('hide');
                            toastr.error('Update Failed');
                            getProductsdata();
                        }
                    } else {
                        $('#updateProductModal').modal('hide');
                        toastr.error('Something Went Wrong');
                    }
                }).catch(function(error) {
                    console.log(error);
                    $('#updateProductModal').modal('hide');
                    toastr.error('Something Went Wrong.....');

                });
            }

        }













        $('#pdmeserment').change(function () {
        var pdmesermentId = $('#pdmeserment').val();


    var html = "";
    if (pdmesermentId == 1) {
        html+='<table class="table table-bordered"><thead clss="text-center"><tr><th>Entry</th><th>Meserments</th><th class="text-center"><button class="btn btn-success btn-sm ml-auto" onclick="addMoreBtnForMesermrntSize();">Add More</button></th></tr></thead><tbody id="MesermrntSize">';


    } else if (pdmesermentId == 2) {
        html+='<table class="table table-bordered"><thead clss="text-center"><tr><th>Entry</th><th>Meserments</th><th class="text-center"><button class="btn btn-success btn-sm ml-auto" onclick="addMoreBtnForMesermrntWight();">Add More</button></th></tr></thead><tbody id="MesermrntWight">';




    } else if (pdmesermentId == 3) {
        html+='<table class="table table-bordered"><thead clss="text-center"><tr><th>Entry</th><th>Meserments</th><th class="text-center"><button class="btn btn-success btn-sm ml-auto" onclick="addMoreBtnForMesermrntDiamention();">Add More</button></th></tr></thead><tbody id="MesermrntDiamention">';

    } else {
        html += '<h4>No Meserment Selected</h4>';
    }
    html+='</tbody><table>'

    $('.meserment_input').html(html);
    addExtraColum(pdmesermentId);
});



var size=0;
function addMoreBtnForMesermrntSize() {
    size++;

    var html2="";
    html2+='<tr class="sizediv'+size+'">';
    html2+='<td colspan="2">';
    html2+='<select id="pdmesermentValue'+size+'" onChange="sizeOnChange('+size+')" name="pdmesermentValue[]" style="margin-bottom: 10px;" class="browser-default custom-select">';
    html2+='<option selected>Select Type</option>';
    html2+='<option value="xsm" seclected>Extra Small</option>';
    html2+='<option value="sm">Small</option>';
    html2+='<option value="md">Medium</option>';
    html2+='<option value="lg">Large</option>';
    html2+='<option value="xl">Extra Large</option>';
    html2+='<option value="xxl">Dubble Extra Large</option>';
    html2+='</select><input type="hidden" id="sizeValue'+ size +'" name="sizeValue[]" />';
    html2+='</td>';
    html2+='<td class="text-center">';
    html2+='<button class="btn btn-danger btn-sm mt-0" onclick="SizeRemove('+size+')"><i class="fas fa-minus-circle"></i></button>';
    html2+='</td>';
    html2+='</tr>';

    $('#MesermrntSize').append(html2);

}
function SizeRemove(id) {
    $('.sizediv'+id).remove();
}

function sizeOnChange(id){
    var getSizeValueforPushToInput=$('#pdmesermentValue'+id).val();
    $('#sizeValue'+id).val(getSizeValueforPushToInput);

}

var Wightrow = 0;

function addMoreBtnForMesermrntWight() {
    Wightrow++;

    var html3 = "";
    html3 += '<tr class="Wightdiv'+Wightrow+'">';
    html3 += '<td>';
    html3 += '<input id="WightmesermentValue" name="WightmesermentValue[]"  type="text" class="form-control" placeholder="Product Wight"/>';
    html3 += '</td>';
    html3 += '<td>';
    html3 += '<select id="WightmesermentType'+Wightrow+'" onChange="setWightInputValue('+Wightrow+');" name="WightmesermentType[]" style="margin-bottom: 10px;" class="browser-default custom-select"><option selected>Select Wight Type</><option value="mg">Mg</option><option value="gm">Gm</option><option value="KG">Kg</option><option value="galon">Galon</option></select>';
    html3 += '<input type="hidden" id="wightValue'+Wightrow+'" name="WightmesermentType[]"/></td>';
    html3 += '<td class="text-center">';
    html3 += '<button class="btn btn-danger btn-sm mt-0" onclick="WightrowRemove('+Wightrow+')"><i class="fas fa-minus-circle"></i></button>';
    html3 += '</td>';
    html3 += '</tr>';
    $('#MesermrntWight').append(html3);
}

function WightrowRemove(id) {
    $('.Wightdiv'+id).remove();
}


function setWightInputValue(id) {
    $('#wightValue'+id).val($('#WightmesermentType'+id).val());

}

var DiamentionRow = 0;

function addMoreBtnForMesermrntDiamention() {
    DiamentionRow++;

    var html4 = "";
    html4 += '<tr class="DiamentionRow'+DiamentionRow+'">';
    html4 += '<td>';
    html4 += '<input  name="pdmesermentValue[]" type="text" class="form-control" placeholder="Product Dimension"/>';
    html4 += '</td>';
    html4 += '<td>';
    html4 += '<select id="Diamentionmeserment'+DiamentionRow+'" onchange="setDiamentionInputValue('+DiamentionRow+')" style="margin-bottom: 10px;" class="browser-default custom-select"><option>Select Type</option><option value="metter">Metter</option><option value="cm">Centi Metter</option><option value="inc">Inch</option><option value="feet">feet</option></select>';
    html4 += '<input type="hidden" id="diamentionValue'+DiamentionRow+'" name="diamentionInput[]" /></td>';
    html4 += '<td class="text-center">';
    html4 += '<button class="btn btn-danger btn-sm mt-0" onclick="diamentionRowRemove('+DiamentionRow+');"><i class="fas fa-minus-circle"></i></button>';
    html4 += '</td>';
    html4 += '<tr>';

    $('#MesermrntDiamention').append(html4);
}

function diamentionRowRemove(id) {
    $('.DiamentionRow'+id).remove();
}

function setDiamentionInputValue(id) {
    $('#diamentionValue'+id).val($('#Diamentionmeserment'+id).val());
}


    var color = 0;

    function addInput() {
    color++;
    var html6 = "";
    html6+= '<tr id="rowid' + color + '">';
    html6+='<td>';
    html6+='<div id="input' + color + '" class="input-group" name="colorInput" title="Using input value">';
    html6+='<input type="text" class="form-control input-lg" name="pdcolor[]" value="#000000"/>';
    html6+='<span class="input-group-append">';
    html6+='<span class="input-group-text colorpicker-input-addon"><i></i></span>';
    html6+='</span>';
    html6+='</div>';
    html6+='</td>';
    html6 +='<td class="text-center p-0"> <button onclick="removeColorInput(' + color + ');" class="btn  btn-danger btn-sm p-o"><i class="fas fa-minus-circle fa-2x"></i></button></td>';
    html6 +='</tr>';

    $('#append_tbody').append(html6);
    $('#input'+color).colorpicker();
    }


    function removeColorInput(row_id) {
    $('#rowid' + row_id).remove();
    }


function addExtraColum(id) {

    if (id == 1 ) {
        addMoreBtnForMesermrntSize();
    } else if(id == 2){
        addMoreBtnForMesermrntWight();
    } else if(id == 3){
        addMoreBtnForMesermrntDiamention()
    }else{
        return;
    }
}







        function addEditInput() {
            colorExistCount++;
            var html8 = "";
            html8+= '<tr id="rowid' + colorExistCount + '">';
            html8+='<td>';
            html8+='<div id="inputEdit' + colorExistCount + '" class="input-group" name="colorInputEdit" title="Using input value">';
            html8+='<input type="text" class="form-control input-lg" name="pdcolorEdit[]" value="#000000"/>';
            html8+='<span class="input-group-append">';
            html8+='<span class="input-group-text colorpicker-input-addon"><i></i></span>';
            html8+='</span>';
            html8+='</div>';
            html8+='</td>';
            html8 +='<td class="text-center p-0"> <button onclick="removeColorInput(' + colorExistCount + ');" class="btn  btn-danger btn-sm p-o"><i class="fas fa-minus-circle fa-2x"></i></button></td>';
            html8 +='</tr>';

            $('#addEditColorInput').append(html8);
            $('#inputEdit'+colorExistCount).colorpicker();

        }



function addMoreBtnForMesermrntSizeEdit(){
    mesermenExitCount++;

    var html10="";
    html10+='<tr class="sizedivEdit'+mesermenExitCount+'">';
    html10+='<td colspan="2">';
    html10+='<select id="pdmesermentValueEdit'+mesermenExitCount+'" onChange="sizeOnChangeEdit('+mesermenExitCount+')" name="pdmesermentValue[]" style="margin-bottom: 10px;" class="browser-default custom-select">';
    html10+='<option selected>Select Type</option>';
    html10+='<option value="xsm" seclected>Extra Small</option>';
    html10+='<option value="sm">Small</option>';
    html10+='<option value="md">Medium</option>';
    html10+='<option value="lg">Large</option>';
    html10+='<option value="xl">Extra Large</option>';
    html10+='<option value="xxl">Dubble Extra Large</option>';
    html10+='</select><input type="hidden" id="sizeValueEdit'+ mesermenExitCount +'" name="sizeValueEdit[]" />';
    html10+='</td>';
    html10+='<td class="text-center">';
    html10+='<button class="btn btn-danger btn-sm mt-0" onclick="SizeRemoveEdit('+mesermenExitCount+')"><i class="fas fa-minus-circle"></i></button>';
    html10+='</td>';
    html10+='</tr>';

    $('#MesermrntSizeEdit').append(html10);

}


function sizeOnChangeEdit(id) {
    $('#sizeValueEdit'+id).val($('#pdmesermentValueEdit'+id).val());
}


function SizeRemoveEdit(id) {

    $('.sizedivEdit'+id).remove();
}

function addMoreBtnForMesermrntWeightEdit(){
var html11="";
    mesermenExitCount++;
    html11 += '<tr id="WightdivEdit'+mesermenExitCount+'">';
    html11 += '<td>';
    html11 += '<input id="WightmesermentValueEdit" name="WightmesermentValueEdit[]" value="" type="text" class="form-control" placeholder="Product Wight"/>';
    html11 += '</td>';
    html11 += '<td>';
    html11 += '<select id="WightmesermentTypeEdit'+mesermenExitCount+'" onChange="setWightInputValueEdit('+mesermenExitCount+');" name="WightmesermentTypeEdit[]" style="margin-bottom: 10px;" class="browser-default custom-select">';
    html11 += '<option selected disable>Slect Width</option>';
    html11 += '<option value="mg">Mg</option>';
    html11 += '<option value="gm">Gm</option>';
    html11 += '<option value="kg">Kg</option>';
    html11 += '<option value="galon">Galon</option>';
    html11 += '<input type="hidden" id="wightValueEdit'+mesermenExitCount+'" value="" name="WightmesermentTypeEdit[]"/></td>';
    html11 += '<td class="text-center">';
    html11 += '<button class="btn btn-danger btn-sm mt-0" onclick="WightrowRemoveEdit('+mesermenExitCount+')"><i class="fas fa-minus-circle"></i></button>';
    html11 += '</td>';
    html11 += '</tr>';

    $('#MesermrntWeightEdit').append(html11);
}


function setWightInputValueEdit(id) {
    $('#wightValueEdit'+id).val($('#WightmesermentTypeEdit'+id).val());

}


function WightrowRemoveEdit(id) {
    console.log(id);
    $('#WightdivEdit'+id).remove();
}


function addMoreBtnForMesermrntDiamentionEdit() {
    mesermenExitCount++;
    var html12="";
    html12 += '<tr class="DiamentionRowedit'+mesermenExitCount+'">';
    html12 += '<td>';
    html12 += '<input  name="diamentionValueInputEdit[]" type="text" value="" class="form-control" placeholder="Product Dimension"/>';
    html12 += '</td>';
    html12 += '<td>';
    html12 += '<select id="DiamentionmesermentEdit'+mesermenExitCount+'" onchange="setDiamentionInputValueEdit('+mesermenExitCount+')" style="margin-bottom: 10px;" class="browser-default custom-select">';
    html12 += '<option>Select Type</option>';
    html12 += '<option value="metter">Metter</option>';
    html12 += '<option value="cm">Centi Metter</option>';
    html12 += '<option value="inc">Inch</option>';
    html12 += '<option value="feet">feet</option>';
    html12 += '</select><input type="hidden" id="diamentionValueEdit'+mesermenExitCount+'" value="" name="diamentionInputEdit[]" /></td>';
    html12 += '<td class="text-center">';
    html12 += '<button class="btn btn-danger btn-sm mt-0" onclick="diamentionRowRemoveEdit('+mesermenExitCount+');"><i class="fas fa-minus-circle"></i></button>';
    html12 += '</td>';
    html12 += '</tr>';
    $('#MesermrntDimentionEdit').append(html12)

}



function setDiamentionInputValueEdit(id) {
    $('#diamentionValueEdit'+id).val($('#DiamentionmesermentEdit'+id).val());
}

function diamentionRowRemoveEdit(id) {
    $('.DiamentionRowedit'+id).remove();
}

$('#pdmesermentEdit').change(function(){
var pdmesermentEdit= $('#pdmesermentEdit').val();
    var html13="";

    if (pdmesermentEdit==1) {
    html13+='<table class="table table-bordered"><thead clss="text-center"><tr><th>Entry</th><th>Meserments</th><th class="text-center"><button class="btn btn-success btn-sm ml-auto" onclick="addMoreBtnForMesermrntSizeEdit();">Add More</button></th></tr></thead><tbody id="MesermrntSizeEdit">';

    } else if (pdmesermentEdit==2){
    html13+='<table class="table table-bordered"><thead clss="text-center"><tr><th>Entry</th><th>Meserments</th><th class="text-center"><button class="btn btn-success btn-sm ml-auto" onclick="addMoreBtnForMesermrntWeightEdit();">Add More</button></th></tr></thead><tbody id="MesermrntWeightEdit">';


    }else if (pdmesermentEdit==3){
    html13+='<table class="table table-bordered"><thead clss="text-center"><tr><th>Entry</th><th>Meserments</th><th class="text-center"><button class="btn btn-success btn-sm ml-auto" onclick="addMoreBtnForMesermrntDiamentionEdit();">Add More</button></th></tr></thead><tbody id="MesermrntDimentionEdit">';

    }

    $('.meserment_edit').html(html13);

});





function calculate(){
    var mainPrice =parseInt( $('#pdPrice').val());
    var savings= $('#pdSaving').val();

    if (savings.length==0) {
        var offerPrice=mainPrice;
       $('#pdOffer').val(offerPrice);
    }else{
       var offerPrices=mainPrice - savings / 100 * mainPrice;
        $('#pdOffer').val(offerPrices);
    }


}
function calculateEdit(){
    var mainPrice =parseInt( $('#pdEditPrice').val());
    var savings=$('#pdEditSaving').val();

    if (savings.length==0) {
        var offerPrice=mainPrice;
       $('#pdEditOffer').val(offerPrice);
    }else{
        var offerPrice=mainPrice - savings / 100 * mainPrice;
        $('#pdEditOffer').val(offerPrice);
    }

}

</script>

@endsection
