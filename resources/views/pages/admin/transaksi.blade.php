{{-- @extends('temp.sidebar')

@section('con') --}}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('DataTables/DataTables-1.13.10/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-pro-6.5.1-web/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('simple-notify\dist\simple-notify.css') }}">
  <script src="{{ asset('DataTables/jQuery-3.7.0/jquery-3.7.0.js') }}"></script>
  <script src="{{ asset('DataTables/datatables.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.css') }}">
  <script src="{{ asset('select2/dist/js/select2.js') }}"></script>

  </head>
  <style>
    .select2-container{

        z-index: 1000000;
        width: 100% !important
    }
    .select2-dropdown{
        z-index: 1000000;

    }
    #modaltdProduk{
        z-index: 100000;

    }
  </style>
  <body>



    <section class="w-100 vh-100  d-flex ">
      <section class="con-kasir overflow-hidden " id="main-pri">
        <section class="overflow-y-auto w-100 h-100  " >
          <section class="con-main  " id="con-main">
            <div class="main w-100 px-3">
                <main class="overflow-y-auto p-3" style="max-height: 80%; max-width:100%;">
                    <form class="row mx-0 g-3 mt-2 px-0 d-flex justify-content-center" action="/transaksi" method="post">
                        @csrf
                          <div class="col-md-5 mb-3">
                              <label for="pelanggan_id" class="form-label">Pelanggan</label>
                              <select id="pelanggan_id" name="pelanggan_id" class="form-select shadow-sm rounded">
                                @foreach ($pelanggan as $p)
                                  <option value="{{ $p->customerID }}">{{ $p->customerName }}</option>
                                @endforeach
                              </select>
                          </div>
                          <div class="col-md-5">
                            <label for="produk_id" class="form-label">Produk</label>
                            <select id="produk_id" name="produk_id" class="form-select shadow-sm rounded">
                              @foreach ($produk as $p)
                                <option data-harga="{{ $p->sellingPrice }}" value="{{ $p->productID }}">{{ $p->name }} (@currency($p->harga))</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-5">
                            <label for="user_id" class="form-label">Kasir</label>
                            <input type="text" class="form-control shadow-sm rounded" name="user_id" id="user_id" readonly value="{{ $user->name }}">
                          </div>
                          <div class="col-md-5">
                            <label for="kuantitas" class="form-label">Kuantitas</label>
                            <input type="number" class="form-control shadow-sm rounded" name="kuantitas" id="kuantitas" placeholder="">
                          </div>
                          <button type="button" class="col-md-9 btn btn-primary mt-4 mb-3 shadow-sm rounded" onclick="addProductToTable()">Buat Transaksi</button>

                      <div class="card col-md-10 shadow-sm rounded" style="max-height: 200px; overflow-y: auto;">
                        <div class="card-body">
                          <div class="table-responsive p-3">
                            <table class="table table-striped table-sm text-start">
                              <thead class="table-primary">
                                  <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Kuantitas</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody id="transactionTableBody">
                                  </tbody>
                                  <tfoot>
                                    <div>
                                      <tr>
                                        <td class="align-center"><h5>Total Harga</h5></td>
                                        <td id="total_harga" class="text-center"></td>
                                      </tr>
                                    </div>
                                  </tfoot>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="row mx-0 g-3 mt-2 px-0 d-flex justify-content-center">
                            <div class="col-md-3">
                              <label for="pembayaran" class="form-label">Pembayaran</label>
                              <input type="number" class="form-control shadow-sm rounded" name="pembayaran" id="pembayaran" oninput="calculateChange()">
                            </div>
                            <div class="col-md-3">
                              <label for="kembalian" class="form-label">Kembalian</label>
                              <input type="number" class="form-control shadow-sm rounded" name="kembalian" id="kembalian"  value="" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary col-md-3 ms-2 shadow-sm rounded" style="height: 40px; margin-top: 47.5px;" onclick="appendAllArrayToInputs()">Transaksi</button>
                            <div class="mb-5">
                              <input type="hidden" id="produk_id_hidden" name="produk_id" value="">
                              <input type="hidden" id="kuantitas_hidden" name="kuantitas" value="">
                              <input type="hidden" name="total_harga" value="" id="input_total_harga">
                            </div>
                          </div>
                        </form>
                  </main>
                </div>
            </div>
          </section>
        </section>
      </section>
    </section>
    <script src="{{ asset('simple-notify\dist\simple-notify.min.js') }}"></script>
    <script src="{{ asset('script/script.js') }}"></script>
  <script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.js') }}"></script>
  <script>
