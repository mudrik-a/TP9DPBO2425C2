<?php
include_once("views/KontrakViewSponsor.php");
include_once("models/Sponsor.php");

class ViewSponsor implements KontrakViewSponsor {
    public function tampilSponsor($listSponsor): string {
        $rows = '';
        $no = 1;
        foreach($listSponsor as $s){
            $nilaiFmt = number_format((float)$s->getNilai(), 0, ',', '.');
            $rows .= "<tr>";
            $rows .= "<td>{$no}</td>";
            $rows .= "<td>".htmlspecialchars($s->getNama())."</td>";
            $rows .= "<td>".htmlspecialchars($s->getJenis())."</td>";
            $rows .= "<td>{$nilaiFmt}</td>";
            $rows .= "<td>
                        <a href='index.php?nav=sponsor&screen=edit&id={$s->getId()}' class='btn btn-edit'>Edit</a>
                        <button data-id='{$s->getId()}' class='btn btn-delete'>Hapus</button>
                      </td>";
            $rows .= "</tr>";
            $no++;
        }
        
        if(empty($rows)) {
            $rows = "<tr><td colspan='5' style='text-align:center'>Data Kosong</td></tr>";
        }

        $templatePath = __DIR__ . '/../template/skin_sponsor.html';
        
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            
            // --- BAGIAN DETEKTIF (DEBUGGING) ---
            // Kita cek apakah ada tulisan '' di file HTML lo
            if (strpos($template, '') === false) {
                die("<h1>ERROR FATAL:</h1> 
                     <p>File <code>template/skin_sponsor.html</code> lo GA ADA tulisan <code>&lt;!-- DATA_TABEL --&gt;</code> di dalem tbody.</p>
                     <p>Tolong buka file html itu dan tambahin dulu.</p>");
            }
            // ------------------------------------

            // Kalo lolos pengecekan, baru di-replace
            return str_replace('', $rows, $template);
            
        } else {
            return "Error: Template file not found at $templatePath";
        }
    }

    public function tampilFormSponsor($data = null): string {
        $template = file_get_contents(__DIR__ . '/../template/form_sponsor.html');
        $action = 'add';
        $id = ''; $nama = ''; $jenis = ''; $nilai = '';

        if($data){
            $action = 'edit';
            $id = $data['id'];
            $nama = $data['nama_brand'];
            $jenis = $data['jenis_industri'];
            $nilai = $data['nilai_kontrak'];
        }

        $template = str_replace('{{ACTION}}', $action, $template);
        $template = str_replace('{{ID}}', $id, $template);
        $template = str_replace('{{NAMA}}', $nama, $template);
        $template = str_replace('{{JENIS}}', $jenis, $template);
        $template = str_replace('{{NILAI}}', $nilai, $template);

        return $template;
    }
}
?>