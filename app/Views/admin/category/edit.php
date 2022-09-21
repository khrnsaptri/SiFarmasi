        <?= $this->extend('admin/layout/MainLayout') ?>

        <?= $this->section('content') ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Edit Kategori</h1>
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
                        if(!empty($errors)){ ?>
                        <div class="alert alert-danger" role="alert">
                            <ul>
                            <?php foreach ($errors as $errors) : ?>
                                <li><?= esc($errors) ?></li>
                            <?php endforeach ?>
                            </ul>
                        </div>
                        <?php
                        } 
                        if(!empty($error)){ ?>
                        <div class="alert alert-danger" role="alert">
                            <?= esc($error) ?><br />
                        </div>
                        <?php } 
                        if(!empty($success)){?>
                        <div class="alert alert-success" role="alert">
                            <?= esc($success) ?><br />
                        </div>
                        <?php } ?>
                    <!-- Main row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Data Kategori</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" enctype="multipart/form-data">
                                    <?= csrf_field() ?>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="name">Nama Kategori <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" <?php if(isset($inputs['name'])){ echo "value='".$inputs['name']."'"; } else if(isset($data)){ echo "value='".$data['name']."'"; }?> required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="image">Gambar</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="image" name="image">
                                                        <label class="custom-file-label" for="image">Pilih Gambar</label>
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
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <?= $this->endSection() ?>
        <?= $this->section('js') ?>
        <!-- bs-custom-file-input -->
        <script src="<?= base_url(); ?>/assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <script>
            $(document).ready(function () {
                bsCustomFileInput.init();
            });
        </script>
        <?= $this->endSection() ?>