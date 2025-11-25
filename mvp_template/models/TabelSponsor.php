<?php
include_once("models/DB.php");
include_once("models/KontrakModelSponsor.php");

class TabelSponsor extends DB implements KontrakModelSponsor {
    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    public function getAllSponsor(): array {
        $query = "SELECT * FROM sponsor";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getSponsorById($id): ?array {
        $query = "SELECT * FROM sponsor WHERE id = ?";
        $this->executeQuery($query, [$id]);
        $result = $this->getAllResult();
        return $result[0] ?? null;
    }

    public function addSponsor($nama, $jenis, $nilai): void {
        // PERBAIKAN NAMA KOLOM
        $query = "INSERT INTO sponsor (nama_brand, jenis_industri, nilai_kontrak) VALUES (?, ?, ?)";
        $this->executeQuery($query, [$nama, $jenis, $nilai]);
    }

    public function updateSponsor($id, $nama, $jenis, $nilai): void {
        // PERBAIKAN NAMA KOLOM
        $query = "UPDATE sponsor SET nama_brand = ?, jenis_industri = ?, nilai_kontrak = ? WHERE id = ?";
        $this->executeQuery($query, [$nama, $jenis, $nilai, $id]);
    }

    public function deleteSponsor($id): void {
        $query = "DELETE FROM sponsor WHERE id = ?";
        $this->executeQuery($query, [$id]);
    }
}
?>