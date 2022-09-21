<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    // Login Admin
    public $login_admin = [
        'username' => [
            'label'  => 'Username',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'password' => [
            'label'  => 'Password',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ]
    ];

    // Tambah Kategori dari Admin Panel
    public $category = [
        'name' => [
            'label'  => 'Nama Kategori',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi'
            ],
        ],
        'image' => [
            'label'  => 'Gambar',
            'rules'  => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'max_size' => 'Ukuran gambar terlalu besar',
                'is_image' => 'File yang diupload bukan gambar',
                'mime_in'  => 'Format gambar tidak didukung',
            ],
        ],
    ];

    // Edit Kategori dari Admin Panel Tanpa Gambar
    public $category_edit = [
        'name' => [
            'label'  => 'Nama Kategori',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi'
            ],
        ],
    ];
    
    //Tambah Produk
    public $product = [
        'name' => [
            'label'  => 'Nama Produk',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi'
            ],
        ],
        'price' => [
            'label'  => 'Harga',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi'
            ],
        ],
        'weight' => [
            'label'  => 'Berat',
            'rules'  => 'required|is_natural_no_zero',
            'errors' => [
                'required' => '{field} wajib diisi',
                'is_natural_no_zero' => '{field} wajib diisi dengan angka',
            ],
        ],
        'category_id' => [
            'label'  => 'Kategori',
            'rules'  => 'required|is_natural_no_zero',
            'errors' => [
                'required' => '{field} wajib diisi',
                'is_natural_no_zero' => '{field} wajib diisi dengan angka',
            ],
        ],
        'stock' => [
            'label'  => 'Stok',
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => '{field} wajib diisi',
                'numeric'  => '{field} harus berupa angka',
            ],
        ],
        'image' => [
            'label'  => 'Gambar',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
    ];

    // Register User
    public $registerUser = [
        'firstname' => [
            'label'  => 'Nama Depan',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'lastname' => [
            'label'  => 'Nama Belakang',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'email' => [
            'label'  => 'Email',
            'rules'  => 'required|valid_email',
            'errors' => [
                'required' => '{field} wajib diisi',
                'valid_email' => '{field} tidak valid',
            ],
        ],
        'phone' => [
            'label'  => 'Password',
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => '{field} wajib diisi',
                'numeric' => '{field} harus berupa angka',
            ],
        ],
        'password' => [
            'label'  => 'Konfirmasi Password',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
    ];

    // Update Data Akun
    public $updateAccount = [
        'firstname' => [
            'label'  => 'Nama Depan',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'lastname' => [
            'label'  => 'Nama Belakang',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'phone' => [
            'label'  => 'Nomor HP',
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => '{field} wajib diisi',
                'numeric' => '{field} harus berupa angka',
            ],
        ],
    ];

    // Update Password
    public $updatePassword = [
        'old_password' => [
            'label'  => 'Password Lama',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'new_password' => [
            'label'  => 'Password Baru',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'confirm_password' => [
            'label'  => 'Konfirmasi Password',
            'rules'  => 'required|matches[new_password]',
            'errors' => [
                'required' => '{field} wajib diisi',
                'matches' => '{field} tidak sama dengan password baru',
            ],
        ],
    ];

    // Tambah Alamat
    public $address = [
        'receiver_name' => [
            'label'  => 'Nama Penerima',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'phone' => [
            'label'  => 'Nomor HP',
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => '{field} wajib diisi',
                'numeric' => '{field} harus berupa angka',
            ],
        ],
        'address' => [
            'label'  => 'Alamat',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'city' => [
            'label'  => 'Kota',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'state' => [
            'label'  => 'Provinsi',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'zipcode' => [
            'label'  => 'Kode Pos',
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => '{field} wajib diisi',
                'numeric' => '{field} harus berupa angka',
            ],
        ],
        'country' => [
            'label'  => 'Negara',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
    ];

    // Update User
    public $editUser = [
        'firstname' => [
            'label'  => 'Nama Depan',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'lastname' => [
            'label'  => 'Nama Belakang',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'phone' => [
            'label'  => 'Nomor HP',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
        'email' => [
            'label'  => 'Email',
            'rules'  => 'required|valid_email',
            'errors' => [
                'required' => '{field} wajib diisi',
                'valid_email' => '{field} tidak valid',
            ],
        ],
        'status' => [
            'label'  => 'Status',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} wajib diisi',
            ],
        ],
    ];
}
