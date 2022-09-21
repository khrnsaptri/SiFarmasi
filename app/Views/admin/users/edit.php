        <?= $this->extend('admin/layout/MainLayout') ?>

        <?= $this->section('content') ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Ubah Pengguna</h1>
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
                                    <h3 class="card-title">Form Data Pengguna</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" enctype="multipart/form-data">
                                    <?= csrf_field() ?>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="firstname">Nama Depan <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Nama Depan" <?php if(isset($inputs['firstname'])){ echo "value='".$inputs['firstname']."'"; } else if(isset($dataUser)){ echo "value='".$dataUser['firstname']."'"; }?> required>
                                                </div>
                                                <div class="col-lg-6">
                                                <label for="lastname">Nama Belakang <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nama Belakang" <?php if(isset($inputs['lastname'])){ echo "value='".$inputs['lastname']."'"; } else if(isset($dataUser)){ echo "value='".$dataUser['lastname']."'"; }?> required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label for="email">Email <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" <?php if(isset($inputs['email'])){ echo "value='".$inputs['email']."'"; } else if(isset($dataUser)){ echo "value='".$dataUser['email']."'"; }?> required readonly>
                                                </div>
                                                <div class="col-lg-4">
                                                <label for="phone">No. HP <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="No HP" <?php if(isset($inputs['phone'])){ echo "value='".$inputs['phone']."'"; } else if(isset($dataUser)){ echo "value='".$dataUser['phone']."'"; }?> required readonly>
                                                </div>
                                                <div class="col-lg-4">
                                                <label for="status">Status <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="">Pilih Status</option>
                                                        <option value="active" <?php if(isset($inputs['status']) && $inputs['status'] == "active"){ echo "selected"; } else if(isset($dataUser) && $dataUser['status'] == "active"){ echo "selected"; }?>>Aktif</option>
                                                        <option value="blocked" <?php if(isset($inputs['status']) && $inputs['status'] == "blocked"){ echo "selected"; } else if(isset($dataUser) && $dataUser['status'] == "blocked"){ echo "selected"; }?>>Blokir</option>
                                                    </select>
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