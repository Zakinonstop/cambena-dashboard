<div class="row">
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
                        <th>Order ID</th>
                        <th>Bank</th>
                        <th>Va Number</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <p></p>
                    <?php 
                    $no = 1;
                        foreach ($midtrans as $key => $value) { ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $value->order_id ?></td>
                                <td><?= $value->bank ?></td>
                                <td><?= $value->va_number?></td>
                                <td><span class="badge bg-warning text-dark"><?= $value->transaction_status ?></span></td>
                                <td><?= $value->gross_amount ?></td>
                            </tr>
                        <?php $no++; }
                    ?>
                </tbody>
            </table>
        </div>
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
        var total = $('.total-hidden').val();
        var nama = $('.nama-hidden').val();
        var no_hp = $('.no_hp-hidden').val();

        $.ajax({
        url: '<?=base_url()?>/snap/token',
        type: "POST",
        data: {
            'total': total,
            'nama': nama,
            'no_hp': no_hp,
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
