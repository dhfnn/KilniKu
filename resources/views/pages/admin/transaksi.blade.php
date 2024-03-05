@extends('temp.sidebar')
@section('con')

<div class="container-fluid px-md-5">
    <form id="TambahTrans" method="POST">
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                <div class="bg-white p-1 mb-3 " style="border-radius:7px;">
                    <div class="col">
                        <div class="p-2 ">
                            <div class="row g-3">
                                <div class="col">

                                    <div class="col">
                                        <span class="m-data">Pasien</span>
                                        <div class="input-group">
                                            <select id="dataSelectPasien" class="slt-data" name="customerID">
                                                <option selected disabled>Pilih Pasien</option>
                                                @foreach ($pelanggan as $item)
                                                <option value="{{ $item->customerID }}">{{ $item->customerName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col mt-2">
                                        <span class="m-data">Pemeriksaan</span>
                                        <div class="input-group">
                                            <select id="dataSelectPeriksa" class="slt-data" name="checkupID">
                                                <option selected disabled>Pilih Pemeriksaan</option>
                                                @foreach ($checkup as $item)
                                                <option value="{{ $item->checkupID }}" data-harga="{{ $item->price }}">{{ $item->checkupName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <span class="m-data">Obat</span>
                                    <div class="input-group">
                                        <select id="dataSelectProduct" class="slt-data">
                                            <option selected disabled>Pilih Obat</option>
                                            @foreach ($produk as $item)
                                            <option value="{{ $item->productID }}"  data-name="{{ $item->name }}" data-Harga="{{ $item->purchasePrice }}" data-productID="{{ $item->productID }}" data-stock="{{ $item->stock }}">
                                            <span style="font-style: italic;">
                                                {{ $item->name }} Rp. {{ $item->purchasePrice }}
                                            </span>


                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="col d-flex justify-content-end">
                        <button type="button" id="TambahObat" class="px-2 py-1 btn-add text-white fw-bold ">Tambahkan Obat</button>
                    </div>
                </div>
            </div>

            <div class="" >
                <div class="">
                    <span class="t-jta">Daftar Obat</span>
                </div>
                <div class="card-body bg-white px-3 " style="border-radius:7px; " >
                    <div class="table-responsive pb-2 fixed_header">
                        <table id="example" class="table-standart" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pasien</th>
                                    <th>Obat</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Harga</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="" style="background-color:#fdfdfd;" id="tableDatatrans">
                            </tbody >

                        </table>
                        <div class="col px-0 " style="border-top:1px #efe9e9 solid;">
                            <div class="row px-0 mx-0 mt-2 d-flex">

                                <div class="col">
                                    <span class="hargaPemeriksaan fw-bold"> Pemeriksaan: </span>
                                    <span id="checkupPrice">0</span>
                                    <input type="hidden" id="checkupPriceInput" name="checkupPriceInput">

                                </div>
                                <div class="col">
                                    <input type="hidden" name="totalPrice" id="totalPriceInput" value="0"><span class="totalHarga fw-bold">Harga Obat : </span><span id="totalPrice">0</span>
                                </div>
                                <div class="col">
                                    <span class="Kessluruhan fw-bold">Total Harga: </span><span id="allPrice">0</span>
                                    <input type="hidden" name="hargaKeseluruhan" id="hargaKeseluruhanInput">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col px-0 " style="border-top:1px #efe9e9 solid;">
                    <div class="row px-0 mx-0 mt-2 d-flex">
                        <div class="col">
                            <span class="m-data">Tunai</span>
                            <input type="text" class="it-data w-100 px-2" name="uangBayar" id="uangBayar">
                        </div>
                        <div class="col">
                            <span class="m-data">Kembalian</span>

                            <input type="text" class="it-data w-100 px-2" name="uangKembalian" id="uangKembalian" readonly>
                        </div>
                        <div class="col d-flex  justify-content-start align-items-end  mt-2 me-1">
                           <div class="col">
                            <button type="submit" id="BayarTombol" class="p-1 px-3 fw-bold text-white btn-add ">Bayar</button>
                           </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
<script>
const BayarTombol = document.getElementById('BayarTombol');
const tambahObatBtn = document.getElementById('TambahObat');
const stockInputs = document.querySelectorAll('.inputJumlah');
const tableDatatrans = document.getElementById('tableDatatrans');

BayarTombol.style.display = 'none';

function hideBtnBayar() {
    BayarTombol.style.display = tableDatatrans.getElementsByTagName('tr').length > 0 ? 'block' : 'none';

}
tambahObatBtn.addEventListener('click', tambahObat);

function tambahObat() {
    const pembeli = document.getElementById('dataSelectPasien');
    const product = document.getElementById('dataSelectProduct');
    const periksa = document.getElementById('dataSelectPeriksa');
    const productId = product.value;
    const stockProduct = parseInt(product.options[product.selectedIndex].getAttribute('data-stock'));

    if (stockProduct <= 0) {
        showError('Stok Habis !!');
        return;
    }

    if (!cekInput(pembeli, product, periksa)) {
        showError('isi semua data');
        return;
    }

    let row = caraProductId(productId);
    if (row) {
        let stockInput = row.querySelector('.inputJumlah');
        let stockValue = parseInt(stockInput.value);
        if (stockValue < stockProduct) {
            stockInput.value = stockValue + 1;
        } else {
            showError('jumlah cannot exceed available stock (' + stockProduct + ').');
        }
    } else {
        barisBaru(pembeli, product, productId, stockProduct);
    }

    updateHargaTotal();
    hideBtnBayar();
}

stockInputs.forEach(function(input) {
    input.addEventListener('input', function() {
        let maxStock = parseInt(this.getAttribute('max'));
        let currentStock = parseInt(this.value);
        if (currentStock > maxStock) {
            showError('Stock maksimal (' + maxStock + ').');
            this.value = maxStock;
        } else if (currentStock < 1) {
            showError('Minimal 1 !');
            this.value = 1;
        }
    });
});

function cekInput(pembeli, product, periksa) {
    return pembeli.value && !pembeli.options[pembeli.selectedIndex].disabled &&
           product.value && !product.options[product.selectedIndex].disabled &&
           periksa.value && !periksa.options[periksa.selectedIndex].disabled
}

function showError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: message
    });
}
function barisBaru(pembeli, product, productId, stockProduct) {
    let barisBaru = tableDatatrans.insertRow();
    barisBaru.innerHTML = `
        <td>${tableDatatrans.getElementsByTagName('tr').length}</td>
        <td>${pembeli.options[pembeli.selectedIndex].text}</td>
        <td><input type="hidden" class="form-control productId" name="productId[]" value="${productId}">${product.options[product.selectedIndex].getAttribute('data-name')}</td>
        <td><input type="number" name="jumlah[]" class="form-control inputJumlah" value="1" min="1" max="${stockProduct}" /></td>
        <td>Rp${product.options[product.selectedIndex].getAttribute('data-Harga')}</td>
        <td><span class="subtotal"></span> <input type="hidden" class="subtotalInput" name="subTotal"> </td>
        <td class="text-center"><button class="text-white hapusDataObat"> <i class="fa-regular fa-square-minus text-danger"></i> </button></td>
    `;

    barisBaru.setAttribute('data-productID', productId);
barisBaru.querySelector('.inputJumlah').addEventListener('input', function() {
    updateSubtotal(barisBaru);
    updateHargaTotal();
});
barisBaru.querySelector('.hapusDataObat').addEventListener('click', function() {
    barisBaru.style.display = 'none';
    updateHargaTotal();
    hideBtnBayar();
});


    updateSubtotal(barisBaru);
    hideBtnBayar();
}

function updateSubtotal(row) {
    let priceString = row.getElementsByTagName('td')[4].textContent;
    let price = parseFloat(priceString.replace('Rp', '').replace(',', ''));
    let jumlah = parseInt(row.getElementsByTagName('td')[3].getElementsByTagName('input')[0].value);
    let subtotal = price * jumlah;

    row.querySelector('.subtotal').textContent = subtotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
    row.querySelector('.subtotalInput').value = subtotal;
}

function caraProductId(productId) {
    let rows = tableDatatrans.getElementsByTagName('tr');
    for (let i = 0; i < rows.length; i++) {
        let rowProductId = rows[i].getAttribute('data-productID');
        if (rowProductId === productId) {
            return rows[i];
        }
    }
    return null;
}

// Ambil elemen select untuk pemeriksaan
const selectPeriksa = document.getElementById('dataSelectPeriksa');
const hargaPemeriksaan = document.getElementById('checkupPrice');
selectPeriksa.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const harga = selectedOption.getAttribute('data-harga');
    if (harga) {
        hargaPemeriksaan.textContent = harga;
    } else {
        hargaPemeriksaan.textContent = '0';
    }
    updateHargaTotal();
});

    function updateHargaTotal() {
        let totalPrice = 0;
        let checkupPrice = parseFloat(document.getElementById('checkupPrice').textContent);
        let rows = tableDatatrans.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            let row = rows[i];
            let priceString = row.getElementsByTagName('td')[4].textContent;
            let price = parseFloat(priceString.replace('Rp', '').replace(',', ''));
            let jumlah = parseInt(row.getElementsByTagName('td')[3].getElementsByTagName('input')[0].value);
            totalPrice += price * jumlah;
        }

        let totalPriceRp = totalPrice.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        document.getElementById('totalPriceInput').value = totalPrice.toFixed(2);
        document.getElementById('totalPrice').textContent = totalPriceRp;
        let allPrice = checkupPrice + totalPrice;

        //isi nputan hidden
