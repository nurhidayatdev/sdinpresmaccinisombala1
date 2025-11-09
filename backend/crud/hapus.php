<?php
include '../../koneksi.php';

if (isset($_GET['tabel']) && isset($_GET['id'])) {
    $tabel = $_GET['tabel'];
    $id = intval($_GET['id']);

    $tabel_diizinkan = ['guru', 'mengajar', 'pembina_kegiatan', 'fasilitas_sekolah', 'berita', 'form_futsal', 'kelompok', 'login'];

    if (in_array($tabel, $tabel_diizinkan)) {
        $hapus = mysqli_query($koneksi, "DELETE FROM $tabel WHERE id='$id'");

        if ($hapus) {
            switch ($tabel) {
                case 'guru':
                    header("Location: ../dashboard/dashboard_guru.php?status=deleted");
                    break;
                case 'mengajar':
                    header("Location: ../dashboard/dashboard_kegiatan_akademik.php?status=deleted");
                    break;
                case 'pembina_kegiatan':
                    header("Location: ../dashboard/dashboard_kegiatan_akademik.php?status=deleted");
                    break;
                case 'fasilitas_sekolah':
                    header("Location: ../dashboard/dashboard_fasilitas.php?status=deleted");
                    break;
                case 'berita':
                    header("Location: ../dashboard/dashboard_berita.php?status=deleted");
                    break;
                case 'form_futsal':
                    header("Location: ../dashboard/dashboard_futsal.php?status=deleted");
                    break;
                case 'kelompok':
                    header("Location: ../dashboard/dashboard_kelompok.php?status=deleted");
                    break;
                case 'login':
                    header("Location: ../dashboard/dashboard_login.php?status=deleted");
                    break;
            }
        } else {
            echo "Gagal menghapus data dari tabel $tabel";
        }
    } else {
        echo "Tabel tidak diizinkan!";
    }
} else {
    echo "Parameter tidak lengkap!";
}
exit;
