    <?= $this->extend('layout/MainLayout') ?>

    <?= $this->section('content') ?>
    <main>
        <div class="accounnt_header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-auto col-12 order-md-2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a class="text-nowrap" href="/"><i class="fa fa-home mr-2"></i>Beranda</a>
                                </li>
                                <li class="breadcrumb-item text-nowrap active" aria-current="page">Akun</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="order-md-1 text-center text-md-left col-lg col-12">
                        <h1 class="h3 mb-0">Akun Saya</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="accounnt_body">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-4 col-md-4 col-12">
                        <nav class="navbar navbar-expand-md mb-4 mb-lg-0 sidenav">
                            <!-- Menu -->
                            <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Sidebar Menu</a>
                            <!-- Button -->
                            <button class="navbar-toggler d-md-none rounded bg-primary text-light" type="button"
                                data-toggle="collapse" data-target="#sidenav" aria-controls="sidenav"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="ti-menu"></span>
                            </button>
                            <!-- Collapse navbar -->
                            <div class="collapse navbar-collapse" id="sidenav">
                                <div class="navbar-nav flex-column">
                                    <!-- List -->
                                    <div class="border-bottom">
                                        <div class="m-4">
                                            <div class="row no-gutters align-items-center">
                                                <?php 
                                                    $firstname = explode(" ", $user_login['firstname']);
                                                    $lastname = explode(" ", $user_login['lastname']);
                                                    $word = $firstname[0][0] . $lastname[0][0];
                                                ?>
                                                <div class="col-auto">
                                                    <div class="avater btn-soft-primary"><?= strtoupper($word) ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <h6 class="d-block font-weight-bold mb-0"><?= $user_login['firstname'] . " " . $user_login['lastname']; ?> </h6>
                                                    <small class="text-muted"><?= $user_login['email'] ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="<?= base_url('account'); ?>"><i class="fa fa-user"></i> Akun Saya</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('account/password'); ?>"><i class="fa fa-lock"></i>
                                                Password</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('account/address'); ?>"><i class="fa fa-address-book"></i>
                                                Alamat</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('account/orders'); ?>"><i class="fa fa-shopping-cart"></i>
                                                Pesanan Saya</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/logout"><i class="fa fa-sign-out"></i> Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="ml-0 ml-md-4">
                            <div class="d-none d-md-block">
                                <div class="row mb-md-5">
                                    <div class="col">
                                        <h5 class="mb-1 text-white">Detail Akun</h5>
                                        <p class="mb-0 text-white small">
                                            Anda memiliki kendali penuh untuk mengelola Akun Anda sendiri.
                                        </p>
                                    </div>
                                    <div class="col-auto">
                                        <a href="<?= base_url('account/password'); ?>" class="btn btn-primary btn-sm"> Ganti Password</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <form class="row align-items-end" method="post">
                                            <?= csrf_field() ?>
                                            <!-- First name -->
                                            <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label" for="firstname">Nama Depan <span class="text-danger">*</span></label>
                                                <input type="text" name="firstname" id="firstname" class="form-control" value="<?= $user_login['firstname'];?>" required>
                                            </div>
                                            <!-- Last name -->
                                            <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label" for="lastname">Nama Belakang <span class="text-danger">*</span></label>
                                                <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $user_login['lastname'];?>" required>
                                            </div>
                                            <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label" for="fname">Nomor HP <span class="text-danger">*</span></label>
                                                <input type="text" name="phone" id="phone" class="form-control" value="<?= $user_login['phone'];?>" required>
                                            </div>

                                            <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label" for="fname">Email <span class="text-danger">*</span></label>
                                                <input type="text" name="email" id="email" class="form-control" value="<?= $user_login['email'];?>" readonly required>
                                            </div>
                                            <div class="col-12 mb-3 text-lg-right">
                                                <button class="btn btn-primary" type="submit">
                                                    ubah data
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?= $this->endSection() ?>