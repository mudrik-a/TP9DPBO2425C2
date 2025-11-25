<?php
interface KontrakPresenterSponsor {
    public function tampilkanSponsor(): string;
    public function tampilkanFormSponsor($id = null): string;
    public function tambahSponsor($nama, $jenis, $nilai): void;
    public function ubahSponsor($id, $nama, $jenis, $nilai): void;
    public function hapusSponsor($id): void;
}
?>