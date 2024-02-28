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
            id="mtK"
          >
          <i class="fa-regular fa-plus"></i>
          </button>
          <!-- Modal -->
        @include('modals.tambahKaryawan')
        {{-- @include('modals.editKaryawan') --}}
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
                    $('#tableDataKaryawan').DataTable({
                        lengthMenu: [ [5, 10, 20], [5, 10, 20] ],
                        processing: true,
                        serverSide: true,
                        ajax:"{{ url('/getDatakaryawan') }}",
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
                    });
                });

                $('#mtK').click(function(){
                      $('#modaltdKaryawan').modal('show')
                  })
            </script>

            @endsection
