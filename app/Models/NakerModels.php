<?php

namespace App\Models;

use CodeIgniter\Model;

class NakerModels extends Model{
    protected $table ="naker";
    protected $primaryKey = "id";
    protected $allowedFields = ["kota", "nik", "nama", "jabatan", "status_naker", "nosim", "jenis_sim", "masa_berlaku_sim"];
}

?>