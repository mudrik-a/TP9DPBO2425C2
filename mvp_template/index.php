<?php

include_once("models/DB.php");
include_once("models/TabelPembalap.php");
include_once("models/TabelSponsor.php");

include_once("views/ViewPembalap.php");
include_once("views/ViewSponsor.php");

include_once("presenters/PresenterPembalap.php");
include_once("presenters/PresenterSponsor.php");

// Konfigurasi Database
$dbHost = 'localhost';
$dbName = 'mvp_db';
$dbUser = 'root';
$dbPass = '';

// Routing Sederhana
$nav = isset($_GET['nav']) ? $_GET['nav'] : 'pembalap';

if ($nav == 'sponsor') {
    // --- AREA SPONSOR ---
    $tabelSponsor = new TabelSponsor($dbHost, $dbName, $dbUser, $dbPass);
    $viewSponsor = new ViewSponsor();
    $presenter = new PresenterSponsor($tabelSponsor, $viewSponsor);

    if (isset($_GET['screen'])) {
        if ($_GET['screen'] == 'add') {
            echo $presenter->tampilkanFormSponsor();
        } elseif ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
            echo $presenter->tampilkanFormSponsor($_GET['id']);
        }
    } elseif (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $presenter->tambahSponsor($_POST['nama'], $_POST['jenis'], $_POST['nilai']);
        } elseif ($_POST['action'] == 'edit') {
            $presenter->ubahSponsor($_POST['id'], $_POST['nama'], $_POST['jenis'], $_POST['nilai']);
        } elseif ($_POST['action'] == 'delete') {
            $presenter->hapusSponsor($_POST['id']);
        }
    } else {
        echo $presenter->tampilkanSponsor();
    }

} else {
    // --- AREA PEMBALAP (DEFAULT) ---
    $tabelPembalap = new TabelPembalap($dbHost, $dbName, $dbUser, $dbPass);
    $viewPembalap = new ViewPembalap();
    $presenter = new PresenterPembalap($tabelPembalap, $viewPembalap);

    if (isset($_GET['screen'])) {
        if ($_GET['screen'] == 'add') {
            echo $presenter->tampilkanFormPembalap();
        } elseif ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
            echo $presenter->tampilkanFormPembalap($_GET['id']);
        }
    } elseif (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $presenter->tambahPembalap($_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'edit') {
            $presenter->ubahPembalap($_POST['id'], $_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'delete') {
            $presenter->hapusPembalap($_POST['id']);
        }
    } else {
        echo $presenter->tampilkanPembalap();
    }
}
?>