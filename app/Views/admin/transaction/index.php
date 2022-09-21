        <?= $this->extend('admin/layout/MainLayout') ?>
        <?= $this->section('css') ?>
        <!-- DataTables -->
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <?= $this->endSection() ?>
        <?= $this->section('content') ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Transaksi</h1>
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="tblProduk" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Invoice</th>
                                                <th>Pembeli</th>
                                                <th>Status</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($invoice as $row) : ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $row['invoice_number']; ?></td>
                                                    <td><?= $row['firstname']; ?> <?= $row['lastname']; ?></td>
                                                    <td>
                                                        <?php if ($row['status'] == 'pending') : ?>
                                                            <span class="badge badge-warning">Menunggu Pembayaran</span>
                                                        <?php elseif ($row['status'] == 'dibayar') : ?>
                                                            <span class="badge badge-success">Pembayaran Diterima</span>
                                                        <?php elseif ($row['status'] == 'dikirim') : ?>
                                                            <span class="badge badge-info">Pesanan Dikirim</span>
                                                        <?php elseif ($row['status'] == 'delivered') : ?>
                                                            <span class="badge badge-primary">Pesanan Diterima</span>
                                                        <?php elseif ($row['status'] == 'cancel') : ?>
                                                            <span class="badge badge-danger">Pesanan Dibatalkan</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= date('d F Y', strtotime($row['created_at'])); ?></td>
                                                    <?php if($row['status'] == "pending"): ?>
                                                    <td>
                                                        Menunggu Pembayaran
                                                    </td>
                                                    <?php elseif($row['status'] == "cancel"): ?>
                                                    <td>
                                                        Pesanan dibatalkan
                                                    </td>
                                                    <?php else: ?>
                                                    <td>
                                                        <a href="<?= base_url("admin/transaction/process/" . $row['invoice_number']); ?>" class="btn btn-primary btn-md">
                                                            <i class="fas fa-edit"></i> Proses Pesanan
                                                        </a>
                                                    </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php
                                                $no++;
                                            endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>Invoice</th>
                                                <th>Pembeli</th>
                                                <th>Status</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <?= $this->endSection() ?>
        <?= $this->section('js') ?>
        <!-- DataTables  & Plugins -->
        <script src="<?= base_url(); ?>/assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>/assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>/assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>/assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>/assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url(); ?>/assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>/assets/admin/plugins/jszip/jszip.min.js"></script>
        <script src="<?= base_url(); ?>/assets/admin/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?= base_url(); ?>/assets/admin/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?= base_url(); ?>/assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url(); ?>/assets/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url(); ?>/assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- Page specific script -->
        <script>
            $(function() {
                $("#tblProduk").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print"]
                }).buttons().container().appendTo('#tblProduk_wrapper .col-md-6:eq(0)');
            });
        </script>
        <?= $this->endSection() ?>