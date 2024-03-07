@extends('temp.sidebar')

@section('con')
<div class="main-ta">
    <div class="con-ta py-3">
      <div class="j-ta w-100 px-3  pb-2">
          <span class="t-jta">Data Karyawan</span>
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
  $('#imagetambah').change(function() {
        var input = this
        if (input.files && input.files[0]) {
          var reader = new FileReader()
          reader.onload = function(e) {
            $('#previewtambah').attr('src', e.target.result).show()
          }
          reader.readAsDataURL(input.files[0])
        }
      })
  $('#image2').change(function() {
        var input = this
        if (input.files && input.files[0]) {
          var reader = new FileReader()
          reader.onload = function(e) {
            $('#previewedit').attr('src', e.target.result).show()
          }
          reader.readAsDataURL(input.files[0])
        }
      })
  $('#image3').change(function() {
        var input = this
        if (input.files && input.files[0]) {
          var reader = new FileReader()
          reader.onload = function(e) {
            $('#previewlihat').attr('src', e.target.result).show()
          }
          reader.readAsDataURL(input.files[0])
        }
      })
                    $('#tableDataKaryawan').DataTable({
                        lengthMenu: [ [5, 10, 20], [5, 10, 20] ],
                        processing: true,
                        serverSide: true,
                        dom: '<"html5buttons">Bfrtip',
        language: {
            buttons: {
                colvis : 'show / hide', // label button show / hide
                colvisRestore: "Reset Kolom" // lael untuk reset kolom ke default
            }
        },
        buttons : [
            {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
            {extend:'print',title: 'Data Karyawan'},
            {extend:'pdf',title: 'Data Karyawan'},
        ],
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
                                className: 'text-center',

                            }
                        ]
                    })

                $('#mtK').click(function(){
                    $('#modaltdKaryawan').modal('show')
                })
                // $('body').on('click', '#btn-ld' ,function(e){
                //     $('#modalldKaryawan').modal('show')

                // })
                $('body').on('click', '#btn-ed' ,function(e){
                    var id = $(this).data('id')
                    console.log('lolo');
                    var url = '/data/dataKaryawan/'+  id +'/edit'
                    $.ajax({
                        url:url,
                        type:'GET',
                        success: function(response) {
                            console.log(response.data);
                            const sanitizedFilename = encodeURIComponent('/'+response.data.image);
                    const urlImg = `{{ asset('storage/image-products/') }}` + sanitizedFilename;
                            $('#previewedit').attr('src', urlImg)
                            $('#ed-name').val(response.data.name);
                            $('#ed-phoneNumber').val(response.data.phoneNumber);
                            $('#ed-birthdate').val(response.data.birthdate);
                            $('input[name="gender"][value="' + response.data.gender + '"]').prop('checked', true);
                            $('#ed-address').val(response.data.address);
                            $('#ed-position option[value="' + response.data.position + '"]').prop('selected', true);
                            $('#id-kar').attr('data-karyawan-id' , response.data.employeeID);
                            $('#ed-startWork').val(response.data.startWork);

                            $('#modaledKaryawan').modal('show')
                        }
                        ,
                        error:function(xhr, status, error){
                            console.log(xhr.responseText);
                        }

                    })

                })
                $('body').on('click', '#btn-ld' ,function(e){
                    var id = $(this).data('id')
                    console.log('lolo');
                    var url = '/data/dataKaryawan/'+  id +'/edit'
                    $.ajax({
                        url:url,
                        type:'GET',
                        success: function(response) {
                            console.log(response.data);
                            const sanitizedFilename = encodeURIComponent('/'+response.data.image);
                    const urlImg = `{{ asset('storage/image-products/') }}` + sanitizedFilename;
                    $('#previewlihat').attr('src', urlImg);
$('#ld-name').val(response.data.name).prop('readonly', true);
$('#ld-phoneNumber').val(response.data.phoneNumber).prop('readonly', true);
$('#ld-birthdate').val(response.data.birthdate).prop('readonly', true);
$('input[name="gender"][value="' + response.data.gender + '"]').prop('checked', true).prop('disabled', true);
$('#ld-address').val(response.data.address).prop('readonly', true);
$('#ld-position').val(response.data.position).prop('disabled', true);
$('#id-kar').attr('data-karyawan-id', response.data.employeeID);
$('#ld-startWork').val(response.data.startWork).prop('readonly', true);

$('#modalldKaryawan').modal('show');

                        }
                        ,
                        error:function(xhr, status, error){
                            console.log(xhr.responseText);
                        }

                    })

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


                        },
                                error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                }
                    })
                }



                //   function save(id =''){

                    $('#formTambahKaryawan').submit(function(e) {
                            e.preventDefault();
                            var formData = new FormData(this);
                            var  url = '/data/dataKaryawan';
                            var type = 'POST';
                            var nameId = 'td';
                            $.ajax({
                                url: url,
                                type: type,
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                console.log(`hasilnya adalah ${response.hasil}`);
                                console.log(response.errors);
                                for (var key in response.errors) {
                                    var pesanErrors = response.errors[key][0];
                                    $(`#${nameId}-${key}-error`).text(pesanErrors);
                                }
                                if (response.success) {
                                    $('#modaltdKaryawan').modal('hide')
                                    $('#tableDataKaryawan').DataTable().ajax.reload();
                                }
                            },
                                error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                }
                            });
                            });

                            $('#editFormKaryawan').submit(function(e){
                                e.preventDefault();
                                const formData = new FormData(this);
                                const id = $('#id-kar').data('karyawan-id');
                                $.ajax({
                                    url:'/update-karyawan/'+id,
                                    method:'POST',
                                    data: formData,
                                    cache:false,
                                    contentType:false,
                                    processData:false,
                                    dataType:'json',
                                    success: function(response){
                                        if (response.errors) {
                                            for (var key in response.errors) {
                                                    var pesanErrors = response.errors[key][0];
                                                    $(`#ed-${key}-error`).text(pesanErrors);
                                                }
                                        }
                                        if(response.success){
                                            $('#modaledKaryawan').modal('hide');
                                            $('#tableDataKaryawan').DataTable().ajax.reload();
                                        }
                                    },
                                    error:function(xhr, status,error){
                                        console.log(xhr.responseText);
                                    }
                                })

                            });

                })

                </script>
            @endsection