<div class="modal fade" id="modalldKaryawan" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-m"  role="document">
        <div class="modal-content border-0 p-2 px-3" >
            <div class="d-flex justify-content-between border-bottom py-1">
                <span class="text-td">Data Karyawan</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-blue close-crud">
                    <i class="fa-regular fa-xmark"></i>
                </button>
            </div>
            <div class="col m-0 pt-2 mb-2">
                <div class="col">
                    <div class="col mt-2">
                        <div class="col">
                            <div class="d-flex justify-content-center ">
                                <div class="cont-preview">
                                    <img id="preview" src="{{ asset('img/pp.png') }}" alt="Preview Gambar" style="max-width: 300px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col px-3">
                        <div class="row">
                            <div class="col">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Nama</span>
                                    <span class="text-error" id="td-supplierName-error"></span>
                                </div>
                                <span>Naufal Dhafin Ghani</span>
                            </div>
                            <div class="col">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Jenis Kelamin</span>
                                    <span class="text-error" id="td-supplierName-error"></span>
                                </div>
                                <div class="col d-flex">
                                    <span>Laki-Laki</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0 p-0">

                            <div class="col pe-0">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Tanggal Lahir</span>
                                    <span class="text-error" id="td-supplierName-error"></span>
                                </div>
                                <span>08-0-2005</span>
                            </div>
                            <div class="col ps-0 ">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Telepon</span>
                                    <span class="text-error" id="td-supplierName-error"></span>
                                </div>
                                081772846124
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col">
                    <div class="col">
                        <div class="col d-flex justify-content-between ">
                            <span class="st-data">Alamat</span>
                            <span class="text-error" id="td-supplierName-error"></span>
                        </div>
                        <p>
                            jalan cikunten indah rt 05 rw 012
                        </p>

                    </div>
                    <div class="col">
                        <div class="col  ">
                            <div class="col d-flex justify-content-between ">
                                <span class="st-data">Posisi/Jabatan </span>
                                <span class="text-error" id="td-supplierName-error"></span>
                            </div>
                            <span>dokter</span>
                        </div>
                        <div class="col ">
                            <div class="col d-flex justify-content-between ">
                                <span class="st-data">Mulai Bekerja</span>
                                <span class="text-error" id="td-supplierName-error"></span>
                            </div>
                           <span>08-08-2005</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button class="btn-add p-1 tds">Tambah</button>
            </div>
        </div>
    </div>
</div>