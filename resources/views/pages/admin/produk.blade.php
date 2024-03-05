@extends('temp.sidebar')
@section('con')
<div class="main-ta">
    <div class="con-ta py-3">
      <div class="j-ta w-100 px-3  ">
          <span>Data Produk</span>
          <button
            type="button"
            class="btn-blue"
            data-bs-toggle="modal"
            id="mtp"
          >
          <i class="fa-regular fa-plus"></i>
          </button>
          <input type="text" id="searchInput" placeholder="Cari produk...">

          <button id="stockFilter">
            tekan
          </button>
          <button id="stockFilterTen">
            cari
          </button>

    </div>
</div>
<div class="row row-cols-4" id="con-row">



</div>
@include('modals.tambahProduk')
@include('modals.lihatProduk')
@include('modals.hapusAkun')

</div>
<script>

    $(document).ready(function() {

$('#stockFilter').on('click', function() {
    var currentOrder = $(this).data('order');
    var cards = $('.con-card');
    if (currentOrder === 'asc') {
        cards.sort(function(a, b) {
            return parseInt($(a).find('.card-bottom').text().split(':')[1]) - parseInt($(b).find('.card-bottom').text().split(':')[1]);
        });
        $(this).data('order', 'desc');
    } else {
        cards.sort(function(a, b) {
            return parseInt($(b).find('.card-bottom').text().split(':')[1]) - parseInt($(a).find('.card-bottom').text().split(':')[1]);
        });
        $(this).data('order', 'asc');
    }
    $('#con-row').empty();
    cards.each(function() {
        $('#con-row').append($(this));
    });
});

$('#stockFilterTen').on('click', function() {
    console.log('halooo');
    $('.con-card').hide();
    $('.con-card').each(function() {
        var stock = parseInt($(this).find('.card-bottom').text().split(':')[1]);
        if (stock <= 10) {
            $(this).show();
        }
    });
});
$('#searchInput').on('input', function() {
    var searchText = $(this).val().toLowerCase();
    $('.con-card').hide();
    $('.con-card').each(function() {
        var productName = $(this).find('.card-top span').text().toLowerCase();
        if (productName.includes(searchText)) {
            $(this).show();
        }
    });
});




        $('[data-toggle="tooltip"]').tooltip();

    function selectForm() {
        $.ajax({
            url:'/getsupplierAdmin',
            type:'GET',
            dataType:'json',
            success: function(response){
                var select = $('#td-supplierID')
                var select2 = $('#tdt-supplierID')
                select.empty()
                select2.empty()
                $.each(response.hasil ,function(index ,value){
                    select.append($('<option></option>').attr('value', value.supplierID).text(value.supplierName))
                })
                $.each(response.hasil ,function(index ,value){
                    select2.append($('<option></option>').attr('value', value.supplierID).text(value.supplierName))
                })
            }
    })
}
selectForm();
        $('#td-supplierID').select2();
        $('#tdt-supplierID').select2();
            $('#td-image').change(function() {
            var input = this
            if (input.files && input.files[0]) {
              var reader = new FileReader()
              reader.onload = function(e) {
                $('#preview2').attr('src', e.target.result).show()
              }
              reader.readAsDataURL(input.files[0])
            }
          })
            $('#tdt-image').change(function() {
            var input = this
            if (input.files && input.files[0]) {
              var reader = new FileReader()
              reader.onload = function(e) {
                $('#previewoi').attr('src', e.target.result).show()
              }
              reader.readAsDataURL(input.files[0])
            }
          })


        $('#mtp').click(function(){
            $('#modaltdProduk').modal('show')

        })

        $('#card-product').click(function(){
            console.log('hlaooooooooooooooooooooo');
        })
        // BAGIAN TAMPILKAN DATA
        $.ajax({
            url:'/getDataProdukAdmin',
            type:'GET',
            success:function(response){
                response.forEach(function(products) {
                        $('#con-row').append(
                            `<div class="col  mt-2 con-card" data-toggle="tooltip"  data-toggle="modal" data-target="#productDetailModal" data-product-id="${products.productID}">
        <div class="card-product bg-white" >
            <div class="con-img">

                <img src="{{asset('storage/image-products/${products.image}')}}" class="img-card" alt="">
            </div>
            <div class="col card-top px-2 mt-2">
                    <span> ${products.name}</span>
              </div>
              <div class="col card-center px-2">
                  <p>${products.description}</p>
              </div>
              <div class="col card-bottom text-end">
                    <span class="px-2 py-1">Stok:${products.stock}</span>
              </div>
          </div>
    </div>`
                        );
                    });
            }
        })
    $(document).on('click', '.con-card', function(){

            $('.tdt-read').prop('readonly', true);
            $('.tdt-slt').hide()
            $('.select2-container').hide()
            $('.t-detailK').hide()
            $('.pt-detailp').hide()
            $('#btn-hdD').show()



            $('.t-detailp').click(function(){
                    $('.t-detailK').show()
                    $('.pt-detailp').show()
                    $('.tdt-slt').show()
                    $('.t-detailp').hide()
                    $('.select2-container').show()
                    $('.cd-supplierID').hide()
                    $('.cd-category').hide()
                    $('#btn-hdD').hide()
                    $('.tdt-read').prop('readonly', false)
                    });

    $('.btn-closeD').click(function(){
            $('.tdt-read').prop('readonly', true);
            $('.tdt-slt').hide()
            $('.select2-container').show()
            $('.t-detailK').hide()
            $('.pt-detailp').hide()
            $('.t-detailp').show()
            $('.cd-supplierID').show()
            $('.cd-category').show()
            })

    $('.t-detailK').click(function(){

        $('.tdt-read').prop('readonly', true);
            $('.tdt-slt').hide()
            $('.select2-container').hide()
            $('.t-detailK').hide()
            $('.pt-detailp').hide()
            $('.cd-supplierID').show()
            $('.t-detailp').show()
            $('#btn-hdD').show()

            $('.cd-category').show()
    })
            var id = $(this).data('product-id')
            $.ajax({
                url:'/produk/'+id+'/edit',
                type:'GET',
                success:function(response){
                    var img = response.hasil.image;
                    console.log(response.hasil);
                    const sanitizedFilename = encodeURIComponent('/'+response.hasil.image);
                    const urlImg = `{{ asset('storage/image-products/') }}` + sanitizedFilename;
    $('.t-detailK').click(function(){
        showEdit()
    })
                    showEdit()
                    function showEdit() {
                        $('#tdt-image').val('')
                        $('#previewoi').attr('src', urlImg);
                        $('#tdt-name').val(response.hasil.name);
                        $('.cd-category').val(response.hasil.category);
                        $('#tdt-stock').val(response.hasil.stock);
                        $('#tdt-description').val(response.hasil.description);
                        $('.cd-supplierID').val(response.hasil.supplier.supplierName);
                        $('#tdt-expiryDate').val(response.hasil.expiryDate);
                        $('#tdt-purchasePrice').val(response.hasil.purchasePrice);
                        $('#tdt-sellingPrice').val(response.hasil.sellingPrice);
                        $('#lihatForm').attr('data-produk-id', response.hasil.productID)
                        $('#btn-hdD').attr('data-produk-id', response.hasil.productID)
                        $('#tdt-category option[value="' + response.hasil.category + '"]').prop('selected', true);
                        $('#tdt-supplierID option[value="' + response.hasil.supplierName + '"]').prop('selected', true);
                    }

                    $('#modaltdtProduk').modal('show')
                },
                error: function(xhr, status, error) {
                console.error(xhr.responseText);
                }
            })
        })
        // BAGIAN TAMBAH
            $('#addForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var  url = '/produk';
            var type = 'POST';
            var nameId = 'td';
            $.ajax({
                url: url,
                type: type,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(formData);
                console.log(response.errors);
                for (var key in response.errors) {
                    var pesanErrors = response.errors[key][0];
                    $(`#${nameId}-${key}-error`).text(pesanErrors);
                }
                if (response.success) {
                        $('#modaltdProduk').modal('hide')
                        location.reload()
                }
            },
                error: function(xhr, status, error) {
                console.error(xhr.responseText);
                }
            });
            });


            $('#lihatForm').submit(function(e) {
                e.preventDefault()
               const formData = new FormData(this)
               const id = $(this).data('produk-id')

               $.ajax({
                                    url:'/update-produk/'+id,
                                    method:'POST',
                                    data: formData,
                                    cache:false,
                                    contentType:false,
                                    processData:false,
                                    dataType:'json',
                                    success: function(response){
                                        if (response.errors) {
                                            console.log(response.hasil);
                                            for (var key in response.errors) {
                                                    var pesanErrors = response.errors[key][0];
                                                    $(`#tdt-${key}-error`).text(pesanErrors);
                                                }
                                        }
                                        if(response.success){
                                            $('#modaltdtProduk').modal('hide');
                                            location.reload();
                                        }
                                    },
                                    error:function(xhr, status,error){
                                        console.log(xhr.responseText);
                                    }
                                })
                });


                    //button hapus
                    $('#btn-hdD').click(function() {
                        var id = $(this).data('produk-id')
                            $('#MhapusData').modal('show')
                            $('.btn-hda').click(function() {
                                hapus(id)
                                console.log(id)
                            })
                    })
                    function hapus(id) {
                        console.log(id)

                        $.ajax({
                            url:'/produk/'+id,
                            type:'DELETE',
                            success: function(response){
                                console.log(response);
                                $('#MhapusData').modal('hide')
                                location.reload(true);

                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        })
                    }
        })


</script>
@endsection