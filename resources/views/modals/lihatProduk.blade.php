<div class="modal fade " id="modaltdtProduk" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="modalTitleId" aria-hidden="true" >
    <div class="modal-dialog modal-lg"  role="document">
        <form action="#" method="POST" id="lihatForm" enctype="multipart/form-data">
        <div class="modal-content border-0 p-2 px-3" >
            <div class="d-flex justify-content-between border-bottom py-1">
                <span class="text-td">Tambah Data</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-blue close-crud btn-closeD">
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
                                    <span class="text-error" id="tdt-name-error"></span>
                                </div>
                                <input type="text" class="it-data tdt-read w-100 px-2" name="name" id="tdt-name" >
                            </div>
                            <div class="col-4 pe-0">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Kategori</span>
                                    <span class="text-error" id="tdt-category-error"></span>
                                </div>
                        <input class="it-data w-100 tdt-read cd-category" type="text" id="tdt-category">

                                <select name="category" id="tdt-category" class="slt-data tdt-slt">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Obat Bebas">Obat Bebas</option>
                                    <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
                                    <option value="Obat Keras">Obat Keras</option>
                                </select>
                            </div>
                            <div class="col ">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Jumlah</span>
                                    <span class="text-error" id="tdt-stock-error"></span>
                                </div>
                                <input type="number" class="it-data tdt-read w-100 px-2" name="stock" id="tdt-stock" >
                            </div>
                        </div>

                        {{-- 2 --}}
                        <div class="row mt-3 mx-0 p-0">
                                <div class="col px-0 d-flex justify-content-between ">
                                    <span class="st-data">Deskripsi</span>
                                    <span class="text-error" id="tdt-description-error"></span>
                                </div>
                                <textarea name="description" cols="30" rows="10" class="tt-data tdt-read" id="tdt-description" ></textarea>
                        </div>
                    </div>

                    <div class="col d-flex justify-content-end">
                        <div class="mt-3 ">
                            <div class="d-flex justify-content-center ">
                                <div class="cont-preview2">
                                    <img id="previewoi" class="previewgambar" alt="Preview Gambar" style="max-width: 300px;" >
                                </div>
                            </div>
                            <div class="d-flex justify-content-center pt-3 ">
                                
                                <input type="file" name="image" style="display:none;"  id="tdt-image"  >
                                <label for="tdt-image" class="custom-file-upload p-1 px-2 tdt-slt " style="cursor: pointer;">Pilih Gambar</label>
                            <span class="text-error" id="tdt-image-error"></span>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col ">
                        <div class="col d-flex justify-content-between ">
                            <span class="st-data">Supplier</span>
                            <span class="text-error" id="tdt-supplierID-error"></span>
                        </div>
                        <input class="it-data w-100 tdt-read cd-supplierID" type="text" id="cd-supplier">
                        <select name="supplierID" id="tdt-supplierID"  class="w-100 slt-data tdt-slt2"  style="display: none !important;">
                            <option value="">Pilih supplier</option>
                        </select>
                    </div>
                    <div class="col ">
                        <div class="col d-flex justify-content-between ">
                            <span class="st-data">Tanggal Kadaluwarsa</span>
                            <span class="text-error" id="tdt-expiryDate-error"></span>
                        </div>
                        <input type="date" class="it-data tdt-read w-100 px-2" name="expiryDate" id="tdt-expiryDate" >
                    </div>

                        <div class="col  ">
                            <div class="col d-flex justify-content-between ">
                                <span class="st-data">Harga Beli </span>
                                <span class="text-error" id="tdt-purchasePrice-error"></span>
                            </div>
                            <input type="number" placeholder="per-satuan" class="it-data tdt-read w-100 px-2" name="purchasePrice" id="tdt-purchasePrice" >

                        </div>
                        <div class="col ">
                            <div class="col d-flex justify-content-between ">
                                <span class="st-data">Harga Jual</span>
                                <span class="text-error" id="tdt-sellingPrice-error"></span>
                            </div>
                            <input type="number" placeholder="per-satuan" class="it-data tdt-read w-100 px-2" name="sellingPrice" id="tdt-sellingPrice" >
                        </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end pt-2">
                <button type="button" class="t-detailp t-edit btn-eda p-1 me-2 tdP px-1 fw-bold">Ubah Data ?</button>
                <button type="button" class="t-detailK t-edit btn-eda p-1  tdP px-1 fw-bold me-2">
                    Batal
                </button>

                <button type="submit" id="id-Pro" class="pt-detailp btn-add p-1  tdP px-1 fw-bold" >
                    Ubah
                </button>
            </form>
                <button type="button" class="t-hapus btn-tdh "  id="btn-hdD"   data-bs-toggle= "modal"  type="modal">
                    <i class="fa-duotone fa-trash"></i>
                </button>

            </div>
        </div>
    </div>
</div>