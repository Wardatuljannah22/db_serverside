<script>
    //Untuk filter pastikan dropdown dibuat dan di panggil nilainya
    function refresh_table() {

        $.ajax({
            url: "<?= base_url('form_siswa/get_all') ?>",
            success: function(data) {
                $("#tampil").html(data);
                $('#tbl_siswa').DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                })
            }
        });
    };
    refresh_table();
</script>