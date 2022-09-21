    <?= $this->extend('layout/MainLayout') ?>

    <?= $this->section('content') ?>
    <section class="section-padding mt-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-9">
                    <div class="cart_product">
                        <div class="cart_product_heading">
                            <div class="row align-items-center">
                                <div class="col-sm-6 text-lg-left">
                                    <h4>Keranjang Belanja
                                        <span id="countItem">( <?= count($dataCart) ?> Item )</span>
                                    </h4>
                                </div>
                                <div class="col-sm-6 text-lg-right">
                                    <a href="#" class="btn btn-light btn-medium button-sm d-none d-md-inline-block empty-cart"><i class="ti-trash"></i> Kosongkan Keranjang</a>
                                </div>
                            </div>
                        </div>

                        <?php 
                        $no = 0;
                        foreach($dataProduk as $produk) : 
                        $img = unserialize($produk['image']) ?>
                        <div class="cart_item">
                            <div class="cart_item_image">
                                <img src="<?= base_url('assets/uploads/images/'.$img[0]); ?> " alt="shop">
                            </div>
                            <div class="c-item-body mt-4 mt-md-0">
                                <input type="hidden" class="key-item" value="<?= $no; ?>">
                                <div class="cart_item_title mb-2">
                                    <h4><?= $produk['name']; ?></h4>
                                    <!-- <p class="small mb-0 text-muted">bottle of 60 capsules</p> -->
                                </div>
                                <div class="cart_item_price">
                                    <div class="product-price">
                                        <input type="hidden" class="product-line" value="<?= $produk["price"]; ?>">
                                        Harga Satuan: <span class="product-line-price"><strong><?= "Rp " . number_format($produk["price"],0,',','.')?></strong></span>
                                    </div>
                                    <div class="total-price">
                                        <input type="hidden" class="total-lines" value="<?= $produk["price"]*$produk['qty']; ?>">
                                        Total Harga: <span class="total-line-price"><strong><?= "Rp " . number_format($produk["price"]*$produk['qty'],0,',','.')?></strong></span>
                                    </div>
                                    <div class="cart_product_remove">
                                        <a href="#"><i class="ti-trash"></i> Hapus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="qty-input btn mt-4 mt-md-0">
                                <i class="less cart">-</i>
                                <input class="txt_qty" type="text" value="<?= $produk['qty']; ?>"/>
                                <i class="more cart">+</i>
                            </div>
                        </div>
                        <?php
                        $no++; 
                        endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-3 mt-lg-0 mt-6">
                    <h6 class="font-weight-bold">Alamat Pengiriman</h6>
                    <div class="mb-4">
                        <select class="form-control" id="alamat">
                            <?php foreach($dataAlamat as $alamat) : ?>
                            <option value="<?= $alamat['id']; ?>"><?= $alamat['receiver_name'] ?> - <?= $alamat['zipcode'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <h6 class="font-weight-bold">Pilih Kurir</h6>
                    <div class="mb-4">
                        <select class="form-control" id="kurir">
                            <option value="jne">JNE</option>
                            <option value="pos">Pos Indonesia</option>
                            <option value="tiki">TIKI</option>
                        </select>
                    </div>
                    <h6 class="font-weight-bold">Layanan Pengiriman</h6>
                    <div class="mb-4">
                        <select class="form-control" id="pengiriman"></select>
                    </div>
                    <div class="cart-summary">
                        <input type="hidden" class="txt_sifarmasi_token" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <div class="cart-summary-wrap">
                            <h4>Rincian Keranjang</h4>
                            <p>Sub Total <span class="totals-value" id="cart-subtotal">Rp 0</span></p>
                            <p>PPN (10%) <span class="totals-value" id="cart-tax">Rp 0</span></p>
                            <p>Biaya Pengiriman <span class="totals-value" id="cart-shipping">Rp 0</span></p>
                            <h2>Total Bayar <span class="totals-value" id="cart-total">Rp 0</span></h2>
                        </div>
                        <div class="cart-summary-button">
                            <a href="#" class="btn btn-primary btn-rounded btn-full btn-large btn-payment">Lanjut ke Pembayaran <i class="ti-arrow-right"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?= $this->endSection() ?>
    <?= $this->section('js') ?>
    <script>
        $(document).ready(function() {
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

            /* pajak */
            var taxRate = 0.1;
            var fadeTime = 300;
            // Cek jika ada perubahan pada field input
            $('.qty-input input').change(function() {
                updateQuantity(this);
            });
            $('.cart_product_remove').click(function() {
                removeProduct(this);
            });
            $('#kurir').change(function() {
                cekOngkir();
            });
            $('#pengiriman').change(function() {
                recalculateCart();
            });
            $('.empty-cart').click(function() {
                $.ajax({
                    url: '<?= base_url('shop/emptyCart'); ?>',
                    type: 'get',
                    success: function(data) {
                        window.location.href = '<?= base_url(); ?>';
                    }
                });
            });
            $('.btn-payment').click(function(){
                var idAlamat = $('#alamat').val();
                var idKurir = $('#kurir').val();
                var idPengiriman = $('#pengiriman').val();
                var total = $('#cart-total').text();
                var total = total.replace('Rp ', '');
                var total = total.replace(/\./g, '');
                var total = total.replace(/,/g, '');
                var total = parseInt(total);
                $.ajax({
                    url: '<?= base_url('shop/checkout'); ?>',
                    type: 'post',
                    data: {
                        'idAlamat' : idAlamat,
                        'courier' : idKurir,
                        'shipping_cost' : idPengiriman,
                        'total' : total,
                        [csrfName]: csrfHash
                    },
                    success: function(data) {
                        if(data.status == true){
                            window.location.href = '<?= base_url('shop/payment'); ?>/'+data.noInv;
                        } else {
                            Swal.fire({
                                title: "Gagal",
                                text: data.message,
                                icon: "error",
                                button: "Ok",
                            });
                        }
                    },
                    complete: function(){
                        refreshToken();
                    }
                });
            });

            cekOngkir();
            recalculateCart();

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix=""){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split   		= number_string.split(','),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
    
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
    
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
            }

            /* Fungsi Cek Ongkir */
            function cekOngkir(){
                var alamat = $('#alamat').val();
                var kurir = $('#kurir').val();
                $('#pengiriman').html('');
                $('#pengiriman').trigger('change');
                $.ajax({
                    url: '<?= base_url('data/getOngkir'); ?>',
                    type: 'post',
                    data: {
                        alamat: alamat,
                        kurir: kurir,
                        [csrfName]: csrfHash
                    },
                    complete:function() {
                        // Update CSRF hash
                        refreshToken()			
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $.each(data.rajaongkir.results[0].costs, function(index, value) {
                            $('#pengiriman').append('<option value="'+value.cost[0].value+'">'+value.service+' - '+value.description+'</option>');
                        });
                        $('#pengiriman').trigger('change');
                    }
                });
            }

            /* Menghitung ulang total keranjang */
            function recalculateCart() {
                var subtotal = 0;

                /* Sum up row totals */
                $('.cart_item').each(function() {
                    subtotal += parseInt($(this).children('.c-item-body').children('.cart_item_price').children('.total-price').children('.total-lines').val());
                });

                /* Calculate totals */
                var tax = subtotal * taxRate;
                var shipping = parseInt($('#pengiriman').val());
                var total = subtotal + tax + shipping;

                /* Update totals display */
                $('.totals-value').fadeOut(fadeTime, function() {
                    $('#cart-subtotal').html(formatRupiah(subtotal.toFixed(0)));
                    $('#cart-tax').html(formatRupiah(tax.toFixed(0)));
                    $('#cart-shipping').html(formatRupiah(shipping.toFixed(0)));
                    $('#cart-total').html(formatRupiah(total.toFixed(0)));
                    if (total == 0) {
                        $('.checkout').fadeOut(fadeTime);
                    } else {
                        $('.checkout').fadeIn(fadeTime);
                    }
                    $('.totals-value').fadeIn(fadeTime);
                });
            }

            /* Hapus produk dari keranjang */
            function removeProduct(removeButton) {
                /* Remove row from DOM and recalculate cart */
                var productRow = $(removeButton).parent().parent().parent();
                var key = parseInt(productRow.children('.c-item-body').children('.key-item').val());

                $.ajax({
                    url: '<?= base_url('shop/deleteCart'); ?>',
                    type: 'post',
                    dataType: "JSON",
                    data: {
                        key: key,
                        [csrfName]: csrfHash
                    },
                    complete:function() {
                        // Update CSRF hash
                        refreshToken()			
                    },
                    success: function(data) {
                        console.log(data.count);
                        if(data.count == 0){
                            location.reload();
                        }
                        $('#countItem').text("( "+data.count+" Item)");
                        viewCart();
                        productRow.slideUp(fadeTime, function() {
                            productRow.remove();
                            recalculateCart();
                        });
                    }
                });
            }

            /* Update quantity */
            function updateQuantity(quantityInput) {
                /* Menghitung harga */
                var productRow = $(quantityInput).parent().parent();
                var price = parseInt(productRow.children('.c-item-body').children('.cart_item_price').children('.product-price').children('.product-line').val());
                var quantity = $(quantityInput).val();
                var linePrice = price * quantity;
                var key = parseInt(productRow.children('.c-item-body').children('.key-item').val());

                /* Update harga per produk dan menghitung ulang total harga */
                productRow.children('.c-item-body').children('.cart_item_price').children('.total-price').children('.total-line-price').each(function() {
                    $(this).fadeOut(fadeTime, function() {
                        $(this).html(formatRupiah(linePrice.toFixed(0)).bold());
                        recalculateCart();
                        $(this).fadeIn(fadeTime);
                    });
                });

                productRow.children('.c-item-body').children('.cart_item_price').children('.total-price').children('.total-lines').each(function() {
                    $(this).fadeOut(fadeTime, function() {
                        $(this).val(linePrice.toFixed(0));
                    });
                });

                $.ajax({
                    url: "<?= base_url('shop/updateCart'); ?>",
                    method: "POST",
                    data: {
                        key: key,
                        qty: quantity,
                        [csrfName]: csrfHash
                    },
                    complete:function() {
                        // Update CSRF hash
                        refreshToken()			
                    },
                    success: function(data) {
                        viewCart()
                    }
                });
            }
        });
    </script>
    <?= $this->endSection() ?>