@extends('temp.sidebar')

@section('con')
<div class="main-ta">
    <div class="con-ta py-3">
      <div class="j-ta w-100 px-3  pb-2">
          <span class="t-jta">Riwayat Transaksi</span>

      </div>
      <table id="tableDataRiwayat" class="table table-responsive table-standart " style="width: 100%;">
          <thead>
              <tr>
                  <th class="text-center">NO</th>
                  <th>TANGGAL</th>
                  <th>NAMA KASIR</th>
                  <th>NAMA PELANGGAN</th>
                  <th>TOTAL HARGA</th>
                <th>AKSI</th>
              </tr>
          </thead>
        </table>
            </div>
</div>
<script>
 $(document).ready(function() {
                    new DataTable('#tableDataRiwayat', {
                    lengthMenu: [ [5, 10, 20], [5, 10, 20] ],
                      processing:true,
                      serverside:true,
                        ajax :"{{ url('/getDataRiwayat') }}",
                        columns:[
                            {
                                data:'DT_RowIndex',
                              name:'DT_RowIndex',
                              orderable:false,
                              searchable:false,
                              className: 'text-center'
                            },
                            {
                                data:'transactionDate',
                                name:'transactionDate'
                            },
                            {
                                data:'customer.customerName',
                                name:'customerName'
                            },
                            {
                                data:'user.employee.name',
                                name:'name',
                            },
                            {
                                data:'totalPrice',
                                name:'totalPrice',
                            },
                            {
                                data:'ACTION',
                                name:'aksi',
                                className:'d-flex justify-content-center gap-2'
                            }
                        ]
                    })
                })


</script>
@endsection
