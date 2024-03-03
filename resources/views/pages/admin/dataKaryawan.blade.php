@extends('temp.sidebar')

@section('con')
<div class="main-ta">
    <div class="con-ta py-3">
      <div class="j-ta w-100 px-3  pb-2">
          <span class="t-jta">Data Akun</span>
          <button
            type="button"
            class="btn-blue"
            data-bs-toggle="modal"
            id="mtK"
          >
          <i class="fa-regular fa-plus"></i>
          </button>
          <!-- Modal -->
        @include('modals.tambahKaryawan')
        @include('modals.lihatKaryawan')
        @include('modals.editKaryawan')
        @include('modals.hapusAkun')
      </div>
      <table id="tableDataKaryawan" class="table table-responsive table-standart " style="width:100%">
          <thead>
              <tr>
                  <th class="text-center">NO</th>
                  <th>NAMA</th>
                  <th>JABATAN</th>
                  <th>ALAMAT</th>
                  <th>MULAI BEKERJA</th>
                  <th class="text-center ">ACTION</th>
              </tr>
          </thead>

        </table>
            </div>
            <script>
    $(document).ready(function() {
  $('#image').change(function() {
        var input = this
        if (input.files && input.files[0]) {
          var reader = new FileReader()
          reader.onload = function(e) {
            $('#preview').attr('src', e.target.result).show()
          }
          reader.readAsDataURL(input.files[0])
        }
      })
    })

                $(document).ready(function() {
                    $('#tableDataKaryawan').DataTable({
                        lengthMenu: [ [5, 10, 20], [5, 10, 20] ],
                        processing: true,
                        serverSide: true,
                        ajax: "{{ url('/getDatakaryawan') }}",

                        columns: [
                            {
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false,
                                className: 'text-center'
                            },
                            {
                                data: 'name',
                                name: 'nama'
                            },
                            {
                                data: 'position',
                                name: 'jabatan'
                            },
                            {
                                data: 'address',
                                name: 'alamat'
                            },
                            {
                                data: 'startWork',
                                name: 'Muali Bekerja',
                                className: 'text-center'
                            },
                            {
                                data: 'ACTION',
                                name: 'Aksi',
                                className: 'text-center'
                            }
                        ]
                    })
                })

                $('#mtK').click(function(){
                      $('#modaltdKaryawan').modal('show')
                  })
                  $('body').on('click', '#btn-ld' ,function(e){
                    $('#modalldKaryawan').modal('show')

                  })
                  $('body').on('click', '#btn-ed' ,function(e){
                    var id = $(this).data('id')
                    console.log('lolo');
                    var url = '/data/dataKaryawan/'+  id +'/edit'
                    $.ajax({
                        url:url,
                        type:'GET',
                        success: function(response) {
                            console.log(response.data);
                            $('#ed-name').val(response.data.name);
                            $('#ed-phoneNumber').val(response.data.phoneNumber);
                            $('#ed-birthdate').val(response.data.birthdate);
                            $('input[name="gender"][value="' + response.data.gender + '"]').prop('checked', true);
                            $('#ed-address').val(response.data.address);
                            $('#te-position option[value="' + response.data.position + '"]').prop('selected', true);
                            $('#ed-startWork').val(response.data.startWork);
                            $('#modaledKaryawan').modal('show')

                            $('.eds').click(function(){
                                save(id)

                            })
                        }
                        ,
                            error:function(xhr, status, error){
                          console.log(xhr.responseText);
                      }

                    })

                  })

                  $('.tdK').click(function() {
                    save()
                    console.log('hakii')
                  })
                  $('body').on('click', '#btn-hd', function(e){
                       var id =  $(this).data('id');
                        $('#MhapusData').modal('show')
                        $('.hapusdataAkun').click(function() {
                            hapus(id)
                        })
                })
                function hapus(id){
                    $.ajax({
                        url:'/data/dataKaryawan/'+id,
                        type:'DELETE',
                        success: function(response){
                        $('#tableDataKaryawan').DataTable().ajax.reload();
                        $('#MhapusData').modal('hide')

                        }
                    })
                }



                  function save(id =''){
                    if (id =='') {
                            var url= '/data/dataKaryawan'
                            var type = 'POST'
                            var nameId ='td'
                            console.log('tambah')
                    }else{
                        var url= '/data/dataKaryawan/'+ id
                            var type = 'PUT'
                            var nameId ='ed'
                            console.log('edit')
                    }

                        $.ajax({
                            url:url,
                            type:type,
                            data: {
                                name: $('#' + nameId + '-name').val(),
                                phone: $('#' + nameId + '-phoneNumber').val(),
                                birthdate: $('#' + nameId + '-birthdate').val(),
                                phoneNumber: $('#' + nameId + '-phoneNumber').val(),
                                gender: $('input[name="gender"]:checked').val(),
                                address: $('#' + nameId + '-address').val(),
                                position: $('#' + nameId + '-position').val(),
                                startWork: $('#' + nameId + '-startWork').val(),
                                image: $('#' + nameId + '-image').val()
                            },
                            success: function(response){
                                for(var key in response.errors){
                                    var pesanErrors = response.errors[key][0]
                                    $(`#${nameId}-${key}-error`).text(pesanErrors);
                                }
                                console.log(response.errors);
                                console.log(response.success);
                                $('#tableDataKaryawan').DataTable().ajax.reload()
                                if (type === 'POST') {
                                        $('#modaltdKaryawan').modal('hide')
                                    } else {
                                        $('#modaledKaryawan').modal('hide')
                                    }
                            },
                            error:function(xhr, status, error){
                          console.log(xhr.responseText);
                      }
                        })
                  }
            </script>

            @endsection