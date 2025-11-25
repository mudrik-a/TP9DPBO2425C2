# Janji
Saya Mohammad Mudrik Mujayyin dengan NIM 2407142 mengerjakan Tugas Praktikum 9 pada Mata Kuliah Desain dan Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

## Arsitektur Program (MVP)

Program ini memisahkan logika aplikasi menjadi tiga komponen utama untuk menjaga kode tetap rapi, terstruktur, dan mudah dikembangkan (Separation of Concerns).

1.  **Model (`models/`)**:
    * Bertanggung jawab mengelola data dan berinteraksi langsung dengan database (MySQL).
    * Mengimplementasikan interface `KontrakModel` dan `KontrakModelSponsor`.
    * Contoh: `TabelPembalap.php` dan `TabelSponsor.php`.

2.  **View (`views/`)**:
    * Bertanggung jawab menampilkan antarmuka pengguna (HTML) kepada user.
    * View **tidak boleh** mengakses Model atau Database secara langsung.
    * Mengimplementasikan interface `KontrakView` dan `KontrakViewSponsor`.
    * Contoh: `ViewPembalap.php` dan `ViewSponsor.php`.

3.  **Presenter (`presenters/`)**:
    * Bertindak sebagai perantara (jembatan) antara View dan Model.
    * Menerima input dari View (melalui Controller/index), memproses logika bisnis, meminta data ke Model, dan menyerahkannya kembali ke View.
    * Mengimplementasikan interface `KontrakPresenter` dan `KontrakPresenterSponsor`.
    * Contoh: `PresenterPembalap.php` dan `PresenterSponsor.php`.

### Alur Program

1.  **Request**: User membuka `index.php`.
2.  **Routing**: `index.php` mengecek parameter `nav` (default 'pembalap' atau 'sponsor').
3.  **Inisialisasi**: `index.php` membuat objek Model, View, dan Presenter yang sesuai berdasarkan routing.
4.  **Proses**:
    * Presenter meminta data ke Model (misal: `getAllPembalap` atau `getAllSponsor`).
    * Model query ke Database.
    * Model mengembalikan data array ke Presenter.
    * Presenter mengubah data array menjadi list objek Entity (`Pembalap` atau `Sponsor`).
    * Presenter memberikan list objek ke View.
5.  **Response**: View merender HTML (menggunakan template `skin.html` atau `skin_sponsor.html`) dan menampilkannya ke user.

## Struktur Folder

```text
TP9DPBO2425C2/
├── mvp_template/
│   ├── models/
│   │   ├── DB.php
│   │   ├── KontrakModel.php
│   │   ├── KontrakModelSponsor.php
│   │   ├── Pembalap.php
│   │   ├── Sponsor.php
│   │   ├── TabelPembalap.php
│   │   └── TabelSponsor.php
│   │
│   ├── views/
│   │   ├── KontrakView.php
│   │   ├── KontrakViewSponsor.php
│   │   ├── ViewPembalap.php
│   │   └── ViewSponsor.php
│   │
│   ├── presenters/
│   │   ├── KontrakPresenter.php
│   │   ├── KontrakPresenterSponsor.php
│   │   ├── PresenterPembalap.php
│   │   └── PresenterSponsor.php
│   │
│   ├── template/
│   │   ├── skin.html
│   │   ├── skin_sponsor.html
│   │   ├── form.html
│   │   └── form_sponsor.html
│   │
│   ├── index.php
│   └── mvp_db.sql
│
└── README.md

```
## Fitur CRUD
Aplikasi ini memiliki fitur CRUD lengkap untuk dua entitas:

Pembalap:

 - Create: Form tambah pembalap (Nama, Tim, Negara, Poin Musim, Jumlah Menang).

 - Read: Tabel daftar pembalap.

 - Update: Form edit data pembalap.

 - Delete: Tombol hapus pembalap.

Sponsor:

 - Create: Form tambah sponsor (Nama Brand, Jenis Industri, Nilai Kontrak).

 - Read: Tabel daftar sponsor.

 - Update: Form edit sponsor.

 - Delete: Tombol hapus sponsor.

Dokumentasi

https://github.com/user-attachments/assets/e50c14a2-491b-47ad-a157-0481f8f93f2b

