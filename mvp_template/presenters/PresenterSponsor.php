<?php
include_once("models/Sponsor.php");
include_once("models/TabelSponsor.php");
include_once("views/ViewSponsor.php");
include_once("presenters/KontrakPresenterSponsor.php");

class PresenterSponsor implements KontrakPresenterSponsor {
    private $tabelSponsor;
    private $viewSponsor;

    public function __construct($tabelSponsor, $viewSponsor) {
        $this->tabelSponsor = $tabelSponsor;
        $this->viewSponsor = $viewSponsor;
    }

    public function tampilkanSponsor(): string {
        $data = $this->tabelSponsor->getAllSponsor();
        $listSponsor = [];
        foreach($data as $row) {
            // PERBAIKAN DI SINI: Sesuaikan dengan nama kolom di database (nama_brand & jenis_industri)
            $listSponsor[] = new Sponsor(
                $row['id'], 
                $row['nama_brand'],      // Sebelumnya nama_sponsor
                $row['jenis_industri'],  // Sebelumnya jenis_sponsor
                $row['nilai_kontrak']
            );
        }
        return $this->viewSponsor->tampilSponsor($listSponsor);
    }

    public function tampilkanFormSponsor($id = null): string {
        $data = null;
        if($id) {
            $data = $this->tabelSponsor->getSponsorById($id);
        }
        return $this->viewSponsor->tampilFormSponsor($data);
    }

    public function tambahSponsor($nama, $jenis, $nilai): void {
        $this->tabelSponsor->addSponsor($nama, $jenis, $nilai);
        header("Location: index.php?nav=sponsor");
        exit();
    }

    public function ubahSponsor($id, $nama, $jenis, $nilai): void {
        $this->tabelSponsor->updateSponsor($id, $nama, $jenis, $nilai);
        header("Location: index.php?nav=sponsor");
        exit();
    }

    public function hapusSponsor($id): void {
        $this->tabelSponsor->deleteSponsor($id);
        header("Location: index.php?nav=sponsor");
        exit();
    }
}
?>