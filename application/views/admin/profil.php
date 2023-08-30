<style>
    .td-center {
        text-align: center;
    }
</style>

<div class="row">
    <!-- <div class="col-lg-4 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                    <p class="mb-4">
                    You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                    your profile.
                    </p>

                    <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="col-md-4 col-lg-4">
        <h6 class="mt-2 text-muted">Images</h6>
        <div class="card mb-4">
        <img class="card-img-top" src="../assets/img/elements/5.jpg" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the card's content.
            </p>
            <p class="card-text">
            Cookie topping caramels jujubes gingerbread. Lollipop apple pie cupcake candy canes cookie ice
            cream. Wafer chocolate bar carrot cake jelly-o.
            </p>
        </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-8 order-1">
        <div class="card card-secondary">
            <div class="card-header">
                <?php if (isset($judul)) { echo $judul; }  ?>
            </div>


            <div class="row card-body">
                <div class="col-12">
                    <!-- <button class="btn btn-success" onclick="showFormAddprofil()">Tambah profil</button> -->
                </div>

                <div class="col-lg-12 table-responsive mt-4">
                    <table id="profilTable" class="table table-striped display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th>No. Hp</th>
                                <th>Alamat</th>
                                <!-- <th>Foto</th> -->
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                                foreach ($profil as $key => $value) { ?>
                                <tr>
                                    <td class="td-center"><?= $no++ ?></td>
                                    <td><?= $value->nama ?></td>
                                    <td><?= $value->no_hp ?></td>
                                    <td><?= $value->alamat ?></td>
                                    <!-- <td><?= $value->foto ?></td> -->
                                    <td class="text-center">
                                        <!-- <button class="btn btn-danger btn-sm" onclick="remove(<?= $value->id ?>)">Hapus</button> -->
                                        <button class="btn btn-warning btn-sm" onclick="showFormEditprofil(<?= $value->id ?>)">Edit</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>              
        </div>
    </div>
</div>



<!-- Modal form profil-->
    <!-- <div class="modal fade" id="profilModal" tabindex="-1" role="dialog" aria-labelledby="profilModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title form-profil-title" id="profilModalLabel">Tambah profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="formProfil" action="<?= base_url('api/addprofil'); ?>" method="post" enctype="multipart/form-data">
                    <input hidden type="text" class="form-control" id="id" name="id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="noHp">No.Hp</label>
                                <input type="text" class="form-control" id="noHp" name="no_hp">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat">
                            </div>
                            <div class="form-group">
                                <label for="foto">foto</label>
                                <input type="text" class="form-control" id="foto" name="foto">
                            </div>
                            <div class="col-md-12 box-foto">
                                <label>Gambar</label>
                                <input type="file" id="foto" name="foto" class="dropify" data-allowed-file-extensions="jpg jpeg png">
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-primary btn-submit me-2" onclick="create()">Submit</button>
                        <button type="button" class="btn btn-primary btn-update me-2" onclick="update()" style="display: none">Update</button>
                        <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal" style="display: none">Cancel</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div> -->
<!-- end modal form profil  -->

<!-- Modal form jenisKain-->
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="profilModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title form-profil-title" id="exampleModalLabel1">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formProfil" action="<?= base_url('api/addprofil'); ?>" method="post" enctype="multipart/form-data">
                         <input hidden type="text" class="form-control" id="id" name="id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="noHp">No.Hp</label>
                                <input type="text" class="form-control" id="noHp" name="no_hp">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat">
                            </div>
                            <div class="col-md-12 box-foto">
                                <label>Gambar</label>
                                <input type="file" id="foto" name="foto" class="dropify" data-allowed-file-extensions="jpg jpeg png">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-submit btn-primary" onclick="create()" style="display: none">Simpan</button>
                    <button type="button" class="btn btn-primary btn-update me-2" onclick="update()" style="display: block">Update</button>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- end modal form jenisKain  -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>

<script type="text/javascript">
    // var tbl_profil;
    $(document).ready(function() {
        new DataTable('#profilTable');
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
            url: "<?= site_url('profil/data-kategori') ?>",
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

    function showFormAddprofil() {
        $('#profilModal').modal('show');
        $('#formProfil')[0].reset();

        $('.form-profil-title').html('Tambah profil');
        $("#formProfil .btn-update").css("display", "none");
        $("#formProfil .btn-cancel").css("display", "none");
        $("#formProfil .btn-submit").css("display", "block");
        $("#formProfil .btn-close").css("display", "block");

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
        var formData = new FormData($('#formProfil')[0]);

        $.ajax({
            url: '<?= base_url("profil/create"); ?>',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#profilModal').modal('hide');
                showAlertMessage(response.status, response.title, response.message);
                $('#formProfil')[0].reset();
                setTimeout(function() {
                    location.reload();
                }, 1500);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function showFormEditprofil(id) {
        // $('.box-foto').html("")
        $.ajax({
            type: "POST",
            url: "<?= site_url("profil/getprofilById") ?>",
            data: { "id": id },
            success: function(response) {
                $('#profilModal').modal('show');
                $('.form-profil-title').html('Edit profil');
                
                $("#formProfil #id").val(response.id);
                $("#formProfil #nama").val(response.nama);
                $("#formProfil #alamat").val(response.alamat);
                $("#formProfil #noHp").val(response.no_hp);
                $("#formProfil #foto").val(response.foto);

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
        var formData = new FormData($('#formProfil')[0]);
        
        $.ajax({
            url: '<?= base_url("profil/update"); ?>',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#profilModal').modal('hide');
                showAlertMessage(response.status, response.title, response.message);
                $('#formProfil')[0].reset();
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
                url: '<?= base_url('profil/remove'); ?>',
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