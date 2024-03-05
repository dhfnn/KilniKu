@extends('temp.sidebar')

@section('con')
<div class="main-ta">
    <div class="con-ta py-3">
      <div class="j-ta w-100 px-3  pb-2">
          <span class="t-jta">Data Pelanggan</span>
          <button
            type="button"
            class="btn-blue"
            data-bs-toggle="modal"
            id="btn-mdp"
          >
          <i class="fa-regular fa-plus"></i>
          </button>
      </div>
      <table id="tableDataPelanggan" class="table table-responsive table-standart " style="width:100%">
          <thead>
              <tr>
                  <th class="text-center">NO</th>
                  <th>NAMA</th>
                  <th>ALAMAT</th>
                  <th>NO HANDPHONE</th>
                  <th class="text-center">ACTION</th>
              </tr>
          </thead>
        </table>
        @include('modals.tambahPelanggan')
        @include('modals.editPelanggan')
            </div>
</div>
            <script>

                $(document).ready(function() {
                    new DataTable('#tableDataPelanggan', {
                    lengthMenu: [ [5, 10, 20], [5, 10, 20] ],
                      processing:true,
                      serverside:true,
                        ajax :"{{ url('/getDataPelanggan') }}",
                        columns:[
                            {
                                data:'DT_RowIndex',
                              name:'DT_RowIndex',
                              orderable:false,
                              searchable:false,
                              className: 'text-center'
                            },
                            {
                                data:'customerName',
                                name:'customerName'
                            },
                            {
                                data:'address',
                                name:'address'
                            },
                            {
                                data:'phoneNumber',
                                name:'phoneNumber'
                            },
                            {
                                data:'ACTION',
                                name:'aksi',
                                className:'d-flex justify-content-center gap-2'
                            }
                        ]
                    })
                })

                $('#btn-mdp').on('click', function() {
                    $('#modalIdPelanggan').modal('show')
                })

                $('.tdp').on('click' , function() {
                    save();
                })
                $('.it-data, .slt-data, .tt-data').on('input change', function() {
                    console.log('teks dihaous')
                    var inputId = $(this).attr('id')
                    $(`#${inputId}-error`).text('')
                })
                $('body').on('click', '.btn-eda' ,function(e){
                    var id = $(this).data('id')
                    var url = '/data/dataPelanggan/'+ id +'/edit'
                    $.ajax(
                      {
                        url:url,
                        type:'GET',
                        success: function(response) {
                            $(`#ed-customerName`).val(response.hasil.customerName)
                            $(`#ed-phoneNumber`).val(response.hasil.phoneNumber)
                            $(`#ed-address`).val(response.hasil.address)
                            $('#modalEdPelanggan').modal('show')
                            $('.editdata').click(function() {
                                save(id)
                            })
                        },
                        error:function(xhr, status, error){
                          console.log(xhr.responseText);
                      }
                      }
                    )
                  });
                function save(id = '') {
                    if (id == '') {
                        var url = '/data/dataPelanggan'
                        var type = 'POST'
                        console.log('bagian TAMBAHHH');
                        var nameId = 'td'
                    } else {
                        var url = '/data/dataPelanggan/'+id
                        console.log('bagian edit');
                        var type = 'PUT'
                        var nameId = 'ed'
                    }

                        $.ajax({
                            url: url,
                            type:type,
                            data:{
                                customerName: $(`#${nameId}-customerName`).val(),
                                phoneNumber: $(`#${nameId}-phoneNumber`).val(),
                                address: $(`#${nameId}-address`).val()
                            },
                            success: function( response) {
                                console.log(response.success);
                                console.log(response.data);
                                console.log(url);
                                for(var key in response.errors){
                                    var pesanError =response.errors[key][0];
                                    $(`#${nameId}-${key}-error`).text(pesanError);
                                }
                                if (response.success) {
                                    $('#tableDataPelanggan').DataTable().ajax.reload()
                                    $('.slt-data, .tt-data, .it-data').val('')
                                    $('.text-error').text('')
                                    if (type === 'POST') {
                                        $('#modalIdPelanggan').modal('hide')
                                    } else {
                                        $('#modalEdPelanggan').modal('hide')
                                    }
                                }
                            },
                            error:function(xhr, status, error){
                          console.log(xhr.responseText);
                      }
                        })
                }
                $('body').on('click', '.btn-tdh', function(e) {
                    $('#MhapusData').modal('show')
                    var id =$(this).data('id')
                    $('.hapusdataAkun').click(function() {
                              hapus(id);
                          })
                })

                function hapus(id) {
                    $.ajax({
                        url:'/data/dataPelanggan/'+ id,
                        type:'DELETE',
                        success: function(response) {
                            console.log(response.success);
                            $('#MhapusData').modal('hide')
                            $('#tableDataPelanggan').DataTable().ajax.reload();
                        }

                    })
                }
            </script>
@endsection