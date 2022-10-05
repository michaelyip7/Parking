<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table = 'jenis_kendaraan';
    protected $primaryKey = 'no';
    protected $allowedFields = ['no', 'nama', 'kendaraan_id', 'harga', 'harga_flat', 'type'];
}