const hargaKeseluruhanInput = document.getElementById('hargaKeseluruhanInput');
hargaKeseluruhanInput.value = allPrice.toFixed(2);
const hpInput = document.getElementById('checkupPriceInput');
hpInput.value = checkupPrice.toFixed(2);
        document.getElementById('allPrice').textContent = allPrice.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

        calculateChange();
    }


function calculateChange() {
    const uangBayarInput = document.getElementById('uangBayar');
    const uangBayar = parseFloat(uangBayarInput.value);
    const uangKembalianInput = document.getElementById('uangKembalian');
    const hargaKeseluruhanInput = document.getElementById('hargaKeseluruhanInput');

    const totalPrice = parseFloat(hargaKeseluruhanInput.value);

    if (uangBayar < totalPrice) {
    uangKembalianInput.value = 'uang kurang !!';
} else {
    const uangKembalian = uangBayar - totalPrice;
    uangKembalianInput.value = uangKembalian;

}

}

hargaKeseluruhanInput.addEventListener('input', function() {
    updateHargaTotal();
});
uangBayar.addEventListener('input', function() {
    updateHargaTotal();
});



BayarTombol.addEventListener('click', function(event) {
    event.preventDefault();

    let hargaKeseluruhanInput = document.getElementById('hargaKeseluruhanInput');
    let a = document.getElementById('uangBayar');
    let nilaib = parseFloat(hargaKeseluruhanInput.value);
    let nilai = parseFloat(a.value);

    if (isNaN(nilai)) {
        showError('Masukan Uang Bayar !');

        console.log('uang bayar kosong')
        console.log(nilai);
        console.log(nilaib);
    } else if (nilai < nilaib) {
        showError('Uang Kurang !');

    } else {
        console.log('pass');
    let form = document.getElementById('TambahTrans');
    let formData = new FormData(form);
    let url = '/admin/transaksi';
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);
            console.log(response.allData);
            console.log(response.dataA);
            console.log(response.id);

            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Berhasil !!',
                // showCancelButton: true,
                confirmButtonText: 'Yes',
                // cancelButtonText: 'No',
                closeOnConfirm: false,
                closeOnCancel: false
            })
            .then((result) => {
                if (result.isConfirmed) {
                    console.log('behasil');
                    location.reaload()
                }
            });
        },
        error: function(xhr, status, error) {
                console.error(xhr.responseText);
                }
    });
    }


});



</script>
@endsection