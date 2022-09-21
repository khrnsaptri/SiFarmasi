    <?= $this->extend('layout/MainLayout') ?>

    <?= $this->section('content') ?>
    <section class="section-padding mt-4">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-lg-4">
                    <!--=======  product details slider area  =======-->
                    <div class="product-details-slider-area">
                        <div class="big-image-wrapper">
                            <div class="product-details-big-image-slider-wrapper slider-for" data-autoplay="false" data-nav="false">
                                <?php foreach(unserialize($product_detail['image']) as $p1): ?>
                                <div class="single-image">
                                    <img src="<?= base_url("assets/uploads/images/".$p1); ?>" alt="slider">
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="slider-nav product-details-small-image-slider-wrapper" data-slides-to-show="3" data-autoplay="false" data-slick-center-mode="true" data-nav="false">
                                <?php foreach(unserialize($product_detail['image']) as $p2): ?>
                                <div class="single-image">
                                    <img src="<?= base_url("assets/uploads/images/".$p2); ?>" alt="slider">
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!--======= End of product details slider area =======-->
                </div>
                <div class="col-lg-8 mt-4">
                    <div class="row pl-lg-3">
                        <div class="col-lg-7">
                            <div class="single-product-content-description">
                                <!-- <p class="single-info">Brands <a href="category.html">BrandName</a> </p> -->
                                <h4 class="product-title"><?= $product_detail['name']; ?> </h4>
                                <!-- <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span class="review-count ml-3">4.5 (2,213)</span>
                                </div> -->
                                <p class="single-grid-product__price">
                                    <span class="discounted-price"><?= "Rp " . number_format($product_detail["price"],0,',','.')?></span> 
                                    <!-- <span class="main-price discounted">₹1699</span> -->
                                </p>

                                <div class="single-info">
                                    <span class="d-block text-muted mb-2"><strong>Berat :</strong> <?= $product_detail['weight']; ?> gr</span>
                                    <span class="d-block text-muted mb-2"><strong>Kategori :</strong> <?= $product_detail['category_name']; ?></span>
                                    <span class="d-block text-muted mb-2"><strong>Stok :</strong> <?= $product_detail['stock']; ?></span>
                                </div>

                                <!-- <div class="varient mt-4">
                                    <h6 class="font-weight-bold text-dark mb-3">Product Varient</h6>
                                    <div class="row box-checkbox">
                                        <label tabindex="0">
                                            <input tabindex="-1" type="checkbox" checked name="" />
                                            <div class="icon-box">
                                                <div class="label">399g</div>
                                                <span class="value">₹599</span>
                                            </div>
                                        </label>
                                        <label tabindex="0">
                                            <input tabindex="-1" type="checkbox" name="" />
                                            <div class="icon-box">
                                                <div class="label">997g</div>
                                                <span class="value">₹999</span>
                                            </div>
                                        </label>
                                        <label tabindex="0">
                                            <input tabindex="-1" type="checkbox" name="" />
                                            <div class="icon-box">
                                                <div class="label">1.2kg</div>
                                                <span class="value">₹1599</span>
                                            </div>
                                        </label>
                                    </div>
                                </div> -->

                                <div class="product-actions my-4 justify-content-between">
                                    <input type="hidden" class="txt_sifarmasi_token" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                    <!-- Quantity -->
                                    <div class="qty-input btn">
                                        <i class="less">-</i>
                                        <input type="text" class="txt_qty" id="qty" value="1" />
                                        <i class="more">+</i>
                                    </div>
                                    <!-- End Quantity -->
                                    <div class="product-buttons ml-0 ml-md-3 mt-4 mt-md-0 text-md-left text-center">
                                        <!-- <a class="btn btn-rounded btn-soft-primary mr-2" href="wishlist.html"> <i class="fa fa-heart"></i> Add To Wishlist</a> -->
                                        <a class="btn btn-rounded btn-primary btn-cart" href="javascript:void(0)" data-id="<?= $product_detail['id']; ?>"> <i class="fa fa-shopping-cart"></i> Tambahkan ke Keranjang</a>
                                    </div>
                                </div>
                                <!-- <div class="mb-4">
                                    <a href="checkout.html" class="btn btn-block btn-primary btn-pill transition-3d-hover">Buy Now</a>
                                </div> -->
                            </div>
                        </div>
                        <!-- <div class="col-lg-5 mt-4 mt-lg-0">
                            <div class="bg-light p-3">
                                <h6>Delivery Options</h6>
                                <div class="media align-items-center">
                                    <span class="mr-2">
                                        <i class="ti-check text-primary small"></i>
                                    </span>
                                    <div class="media-body text-body small">
                                        <span class="font-weight-bold mr-1">Free Shipping</span>
                                    </div>
                                </div>
                                <div class="media align-items-center">
                                    <span class="mr-2">
                                        <i class="ti-check text-primary small"></i>
                                    </span>
                                    <div class="media-body text-body small">
                                        <span class="font-weight-bold mr-1"> Cash on Delivery Available</span>
                                    </div>
                                </div>
                                <div class="media align-items-center">
                                    <span class="mr-2">
                                        <i class="ti-check text-primary small"></i>
                                    </span>
                                    <div class="media-body text-body small">
                                        <span class="font-weight-bold mr-1"> 14 days Return</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h6 class="font-weight-bold text-dark">Products highlights</h6>
                                <ul class="pl-3">
                                    <li>Comprise of WPC</li>
                                    <li>Helps in Muscle Building</li>
                                    <li>Generally Consumed With Water</li>
                                    <li>Helps to strengthen the immune system </li>
                                    <li>Supports healthy functioning of the cardiovascular system</li>
                                </ul>
                            </div>
                            <div class="mt-4">
                                <h6 class="font-weight-bold text-dark">Share on</h6>
                                <div class="social-links social-links-dark">
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-dribbble"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-behance"></i>
                                    </a>

                                </div>
                            </div>
                            <div class="form-group mt-5">
                                <h6 class="font-weight-bold text-dark">Delivery availability</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control custom-location"
                                        placeholder="Delivery Pincode">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white cursor-pointer">
                                            Check
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!--=======  product description review   =======-->
        <div class="product-full-description">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="entry-product-section-heading">Deskripsi</h3>
                        <?= $product_detail['description']; ?>
                        <h3 class="entry-product-section-heading">Informasi Tambahan</h3>
                        <div class="product-info-sec">
                            <?= $product_detail['additional_information']; ?>
                        </div>
                        <!-- <h2 class="entry-product-section-heading"> Reviews </h2>
                        <div class="row justify-content-between">
                            <div class="col-lg-5">
                                <div class="review_content">
                                    <div class="mb-1">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span class="review-count ml-3">4.5 (2,213)</span>
                                        </div>
                                        <em>Published 54 minutes ago</em>
                                    </div>
                                    <h4>"Commpletely satisfied"</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus
                                        autem, distinctio hic omnis molestiae, perspiciatis deserunt labore nisi
                                        exercitationem non laudantium </p>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="review_content">
                                    <div class="mb-1">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span class="review-count ml-3">4.5 (2,213)</span>
                                        </div>
                                        <em>Published 1 day ago</em>
                                    </div>
                                    <h4>"Always the best"</h4>
                                    <p>dolor reiciendis repellat accusantium exercitationem placeat consequatur,
                                        labore laboriosam perferendis in inventore magnam excepturi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-lg-5">
                                <div class="review_content">
                                    <div class="mb-1">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span class="review-count ml-3">4.5 (2,213)</span>
                                        </div>
                                        <em>Published 54 minutes ago</em>
                                    </div>
                                    <h4>"Commpletely satisfied"</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus
                                        autem, distinctio hic omnis molestiae, perspiciatis deserunt labore nisi
                                        exercitationem non laudantium </p>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="review_content">
                                    <div class="mb-1">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span class="review-count ml-3">4.5 (2,213)</span>
                                        </div>
                                        <em>Published 1 day ago</em>
                                    </div>
                                    <h4>"Always the best"</h4>
                                    <p>dolor reiciendis repellat accusantium exercitationem placeat consequatur,
                                        labore laboriosam perferendis in inventore magnam excepturi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-lg-5">
                                <div class="review_content">
                                    <div class="mb-1">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span class="review-count ml-3">4.5 (2,213)</span>
                                        </div>
                                        <em>Published 54 minutes ago</em>
                                    </div>
                                    <h4>"Commpletely satisfied"</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus
                                        autem, distinctio hic omnis molestiae, perspiciatis deserunt labore nisi
                                        exercitationem non laudantium </p>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="review_content">
                                    <div class="mb-1">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span class="review-count ml-3">4.5 (2,213)</span>
                                        </div>
                                        <em>Published 1 day ago</em>
                                    </div>
                                    <h4>"Always the best"</h4>
                                    <p>dolor reiciendis repellat accusantium exercitationem placeat consequatur,
                                        labore laboriosam perferendis in inventore magnam excepturi.</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-right"><a href="leave-review.html" class="btn btn-primary">Leave a review</a></p> -->
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- <div class="single-row-slider-area pt-7">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 text-center mb-4">
                        <h2>Related Products</h2>
                        <p>Mirum est notare quam littera gothica, quam nunc putamus parum
                            claram anteposuerit litterarum formas.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider  arrow-light slider-gap" data-slides-to-show="6" data-autoplay="true"
                            data-nav="true" data-dots="false">
                            <div class="product">
                                <a href="product-single.html" class="product-img">
                                    <img src="assets/img/product/product-1.png" class="" alt="">
                                </a>
                                <div class="product-info">
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <div class="review-count">4.5 (2,213)</div>
                                    </div>
                                    <h3>
                                        <a href="product-single.html"> TruRadix Curcumin Oral Strip Orange Mango</a>
                                    </h3>
                                    <div class="product-value">
                                        <div class="d-flex">
                                            <small class="regular-price">MRP <del>₹250.99</del></small>
                                            <div class="off-price">53% off</div>
                                        </div>
                                        <div class="current-price">₹237.99</div>
                                    </div>
                                </div>
                            </div>
                            <div class="product">
                                <a href="product-single.html" class="product-img">
                                    <img src="assets/img/product/product-2.png" class="" alt="">
                                </a>
                                <div class="product-info">
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <div class="review-count">4.5 (2,213)</div>
                                    </div>
                                    <h3>
                                        <a href="product-single.html"> TruRadix Curcumin Oral Strip Orange Mango</a>
                                    </h3>
                                    <div class="product-value">
                                        <div class="d-flex">
                                            <small class="regular-price">MRP <del>₹250.99</del></small>
                                            <div class="off-price">53% off</div>
                                        </div>
                                        <div class="current-price">₹237.99</div>
                                    </div>
                                </div>
                            </div>
                            <div class="product">
                                <a href="product-single.html" class="product-img">
                                    <img src="assets/img/product/product-3.png" class="" alt="">
                                </a>
                                <div class="product-info">
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <div class="review-count">4.5 (2,213)</div>
                                    </div>
                                    <h3>
                                        <a href="product-single.html"> TruRadix Curcumin Oral Strip Orange Mango</a>
                                    </h3>
                                    <div class="product-value">
                                        <div class="d-flex">
                                            <small class="regular-price">MRP <del>₹250.99</del></small>
                                            <div class="off-price">53% off</div>
                                        </div>
                                        <div class="current-price">₹237.99</div>
                                    </div>
                                </div>
                            </div>
                            <div class="product">
                                <a href="product-single.html" class="product-img">
                                    <img src="assets/img/product/product-4.png" class="" alt="">
                                </a>
                                <div class="product-info">
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <div class="review-count">4.5 (2,213)</div>
                                    </div>
                                    <h3>
                                        <a href="product-single.html"> TruRadix Curcumin Oral Strip Orange Mango</a>
                                    </h3>
                                    <div class="product-value">
                                        <div class="d-flex">
                                            <small class="regular-price">MRP <del>₹250.99</del></small>
                                            <div class="off-price">53% off</div>
                                        </div>
                                        <div class="current-price">₹237.99</div>
                                    </div>
                                </div>
                            </div>
                            <div class="product">
                                <a href="product-single.html" class="product-img">
                                    <img src="assets/img/product/product-5.png" class="" alt="">
                                </a>
                                <div class="product-info">
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <div class="review-count">4.5 (2,213)</div>
                                    </div>
                                    <h3>
                                        <a href="product-single.html"> TruRadix Curcumin Oral Strip Orange Mango</a>
                                    </h3>
                                    <div class="product-value">
                                        <div class="d-flex">
                                            <small class="regular-price">MRP <del>₹250.99</del></small>
                                            <div class="off-price">53% off</div>
                                        </div>
                                        <div class="current-price">₹237.99</div>
                                    </div>
                                </div>
                            </div>
                            <div class="product">
                                <a href="product-single.html" class="product-img">
                                    <img src="assets/img/product/product-6.png" class="" alt="">
                                </a>
                                <div class="product-info">
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <div class="review-count">4.5 (2,213)</div>
                                    </div>
                                    <h3>
                                        <a href="product-single.html"> TruRadix Curcumin Oral Strip Orange Mango</a>
                                    </h3>
                                    <div class="product-value">
                                        <div class="d-flex">
                                            <small class="regular-price">MRP <del>₹250.99</del></small>
                                            <div class="off-price">53% off</div>
                                        </div>
                                        <div class="current-price">₹237.99</div>
                                    </div>
                                </div>
                            </div>
                            <div class="product">
                                <a href="product-single.html" class="product-img">
                                    <img src="assets/img/product/product-7.png" class="" alt="">
                                </a>
                                <div class="product-info">
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <div class="review-count">4.5 (2,213)</div>
                                    </div>
                                    <h3>
                                        <a href="product-single.html"> TruRadix Curcumin Oral Strip Orange Mango</a>
                                    </h3>
                                    <div class="product-value">
                                        <div class="d-flex">
                                            <small class="regular-price">MRP <del>₹250.99</del></small>
                                            <div class="off-price">53% off</div>
                                        </div>
                                        <div class="current-price">₹237.99</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </section>
    <?= $this->endSection() ?>
    <?= $this->section('js') ?>
    <script>
        var csrfName = $('.txt_sifarmasi_token').attr('name'); // CSRF Token name
        var csrfHash = $('.txt_sifarmasi_token').val(); // CSRF hash
        //Refresh Token CSRF
        function refreshToken(){
            $.ajax({
                url: '<?= base_url('data/refreshToken'); ?>',
                type: 'get',
                success: function(data) {
                    // Update CSRF hash
                    $('.txt_sifarmasi_token').val(data);

                    getToken();
                }
            });
        }

        //Fungsi Ambil Token Terbaru
        function getToken(){
            csrfName = $('.txt_sifarmasi_token').attr('name'); // CSRF Token name
            csrfHash = $('.txt_sifarmasi_token').val(); // CSRF hash
        }

        // Add to Cart
        $('.btn-cart').on('click',function(){
            // ambil data id produk
            const product_id = $(this).data('id');
            const quantity = $('.txt_qty').val();

            //Ajax tambah data ke cart
			$.ajax({
                url: '<?= base_url('shop/addToCart'); ?>',
                type: 'post',
                data: {
                    id: product_id,
                    qty: quantity,
                    [csrfName]: csrfHash
                },
                complete:function() {
                    // Update CSRF hash
                    refreshToken()			
                },
                success: function(data) {
                    // Show Data
                    // $('#dataCart').html(data);
                    viewCart()
                }
            });
        });
    </script>
    <?= $this->endSection() ?>