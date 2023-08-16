<style>
    .td-center {
        text-align: center;
    }
</style>
<div class="card card-secondary">
    <div class="card-header">
        <?php if (isset($judul)) { echo $judul; }  ?>
    </div>
    <div class="row card-body">
        <div class="col-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" onclick="showFormAddmodel()" data-bs-toggle="modal">
                Tambah Model
            </button>
        </div>
        <div class="col-lg-12 table-responsive mt-4">
            <table id="modelTable" class="table table-striped display" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                        foreach ($model as $key => $value) { ?>
                        <tr>
                            <td class="td-center"><?= $no++ ?></td>
                            <td><?= $value->nama ?></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm" onclick="remove(<?= $value->id ?>)">Hapus</button>
                                <button class="btn btn-warning btn-sm" onclick="showFormEditmodel(<?= $value->id ?>)">Edit</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>              
</div>

<!-- Modal form model-->
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="modelModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title form-model-title" id="exampleModalLabel1">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formmodel" action="<?= base_url('api/addmodel'); ?>" method="post" enctype="multipart/form-data">
                        <input hidden type="text" class="form-control" id="id" name="id">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-submit btn-primary" onclick="create()" style="display: none">Simpan</button>
                    <button type="button" class="btn btn-primary btn-update me-2" onclick="update()" style="display: none">Update</button>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- end modal form model  -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>

<script type="text/javascript">
    // var tbl_model;
    $(document).ready(function() {
        new DataTable('#modelTable');
        // loadDropify();
        // getKategori();
        $('.dropify').dropify();
    })

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

     function loadDropify() {
        $('.dropify').dropify({
            messages: {
                'default': 'Seret dan lepas file di sini atau klik',
                'replace': 'Seret dan lepas atau klik untuk mengganti',
                'remove':  'Hapus',
                'error':   'Ups, terjadi sesuatu yang salah.'
            },
            
            tpl: {
                wrap: '<div class="dropify-wrapper"></div>',
                loader: '<div class="dropify-loader"></div>',
                message: '<div class="dropify-message"><span class="file-icon" /> <p>{{ default }}</p></div>',
                preview: '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
                filename: '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
                clearButton: '<button type="button" class="dropify-clear">{{ remove }}</button>',
                errorLine: '<p class="dropify-error">{{ error }}</p>',
                errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
            },
            
        });
    }

    function getKategori() {
        $.ajax({
            type: "get",
            url: "<?= site_url('model/data-kategori') ?>",
            success: function(response) {
                $("#id_kategori").html("");
                $.each(response, function(index, value) {
                    $("#id_kategori").append(`
                        <option value="${value.id_kategori}">${value.nama_kategori}</option>
                    `);
                });
            }
        });
    }

    function showFormAddmodel() {
        $('#modelModal').modal('show');
        $('#formmodel')[0].reset();

        $('.form-model-title').html('Tambah model');
        $(".btn-update").css("display", "none");
        $(".btn-cancel").css("display", "none");
        $(".btn-submit").css("display", "block");
        $(".btn-close").css("display", "block");

        $('.box-foto').html(`
            <label>Gambar</label>
            <input type="file" id="foto" name="foto" class="dropify" data-allowed-file-extensions="jpg jpeg png">
            <input hidden type="text" id="noFoto" class="no-foto" name="no_foto">
        `);

        loadDropify();
        
        var dropifyEvent = $('.dropify').dropify({
            defaultFile: foto_url ,
            messages: {
                'default': 'Seret dan lepas file di sini atau klik',
                'replace': 'Seret dan lepas atau klik untuk mengganti',
                'remove':  'Hapus',
                'error':   'Ups, terjadi sesuatu yang salah.'
            },
            
            tpl: {
                wrap: '<div class="dropify-wrapper"></div>',
                loader: '<div class="dropify-loader"></div>',
                message: '<div class="dropify-message"><span class="file-icon" /> <p>{{ default }}</p></div>',
                preview: '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
                filename: '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
                clearButton: '<button type="button" class="dropify-clear">{{ remove }}</button>',
                errorLine: '<p class="dropify-error">{{ error }}</p>',
                errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
            },
            
        });
        
        dropifyEvent.on('dropify.beforeClear', function(event, element){
            $('.no-foto').val('no_foto');
        });
    }

    function create() {
        event.preventDefault();
        var formData = new FormData($('#formmodel')[0]);

        $.ajax({
            url: '<?= base_url("model/create"); ?>',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#modelModal').modal('hide');
                showAlertMessage(response.status, response.title, response.message);
                $('#formmodel')[0].reset();
                setTimeout(function() {
                    location.reload();
                }, 1500);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function showFormEditmodel(id) {
        // $('.box-foto').html("")
        $.ajax({
            type: "POST",
            url: "<?= site_url("model/getmodelById") ?>",
            data: { "id": id },
            success: function(response) {
                $('#modelModal').modal('show');
                $('.form-model-title').html('Edit model');
                
                $("#formmodel #id").val(response.id);
                $("#formmodel #nama").val(response.nama);
                $("#formmodel #foto").val(response.foto);

                $(".btn-submit").css("display", "none");
                $(".btn-close").css("display", "none");
                $(".btn-update").css("display", "block");
                $(".btn-cancel").css("display", "block");
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function update() {
        var formData = new FormData($('#formmodel')[0]);
        
        $.ajax({
            url: '<?= base_url("model/update"); ?>',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#modelModal').modal('hide');
                showAlertMessage(response.status, response.title, response.message);
                $('#formmodel')[0].reset();
                setTimeout(function() {
                    location.reload();
                }, 1500);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function remove(id) {
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: "Data tidak dapat dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Tidak',
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('model/remove'); ?>',
                type: 'POST',
                data: { "id": id },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        showAlertMessage(response.status, response.title, response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        showAlertMessage(response.status, response.title, response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while processing your request.');
                }
            });
          }
        })
    }

</script>