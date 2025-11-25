<?php
class Sponsor {
    private $id;
    private $nama;
    private $jenis;
    private $nilai;

    public function __construct($id, $nama, $jenis, $nilai) {
        $this->id = $id;
        $this->nama = $nama;
        $this->jenis = $jenis;
        $this->nilai = $nilai;
    }

    public function getId() { return $this->id; }
    public function getNama() { return $this->nama; }
    public function getJenis() { return $this->jenis; }
    public function getNilai() { return $this->nilai; }
}
?>