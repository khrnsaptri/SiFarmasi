<!doctype html>
<html lang="zxx">
<head>
    <!-- Describes the encoding of the page to the browser -->
    <meta charset="utf-8">

    <!-- Sets the title of the page.  Shown in the tab of your browser -->
    <title>SiFarmasi - <?= $title; ?></title>

    <!-- Required for Bootstrap's responsive media queries to function -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/home/img/favicon.png" type="image/png">

    <!-- Meta tag for basic SEO -->
    <meta name="description" content="hospitania">

    <!-- Main Theme CSS styles -->
    <link href="<?= base_url(); ?>/assets/home/css/theme.css" rel="stylesheet" type="text/css" media="all" />

    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font linked from external Google Fonts resource -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2da31.css?family=Nunito:wght@200;300;400;600;700;800;900&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
</head>

<body>
    <!-- <div class="alert alert-warning alert-dismissible fade show announcement-header" role="alert">
        <div class="container-fluid">
            <div class="pro-description">
                <div class="pro-info">
                    Get<strong> UPTO 40% OFF </strong>on your 1st order
                    <div class="pro-link-dropdown js-toppanel-link-dropdown">
                        <a href="https://pbkskills.com/shop" class="pro-dropdown-toggle">
                            SHOP NOW
                        </a>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

        </div>
    </div> -->

    <div class="header">
        <div class="container-fluid theme-container">
            <div class="top-header">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <a href="<?= base_url(); ?>">
                            <img src="<?= base_url(); ?>/assets/home/img/logo.png" alt="logo" class="header-logo">
                        </a>
                    </div>
                    <div class="col">
                        <div class="header-search">
                            <form action="<?= base_url("search"); ?>">
                                <input name="q" class="form-control custom-search" placeholder="Cari Produk Kesehatan Lainnya" type="text">
                            </form>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="header-right-options">
                            <?php if(empty($user_login['email'])){ ?>
                            <li class="link-item">
                                <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#login_modal">Login</a>
                            </li>
                            <li class="link-item">
                                <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#register_modal">Register</a>
                            </li>
                            <?php } ?>
                            <li class="dropdown head-cart-content">
                                <button id="dropdownCartButton" class="btn dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="list-icon">
                                        <i class="ti-bag"></i>
                                    </div>
                                    <span class="badge badge-secondary" id="countCart">0</span>
                                </button>

                                <div class="shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <ul class="shopping-cart-items" id="dataCart">
                                        <li>Keranjang Anda masih kosong.</li>
                                    </ul>
                                </div>
                            </li>
                            <?php if(!empty($user_login['email'])){ ?>
                            <li class="dropdown">
                                <button id="dropdownCartButton" class="btn dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="list-icon">
                                        <i class="ti-user"></i>
                                    </div>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right user-links"
                                    aria-labelledby="dropdownMenuButton">
                                    <ul>
                                        <li>
                                            <a href="<?= base_url("account") ;?>">
                                                Akun Saya
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url("account/password") ;?>">
                                                Ganti Password
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url("account/address") ;?>">
                                                Alamat
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url("account/orders") ;?>">
                                                Pesanan Saya
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url("logout"); ?>">
                                                Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?php } ?>
                            <!-- <li>
                                <a href="upload-prescription.html" class="btn btn-primary btn-sm">Upload</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- <div class="header-links">
                <div class="container-fluid theme-container">
                    <ul class="header-links-container">
                        <li class="header-links-item">
                            <div class="header-childrenItem-parent">
                                <a href="#">
                                    <span class="header-childrenItem-link-text">AllMedicines</span>
                                </a>
                                <i class="fa fa-angle-down drop-icon"></i>
                            </div>
                            <div class="header-childrenItem-child-category-links">
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Medicines One</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Medicines Two</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Medicines Three</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-links-item">
                            <div class="header-childrenItem-parent">
                                <a href="#">
                                    <span class="header-childrenItem-link-text">COVID Prevention</span>
                                </a>
                                <i class="fa fa-angle-down drop-icon"></i>
                            </div>
                            <div class="header-childrenItem-child-category-links">
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Boost Your Immunity</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Masks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Boost Your Immunity</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Masks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Boost Your Immunity</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Masks</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-links-item">
                            <div class="header-childrenItem-parent">
                                <a href="#">
                                    <span class="header-childrenItem-link-text">Featured</span>
                                </a>
                                <i class="fa fa-angle-down drop-icon"></i>
                            </div>
                            <div class="header-childrenItem-child-category-links">
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Flash Deals</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Top Health Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Summer Essentials</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Trending Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Flash Deals</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Top Health Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Summer Essentials</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Trending Products</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Flash Deals</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Top Health Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Summer Essentials</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Trending Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Flash Deals</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Top Health Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Summer Essentials</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Trending Products</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-links-item">
                            <div class="header-childrenItem-parent">
                                <a href="#">
                                    <span class="header-childrenItem-link-text">Fitness</span>
                                </a>
                                <i class="fa fa-angle-down drop-icon"></i>
                            </div>
                            <div class="header-childrenItem-child-category-links">
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Vitamins &amp;
                                                Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Multivitamins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Vitamins A-Z</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Mineral Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Nutritional Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Adults</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Children</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Women</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Health Food &amp; Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Green Tea &amp; Herbal
                                                Tea</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Herbal Juice</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Apple Cider Vinegar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Healthy Snacks</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Vitamins &amp;
                                                Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Multivitamins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Vitamins A-Z</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Mineral Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Nutritional Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Adults</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Children</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Women</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Health Food &amp; Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Green Tea &amp; Herbal
                                                Tea</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Herbal Juice</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Apple Cider Vinegar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Healthy Snacks</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Vitamins &amp;
                                                Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Multivitamins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Vitamins A-Z</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Mineral Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Nutritional Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Adults</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Children</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Women</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Health Food &amp; Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Green Tea &amp; Herbal
                                                Tea</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Herbal Juice</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Apple Cider Vinegar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Healthy Snacks</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-links-item">
                            <div class="header-childrenItem-parent">
                                <a href="#">
                                    <span class="header-childrenItem-link-text">Diabetes</span>
                                </a>
                                <i class="fa fa-angle-down drop-icon"></i>
                            </div>
                            <div class="header-childrenItem-child-category-links">
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Vitamins &amp;
                                                Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Multivitamins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Vitamins A-Z</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Mineral Supplements</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Trending Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Flash Deals</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Top Health Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Summer Essentials</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Trending Products</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Health Food &amp; Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Green Tea &amp; Herbal
                                                Tea</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Herbal Juice</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Apple Cider Vinegar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Healthy Snacks</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-links-item">
                            <div class="header-childrenItem-parent">
                                <a href="#">
                                    <span class="header-childrenItem-link-text">COVID Test </span>
                                </a>
                                <i class="fa fa-angle-down drop-icon"></i>
                            </div>
                            <div class="header-childrenItem-child-category-links">
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Boost Your Immunity</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Masks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Boost Your Immunity</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Masks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Boost Your Immunity</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Masks</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-links-item">
                            <div class="header-childrenItem-parent">
                                <a href="#">
                                    <span class="header-childrenItem-link-text">Papular</span>
                                </a>
                                <i class="fa fa-angle-down drop-icon"></i>
                            </div>
                            <div class="header-childrenItem-child-category-links">
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Flash Deals</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Top Health Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Summer Essentials</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Trending Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Flash Deals</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Top Health Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Summer Essentials</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Trending Products</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Flash Deals</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Top Health Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Summer Essentials</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Trending Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Flash Deals</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Top Health Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Summer Essentials</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Trending Products</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-links-item">
                            <div class="header-childrenItem-parent">
                                <a href="#">
                                    <span class="header-childrenItem-link-text">Supplements</span>
                                </a>
                                <i class="fa fa-angle-down drop-icon"></i>
                            </div>
                            <div class="header-childrenItem-child-category-links">
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Vitamins &amp;
                                                Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Multivitamins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Vitamins A-Z</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Mineral Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Nutritional Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Adults</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Children</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Women</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Health Food &amp; Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Green Tea &amp; Herbal
                                                Tea</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Herbal Juice</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Apple Cider Vinegar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Healthy Snacks</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Vitamins &amp;
                                                Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Multivitamins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Vitamins A-Z</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Mineral Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Nutritional Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Adults</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Children</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Women</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Health Food &amp; Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Green Tea &amp; Herbal
                                                Tea</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Herbal Juice</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Apple Cider Vinegar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Healthy Snacks</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Vitamins &amp;
                                                Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Multivitamins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Vitamins A-Z</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Mineral Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Nutritional Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Adults</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Children</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Women</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Health Food &amp; Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Green Tea &amp; Herbal
                                                Tea</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Herbal Juice</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Apple Cider Vinegar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Healthy Snacks</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Vitamins &amp;
                                                Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Multivitamins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Vitamins A-Z</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Mineral Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Nutritional Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Adults</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Children</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">For Women</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Health Food &amp; Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Green Tea &amp; Herbal
                                                Tea</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Herbal Juice</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Apple Cider Vinegar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Healthy Snacks</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-links-item">
                            <div class="header-childrenItem-parent">
                                <a href="#">
                                    <span class="header-childrenItem-link-text">Nutrition</span>
                                </a>
                                <i class="fa fa-angle-down drop-icon"></i>
                            </div>
                            <div class="header-childrenItem-child-category-links">
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Vitamins &amp;
                                                Supplements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Multivitamins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Vitamins A-Z</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Mineral Supplements</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Trending Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Flash Deals</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Top Health Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Summer Essentials</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Trending Products</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="header-childrenItem-child-list">
                                    <li>
                                        <a href="#" class="childItem-level-2">
                                            <span class="header-childrenItem-link-text">Health Food &amp; Drinks</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Green Tea &amp; Herbal
                                                Tea</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Herbal Juice</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Apple Cider Vinegar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="childItem-level-3">
                                            <span class="header-childrenItem-link-text">Healthy Snacks</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>

    <div class="mobile-header">
        <div class="container-fluid theme-container">
            <div class="row align-items-center">
                <div class="col-auto">
                    <ul class="header-left-options">
                        <li class="link-item open-sidebar">
                            <i class="ti-menu"></i>
                        </li>
                    </ul>
                </div>
                <div class="col text-center">
                    <img src="<?= base_url(); ?>/assets/home/img/logo.png" alt="logo" class="header-logo">
                </div>
                <!-- <div class="col-auto">
                    <ul class="header-right-options">
                        <li class="link-item">
                            <span class="badge badge-secondary">0</span>
                            <i class="ti-bag"></i>
                        </li>
                    </ul>
                </div> -->
            </div>
            <div class="menu-sidebar">
                <div class="close">
                    <i class="ti-close"></i>
                </div>
                
                <?php if(empty($user_login['email'])){ ?>
                <div class="welcome d-flex align-items-center">
                    <a href="#"  data-toggle="modal" data-dismiss="modal" data-target="#login_modal" class="btn btn-soft-primary btn-md">Login</a>
                    <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#register_modal" class="btn btn-primary btn-md">Register</a>
                </div>
                <?php } else { ?>
                <div class="mobileMenuLinks mb-4 mt-2">
                    <h6>Account Info</h6>
                    <ul>
                        <li>
                            <a href="<?= base_url("account") ;?>">
                                Akun Saya
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("account/password") ;?>">
                                Ganti Password
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("account/address") ;?>">
                                Alamat
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("account/orders") ;?>">
                                Pesanan Saya
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("shop/cart") ;?>">
                                Lihat Keranjang
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("logout"); ?>">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="overlay"></div>
    </div>

    <!-- Ambil data konten -->
    <?= $this->renderSection('content') ?>

    <footer class="site-footer footer-padding-lg bg-light mt-8">
        <div class="container-fluid theme-container">
            <div class="upper-footer">
                <div class="row justify-content-around">
                    <div class="col-lg-4 col-md-3 col-12">
                        <div class="widget">
                            <div class="footer-brand"><img src="<?= base_url(); ?>/assets/home/img/logo.png" alt=""></div>
                            <p>SiFarmasi merupakan situs penjualan obat secara online dengan menggunakan framework CodeIgniter 4.</p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-12">
                        <div class="widget">
                            <div class="widget-title">
                                <h3>Usefull Links</h3>
                            </div>
                            <ul>
                                <li>
                                    <a href="#">Documentation</a>
                                </li>
                                <li>
                                    <a href="#">Support</a>
                                </li>
                                <li>
                                    <a href="#">Privacy &amp; terms</a>
                                </li>
                                <li>
                                    <a href="#">Sitemap</a>
                                </li>
                                <li>
                                    <a href="#">Customers</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-12">
                        <div class="widget">
                            <div class="widget-title">
                                <h3>Help</h3>
                            </div>
                            <ul>
                                <li>
                                    <a href="index-2.html">Home</a>
                                </li>
                                <li>
                                    <a href="about.html">About Us</a>
                                </li>
                                <li>
                                    <a href="#">Business Partnership</a>
                                </li>
                                <li>
                                    <a href="blog.html">Blogs</a>
                                </li>
                                <li>
                                    <a href="contact.html">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-12">
                        <div class="widget">
                            <div class="widget-title">
                                <h3>Policy</h3>
                            </div>
                            <ul>
                                <li>
                                    <a href="policy.html">Privacy policy</a>
                                </li>
                                <li>
                                    <a href="policy.html">Terms and Conditions</a>
                                </li>
                                <li>
                                    <a href="policy.html">Return Policy</a>
                                </li>
                                <li>
                                    <a href="policy.html">Refund Policy</a>
                                </li>
                                <li>
                                    <a href="policy.html">Ip Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-12">
                        <div class="widget">
                            <div class="widget-title">
                                <h3>Social</h3>
                            </div>
                            <ul>
                                <li>
                                    <a href="#">Facebook</a>
                                </li>
                                <li>
                                    <a href="#">Google</a>
                                </li>
                                <li>
                                    <a href="#">Pinterest</a>
                                </li>
                                <li>
                                    <a href="#">Linkedin</a>
                                </li>
                                <li>
                                    <a href="#">Dribble</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lower-footer">
                <div class="row">
                    <div class="col-md-6 text-lg-left">
                        <p class="mb-4 mb-md-0 text-muted">Copyright © <?= date("Y") ?> SiFarmasi By <a href="https://dinus.ac.id/mahasiswa/A11.2019.12199" target="_blank"> Khoirunnisa Abidah R.P</a>| All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-card text-lg-right">
                            <img class="img-fluid mx-2" src="<?= base_url(); ?>/assets/home/img/payment-methods.png" alt="Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal clean_modal clean_modal-lg" id="login_modal" tabindex="-1" aria-labelledby="login_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <!-- <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn btn-gray-border btn-full rounded btn-large text-capitalize mb-3">
                                <img src="<?= base_url(); ?>/assets/home/img/facebook.png" alt="">
                                Login with Facebook
                            </a>
                            <a href="#" class="btn btn-gray-border btn-full rounded btn-large text-capitalize">
                                <img src="<?= base_url(); ?>/assets/home/img/google.png" alt="">
                                Login with Google
                            </a>
                        </div>
                        <div class="col-12 text-center">
                            <p class="text-muted my-4">Or Login With</p>
                        </div>
                    </div> -->
                    <div class="login_error d-none">
                        <div class="alert" role="alert">
                        </div>
                    </div>
                    <form action="<?= base_url("login"); ?>" id="login_modal_form" method="POST">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <input name="email" required type="email" placeholder="Email" class="form-control input-lg rounded">
                        </div>
                        <div class="form-group">
                            <input name="password" required type="password" placeholder="Password" class="form-control input-lg rounded">
                        </div>
                        <button type="submit" id="login_btn" name="submit"
                            class="btn btn-primary btn-full btn-medium rounded">Login</button>
                        <div class="form-group text-center small font-weight-bold mt-3">
                            <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#forgot_modal"> Lupa Password?</a>
                        </div>
                        <hr class="my-4">
                        <div class="form-group text-center small font-weight-bold mb-0">
                            Belum punya akun? <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#register_modal"> Daftar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal clean_modal" id="forgot_modal" tabindex="-1" aria-labelledby="forgot_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <input name="password" type="password" placeholder="Old Password"
                                class="form-control input-lg rounded">
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" placeholder="New Password"
                                class="form-control input-lg rounded">
                        </div>
                        <div class="form-group">
                            <input name="password" type="text" placeholder="Confirm Password"
                                class="form-control input-lg rounded">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-full btn-medium rounded">Change
                            Password</button>
                        <div class="form-group text-center small font-weight-bold mt-3">
                            Want to <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#login_modal">
                                Login?</a>
                        </div>
                        <hr class="my-4">
                        <div class="form-group text-center small font-weight-bold mb-0">
                            Don’t have an account? <a href="#" data-toggle="modal" data-dismiss="modal"
                                data-target="#register_modal"> Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal clean_modal clean_modal-lg" id="register_modal" tabindex="-1" aria-labelledby="register_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="register_error d-none">
                        <div class="alert f-size-16" role="alert">
                        </div>
                    </div>
                    <form action="<?= base_url('register'); ?>" method="POST" id="register_form">
                        <!-- <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-gray-border btn-full rounded btn-large text-capitalize mb-3">
                                    <img src="<?= base_url(); ?>/assets/home/img/facebook.png" alt="">
                                    Register with Facebook
                                </a>
                                <a href="#" class="btn btn-gray-border btn-full rounded btn-large text-capitalize">
                                    <img src="<?= base_url(); ?>/assets/home/img/google.png" alt="">
                                    Register with Google
                                </a>
                            </div>
                            <div class="col-12 text-center">
                                <p class="text-muted my-4">Or Register With</p>
                            </div>
                        </div> -->
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <input class="form-control" required name="firstname" placeholder="Nama Depan" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <input class="form-control" required name="lastname" placeholder="Nama Belakang" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input name="email" type="email" required name="email" placeholder="Email" class="form-control rounded">
                        </div>
                        <div class="form-group mb-3">
                            <input name="phone" type="number" required name="phone" placeholder="Nomor HP" class="form-control rounded checkIsNumber phone-check">
                        </div>
                        <div class="form-group mb-3">
                            <input name="password" type="password" required name="password" placeholder="Password" class="form-control rounded">
                        </div>

                        <button type="submit" id="register_btn" name="submit" class="btn btn-primary btn-full btn-medium rounded">Daftar</button>

                        <!-- <div class="form-group text-center small font-weight-bold mt-3">
                            By continuing you agree to our <a href="#"> Terms and conditions.</a>
                        </div> -->
                        <hr class="my-4">
                        <div class="form-group text-center small font-weight-bold mb-0">
                            Sudah punya akun? <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#login_modal"> Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Required vendor scripts (Do not remove) -->
    <script src="<?= base_url(); ?>/assets/home/js/jquery-2.2.4.min.js"></script>
    <script src="<?= base_url(); ?>/assets/home/js/plugins.bundle.js"></script>

    <!-- Modify theme scripts (Do not remove) -->
    <script src="<?= base_url(); ?>/assets/home/js/theme.js"></script>
    <?php
        $errors = session()->getFlashdata('errors');
        $error = session()->getFlashdata('error');
        $success = session()->getFlashdata('success');
        $error_msg = "";
        if(!empty($errors)){
            foreach ($errors as $errors) {
                $error_msg .= "<li>" . $errors . "</li>";
            }
        }
    ?>
    <script>
        <?php if(!empty($errors)) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal !!',
            html: '<?= $error_msg; ?>',
        })
        <?php } else if(!empty($error)) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal !!',
            html: '<?= $error; ?>',
        })
        <?php } else if(!empty($success)) { ?>
        Swal.fire({
            icon: 'success',
            title: 'Sukses !!',
            html: '<?= $success; ?>',
        })
        <?php }?>

        function viewCart(){
            $.ajax({
                url: "<?= base_url('shop/viewCart'); ?>",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#dataCart').html(data.miniCart);
                    $('#countCart').html(data.count);
                    // console.log(data)
                }
            });
        }

        $(document).ready(function() {
            viewCart()
        });
    </script>

    <!-- Ambil data js tambahan -->
    <?= $this->renderSection('js') ?>
</body>
</html>
