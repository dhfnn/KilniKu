@extends('temp.sidebar')

@section('con')
<div class="main-ta">
    <div class="con-ta py-3">
      <div class="j-ta w-100 px-3  pb-2">
          <span>Data Akun</span>
          <button
            type="button"
            class="btn-blue"
            data-bs-toggle="modal"
            id="mtd"
          >
          <i class="fa-regular fa-plus"></i>
          </button>

      </div>
      <table id="tableDataAKun" class="table table-responsive table-standart " style="width:100%">
          <thead>
              <tr>
                  <th class="text-center">NO</th>
                  <th>USERNAME</th>
                  <th>NAME</th>
                  <th>ROLE</th>
                  <th class="text-center ">ACTION</th>
              </tr>
          </thead>

        </table>
            </div>
                      <!-- Modal -->
        @include('modals.tambahAkun')
        @include('modals.editAkun')
            <script >

                $(document).ready(function(){
                    $('[data-toggle="tooltip"]').tooltip();
                  });
                    new DataTable('#tableDataAKun', {
                      lengthMenu: [ [5, 10, 20], [5, 10, 20] ],
                      processing:true,
                      serverside:true,

                      ajax:"{{ url('/getDataAkun') }}",
                      columns:[
                              {
                              data:'DT_RowIndex',
                              name:'DT_RowIndex',
                              orderable:false,
                              searchable:false,
                              className: 'text-center'
                              },
                              {
                              data:'username',
                              name:'username'
                              },
                              {
                              data:'employee.name',
                              name:'nama'
                              },
                              {
                              data:'role',
                              name:'role'
                              },
                              {

                              data:'ACTION',
                              name:'aksi',
                              className:'d-flex justify-content-center gap-2'
                              }
                          ]
                  });
                  //global setup

                  $('#mtd').click(function(){
                      $('#modalId').modal('show')
                      $.ajax({
                        url:'/getDataEm',
                        type:'GET', 
                        success:function(response){
                            console.log(response.hasil);
                            var select = $('#td-employeeID')
                            select.empty()
                            $.each(response.hasil ,function(index ,value){
                                select.append($('<option></option>').attr('value', value.employeeID).text(value.name))
                            })
                        },
                          error:function(xhr, status, error){
                          console.log(xhr.responseText);
                      }

                      })
                  })
                  // simpan data akun
                  $('.tda').click(function(){
                      save()
                  });
                  $('.it-data, .slt-data').on('input change', function() {
                      console.log('teks di hapus')
                      var inputId = $(this).attr('id');
                      $('#' + inputId + '-error').text('');
                  });



                  $('body').on('click', '.btn-eda' ,function(e){
                    var id = $(this).data('id')
                    $.ajax(
                      {
                        url:'/data/dataAkun/'+ id +'/edit',
                        type:'GET',
                        success: function(response) {
                            console.log('bawah ini');
                            console.log(response.hasil);
                            $('#modalIdEdit').modal('show');
                            $('#ed-username').val(response.hasil.username);
                            $('#ed-employeeID').val(response.hasil.employee.name);
                            $('#ed-role').val(response.hasil.role);


                            var select = $('#ed-employeeID')
                            select.empty()
                            $.each(response.dataEm ,function(index ,value){
                                select.append($('<option></option>').attr('value', value.employeeID).text(value.name))
                            })
                            $('.employeeID2 option[value="' + response.hasil.employee.employeeID + '"]').prop('selected', true);

                          $('.editdata').click(function(){
                                save(id)
                          });

                        }


                      }
                    )

                  });
                  $('body').on('click', '.btn-tdh', function(e) {
                      $('#MhapusData').modal('show');

                    var id = $(this).data('id')
                    $.ajax(
                      {
                        url:'/data/dataAkun/'+ id +'/edit',
                        type:'GET',
                        success: function(response) {
                          $('.hapusdataAkun').click(function() {
                              hapus(response.hasil.id)
                          })

                        }
                      }
                    )

                  });
                  function hapus(id) {
                      $.ajax({
                          url:'/data/dataAkun/'+ id,
                          type:'DELETE',
                          success: function(response) {
                              console.log(response.berhasil)
                              if (response.berhasil) {
                                  console.log('haloo')
                                  $('#tableDataAKun').DataTable().ajax.reload()
                                  $('#MhapusData').modal('hide')
                              }
                              pushNotify('hapus');
                          }
                      })
                  }

                  $('.close-crud').click(function() {
                      $('.text-error').text('');

                  })
                  function save(id = '') {
                      if (id == '') {
                          var var_url = '/data/dataAkun'
                          var var_type = 'POST'
                          console.log('bagian tembah');
                          var nameId = 'td'
                      }else{
                          var var_url = '/data/dataAkun/'+ id
                          var var_type = 'PUT'
                          console.log('bagian edit');
                          var nameId = 'ed'
                      }

                      $.ajax({
                          url: var_url,
                          type:var_type,
                          data:{
                              employeeID : $(`#${nameId}-employeeID`).val(),
                              username : $(`#${nameId}-username`).val(),
                              password : $(`#${nameId}-password`).val(),
                              role : $(`#${nameId}-role`).val()
                          },
                          success: function(response) {
                              console.log(response.errors);
                              $('.text-error').text('');
                                  for (var key in response.errors) {
                                      var errorMessage = response.errors[key][0];
                                      $(`#${nameId}-${key}-error`).text(errorMessage);
                                  }
                                  if (response.success) {
                                      console.log(`hasilnya : ${response.success}`)
                                      $('.text-error').text('');
                                      $('.it-data, .slt-data').val('')
                                      $('#tableDataAKun').DataTable().ajax.reload();
                                        if (var_type === 'POST') {
                                            console.log(response.hasildata);
                                            $('#modalId').modal('hide')
                                            pushNotify('tambahkan')
                                        } else {
                                            $('#modalIdEdit').modal('hide')
                                            pushNotify('ubah')
                                        }
                              }

                          },
                          error:function(xhr, status, error){
                          console.log(xhr.responseText);
                      }
                  })
                  }

                  async function pushNotify(type) {
                    await
                      new Notify({
                      status: 'success',
                      title: 'Berhasil',
                      text: `Data telah berhasil di${type}`,
                      effect: 'fade',
                      speed: 300,
                      customClass: null,
                      customIcon: null,
                      showIcon: true,
                      showCloseButton: true,
                      autoclose: true,
                      autotimeout: 30000,
                      gap: 200,
                      distance: 20,
                      type: 'outline',
                      position: 'right top'
                    })
                  }
                  </script>
@endsection