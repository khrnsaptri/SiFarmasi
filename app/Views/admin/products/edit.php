<?= $this->extend('admin/layout/MainLayout') ?>

<?= $this->section('css') ?>
<!-- summernote -->
<link rel="stylesheet" href="<?= base_url(); ?>/assets/admin/plugins/summernote/summernote-bs4.min.css">
<!-- DropZone -->
<link rel="stylesheet" href="<?= base_url(); ?>/assets/admin/plugins/dropzone/min/dropzone.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Produk</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php
            $inputs = session()->getFlashdata('inputs');
            $errors = session()->getFlashdata('errors');
            $error = session()->getFlashdata('error');
            $success = session()->getFlashdata('success');
            if (!empty($errors)) { ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ($errors as $errors) : ?>
                            <li><?= esc($errors) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php
            }
            if (!empty($error)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= esc($error) ?><br />
                </div>
            <?php }
            if (!empty($success)) { ?>
                <div class="alert alert-success" role="alert">
                    <?= esc($success) ?><br />
                </div>
            <?php } ?>
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Data Produk</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" class="txt_sifarmasi_token" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                            <input type="hidden" class="txt_id_product" name="id_product" value="<?= $data['id'] ?>" />
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Nama Produk <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Produk" <?php if(isset($inputs['name'])){ echo "value='".$inputs['name']."'"; } else if(isset($data)){ echo "value='".$data['name']."'"; } ?> required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="price">Harga <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Masukkan Harga" <?php if (isset($inputs['price'])) { echo "value='" . $inputs['price'] . "'"; } else if(isset($data)){ echo "value='".$data['price']."'"; } ?> required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="weight">Berat (gram) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="weight" name="weight" placeholder="Berat Barang" <?php if (isset($inputs['weight'])) { echo "value='" . $inputs['weight'] . "'"; } else if(isset($data)){ echo "value='".$data['weight']."'"; } ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="category_id">Kategori <span class="text-danger">*</span></label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Pilih Kategori</option>
                                                <?php foreach ($categories as $category) : ?>
                                                    <option value="<?= $category['id'] ?>" <?php if (isset($inputs['category_id']) && $inputs['category_id'] == $category['id']) { echo "selected"; } else if (isset($data['category_id']) && $data['category_id'] == $category['id']) { echo "selected"; } ?>><?= $category['name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="stock">Stok <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="stock" name="stock" placeholder="Jumlah Barang" <?php if (isset($inputs['stock'])) { echo "value='" . $inputs['stock'] . "'"; } else if(isset($data)){ echo "value='".$data['stock']."'"; } ?> required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi <span class="text-danger">*</span></label>
                                    <textarea id="description" name="description">
                                        <?php if (isset($inputs['description'])) { echo $inputs['description']; } else if(isset($data)){ echo $data['description']; } ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="additional_information">Informasi Tambahan</label>
                                    <textarea id="additional_information" name="additional_information">
                                        <?php if (isset($inputs['additional_information'])) { echo $inputs['additional_information']; } else if(isset($data)){ echo $data['additional_information']; } ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="gambar">Gambar <span class="text-danger">*</span></label>
                                    <div>
                                        <div class="filter-container p-0 row" id="getPhoto">

                                        </div>
                                    </div>
                                    <div id="actions" class="row">
                                        <div class="col-lg-6">
                                            <div class="btn-group w-100">
                                                <span class="btn btn-success col fileinput-button">
                                                    <i class="fas fa-plus"></i>
                                                    <span>Tambah</span>
                                                </span>
                                                <!-- <button type="submit" class="btn btn-primary col start">
                                                    <i class="fas fa-upload"></i>
                                                    <span>Upload</span>
                                                </button>
                                                <button type="reset" class="btn btn-warning col cancel">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span>Batalkan</span>
                                                </button> -->
                                            </div>
                                        </div>
                                        <div class="col-lg-6 d-flex align-items-center">
                                            <div class="fileupload-process w-100">
                                                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table table-striped files" id="previews">
                                        <div id="template" class="row mt-2">
                                            <div class="col-auto">
                                                <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                            </div>
                                            <div class="col d-flex align-items-center">
                                                <p class="mb-0">
                                                    <span class="lead" data-dz-name></span>
                                                    (<span data-dz-size></span>)
                                                </p>
                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                            </div>
                                            <div class="col-4 d-flex align-items-center">
                                                <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-primary start">
                                                        <i class="fas fa-upload"></i>
                                                        <span>Mulai</span>
                                                    </button>
                                                    <!-- <button data-dz-remove class="btn btn-warning cancel">
                                                        <i class="fas fa-times-circle"></i>
                                                        <span>Batalkan</span>
                                                    </button>
                                                    <button data-dz-remove class="btn btn-danger delete">
                                                        <i class="fas fa-trash"></i>
                                                        <span>Hapus</span> -->
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
            <!-- Modal -->
            <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="photoModalLabel">Ubah Gambar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="showPhoto" align="center"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-danger btn-delete">Hapus Gambar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- bs-custom-file-input -->
<script src="<?= base_url(); ?>/assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url(); ?>/assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- DropZone -->
<script src="<?= base_url(); ?>/assets/admin/plugins/dropzone/min/dropzone.min.js"></script>
<!-- Ekko Lightbox -->
<script src="<?= base_url(); ?>/assets/admin/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Filterizr-->
<script src="<?= base_url(); ?>/assets/admin/plugins/filterizr/jquery.filterizr.min.js"></script>
<script>
    var csrfName = $('.txt_sifarmasi_token').attr('name'); // CSRF Token name
    var csrfHash = $('.txt_sifarmasi_token').val(); // CSRF hash
    var idProduct = $('.txt_id_product').val(); // ID Barang
    //Refresh Token CSRF
    function refreshToken(){
        $.ajax({
            url: '<?= base_url('data/refreshToken'); ?>',
            type: 'get',
            success: function(data) {
                // Update CSRF hash
                $('.txt_sifarmasi_token').val(data);

                getToken();
            }
        });
    }

    //Fungsi Ambil Token Terbaru
    function getToken(){
        csrfName = $('.txt_sifarmasi_token').attr('name'); // CSRF Token name
        csrfHash = $('.txt_sifarmasi_token').val(); // CSRF hash
    }

    var rupiah = document.getElementById('price');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value);
    });

    $(document).ready(function() {
        // Custom File Input
        bsCustomFileInput.init();

        // Format Rupiah
        rupiah.value = formatRupiah(rupiah.value);

        // Ambil Foto
        getPhoto(idProduct);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }

    // Summernote
    $('#description').summernote({
        placeholder: 'Masukkan Deskripsi Produk',
        tabsize: 2,
        height: 300
    });
    $('#additional_information').summernote({
        placeholder: 'Masukkan Informasi Tambahan (Jika Ada)',
        tabsize: 2,
        height: 300
    });

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        const link = $(this).data('link');
        const name = $(this).data('filename');
        var data = "<img src="+link+" width='50%;' /> <input type='hidden' class='txt_name' value='"+name+"' />";
        $('#showPhoto').html(data);
        // Call Modal Photo Modal
        $('#photoModal').modal('show');
    });

    $('.btn-delete').on('click',function(){
        // get data from button delete
        var name = $('.txt_name').val(); // Nama foto
        // Set data to delete photo
        $.ajax({
            url: '<?= base_url('admin/products/deletePhoto'); ?>',
            type: 'post',
            data: {
                name: name,
                id: idProduct,
                [csrfName]: csrfHash
            },
            complete:function() {
                // Update CSRF hash
                refreshToken()							
            },
            success: function(data) {
                // Update CSRF hash
                // refreshToken()

                // Show Data
                getPhoto(idProduct);
                $('#photoModal').modal('hide');
            }
        });
    });

    //Ambil Foto Barang
    function getPhoto(id) {
        $.ajax({
            url: '<?= base_url(); ?>/admin/products/getPhoto/'+id,
            type: 'get',
            success: function(data) {
                // Update CSRF hash
                refreshToken()

                // Show Data
                $('#getPhoto').html(data);
            }
        });
    }

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "<?= base_url("admin/products/upload_image"); ?>", // Set the url
        sending: function (file, xhr, formData) {
            formData.append(csrfName, csrfHash); // Add the CSRF token
            refreshToken();
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp", // Set mime types
        maxFilesize: 10, // MB
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: true, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })

    myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function() {
            myDropzone.enqueueFile(file)
        }
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0"
        refreshToken()
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
</script>
<?= $this->endSection() ?>