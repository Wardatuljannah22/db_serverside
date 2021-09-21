<script>
  //Untuk filter pastikan dropdown dibuat dan di panggil nilainya
  function refresh_table() {
    //Mendapatkan value dari dropdown id=filter_j_kelamin
    $.ajax({
      url: "<?= base_url('data_siswa/get_all') ?>",
      success: function(data) {
        $("#tampil").html(data);
        $('#tbl_siswa').DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
          "initComplete": function(settings, json) {
            $("#biodata_santri").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
          },
          dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          // "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
          // "<'row'<'col-sm-12'tr>>" +
          // "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          buttons: [{
            extend: 'pdf',
            title: 'Data Siswa MAN 2 Nganjuk',
            filename: 'Data Siswa MAN 2 Nganjuk',
            pageSize: 'A4',
            // customize: function (doc) {
            //                doc.defaultStyle.fontSize = 10; //2, 3, 4,etc
            //                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            //                doc.content[1].table.widths = [ '14%',  '14%', '14%', '0%', '14%', 
            //                                                '15%', '15%', '15%'];
            //            },
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
            },
            customize: function(doc) {
              doc.styles.tableBodyEven.alignment = 'center';
              doc.styles.tableBodyOdd.alignment = 'center';
            }
          }, {
            extend: 'excel',
            title: 'Data Siswa MAN 2 Nganjuk',
            filename: 'Data Siswa MAN 2 Nganjuk',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
            },

          }, ]
        }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
      }
    });
  };
  refresh_table();
  $("#form-tambah").submit(function(e) {
    e.preventDefault();
    modal_tambah = $("#modal-tambah");
    form = $(this);
    $.ajax({
      url: '<?= site_url('data_siswa/crud/insert') ?>',
      type: 'POST',
      //  Tambahan Jika dengan file upload agar terbaca
      data: new FormData(this),
      processData: false,
      contentType: false,
      cache: false,
      async: false,
      success: function() {
        swal("Berhasil!", "Data Siswa Baru Telah Ditambahkan.", "success");
        form[0].reset();
        modal_tambah.modal('hide');
        $('#tbl_siswa').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response) {
        alert(response);
      }
    })
  });
</script>