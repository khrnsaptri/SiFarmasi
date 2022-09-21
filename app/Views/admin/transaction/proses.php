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
                    <h1 class="m-0">Proses Pesanan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
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
            <div class="card-header">
                <h3 class="card-title">Detail Transaksi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Subtotal</span>
                                        <span class="info-box-number text-center text-muted mb-0"><?= "Rp " . number_format($subtotal,0,',','.')?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">PPN (10%)</span>
                                        <span class="info-box-number text-center text-muted mb-0"><?= "Rp " . number_format($ppn,0,',','.')?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Ongkos Kirim</span>
                                        <span class="info-box-number text-center text-muted mb-0"><?= "Rp " . number_format($ongkir,0,',','.')?> (<?= $dataInvoice['courier'] ?>)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4>Barang yang dipesan</h4>
                                <?php foreach($dataTrx as $trx): 
                                $img = unserialize($trx['image']); ?>
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="<?= base_url('assets/uploads/images/'.$img[0]); ?>" alt="user image">
                                        <span class="username">
                                            <a href="<?= base_url("product/detail/".$trx['ProdukID']) ?>" target="_blank"><?= $trx['name']; ?></a>
                                        </span>
                                        <!-- <span class="description">Shared publicly - 7:45 PM today</span> -->
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Harga produk : <?= $trx['price']; ?><br>
                                        Jumlah pesanan : <?= $trx['qty']; ?><br>
                                        Subtotal : <?= $trx['price']*$trx['qty']; ?><br>
                                    </p>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary"><i class="fas fa-home"></i> Alamat Pengiriman</h3>
                        <p class="text-muted"><?= $dataInvoice['address']; ?><?php if($dataInvoice['apt'] != "") { echo " (".$dataInvoice['apt'].")"; } ?>, <?= $dataInvoice['city']; ?>, <?= $dataInvoice['state']; ?> - <?= $dataInvoice['zipcode']; ?></p>
                        <br>

                        <h5 class="mt-5 text-muted">Update Pesanan</h5>
                        <form method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="waybill">Nomor Resi <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="waybill" name="waybill" placeholder="Masukkan Nomor Resi" <?php if(isset($inputs['name'])){ echo "value='".$inputs['name']."'"; }?> required>
                                        </div>
                                    </div>
                                </div>
                            <!-- /.card-body -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>