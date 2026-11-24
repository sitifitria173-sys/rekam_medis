<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Menghapus Data...</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM pasien WHERE id_pasien = '$id'";

if (mysqli_query($conn, $query)) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data pasien berhasil dihapus!',
                confirmButtonText: 'Lanjut',
                confirmButtonColor: '#007bff',
                allowOutsideClick: false
            }).then(function() {
                window.location.href = 'pasien.php';
            });
          </script>";
} else {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal menghapus data: " . mysqli_error($conn) . "'
            });
          </script>";
}
?>

</body>
</html>