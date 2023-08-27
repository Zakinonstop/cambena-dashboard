<div class="col-md-6">
    <div class="card mb-4">
    <h5 class="card-header">Order</h5>

    <hr class="m-0">
    <div class="card-body">
        <form id="formOrder" action="<?= base_url('api/addOrder'); ?>" method="post" enctype="multipart/form-data">
            <small class="text-light fw-semibold">Pilih Model</small> 
            <div class="mb-3"> 
                <select id="box-model" name="id_model" class="form-select">
                    <!-- <option>Default select</option> -->
                </select>
            </div>

            <small class="text-light fw-semibold">Pilih Jenis Pakaian</small> 
            <div class="mb-3"> 
                <select id="box-jenis_pakaian" name="id_jenis_pakaian" class="form-select">
                    <!-- <option>Default select</option> -->
                </select>
            </div>

            <small class="text-light fw-semibold">Pilih Jenis kain</small> 
            <div class="mb-3"> 
                <select id="box-jenis_kain" name="id_jenis_kain" class="form-select">
                    <!-- <option>Default select</option> -->
                </select>
            </div>

            <small class="text-light fw-semibold">Pilih Ukuran</small> 
            <div class="mb-3"> 
                <select id="box-ukuran" name="id_ukuran" class="form-select">
                    <!-- <option>Default select</option> -->
                </select>
            </div>

            <small class="text-light fw-semibold">Pilih Warna</small> 
            <div class="mb-3"> 
                <select id="box-warna" name="id_warna" class="form-select">
                    <!-- <option>Default select</option> -->
                </select>
            </div>

            <small class="text-light fw-semibold">Pilih Keterangan</small> 
            <div class="mb-3"> 
                <select id="box-keterangan" name="id_keterangan" class="form-select">
                    <!-- <option>Default select</option> -->
                </select>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-submit btn-primary" onclick="create()" style="display: block;">Pesan</button>
    </div>

    </div>
</div>

<script>
    $(document).ready(function() {
       getModel();
       getJenisPakaian();
       getJenisKain();
       getUkuran();
       getWarna();
       getKeterangan();
    })

    function getModel() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('api/getModel') ?>",
            dataType: "JSON",
            success: function(result) {
                    console.log(result);
                    $.each(result, function (index, value) {
                        $('#box-model').append(`
                            <option value="${value.id}">${value.nama}</option>
                        `)
                    })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });
    }

    function getJenisPakaian() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('api/getJenisPakaian') ?>",
            dataType: "JSON",
            success: function(result) {
                    console.log(result);
                    $.each(result, function (index, value) {
                        $('#box-jenis_pakaian').append(`
                            <option value="${value.id}">${value.nama}</option>
                        `)
                    })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });
    }

    function getJenisKain() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('api/getJenisKain') ?>",
            dataType: "JSON",
            success: function(result) {
                    console.log(result);
                    $.each(result, function (index, value) {
                        $('#box-jenis_kain').append(`
                            <option value="${value.id}">${value.nama}</option>
                        `)
                    })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });
    }

    function getUkuran() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('api/getUkuran') ?>",
            dataType: "JSON",
            success: function(result) {
                    console.log(result);
                    $.each(result, function (index, value) {
                        $('#box-ukuran').append(`
                            <option value="${value.id}">${value.nama}</option>
                        `)
                    })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });
    }

    function getWarna() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('api/getWarna') ?>",
            dataType: "JSON",
            success: function(result) {
                    console.log(result);
                    $.each(result, function (index, value) {
                        $('#box-warna').append(`
                            <option value="${value.id}">${value.nama}</option>
                        `)
                    })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });
    }

    function getKeterangan() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('api/getKeterangan') ?>",
            dataType: "JSON",
            success: function(result) {
                    console.log(result);
                    $.each(result, function (index, value) {
                        $('#box-keterangan').append(`
                            <option value="${value.id}">${value.nama}</option>
                        `)
                    })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });
    }

    function showAlertMessage(status, title, message) {
        Swal.fire({
          position: 'center',
          icon: status,
          title: title,
          text: message,
          showConfirmButton: false,
          timer: 1500
        });
    }

    function create() {
        event.preventDefault();
        var formData = new FormData($('#formOrder')[0]);

        $.ajax({
            url: '<?= base_url("order/create"); ?>',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#orderModal').modal('hide');
                showAlertMessage(response.status, response.title, response.message);
                $('#formOrder')[0].reset();
                setTimeout(function() {
                    location.reload();
                }, 1500);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>