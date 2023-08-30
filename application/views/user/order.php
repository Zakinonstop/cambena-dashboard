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

            <h6>Pengiriman</h6>
            <small class="text-light fw-semibold">Provinsi</small> 
            <div class="mb-3"> 
                <select id="box-provinsi" name="id_provinsi" class="form-select">
                    <option>-- Pilih Provinsi --</option>
                </select>
            </div>

            <small class="text-light fw-semibold">Kota/Kabupaten</small> 
            <div class="mb-3"> 
                <select id="box-kota" name="id_kota" class="form-select">
                    <option>-- Pilih Kota/Kabupaten --</option>
                </select>
            </div>

            <small class="text-light fw-semibold">Kurir</small> 
            <div class="mb-3"> 
                <select id="box-kurir" name="id_kurir" class="form-select">
                    <option>-- Pilih Kurir --</option>
                    <option value="jne">JNE</option>
                    <option value="pos">POS</option>
                    <option value="tiki">Tiki</option>
                </select>
            </div>

            <small class="text-light fw-semibold">Berat</small> 
            <div class="mb-3"> 
                <div class="input-group input-group-merge">
                    <input type="text" class="form-control" name="berat" id="berat" value="1000">
                </div>
            </div>
            
            <small class="text-light fw-semibold">Ongkir</small> 
            <div class="mb-3"> 
                <div class="input-group input-group-merge">
                    <p id="box-ongkir">1200</p>
                </div>
            </div>

            <div class="box-hidden">
                <input type="text" class="form-control" name="destination_id" id="destination_id">
                <input type="text" class="form-control" name="kurir" id="kurir">
                <input type="text" class="form-control hidden-berat" name="berat" id="berat">
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
       getProvinsi();
    //    getKota();

       $('#box-kurir').on('change', function () {
            var kurir = this.value;
            // getOngkir(kurir);
            $('#kurir').val(kurir);
        } )

       $('#berat').on('keyup', function () {
            var berat = this.value;
            $('.hidden-berat').val(berat);
            var destination = $('#destination_id').val();
            var kurir = $('#kurir').val();
            getOngkir(destination, kurir, berat);
        } )

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

    function getProvinsi() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('api/getProvinsi')?>",
            dataType: "JSON",
            success: function(result) {
                    console.log(result);
                    $.each(result.rajaongkir.results, function (index, value) {
                        $('#box-provinsi').append(`
                            <option value="${value.province_id}">${value.province}</option>
                        `)
                    })

                    $('#box-provinsi').on('change', function () {
                        var province_id = this.value;
                        var prov = parseInt(province_id);
                        getKota(prov);
                    } )

            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });
    }

    function getKota(province_id) {
        $.ajax({
            type: "post",
            url: "<?= base_url('api/getKota/')?>",
            dataType: "JSON",
            data: {province_id: province_id},

            success: function(result) {
                    console.log(result);
                    $('#box-kota').html('')
                    $.each(result.rajaongkir.results, function (index, value) {
                        $('#box-kota').append(`
                            <option value="${value.city_id}">${value.city_name}</option>
                        `)
                    })

                     $('#box-kota').on('change', function () {
                        var kota = this.value;
                        var destination_id = parseInt(kota);
                        // getOngkir(destination_id);
                        $('#destination_id').val(destination_id);
                    } )
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });
    }

    function getOngkir(destination_id, kurir, berat) {
        $.ajax({
            type: "post",
            url: "<?= base_url('api/getOngkir')?>",
            dataType: "JSON",
            data: {destination_id: destination_id,
                    berat: berat,
                    kurir: kurir,
            },
            success: function(result) {
                    console.log(result);
                    $('#box-ongkir').html('muncul')
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