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

        // BACA FILE TEMPLATE
        $template = file_get_contents(__DIR__ . '/../template/skin.html');
        
        // GANTI PLACEHOLDER DATA_TABEL DENGAN BARIS DATA
        // Pastikan di template/skin.html sudah ada tulisan DATA_TABEL di dalam <tbody>
        return str_replace('DATA_TABEL', $rows, $template);
    }

    public function tampilFormPembalap($data = null): string {
        // BACA FILE TEMPLATE FORM
        $template = file_get_contents(__DIR__ . '/../template/form.html');
        
        $action = 'add';
        $valId = '';
        $valNama = '';
        $valTim = '';
        $valNegara = '';
        $valPoin = '';
        $valMenang = '';

        if($data){
            // Jika data ada (mode edit), isi variabel dengan data dari database
            $action = 'edit';
            $valId = $data['id'];
            $valNama = $data['nama'];
            $valTim = $data['tim'];
            $valNegara = $data['negara'];
            $valPoin = $data['poinMusim'];
            $valMenang = $data['jumlahMenang'];
        }

        // REPLACE PLACEHOLDER HTML DENGAN DATA
        $template = str_replace('DATA_ACTION', $action, $template);
        $template = str_replace('DATA_ID', $valId, $template);
        $template = str_replace('DATA_NAMA', $valNama, $template);
        $template = str_replace('DATA_TIM', $valTim, $template);
        $template = str_replace('DATA_NEGARA', $valNegara, $template);
        $template = str_replace('DATA_POIN', $valPoin, $template);
        $template = str_replace('DATA_MENANG', $valMenang, $template);
        
        return $template;
    }
}
?>