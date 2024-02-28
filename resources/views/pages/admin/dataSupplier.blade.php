@extends('temp.sidebar')

@section('con')
<div class="main-ta">
    <div class="con-ta py-3">
      <div class="j-ta w-100 px-3  pb-2">
          <span class="t-jta">Data supplier</span>
          <button
            type="button"
            class="btn-blue"
            data-bs-toggle="modal"
            id="btn-mds"
          >
          <i class="fa-regular fa-plus"></i>
          </button>
      </div>
      <table id="tableDataSupplier" class="table table-responsive table-standart " style="width:100%">
          <thead>
              <tr>
                  <th class="text-center">NO</th>
                  <th>supplier</th>
                  <th>TELEPON</th>
                  <th class="text-center">ACTION</th>
              </tr>
          </thead>
        </table>
        @include('modals.tambahSupplier')
        @include('modals.editSupplier')
        @include('modals.hapusAkun')
        <script>
            $(document).ready(function(){
                new DataTable('#tableDataSupplier',{
                    lengthMenu : [['5','10'],['5','10']],
                    processing:true,
                    serverside:true,
                    ajax: "{{ url('/getDatasupplier') }}",
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable:false,
                        searchable:false,
                        className: 'text-center'
                    },{
                        data:'supplierName',
                        name:'Nama'
                    },
                    {
                        data:'phoneNumber',
                        name:'Telepon'
                    },{
                        data:'ACTION',
                        name:'aksi',
                        className:'d-flex justify-content-center gap-2'
                    }]
                })
            })


            $('#btn-mds').click(function () {
                $('#modaltdSupplier').modal('show')
            })
            $('.tds').click(function () {
                save()
            })
            $('.close-crud').click(function() {
                      $('.text-error').text('');

                  })
            $('body').on('click', '.btn-eda', function(e) {
                console.log('halo');
                var id = $(this).data('id')
                $.ajax({
                    url:'/data/dataSupplier/'+id+'/edit ',
                    type:'GET',
                    success:function(response){
                        console.log(response.hasil);
                        $('#ed-supplierName').val(response.hasil.supplierName)
                        $('#ed-phoneNumber').val(response.hasil.phoneNumber)
                        $('#modaledSupplier').modal('show')
                        $('.eds').click(function(){
                            save(id)
                        })
                    },
                    error:function(xhr, status, error){
                          console.log(xhr.responseText);
                      }

                })
            })
            $('body').on('click', '.btn-tdh', function() {
                $('#MhapusData').modal('show')
                var id =$(this).data('id')
                $('.hapusdataAkun').click(function() {
                    hapus(id)

                    console.log('jalo');
                })
            })

            function save(id ='') {
                if (id == '') {
                   var url = '/data/dataSupplier'
                   var type='POST'
                   console.log('BAGIAN TAMBAH SUPLER');
                   var nameId='td'
                }else{
                    var url = '/data/dataSupplier/'+id
                   var type='PUT'
                   console.log('BAGIAN EDIT SUPLER');
                   var nameId='ed'
                }
                $.ajax({
                    url:url,
                    type:type,
                    data:{
                        supplierName : $(`#${nameId}-supplierName`).val(),
                        phoneNumber : $(`#${nameId}-phoneNumber`).val()
                    },
                    success: function(response) {
                        console.log(response.errors);
                        for(var key in response.errors){
                            var pesanError =response.errors[key][0];
                            $(`#${nameId}-${key}-error`).text(pesanError);
                        }
                        if (response.success) {
                            console.log(response.success);
                            $('#tableDataSupplier').DataTable().ajax.reload()
                                    $('.it-data').val('')
                                    $('.text-error').text('')
                                    if (type === 'POST') {
                                        $('#modaltdSupplier').modal('hide')
                                    } else {
                                        $('#modaledSupplier').modal('hide')
                                    }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);

                    }
                })
            }

            function hapus(id) {
                $.ajax({
                    url:'/data/dataSupplier/'+id,
                    type:'DELETE',
                    success: function(response){
                        console.log(response.success)
                $('#MhapusData').modal('hide')

                        $('#tableDataSupplier').DataTable().ajax.reload()


                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);

                    }
                })
            }
        </script>
    @endsection