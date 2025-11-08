<?php
include '../koneksi.php';

if (isset($_GET['tabel']) && isset($_GET['id'])) {
    $tabel = $_GET['tabel'];
    $id = intval($_GET['id']);

    $tabel_diizinkan = ['mengajar', 'pembina_kegiatan','fasilitas_sekolah', 'login'];

    if (in_array($tabel, $tabel_diizinkan)) {
        $hapus = mysqli_query($koneksi, "DELETE FROM $tabel WHERE id='$id'");

        if ($hapus) {
            switch ($tabel) {
                case 'mengajar':
                    header("Location: dashboard_info_akademik.php?status=deleted");
                    break;
                    case 'pembina_kegiatan':
                    header("Location: dashboard_info_akademik.php?status=deleted");
                    break;
                case 'fasilitas_sekolah':
                    header("Location: dashboard_fasilitas.php?status=deleted");
                    break;
                case 'login':
                    header("Location: dashboard_login.php?status=deleted");
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