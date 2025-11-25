<?php
interface KontrakModelSponsor {
    public function getAllSponsor(): array;
    public function getSponsorById($id): ?array;
    public function addSponsor($nama, $jenis, $nilai): void;
    public function updateSponsor($id, $nama, $jenis, $nilai): void;
    public function deleteSponsor($id): void;
}
?>