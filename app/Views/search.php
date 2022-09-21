    <?= $this->extend('layout/MainLayout') ?>

    <?= $this->section('content') ?>
    <!-- //product Grid -->
    <div class="pt-5">
        <div class="container-fluid theme-container">
            <div class="row mb-4">
                <div class="col">
                    <h5 class="product-heading">Hasil dari pencarian: <?= $q; ?></h5>
                </div>
            </div>
            <div class="row">
                <?php 
                $count = count($product);
                if($count > 0){
                    foreach ($product as $p) : 
                    $images = unserialize($p['image']); 
                    ?>
                    <div class="col-md-2 col-sm-4 col-6">
                        <div class="product">
                            <a href="<?= base_url("product/detail/".$p['id']); ?>" class="product-img">
                                <img src="<?= base_url("assets/uploads/images/".$images[0]); ?>" class="" alt="">
                            </a>
                            <div class="product-info">
                                <h3>
                                    <a href="<?= base_url("product/detail/".$p['id']); ?>"> <?= $p['name']; ?> </a>
                                </h3>
                                <div class="product-value">
                                    <div class="current-price"><?= "Rp " . number_format($p["price"],0,',','.')?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;
                }else{
                    echo "<div class='col-12 text-center'>
                    <h3>Tidak ada hasil dari pencarian</h3>
                    </div>";
                }
                ?>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>