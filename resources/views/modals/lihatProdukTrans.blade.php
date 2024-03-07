<div class="modal" tabindex="-1" id="lihattranspro">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="col p-2 px-3 d-flex justify-content-between">
                    {{-- <span class="j-modal">Daftar Obat</span> --}}
                    <i class="fa-solid fa-xmark fs-4" data-bs-dismiss="modal"></i>
                </div>

                <div class="invoice">
                    <div class="invoice-header">
                        <h2>Invoice</h2>
                    </div>
                    <div class="invoice-details">
                        <p id="transaction-id">Transaction ID: </p>
                        <p id="transaction-date">Tanggal Transaksi: </p>
                    </div>
                    <div class="col text-emd">
                        <span id="namaPelanggan"></span>
                    </div>
                    <table class="invoice-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Obat</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="halo">

                        </tbody>
                    </table>
                    <div class="total" class="text-start">
                        <span id="checkup-name">Nama Pemeriksaan: </span>
                        <div class="col yo text-end">

                            <p id="total-price">Total Price: </p>
                        </div>
                    </div>
                </div>
                <div class="col px-2 pb-2 d-flex justify-content-end ">

                    <button class="btn btn-primary mt-2 " onclick="printModalContent()">Print</button>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function printModalContent() {
        var printContents = document.getElementById("lihattranspro").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>