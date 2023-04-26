<?php

namespace App\Controllers;

use App\Models\ReportIzinSiswaModels;
use App\Models\SiswaModels;
use App\Models\SppModels;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class SiswaController extends ResourceController {
    use ResponseTrait;

    public function getSiswa() {
       
    $db = db_connect();

        if ($db->connectError) {
        die('Connection error: ' . $db->connectError);
    } else {
        $result = $db->query("SELECT siswa.id,siswa.nama, siswa.kelas, siswa.alamat, siswa.umur,  case when siswa.status_siswa = 1 then 'Siswa Aktif' else 'siswa tidak aktif' end as status_aktif_siswa from siswa order by siswa.id");
        $resultData["siswa"]= $result->getResult();
        // dd($resultData);
        // return $this-("siswa_view", $resultData);
        return $this->respond($resultData);
    }
}

    public function editSiswa($id) {
        $model = new SiswaModels();
        $data = [
            "nama" => $this->request->getVar("nama"),
            "kelas" => $this->request->getVar("kelas"),
            "umur" => $this->request->getVar("umur"),
            "alamat" => $this->request->getVar("alamat"),
            "status_siswa" => $this->request->getVar("status_siswa")
        ];
        $result = $model->update($id, $data);
        return $this->respond($data);

        if($result) {
            $response = [
                "status" => 201,
                "message" => "Successfuly Edit Data"
            ];
            return $this->respond($response);
        } else {
            $response = [
                "status" => 500,
                "message" => "Cannot Edit Data"
            ];
            return $this->respond($response, 500);
        }
    }

    public function deleteSiswa($id) {
        $model = new SiswaModels();
        $result = $model->delete($id);

        if($result) {
            $response = [
                "status" => 201,
                "message" => "Successfully delete"
            ];
            return $this->respond($response);
        } else {
            $responseFailed = [
                "status" => 500,
                "message" => "Cannot delete siswa"
            ];
            return $this->respond($responseFailed, 500);
        }
    }

    public function siswaCreate() {
        $model = new SiswaModels();
        $data = [
            "nama" => $this->request->getVar("nama"),
            "kelas" => $this->request->getVar("kelas"),
            "umur" => $this->request->getVar("umur"),
            "alamat" => $this->request->getVar("alamat"),
            "status_siswa" => $this->request->getVar("status_siswa")
        ];
        $result = $model->save($data);
        if($result) {
            return $this->respond([
                $data
            ],201);
        } else {
            return $this->respond([
                "msg" => "Something Went Wrong"
            ],400);

        }
    }

    public function insertReportIzin() {
        $model = new ReportIzinSiswaModels();
        $data = [
            "absensi_id" => $this->request->getVar("absensi_id"),
            "siswa_id" => $this->request->getVar("siswa_id"),
            "keterangan" => $this->request->getVar("keterangan")
        ];
        $result = $model->save($data);
        if($result) {
            $response = [
                "status" => 201,
                "message" => "Succesfully insert report"
            ];
            return $this->respond($response);
        } else {
            $response = [
                "status" => 400,
                "message" => "Cannot add report"
            ];
            return $this->respond($response);
        }
    }

    public function insertSpp() {
        $model = new SppModels();
        $data = [
            "siswa_id" => $this->request->getVar("siswa_id"),
            "nominal" => $this->request->getVar("nominal"),
            "verifikasi_by" => $this->request->getVar("verifikasi_by")
        ];
        $result = $model->save($data);
        if($result) {
            $response = [
                "status" => 201,
                "data" => $data,
                "message" => "Success insert SPP"
            ];
            return $this->respond($response);
        } else {
            $response = [
                "status" => 400,
                "message" => "Cannot add SPP" 
            ];
            return $this->respond($response);
        }
    }
    
    public function getTransfer() {
        $db = db_connect();

        if($db->connectError) {
            die('Connection error: ' . $db->connectError);
        } else {
            $result = $db->query("SELECT siswa.nama, spp.nominal, spp.verifikasi_by, case when spp.verifikasi_by = 0 then 'BCA' when spp.verifikasi_by = 1 then 'MANDIRI' else 'BRI' end as transfer_lewat from siswa left join spp on siswa.id = spp.siswa_id order by siswa.nama desc");
            $resultDataTransfer = $result->getResult();
            return $this->respond($resultDataTransfer);
        }
    }

    public function getAbsenSiswa() {
        $db = db_connect();

        if($db->connectError) {
            die('Connection error: ' . $db->connectError);
        } else {
            $result = $db->query("SELECT siswa.nama, absensi.izin_alasan, absensi.jumlah_kehadiran from siswa
            left join absensi on siswa.id = absensi.siswa_id order by siswa.nama desc");
            $resultDataSiswa = $result->getResult();
            return $this->respond($resultDataSiswa);
        }
    }
    
    }


?>