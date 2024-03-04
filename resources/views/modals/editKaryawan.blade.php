<div class="modal fade" id="modaledKaryawan" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content border-0 p-2 px-3" >
            <div class="d-flex justify-content-between border-bottom py-1">
                <span class="text-td">Tambah Data</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-blue close-crud">
                    <i class="fa-regular fa-xmark"></i>
                </button>
            </div>
            <form action="#"  id="editFormKaryawan" method="POST" enctype="multipart/form-data">
            <div class="col m-0 pt-2 mb-2">
                <div class="row">
                    <div class="col-8">
                        <div class="col mt-3">
                            <div class="col d-flex justify-content-between ">
                                <span class="st-data">Nama</span>
                                <span class="text-error" id="ed-name-error"></span>
                            </div>
                            <input type="text" class="it-data w-100 px-2" name="name" id="ed-name">
                        </div>
                        <div class="row mt-2 mx-0 p-0">
                            <div class="col ps-0 ">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Telepon</span>
                                    <span class="text-error" id="ed-phoneNumber-error"></span>
                                </div>
                                <input type="text" class="it-data w-100 px-2" name="phoneNumber" id="ed-phoneNumber" >
                            </div>
                            <div class="col pe-0">
                                <div class="col d-flex justify-content-between ">
                                    <span class="st-data">Tanggal Lahir</span>
                                    <span class="text-error" id="ed-birthdaed-error"></span>
                                </div>
                                <input type="date" class="it-data w-100 px-2" name="birthdate" id="ed-birthdate">
                            </div>
                        </div>
                        <div class="col mt-3">
                            <div class="col d-flex justify-content-between ">
                                <span class="st-data">Jenis Kelamin</span>
                                <span class="text-error" id="ed-gender-error"></span>
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
                                    <img id="previewedit" class="previewgambar" alt="Preview Gambar" style="max-width: 300px;" >
                                </div>
                            </div>
                            <div class="d-flex justify-content-center pt-3">
                                <input type="file" id="image2"   style="display:none;" name="image">
                                <label for="image2" class="custom-file-upload p-1 px-2 " style="cursor: pointer;">Pilih Gambar</label>
                                <span class="text-error" id="ed-image-error"></span>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col-8 ">
                        <div class="col d-flex justify-content-between ">
                            <span class="st-data">Alamat</span>
                            <span class="text-error" id="ed-address-error"></span>
                        </div>
                        <textarea name="address" cols="30" rows="10" class="tt-data" id="ed-address"></textarea>

                    </div>
                    <div class="col">
                        <div class="col  ">
                            <div class="col d-flex justify-content-between ">
                                <span class="st-data">Posisi/Jabatan </span>
                                <span class="text-error" id="td-position-error"></span>
                            </div>
                            <select name="position" id="ed-position" class="slt-data">
                                <option value="">Pilih Posisi</option>
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
                                <span class="text-error" id="ed-startWork-error"></span>
                            </div>
                            <input type="date" class="it-data w-100 px-2" name="startWork" id="ed-startWork">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button class="btn-add p-1 mt-3 eds" id="id-kar" type="submit">Ubah</button>
            </div>
        </form>
        </div>
    </div>
</div>