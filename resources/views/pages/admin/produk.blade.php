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
        $('[data-toggle="tooltip"]').tooltip();

    function selectForm() {
        $.ajax({
            url:'/getsupplier',
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
            console.log('toloooooooooooooooooooool');
        })

        $('#card-product').click(function(){
            console.log('hlaooooooooooooooooooooo');
        })
        // BAGIAN TAMPILKAN DATA
        $.ajax({
            url:'/getDataProduk',
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
            $('.btn-hdd').show()



            $('.t-detailp').click(function(){
                    $('.t-detailK').show()
                    $('.pt-detailp').show()
                    $('.tdt-slt').show()
                    $('.t-detailp').hide()
                    $('.select2-container').show()
                    $('.cd-supplierID').hide()
                    $('.cd-category').hide()
            $('.btn-hdd').hide()
                    $('.tdt-read').prop('readonly', false)  
                    });
  
    $('.btn-closeD').click(function(){
            $('.tdt-read').prop('readonly', true);
            $('.tdt-slt').hide()
            $('.select2-container').hide()
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
            $('.btn-hdd').show()

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

                    $('#previewoi').attr('src', urlImg);
                    $('#tdt-name').val(response.hasil.name);
                    $('.cd-category').val(response.hasil.category);
                    $('#tdt-stock').val(response.hasil.stock);
                    $('#tdt-description').val(response.hasil.description);
                    $('.cd-supplierID').val(response.hasil.supplierID);
                    $('#tdt-expiryDate').val(response.hasil.expiryDate);
                    $('#tdt-purchasePrice').val(response.hasil.purchasePrice);
                    $('#tdt-sellingPrice').val(response.hasil.sellingPrice);
                    $('#lihatForm').attr('data-produk-id', response.hasil.productID)
                    $('#btn-hdD').attr('data-produk-id', response.hasil.productID)
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
                }
            },
                error: function(xhr, status, error) {
                console.error(xhr.responseText);
                }
            });
            });


            $('#lihatForm').submit(function(e) {
                var formData = new FormData(this);
                console.log(formData);
                e.preventDefault();
                        var id = $(this).data('produk-id'); 
                        var url = '/produk/' + id; 
                        var type = 'PUT'; 
                        var nameId = 'tdt';
                        $.ajax({
                            url: url,
                            type: type,
                            data: formData, 
                            contentType: false, 
                            processData: false, 
                            success: function(response) {
                                console.log(formData)
                                for (var key in response.errors) {
                                    var pesanErrors = response.errors[key][0];
                                    $(`#${nameId}-${key}-error`).text(pesanErrors);
                                }
                                if (response.success) {
                                    $('#modaltdProduk').modal('hide')
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
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