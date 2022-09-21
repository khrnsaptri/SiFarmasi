    <?= $this->extend('layout/MainLayout') ?>

    <?= $this->section('content') ?>
    <div class="slider" data-autoplay="true" data-autoplay-speed="4000">
        <a href="#">
            <img src="<?= base_url(); ?>/assets/home/img/slider/slider-1.svg" alt="">
        </a>
        <a href="#">
            <img src="<?= base_url(); ?>/assets/home/img/slider/slider-2.jpg" alt="">
        </a>
        <a href="#">
            <img src="<?= base_url(); ?>/assets/home/img/slider/slider-3.jpg" alt="">
        </a>
    </div>

    <!-- //category -->
    <div class="pt-5">
        <div class="container-fluid theme-container">
            <div class="slider  arrow-light slider-gap" data-slides-to-show="4" data-autoplay="true" data-nav="true" data-dots="false">
                <?php foreach ($category as $category) : ?>
                <div class="product-categories-grid">
                    <div class="product-img">
                        <img src="<?= base_url("assets/uploads/category/".$category['image']); ?>" class="" alt="">
                        <div class="cat-info">
                            <h5 class="cat-name">
                                <?= $category['name']; ?>
                            </h5>
                            <a href="<?= base_url("product/category/".$category['slug']); ?>" class="cat-link">
                                Lihat Produk <i class="ti-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- //product slider -->
    <div class="pt-5">
        <div class="container-fluid theme-container">
            <div class="row mb-4">
                <div class="col">
                    <h5 class="product-heading">Produk Terbaru</h5>
                </div>
                <!-- <div class="col-auto text-md-right">
                    <a href="category.html" class="btn btn-primary btn-sm product-heading-btn">See All</a>
                </div> -->
            </div>
            <div class="slider  arrow-light slider-gap" data-slides-to-show="6" data-autoplay="true" data-nav="true" data-dots="false">
                <?php foreach ($product as $product) : 
                $images = unserialize($product['image']); 
                ?>
                <div class="product">
                    <a href="<?= base_url("product/detail/".$product['id']); ?>" class="product-img">
                        <img src="<?= base_url("assets/uploads/images/".$images[0]); ?>" class="" alt="">
                    </a>
                    <div class="product-info">
                        <h3>
                            <a href="<?= base_url("product/detail/".$product['id']); ?>"> <?= $product['name']; ?> </a>
                        </h3>
                        <div class="product-value">
                            <div class="current-price"><?= "Rp " . number_format($product["price"],0,',','.')?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>