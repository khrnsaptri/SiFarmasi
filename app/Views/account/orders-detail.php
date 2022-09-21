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
                                <li class="breadcrumb-item">
                                    <a class="text-nowrap" href="<?= base_url('account'); ?> "></i>Akun</a>
                                </li>
                                <li class="breadcrumb-item text-nowrap active" aria-current="page">Pesanan Saya</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="order-md-1 text-center text-md-left col-lg col-12">
                        <h1 class="h3 mb-0">Pesanan Saya</h1>
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
                            <button class="navbar-toggler d-md-none rounded bg-primary text-light" type="button" data-toggle="collapse" data-target="#sidenav" aria-controls="sidenav" aria-expanded="false" aria-label="Toggle navigation">
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
                                        <li class="nav-item">
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
                                        <li class="nav-item active">
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
                                    <h5 class="mb-1 text-white">Pesanan Saya</h5>
                                    <p class="mb-0 text-white small">
                                        Anda dapat melihat histori pesanan Anda di sini.
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <a href="<?= base_url('account/orders'); ?>" class="btn btn-primary btn-sm"> <i class="ti-angle-left"></i> kembali</a>
                                </div>
                            </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="cart_product border-0">
                                        <?php foreach($transaction as $t) : 
                                        $img = unserialize($t['image']); ?>
                                        <div class="cart_item px-0">
                                            <div class="cart_item_image">
                                                <img src="<?= base_url('assets/uploads/images/'.$img[0]); ?>" alt="shop">
                                            </div>
                                            <div class="c-item-body">
                                                <div class="cart_item_title mb-2">
                                                    <h4><?= $t['name']; ?></h4>
                                                    <!-- <p class="small mb-0 text-muted">bottle of 60 capsules</p> -->
                                                </div>
                                                <div class="cart_item_price">
                                                    <div class="product-price">
                                                        <span>
                                                            <strong><?= "Rp " . number_format($t["price"],0,',','.')?> x <?= $t['qty'] ?></strong>
                                                            <!-- <del>₹1,000</del>
                                                            <small class="product-discountPercentage">(50% OFF)</small> -->
                                                        </span>
                                                    </div>
                                                    <!-- <div class="cart_product_remove">
                                                        <a href="#"><i class="ti-truck"></i> Return Item</a>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="border p-3 mb-4">
                                                <h5 class="details">Order Info</h5>
                                                <div class="row no-gutters">
                                                    <div class="col-auto">
                                                        <i class="ti-map-alt text-secondary mr-2"></i>
                                                    </div>
                                                    <div class="col">
                                                        <p class="text-muted small mb-2"> <strong>Alamat Pengiriman:</strong> <?= $address['address']; ?><?php if($address['apt'] != "") { echo " (".$address['apt'].")"; } ?>, <?= $address['city']; ?>, <?= $address['state']; ?> - <?= $address['zipcode']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row no-gutters">
                                                    <div class="col-auto">
                                                        <i class="ti-mobile text-secondary mr-2"></i>
                                                    </div>
                                                    <div class="col">
                                                        <p class="text-muted small mb-0"><strong>Nomor HP:</strong> <?= $address['phone']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row no-gutters">
                                                    <div class="col-auto">
                                                        <i class="ti-credit-card text-secondary mr-2"></i>
                                                    </div>
                                                    <div class="col">
                                                        <p class="text-muted small mb-2"><strong>Tipe Pembayaran:</strong> <?= $invoice['payment_type']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row no-gutters">
                                                    <div class="col-auto">
                                                        <i class="ti-calendar text-secondary mr-2"></i>
                                                    </div>
                                                    <div class="col">
                                                        <p class="text-muted small mb-2"><strong>Pesanan diterima:</strong> <?= date('d F Y', strtotime($invoice['created_at'])); ?></p>
                                                    </div>
                                                </div>
                                                <div class="row no-gutters">
                                                    <div class="col-auto">
                                                        <i class="ti-email text-secondary mr-2"></i>
                                                    </div>
                                                    <div class="col">
                                                        <p class="text-muted small mb-2"><strong>Nomor Resi:</strong> <?= $invoice['waybill']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?= $this->endSection() ?>