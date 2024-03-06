    <div class="modal fade " id="modaltdKaryawan" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg"  role="document">
            <div class="modal-content border-0 p-2 px-3" >
                <div class="d-flex justify-content-between border-bottom py-1">
                    <span class="text-td">Tambah Data</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-blue close-crud">
                        <i class="fa-regular fa-xmark"></i>
                    </button>
                </div>
                <form action="" id="formTambahKaryawan" enctype="multipart/form-data">
                <div class="col m-0 pt-2 mb-2">
                    <div class="row">
                        <div class="col-8">
                            <div class="col mt-3">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Nama</span>
                                    <span class="text-error" id="td-name-error"></span>
                                </div>
                                <input type="text" class="it-data w-100 px-2" name="name" id="td-name">
                            </div>
                            <div class="row mt-2 mx-0 p-0">
                                <div class="col ps-0 ">
                                    <div class="col d-flex justify-content-between ">
                                        <span class="st-data">Telepon</span>
                                        <span class="text-error" id="td-phoneNumber-error"></span>
                                    </div>
                                    <input type="text" class="it-data w-100 px-2" name="phoneNumber" id="td-phoneNumber">
                                </div>
                                <div class="col pe-0">
                                    <div class="col d-flex justify-content-between ">
                                        <span class="st-data">Tanggal Lahir</span>
                                        <span class="text-error" id="td-birthdate-error"></span>
                                    </div>
                                    <input type="date" class="it-data w-100 px-2" name="birthdate" id="td-birthdate">
                                </div>
                            </div>
                            <div class="col mt-3">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Jenis Kelamin</span>
                                    <span class="text-error" id="td-gender-error"></span>
                                </div>
                                <div class="col d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="Laki-laki" checked>
                                        <label class="form-check-label" for="gender1">
                                        Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check ms-2">
                                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="Perempuan">
                                        <label class="form-check-label" for="gender2">
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
                                        <img id="previewtambah" class="previewgambar" src="{{ asset('img/pp.png') }}" alt="Preview Gambar" style="max-width: 300px;" >
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center pt-3">
                                    <input type="file"  style="display: none;"  name="image" id="imagetambah">
                                    <label for="imagetambah" class="custom-file-upload p-1 px-2 " style="cursor: pointer;">Pilih Gambar</label>
                                <span class="text-error" id="td-image-error"></span>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-8 ">
                            <div class="col d-flex justify-content-between ">
                                <span class="st-data">Alamat</span>
                                <span class="text-error" id="td-address-error"></span>
                            </div>
                            <textarea name="address" cols="30" rows="10" class="tt-data" id="td-address"></textarea>

                        </div>
                        <div class="col">
                            <div class="col  ">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Posisi/Jabatan </span>
                                    <span class="text-error" id="td-position-error"></span>
                                </div>
                                <select name="position" id="td-position" class="slt-data">
                                    <option value="" selected disabled>Pilih Posisi</option>
                                    <option value="Dokter">Dokter</option>
                                    <option value="Perawat">Perawat</option>
                                    <option value="Karyawan">Karyawan</option>
                                    <option value="Farmasis">Farmasis</option>
                                    <option value="Administrasi">Administrasi</option>
                                </select>
                            </div>
                            <div class="col mt-3 ">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Mulai Bekerja</span>
                                    <span class="text-error" id="td-startWork-error"></span>
                                </div>
                                <input type="date" class="it-data w-100 px-2" name="startWork" id="td-startWork">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn-add p-1 mt-3 tdK" >Tambah</button>
                </div>
            </form>
            </div>
        </div>
    </div>