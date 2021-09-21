<table class="table table-bordered" id="tbl_siswa" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>NO.</th>
            <th>NIS</th>
            <th>NAMA</th>
            <th>TEMPAT LAHIR</th>
            <th>TANGGAL LAHIR</th>
            <th>JENIS KELAMIN</th>
            <th>ALAMAT</th>
            <th>JURUSAN</th>
            <th>FOTO</th>
            <th>AKSI</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($data_siswa->result() as $ds) : ?>
            <tr>
                <td width="20px">
                    <?php echo $no++ ?>
                </td>
                <td>
                    <?php echo $ds->nis ?>
                </td>
                <td>
                    <?php echo $ds->nama_siswa ?>
                </td>
                <td>
                    <?php echo $ds->tempat_lahir ?>
                </td>
                <td>
                    <?php echo $ds->tgl_lahir ?>
                </td>
                <td>
                    <?php echo $ds->jenis_kelamin ?>
                </td>
                <td>
                    <?php echo $ds->alamat ?>
                </td>
                <td>
                    <?php echo $ds->jurusan ?>
                </td>

                <td class="text-center">
                    <img width="120" src="<?php echo base_url() ?>assets/uploads/foto_siswa/<?php echo $ds->foto; ?>">
                </td>

                <td style="display: flex;">

                    <!-- Gak bisa karena data target modal belum dipanggil dan data id nya belum dibuat -->
                    <a>
                        <button class='btn btn-sm btn-primary'><i class="fa fa-edit edit-data" data-id="<?php echo $ds->nis ?>"></i></button>
                    </a>
                    </div>&nbsp;&nbsp;
                    <div class="btn btn-sm btn-danger">
                        <i class="fa fa-trash hapus-data" data-id="<?php echo $ds->nis ?>"></i>
                    </div>&nbsp;&nbsp;

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal untuk edit -->

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-data-siswa" method='POST' enctype='multipart/form-data'>
                    <input type="hidden" name="id" />
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis" style="background:#d5d8eb;color: #000000;" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" class="form-control" id="nama_s" name="nama_siswa" style="background:#d5d8eb;color: #000000;">
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_t" name="tempat_lahir" style="background:#d5d8eb;color: #000000;">
                    </div>

                    <div class="form-group">
                        <label> Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" style="background:#d5d8eb;color: #000000;">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
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
                        <label for="pic_file">Foto*:</label><br>
                        <img id="foto-siswa" src="" alt="Foto Siswa" width="150" height="200">
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

<script>
    //menampilkan data dihapus
    $(".hapus-data").click(function(e) {
        e.preventDefault();
        id = $(this).data('id');
        swal({
                title: "Apa Anda Yakin?",
                text: "Data yang terhapus,tidak dapat dikembalikan!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '<?= site_url('data_siswa/crud/delete') ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            swal("Berhasil!", "Data Berhasil Dihapus.", "success");
                            $('#data_siswa').DataTable().clear().destroy();
                            refresh_table();
                        }
                    });
                } else {
                    swal("Dibatalkan", "Data yang dipilih tidak jadi dihapus", "error");
                }
            });
    });

    // menampilkan data di edit
    modal_edit = $("#modal-edit");
    $(".edit-data").click(function(e) {
        id = $(this).data('id');
        $.ajax({
                url: '<?= site_url('data_siswa/get_by_id') ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    id: id
                },
            })
            .done(function(data) {
                $("#form-edit-data-siswa input[name='id']").val(data.object.nis);
                $("#form-edit-data-siswa input[name='nis']").val(data.object.nis);
                $("#form-edit-data-siswa input[name='nama_siswa']").val(data.object.nama_siswa);
                $("#form-edit-data-siswa input[name='tempat_lahir']").val(data.object.tempat_lahir);
                $("#form-edit-data-siswa input[name='tgl_lahir']").val(data.object.tgl_lahir);
                $("#form-edit-data-siswa input[name='alamat']").val(data.object.alamat);
                $("#form-edit-data-siswa input[name='jurusan']").val(data.object.jurusan);
                var foto = data.object.foto;
                $('#foto-siswa').attr("src", `<?php echo base_url() ?>assets/uploads/foto_siswa/${foto}`);
                $("#jenis_kelamin").val(data.object.jenis_kelamin);
                modal_edit.modal('show').on('shown.bs.modal', function(e) {
                    $("#form-edit-data-siswa input[name='nis']").focus();
                });
            });
    })
    //Proses Update ke Db
    $("#form-edit-data-siswa").submit(function(e) {
        e.preventDefault();
        form = $(this);
        $.ajax({
            url: '<?= site_url('data_siswa/crud/update') ?>',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                form[0].reset();
                modal_edit.modal('hide');
                swal("Berhasil!", "Data Siswa berhasil diedit.", "success");
                $('#tbl_siswa').DataTable().clear().destroy();
                refresh_table();
            },
            error: function(response) {
                alert(response);
            }
        })
    });
</script>