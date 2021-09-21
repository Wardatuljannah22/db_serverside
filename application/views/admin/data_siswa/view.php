<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Siswa</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Biodata Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- data-toggle="modal" : Mengarahkan ke modal 
				data-target :"#modal-tambah" : buka modal dengan id='modal_tambah' 
				untuk edit sesuaikan-->
                <a data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Data</span>
                </a>
                <hr>
                &nbsp;
                &nbsp;

                <!-- Ganti div dengan table lood ajax -->
                <div id="tampil">
                    <!-- Data tampil disini -->
                </div>

            </div>
            <!-- modal tambah data -->


            <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Siswa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-tambah" method="post">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input type="text" class="form-control" id="nis" name="nis" style="background:#d5d8eb;color: #000000;">
                                </div>
                                <div class="form-group">
                                    <label>Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama_s" name="nama_siswa" style="background:#d5d8eb;color: #000000;">
                                </div>

                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" style="background:#d5d8eb;color: #000000;">
                                </div>

                                <div class="form-group">
                                    <label> Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" style="background:#d5d8eb;color: #000000;">
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="">--Pilih Jenis Kelamin--</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" style="background:#d5d8eb;color: #000000;">
                                </div>
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <input type="text" class="form-control" id="jurusan" name="jurusan" style="background:#d5d8eb;color: #000000;">
                                </div>

                                <div class="form-group">
                                    <label for="pic_file">Foto*:</label>
                                    <input type="file" name="foto" class="form-control" id="pic_file">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>