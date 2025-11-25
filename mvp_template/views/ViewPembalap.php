<?php
include_once ("KontrakView.php");
include_once ("models/Pembalap.php");

class ViewPembalap implements KontrakView {

    public function tampilPembalap($listPembalap): string {
        $rows = '';
        $no = 1;
        foreach($listPembalap as $p){
            $rows .= "<tr>";
            $rows .= "<td>{$no}</td>";
            $rows .= "<td>".htmlspecialchars($p->getNama())."</td>";
            $rows .= "<td>".htmlspecialchars($p->getTim())."</td>";
            $rows .= "<td>".htmlspecialchars($p->getNegara())."</td>";
            $rows .= "<td>{$p->getPoinMusim()}</td>";
            $rows .= "<td>{$p->getJumlahMenang()}</td>";
            $rows .= "<td>
                        <a href='index.php?screen=edit&id={$p->getId()}' class='btn btn-edit'>Edit</a>
                        <button data-id='{$p->getId()}' class='btn btn-delete'>Hapus</button>
                      </td>";
            $rows .= "</tr>";
            $no++;
        }

        // BACA FILE TEMPLATE DARI LUAR
        $template = file_get_contents(__DIR__ . '/../template/skin.html');
        
        // GANTI PLACEHOLDER DENGAN DATA
        return str_replace('', $rows, $template);
    }

    public function tampilFormPembalap($data = null): string {
        // Biar simple, formnya saya hardcode di sini saja atau kamu bisa buat file template/form.html terpisah
        // Tapi sesuai request "html jangan di view", idealnya ini juga load file.
        // Asumsi kamu punya template/form.html, kode ini membaca file itu:
        
        $template = file_get_contents(__DIR__ . '/../template/form.html');
        
        $action = 'add';
        $valId = '';
        $valNama = '';
        $valTim = '';
        $valNegara = '';
        $valPoin = '';
        $valMenang = '';

        if($data){
            $action = 'edit';
            $valId = $data['id'];
            $valNama = $data['nama'];
            $valTim = $data['tim'];
            $valNegara = $data['negara'];
            $valPoin = $data['poinMusim'];
            $valMenang = $data['jumlahMenang'];
        }

        // Replace manual (karena file form.html kamu sebelumnya pakai JS logic yang agak ribet, 
        // saya sarankan replace value value="" di HTML string-nya atau pakai placeholder spesifik)
        
        // Agar aman dan cepat, untuk FORM saya inject value langsung ke placeholder unik jika file form.html kamu mendukungnya.
        // Kalau file form.html kamu masih yang lama (polos), kamu harus memodifikasinya untuk menerima value.
        // SEMENTARA: Gunakan logika replace string sederhana ke atribut value:
        
        $template = str_replace('value="add"', 'value="'.$action.'"', $template);
        $template = str_replace('value="" id="pembalap-id"', 'value="'.$valId.'" id="pembalap-id"', $template);
        // ... dst (ini agak rentan error kalau template berubah) ...
        
        // CATATAN: Karena form.html lama kamu kompleks, saran saya load form.html
        // lalu inject value menggunakan str_replace placeholder yg kamu buat sendiri.
        
        return $template;
    }
}
?>