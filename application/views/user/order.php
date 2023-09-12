<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
        <h5 class="card-header">Order</h5>
    
        <!-- <form id="payment-form" method="post" action="<?=site_url()?>/snap/finish">
            <input type="hidden" name="result_type" id="result-type" value=""></div>
            <input type="hidden" name="result_data" id="result-data" value=""></div>
        </form> -->

        <hr class="m-0">
        <div class="card-body">
            <form id="formOrder" action="<?= base_url('api/addOrder'); ?>" method="post" enctype="multipart/form-data">
                <input type="text" name="id_pemesan" style="display: none" value="<?= $this->session->userdata['id'];?>">
                <small class="text-light fw-semibold">Pilih Model</small> 
                <div class="mb-3"> 
                    <select id="box-model" name="id_model" class="form-select">
                        <option>-- Pilih Model --</option>
                    </select>
                </div>
    
                <small class="text-light fw-semibold">Pilih Jenis kain</small> 
                <div class="mb-3"> 
                    <select id="box-jenis_kain" name="id_jenis_kain" class="form-select">
                        <option>-- Pilih Jenis Kain --</option>
                    </select>
                </div>
    
                <small class="text-light fw-semibold">Pilih Jenis Pakaian</small> 
                <div class="mb-3"> 
                    <select id="box-jenis_pakaian" name="id_jenis_pakaian" class="form-select">
                        <option>-- Pilih Jenis Pakaian --</option>
                    </select>
                </div>
    
                <small class="text-light fw-semibold">Pilih Ukuran</small> 
                <div class="mb-3"> 
                    <select id="box-ukuran" name="id_ukuran" class="form-select">
                        <option>-- Pilih Ukuran --</option>
                    </select>
                </div>
    
                <small class="text-light fw-semibold">Jumlah</small> 
                <div class="mb-3"> 
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" name="jumlah" id="jumlah">
                    </div>
                </div>
    
                <small class="text-light fw-semibold">Pilih Warna</small> 
                <div class="mb-3"> 
                    <select id="box-warna" name="id_warna" class="form-select">
                        <option>-- Pilih Warna --</option>
                    </select>
                </div>
    
                <small class="text-light fw-semibold">Pilih Keterangan</small> 
                <div class="mb-3"> 
                    <select id="box-keterangan" name="id_keterangan" class="form-select">
                        <option>-- Pilih Keterangan --</option>
                    </select>
                </div>
    
                <h6>Pengiriman</h6>
                <small class="text-light fw-semibold">Provinsi</small> 
                <div class="mb-3"> 
                    <select id="box-provinsi" name="provinsi" class="form-select">
                        <option>-- Pilih Provinsi --</option>
                    </select>
                </div>
    
                <small class="text-light fw-semibold">Kota/Kabupaten</small> 
                <div class="mb-3"> 
                    <select id="box-kota" name="kota" class="form-select">
                        <option>-- Pilih Kota/Kabupaten --</option>
                    </select>
                </div>
    
                <small class="text-light fw-semibold">Kurir</small> 
                <div class="mb-3"> 
                    <select id="box-kurir" name="kurir" class="form-select">
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
                        <select id="box-ongkir" name="ongkir" class="form-select">
                            
                        </select>
                    </div>
                </div>
    
                <div class="box-hidden">
                    <input type="hidden" class="form-control" name="destination_id" id="destination_id">
                    <input type="hidden" class="form-control" name="kurir" id="kurir">
                    <input type="hidden" class="form-control hidden-berat" name="berat" id="berat">
    
                    <input type="text" class="form-control" name="hidden_provinsi" id="hidden_provinsi" style="display: none;">
                    <input type="text" class="form-control" name="hidden_kota" id="hidden_kota" style="display: none;">
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-submit btn-primary" onclick="create()" style="display: block;">Pesan</button>
        </div>
    
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
        <h5 class="card-header">Keranjang</h5>
    
        <hr class="m-0">
        <div class="card-body">
              <div class="col-lg-12 table-responsive mt-4">
            <table id="pesananTable" class="table table-striped display" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Kode</th>
                        <th>Model</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                        foreach ($list_order as $key => $value) { ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $value->no_nota ?></td>
                                <td><?= $value->id_jenis_pakaian ?></td>
                                <td><?= $value->jumlah ?></td>
                                <td><?= $value->harga ?></td>
                            </tr>
                        <?php $no++; }
                    ?>
                    <tr>
                        <td colspan="2" class="text-center fw-bold">Total</td>
                        <td></td>
                        <td></td>
                        <td class="fw-bold"><?= $total_harga->total_harga ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        </div>
        <div class="card-footer">
            <button type="button" id="pay-button" class="btn btn-submit btn-primary" style="display: block;">Bayar</button>
        </div>
    
        </div>
    </div>
</div>

<script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-xrRHzYOegThRMFAM"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
                            <option value="${value.province_id}" data-provinsi="${value.province}">${value.province}</option>
                        `)
                    })

                    $('#box-provinsi').on('change', function () {
                        var province_id = this.value;
                        var prov = parseInt(province_id);
                        getKota(prov);
                        
                        var data_provinsi = $(this).find(':selected').data("provinsi");
                        $('#hidden_provinsi').val(data_provinsi)
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
                            <option value="${value.city_id}" data-kota="${value.city_name}">${value.city_name}</option>
                        `)
                    })

                     $('#box-kota').on('change', function () {
                        var kota = this.value;
                        var destination_id = parseInt(kota);
                        // getOngkir(destination_id);
                        $('#destination_id').val(destination_id);
                        
                        var data_kota = $(this).find(':selected').data("kota");
                        $('#hidden_kota').val(data_kota);
                    } )
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });
    }

    function getOngkir(destination_id, kurir, berat) {
        $('#box-ongkir').html('');
        $.ajax({
            type: "post",
            url: "<?= base_url('api/getOngkir')?>",
            dataType: "JSON",
            data: {destination_id: destination_id,
                    berat: berat,
                    kurir: kurir,
            },
            success: function(result) {
                    console.log(result.rajaongkir.results[0].costs);

                    $.each(result.rajaongkir.results[0].costs, function (index, value) {
                        $('#box-ongkir').append(`
                            <option value="${value.cost[0].value}">${value.description} - ${value.cost[0].value}</option>
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
        console.log(formData);

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

     $('#pay-button').click(function (event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
    
        $.ajax({
        url: '<?=base_url()?>/snap/token',
        type: "POST",
        data: {
            'total': 200000,
        },
        cache: false,

        success: function(data) {
            //location = data;

            console.log('token = '+data);
            
            var resultType = document.getElementById('result-type');
            var resultData = document.getElementById('result-data');

            function changeResult(type,data){
            $("#result-type").val(type);
            $("#result-data").val(JSON.stringify(data));
            //resultType.innerHTML = type;
            //resultData.innerHTML = JSON.stringify(data);
            }

            snap.pay(data, {
            
            onSuccess: function(result){
                changeResult('success', result);
                console.log(result.status_message);
                console.log(result);
                $("#payment-form").submit();
            },
            onPending: function(result){
                changeResult('pending', result);
                console.log(result.status_message);
                $("#payment-form").submit();
            },
            onError: function(result){
                changeResult('error', result);
                console.log(result.status_message);
                $("#payment-form").submit();
            }
            });
        }
        });
    });
</script>
