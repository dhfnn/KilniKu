<div class="modal fade" id="modaltdSupplier" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0 p-2 px-3">
            <div class="d-flex justify-content-between border-bottom py-1">
                <span class="text-td">Tambah Data</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-blue close-crud">
                    <i class="fa-regular fa-xmark"></i>
                </button>
            </div>
            <div class="col m-0 pt-2 mb-2">
                <div class="row">
                    <div class="col-7">
                        <div class="col d-flex justify-content-between ">
                            <span class="st-data">Nama</span>
                            <span class="text-error" id="td-supplierName-error"></span>
                        </div>
                        <input type="text" class="it-data w-100 px-2" name="supplierName" id="td-supplierName">
                    </div>
                    <div class="col">
                        <div class="col d-flex justify-content-between ">
                            <span class="st-data">Telepon</span>
                            <span type="number" class="text-error" id="td-phoneNumber-error"></span>
                        </div>
                        <input type="text" class="it-data w-100 px-2" name="phoneNumber" id="td-phoneNumber">
                    </div>
                </div>

            </div>
            <div class="col-12 d-flex justify-content-end">
                <button class="btn-add p-1 mt-3 tds">Tambah</button>
            </div>
        </div>
    </div>
</div>
