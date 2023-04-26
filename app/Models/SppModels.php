<?php

namespace App\Models;

use CodeIgniter\Model;

class SppModels extends Model {
    protected $table = "spp";
    protected $primaryKey = "id";
    protected $allowedFields = ["siswa_id", "nominal", "verifikasi_by"];
}

?>