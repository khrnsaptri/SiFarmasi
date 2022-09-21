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
                                <li class="breadcrumb-item text-nowrap active" aria-current="page">Alamat</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="order-md-1 text-center text-md-left col-lg col-12">
                        <h1 class="h3 mb-0">Alamat</h1>
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
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('account'); ?>"><i class="fa fa-user"></i> Akun Saya</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('account/password'); ?>"><i class="fa fa-lock"></i>
                                                Password</a>
                                        </li>
                                        <li class="nav-item active">
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
                                        <h5 class="mb-1 text-white">Alamat</h5>
                                        <p class="mb-0 text-white small">
                                            Anda memiliki kendali penuh untuk mengelola Akun Anda sendiri.
                                        </p>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#address_model" class="btn btn-primary btn-sm btn-addAddress"> Tambah Alamat Baru</a>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-5"></div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <?php 
                                        if(count($address) == 0){
                                            echo '<div class="col-12 text-center">
                                                <h5 class="mb-0">Anda belum memiliki alamat</h5>
                                                <p class="mb-0">Silahkan tambahkan alamat baru</p>
                                            </div>';
                                        }
                                        
                                        foreach ($address as $a) : ?>
                                        <div class="col-lg-6">
                                            <div class="address-block bg-light rounded p-3">
                                                <a href="#" class="edit_address" data-toggle="modal" data-dismiss="modal" data-id="<?= $a['id']; ?>" data-receiver_name="<?= $a['receiver_name']; ?>" data-phone="<?= $a['phone']; ?>" data-address="<?= $a['address']; ?>" data-apt="<?= $a['apt']; ?>" data-city="<?= $a['city']; ?>" data-state="<?= $a['state']; ?>" data-zip_code="<?= $a['zipcode']; ?>" data-country="<?= $a['country']; ?>" data-target="#address_model">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                                <a href="#" class="delete_address" data-id="<?= $a['id']; ?>">
                                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                </a>
                                                <h6><?= $a['receiver_name']; ?></h6>
                                                <p class="text-muted"><?= $a['phone']; ?></p>
                                                <span class="text-muted"><?= $a['address']; ?><?php if($a['apt'] != "") { echo " (".$a['apt'].")"; } ?>, <?= $a['city']; ?>, <?= $a['state']; ?> - <?= $a['zipcode']; ?></span>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="modal clean_modal clean_modal-lg" id="address_model" tabindex="-1" aria-labelledby="address_model" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <form action="" id="address_modal_form" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" id="id" value="0">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="receiver_name">Nama Penerima <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="receiver_name" id="receiver_name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="phone">Nomor HP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone" id="phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="address">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address" id="address" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="apt">Apartemen / Suite / Lantai</label>
                                    <input type="text" class="form-control" name="apt" id="apt">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="locality">Kota <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="city" id="locality" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="administrative_area_level_1">Provinsi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="state" id="administrative_area_level_1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="postal_code">Kode Pos <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="zip_code" id="postal_code" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="country">Negara <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="country" id="country" value="Indonesia" readonly required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="address_btn" name="submit" class="btn btn-primary btn-full btn-medium rounded">Tambah Alamat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>
    <?= $this->section('js') ?>
    <script>
        const btn = document.getElementById("address_btn");
        $('.edit_address').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const receiver_name = $(this).data('receiver_name');
            const phone = $(this).data('phone');
            const address = $(this).data('address');
            const apt = $(this).data('apt');
            const city = $(this).data('city');
            const state = $(this).data('state');
            const zip_code = $(this).data('zip_code');
            const country = $(this).data('country');

            // set data to form
            $('#address_modal_form').find('#id').val(id);
            $('#address_modal_form').find('#receiver_name').val(receiver_name);
            $('#address_modal_form').find('#phone').val(phone);
            $('#address_modal_form').find('#address').val(address);
            $('#address_modal_form').find('#apt').val(apt);
            $('#address_modal_form').find('#locality').val(city);
            $('#address_modal_form').find('#administrative_area_level_1').val(state);
            $('#address_modal_form').find('#postal_code').val(zip_code);
            $('#address_modal_form').find('#country').val(country);
            btn.innerText = "Edit Alamat"
        });

        $('.btn-addAddress').on('click',function(){
            $('#address_modal_form').find('#id').val("0");
            document.getElementById("address_modal_form").reset();
            btn.innerText = "Tambah Alamat"
        });

        $('.delete_address').on('click',function(){
            const id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?= base_url('account/delete_address') ?>",
                        type: "POST",
                        data: {
                            id: id,
                            ["<?= csrf_token() ?>"]: "<?= csrf_hash() ?>"
                        },
                        success: function(data){
                            Swal.fire(
                                'Terhapus!',
                                'Data anda telah dihapus.',
                                'success'
                            ).then(function(){
                                location.reload();
                            });
                        }
                    });
                }
            });
        });
    </script>
    <?= $this->endSection() ?>