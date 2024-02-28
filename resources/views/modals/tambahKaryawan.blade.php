<div class="modal fade show" id="modaltdKaryawan" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg"  role="document">
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
                        <div class="col mb-2">
                            <div class="col d-flex justify-content-between ">
                                <span class="st-data">Nama</span>
                                <span class="text-error" id="td-supplierName-error"></span>
                            </div>
                            <input type="text" class="it-data w-100 px-2" name="supplierName" id="td-supplierName">
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col ps-0 ">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Nama</span>
                                    <span class="text-error" id="td-supplierName-error"></span>
                                </div>
                                <input type="text" class="it-data w-100 px-2" name="supplierName" id="td-supplierName">
                            </div>
                            <div class="col pe-0">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Nama</span>
                                    <span class="text-error" id="td-supplierName-error"></span>
                                </div>
                                <input type="date" class="it-data w-100 px-2" name="supplierName" id="td-supplierName">
                            </div>
                        </div>
                        <div class="col mt-2">
                            <div class="col d-flex justify-content-between ">
                                <span class="st-data">Jenis Kelamin</span>
                                <span class="text-error" id="td-supplierName-error"></span>
                            </div>
                            <div class="col d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                      Laki-laki
                                    </label>
                                  </div>
                                  <div class="form-check ms-2">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                      Perempuan
                                    </label>

                                  </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="col mt-3">
                            <div class="d-flex justify-content-center ">
                                <div class="cont-preview">
                                    <img id="preview" src="{{ asset('img/pp.png') }}" alt="Preview Gambar" style="max-width: 300px;">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center pt-3">
                                <input type="file" id="image" style="display: none;" onchange="previewImage()">
                                <label for="image" class="custom-file-upload p-1 px-2 " style="cursor: pointer;">Pilih Gambar</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col mt-2">
                        <div class="col d-flex justify-content-between ">
                            <span class="st-data">Alamat</span>
                            <span class="text-error" id="td-supplierName-error"></span>
                        </div>
                        <textarea name="" cols="30" rows="10" class="tt-data" id="td-address"></textarea>

                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button class="btn-add p-1 mt-3 tds">Tambah</button>
            </div>
        </div>
    </div>
</div>
