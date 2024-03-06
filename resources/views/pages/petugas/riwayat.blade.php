@extends('temp.sidebar2')

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
                  <th>KASIR</th>
                  <th>NAMA PELANGGAN</th>
                  <th>PEMERIKSAAN</th>
                  <th>TOTAL HARGA</th>
                <th>DETAIL</th>
              </tr>
          </thead>
        </table>
            </div>
            @include('modals.lihatProdukTrans')
</div>

<script>
 $(document).ready(function() {
                    new DataTable('#tableDataRiwayat', {
                    lengthMenu: [ [5, 10, 20], [5, 10, 20] ],
                      processing:true,
                      serverside:true,dom: '<"html5buttons">Bfrtip',
        language: {
            buttons: {
                colvis : 'show / hide',
                colvisRestore: "Reset Kolom"
            }
        },
        buttons : [
            {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
            {extend:'print',title: 'Data Karyawan'},
        ],
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
                                name:'transactionDate',
                              className: 'text-center'

                            },
                            {
                                data:'user.employee.name',
                                name:'name',
                              className: 'text-center'

                            },
                            {
                                data:'customer.customerName',
                                name:'customerName',
                              className: 'text-center'

                            },
                            {
                                data:'checkup.checkupName',
                                name:'name',
                              className: 'text-center'

                            },
                            {
                                data:'totalPrice',
                                name:'totalPrice',
                              className: 'text-center'

                            },
                            {
                                data:'ACTION',
                                name:'aksi',
                                className:'d-flex justify-content-center gap-2'
                            }
                        ]
                    })
                })



                $('body').on('click', '#btn-riwayat', function() {
    let id = $(this).data('id');
    $.ajax({
        url:'/petugas/transaksi/'+id+'/edit',
        type:'GET',
        success: function(res) {
            let data = res.hasil;
            console.log(res.hasil);

            // Isi detail transaksi
            $('.invoice-details p:nth-child(1)').text('Transaction ID: ' + data[0].transID);
            $('.invoice-details p:nth-child(2)').text('Transaction Date: ' + data[0].transaction.transactionDate);

            // Isi tabel barang
            let tableBody = $('tbody#halo');
            tableBody.empty();
            $.each(data, function(index, item) {
                let row = '<tr>' +
                    '<td class="text-center">' + (index + 1) + '</td>' +
                    '<td>' + item.product.name + '</td>' +
                    '<td>' + item.quantity + '</td>' +
                    '<td>Rp.' + item.subTotal + '</td>' +
                    '</tr>';
                tableBody.append(row);
            });

            // Isi total harga
            $('.total span').text('Pemeriksaan : ' + data[0].transaction.checkup.checkupName+' = Rp.' +data[0].transaction.checkup.price);
            $('.total p').text('Total Hrga: Rp.' + data[0].transaction.totalPrice);
            $('#namaPelanggan').text('Nama : ')
            $('#lihattranspro').modal('show');
        }
    });
});

</script>
@endsection