let productIdArr = [];
  let qtyArr = [];

  function addProductToTable() {
    let productSelect = document.getElementById('produk_id');
    let productName = productSelect.options[productSelect.selectedIndex].text;
    let productId = productSelect.value;
    let productPrice = parseFloat(productSelect.options[productSelect.selectedIndex].getAttribute('data-harga'));
    let qty = parseFloat(document.getElementById('kuantitas').value);
    let deleteButton = document.createElement('button');

    // Periksa apakah kuantitas tidak kosong
    if (isNaN(qty) || qty <= 0) {
        alert('Kuantitas harus diisi dengan angka yang valid dan lebih besar dari 0.');
        return;
    }
    let tableBody = document.getElementById('transactionTableBody');
    let newRow = tableBody.insertRow();
    let cellIndex = newRow.insertCell(0);
    let cellName = newRow.insertCell(1);
    let cellPrice = newRow.insertCell(2);
    let cellQty = newRow.insertCell(3);
    let cellDate = newRow.insertCell(4);
    let cellDelete = newRow.insertCell(5);

    let totalForProduct = productPrice * qty;

    cellIndex.innerHTML = tableBody.rows.length;
    cellName.innerHTML = productName;
    cellPrice.innerHTML = totalForProduct;
    cellQty.innerHTML = qty;
    cellDate.innerHTML = new Date().toISOString().split('T')[0];
    deleteButton.innerHTML = '<i class="bi bi-trash"></i>';
    deleteButton.classList.add('btn', 'btn-danger', 'delete-btn');
    deleteButton.setAttribute('type', 'button');
    deleteButton.setAttribute('onclick', 'deleteRow(this)');
    cellDelete.appendChild(deleteButton);
    productIdArr.push(productId);
    qtyArr.push(qty);
    document.getElementById('kuantitas').value = '';

    calculateTotal(totalForProduct);
  }

function calculateTotal(newProductPrice) {

        let tableBody = document.getElementById('transactionTableBody');
        let totalPriceCell = document.getElementById('total_harga');
        let total = 0;

        for (let i = 0; i < tableBody.rows.length; i++) {
            let row = tableBody.rows[i];
            let price = parseFloat(row.cells[2].innerHTML);
            total += price;
        }


    // Update total price cell
    document.getElementById('total_harga').innerHTML = total;


  }

function appendAllArrayToInputs(){
  let hiddenProductId = document.getElementById('produk_id_hidden');
    let hiddenQuantity = document.getElementById('kuantitas_hidden');
    let hidden_total_harga = document.getElementById('total_harga');
    let total_harga = document.getElementById('input_total_harga');

    hiddenProductId.value = JSON.stringify(productIdArr);
    hiddenQuantity.value = JSON.stringify(qtyArr);
    total_harga.value = hidden_total_harga.textContent;
  }

function calculateChange() {
    let totalHarga = parseFloat(document.getElementById('total_harga').innerHTML);
    let pembayaran = parseFloat(document.getElementById('pembayaran').value);


    let kembalian = pembayaran - totalHarga;
    document.getElementById('kembalian').value = kembalian;
  }

  function deleteRow(button) {
    // Mendapatkan referensi baris yang akan dihapus
    var row = button.closest('tr');

    // Menghapus baris dari tabel
    row.remove();

    // Perbarui nomor urut pada kolom "No"
    var tableBody = document.getElementById('transactionTableBody');
    for (var i = 0; i < tableBody.rows.length; i++) {
        tableBody.rows[i].cells[0].innerText = i + 1;
    }

    // Perbarui total harga
    calculateTotal();
  }

  </script>
</body>
</html>

{{--
@endsection --}}