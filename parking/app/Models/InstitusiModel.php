<?php

namespace App\Models;

use CodeIgniter\Model;

class InstitusiModel extends Model
{
    protected $table = 'institusi';
    protected $primaryKey = 'no';
    protected $allowedFields = ['no', 'universitas_id', 'universitas', 'logo'];
}
