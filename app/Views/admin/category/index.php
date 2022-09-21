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
                            <h1 class="m-0">Data Kategori</h1>
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
                                    <table id="tblCategory" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama</th>
                                                <th>Gambar</th>
                                                <th>Slug</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($category_listing as $row) : ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $row['name']; ?></td>
                                                    <td><img src="<?= base_url("assets/uploads/category/".$row['image']); ?>" alt="" width="150px" height="120px"></td>
                                                    <td><?= $row['slug']; ?></td>
                                                    <td>
                                                        <a href="<?= base_url("admin/category/edit/" . $row['id']); ?>" class="btn btn-primary btn-md">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="<?= base_url("admin/category/delete/" . $row['id']); ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-md">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                                $no++;
                                            endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama</th>
                                                <th>Gambar</th>
                                                <th>Slug</th>
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
                $("#tblCategory").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": [{
                        text: 'Tambah',
                        action: function ( e, dt, node, config ) {
                            window.location.href = "<?= base_url("admin/category/add"); ?>";
                        }
                    }, "copy", "csv", "excel", "pdf", "print"]
                }).buttons().container().appendTo('#tblCategory_wrapper .col-md-6:eq(0)');
            });
        </script>
        <?= $this->endSection() ?>