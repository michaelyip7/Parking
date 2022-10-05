<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
   protected $table = 'transaksi';
   protected $useTimestamps = true;
   protected $createdField = 'waktu_masuk';
   protected $updatedField = 'waktu_keluar';
   protected $primaryKey = 'id';
   protected $allowedFields = ['kendaraan_id', 'petugas', 'plat_nomor', 'status', 'tarif', 'waktu_keluar'];

   public function getDetail($id = false)
   {
      if ($id == false) {
         return $this->findall();
      }

      return $this->where(['id' => $id])->first();
   }
   public function search($keyword)
   {
      return $this->table('transaksi')->like('plat_nomor', $keyword)->orLike('status', $keyword)->orLike('nama', $keyword)->orLike('petugas', $keyword);
   }
}
