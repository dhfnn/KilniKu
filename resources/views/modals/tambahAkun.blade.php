<div class="modal fade" id="modalId" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="modalTitleId" aria-hidden="true">
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
                    <div class="col-8">
                        <div class="col d-flex justify-content-between ">
                            <span class="st-data">Username</span>
                            <span class="text-error" id="td-username-error"></span>
                        </div>
                        <input type="text" class="it-data w-100 px-2" name="username" id="td-username">
                    </div>
                    <div class="col">
                        <div class="col d-flex justify-content-between ">
                            <span class="st-data">Role</span>
                            <span class="text-error" id="td-role-error"></span>
                        </div>
                        <select name="role" id="td-role" class="slt-data">
                            <option value="" selected disabled>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-2">
                        <div class="col d-flex justify-content-between">
                            <span class="st-data">Nama</span>
                            <span class="text-error" id="td-employeeID-error"></span>
                        </div>
                        <select name="employeeID"  class="slt-data employeeID2" id="td-employeeID">
                            <option value="" selected disabled>Pilih Karyawan</optiom>
                        </select>
                    </div>
                    <div class="col mt-2">

                        <div class="col d-flex justify-content-between">
                            <span class="st-data">Password</span>
                            <span class="text-error" id="td-password-error"></span>
                        </div>
                        <input type="password" class="it-data w-100 px-2" name="password" id="td-password">

                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button class="btn-add p-1 mt-3 tda">Tambah</button>
            </div>
        </div>
    </div>
</div>
