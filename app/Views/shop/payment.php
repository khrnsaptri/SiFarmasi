    <?= $this->extend('layout/MainLayout') ?>

    <?= $this->section('content') ?>
    <section class="section-padding mt-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div id="accordion">
                                <div class="accordion-item">
                                    <div class="accordion-title">
                                        <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true"> Pembayaran online</h5>
                                    </div>
                                    <div class="accordion-content collapse show" id="collapseOne"
                                        data-parent="#accordion">
                                        <div class="accordion-content-inner">
                                            <p class="py-4">Kami menerima pembayaran melalui kartu kredit:&nbsp;&nbsp;<img class="d-inline-block align-middle" src="<?= base_url('assets/home/img/payment-methods.png'); ?>" style="width: 187px;" alt="Cerdit Cards"> dan metode pembayaran lainnya</p>
                                            <button id="pay-button" class="btn btn-primary d-block w-100">Bayar Sekarang</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-lg-0 mt-6">
                    <div class="cart-summary">
                        <div class="cart-summary-wrap">
                            <h4>Total Tagihan</h4>
                            <p>Sub Total <span><?= "Rp " . number_format($subtotal,0,',','.')?></span></p>
                            <p>PPN (10%) <span><?= "Rp " . number_format($ppn,0,',','.')?></span></p>
                            <p>Ongkos Kirim <span><?= "Rp " . number_format($ongkir,0,',','.')?></span></p>
                            <h2>Total <span><?= "Rp " . number_format($total,0,',','.')?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?= $this->endSection() ?>
    <?= $this->section('js') ?>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $clientKey; ?>"></script>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay("<?= $snapToken; ?>");
            // customer will be redirected after completing payment pop-up
        });
    </script>
    <?= $this->endSection() ?>