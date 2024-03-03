<div class="modal fade " id="modaltdProduk" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="modalTitleId" aria-hidden="true" >
    <div class="modal-dialog modal-lg"  role="document">
        <form action="" id="addForm" enctype="multipart/form-data">
        <div class="modal-content border-0 p-2 px-3" >
            <div class="d-flex justify-content-between border-bottom py-1">
                <span class="text-td">Tambah Data</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-blue close-crud">
                    <i class="fa-regular fa-xmark"></i>
                </button>
            </div>
            <div class="col m-0 pt-2 mb-2">
                <div class="row">
                    <div class="col-8">
                        <div class="row mt-3">
                            <div class="col-6 pe-0">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Nama</span>
                                    <span class="text-error" id="td-name-error"></span>
                                </div>
                                <input type="text" class="it-data w-100 px-2" name="name" id="td-name">
                            </div>
                            <div class="col-4 pe-0">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Kategori</span>
                                    <span class="text-error" id="td-category-error"></span>
                                </div>
                                <select name="category" id="td-category" class="slt-data">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Obat Bebas">Obat Bebas</option>
                                    <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
                                    <option value="Obat Keras">Obat Keras</option>
                                </select>
                            </div>
                            <div class="col ">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Jumlah</span>
                                    <span class="text-error" id="td-stock-error"></span>
                                </div>
                                <input type="text" class="it-data w-100 px-2" name="stock" id="td-stock">
                            </div>
                        </div>

                        {{-- 2 --}}
                        <div class="row mt-3 mx-0 p-0">
                                <div class="col px-0 d-flex justify-content-between ">
                                    <span class="st-data">Deskripsi</span>
                                    <span class="text-error" id="td-description-error"></span>
                                </div>
                                <textarea name="description" cols="30" rows="10" class="tt-data" id="td-description"></textarea>
                        </div>
                    </div>

                    <div class="col d-flex justify-content-end">
                        <div class="mt-3 ">
                            <div class="d-flex justify-content-center ">
                                <div class="cont-preview2">
                                    <img id="preview2" src="{{ asset('img/pp.png') }}" alt="Preview Gambar" style="max-width: 300px;" >
                                </div>
                            </div>
                            <div class="d-flex justify-content-center pt-3">
                                
                                <input type="file" name="image" style="display:none;" id="td-image" >
                                <label for="td-image" class="custom-file-upload p-1 px-2 " style="cursor: pointer;">Pilih Gambar</label>
                            <span class="text-error" id="td-image-error"></span>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col ">
                        <div class="col d-flex justify-content-between ">
                            <span class="st-data">Supplier</span>
                            <span class="text-error" id="td-supplierID-error"></span>
                        </div>
                            <select name="supplierID" id="td-supplierID" class="w-100 slt-data" style="z-index: 1000000">
                                <option value="">Pilih supplier</option>
                            </select>
                    </div>
                    <div class="col ">
                        <div class="col d-flex justify-content-between ">
                            <span class="st-data">Tanggal Kadaluwarsa</span>
                            <span class="text-error" id="td-expiryDate-error"></span>
                        </div>
                        <input type="date" class="it-data w-100 px-2" name="expiryDate" id="td-expiryDate">
                    </div>

                        <div class="col  ">
                            <div class="col d-flex justify-content-between ">
                                <span class="st-data">Harga Beli </span>
                                <span class="text-error" id="td-purchasePrice-error"></span>
                            </div>
                            <input type="number" class="it-data w-100 px-2" name="purchasePrice" id="td-purchasePrice">

                        </div>
                        <div class="col ">
                            <div class="col d-flex justify-content-between ">
                                <span class="st-data">Harga Jual</span>
                                <span class="text-error" id="td-sellingPrice-error"></span>
                            </div>
                            <input type="number" class="it-data w-100 px-2" name="sellingPrice" id="td-sellingPrice">
                        </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button class="btn-add p-1 mt-3 tdP">Tambah</button>
            </div>
        </div>
    </form>
    </div>
</div>