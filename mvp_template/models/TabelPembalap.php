<?php

include_once ("models/DB.php");
include_once ("KontrakModel.php");

class TabelPembalap extends DB implements KontrakModel {

    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    public function getAllPembalap(): array {
        $query = "SELECT * FROM pembalap";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getPembalapById($id): ?array {
        // PERBAIKAN: Menggunakan arrow (->) bukan dot (.)
        $query = "SELECT * FROM pembalap WHERE id = ?";
        $this->executeQuery($query, [$id]);
        $result = $this->getAllResult();
        return $result[0] ?? null;
    }

    public function addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        // IMPLEMENTASI INSERT
        $query = "INSERT INTO pembalap (nama, tim, negara, poinMusim, jumlahMenang) VALUES (?, ?, ?, ?, ?)";
        $this->executeQuery($query, [$nama, $tim, $negara, $poinMusim, $jumlahMenang]);
    }
    
    public function updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        // IMPLEMENTASI UPDATE
        $query = "UPDATE pembalap SET nama = ?, tim = ?, negara = ?, poinMusim = ?, jumlahMenang = ? WHERE id = ?";
        $this->executeQuery($query, [$nama, $tim, $negara, $poinMusim, $jumlahMenang, $id]);
    }
    
    public function deletePembalap($id): void {
        // IMPLEMENTASI DELETE
        $query = "DELETE FROM pembalap WHERE id = ?";
        $this->executeQuery($query, [$id]);
    }
}
?>