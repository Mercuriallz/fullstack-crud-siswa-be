<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModels extends Model {
    protected $table = "siswa";
    protected $primaryKey = 'id';
    protected $allowedFields = ["nama", "kelas", "umur","alamat","status_siswa"];

}

?>