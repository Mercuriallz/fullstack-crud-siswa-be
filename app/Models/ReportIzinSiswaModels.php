<?php

namespace App\Models;
use CodeIgniter\Model;

class ReportIzinSiswaModels extends Model {

    protected $table = "report_izin";
    protected $primaryKey = "id";
    protected $allowedFields = ["absensi_id", "siswa_id", "keterangan"];
    
}

?>