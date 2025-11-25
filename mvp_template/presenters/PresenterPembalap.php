<?php

include_once(__DIR__ . "/KontrakPresenter.php");
include_once(__DIR__ . "/../models/TabelPembalap.php");
include_once(__DIR__ . "/../models/Pembalap.php");
include_once(__DIR__ . "/../views/ViewPembalap.php");

class PresenterPembalap implements KontrakPresenter
{
    private $tabelPembalap;
    private $viewPembalap;
    private $listPembalap = [];

    public function __construct($tabelPembalap, $viewPembalap)
    {
        // PERBAIKAN: Konsistensi nama variabel ($this->tabelPembalap)
        $this->tabelPembalap = $tabelPembalap;
        $this->viewPembalap = $viewPembalap;
    }

    public function initListPembalap()
    {
        $data = $this->tabelPembalap->getAllPembalap();
        $this->listPembalap = [];
        
        foreach($data as $item){
            $pembalap = new Pembalap(
                $item['id'],
                $item['nama'],
                $item['tim'],
                $item['negara'],
                $item['poinMusim'],
                $item['jumlahMenang']
            );
            $this->listPembalap[] = $pembalap;
        }
    }

    public function tampilkanPembalap(): string
    {
        $this->initListPembalap(); // Pastikan data di-load dulu
        return $this->viewPembalap->tampilPembalap($this->listPembalap);
    }

    public function tampilkanFormPembalap($id = null): string
    {
        $data = null;
        if ($id !== null) {
            // Mengambil data lama untuk diedit
            $data = $this->tabelPembalap->getPembalapById($id);
        }
        // PERBAIKAN: Memanggil method yang benar di View (tampilFormPembalap)
        return $this->viewPembalap->tampilFormPembalap($data);
    }

    public function tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        $this->tabelPembalap->addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang);
        header("Location: index.php");
        exit;
    }
    
    public function ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        $this->tabelPembalap->updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);
        header("Location: index.php");
        exit;
    }
    
    public function hapusPembalap($id): void {
        $this->tabelPembalap->deletePembalap($id);
        header("Location: index.php");
        exit;
    }
}
?>