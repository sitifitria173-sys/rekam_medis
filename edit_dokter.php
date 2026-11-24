<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dokter - Mediva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- PANGGIL SWEETALERT DI PALING ATAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #f4f7fe; font-family: 'Poppins', sans-serif; color: #333; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card-edit { background: #fff; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); width: 100%; max-width: 500px; }
        .page-title { color: #2c3e50; font-weight: 600; margin-bottom: 20px; text-align: center; }
    </style>
</head>
<body>

<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM dokter WHERE id_dokter = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_dokter = $_POST['nama_dokter'];
    $spesialisasi = $_POST['spesialisasi'];

    $query_update = "UPDATE dokter SET nama_dokter='$nama_dokter', spesialisasi='$spesialisasi' WHERE id_dokter='$id'";
    
    if (mysqli_query($conn, $query_update)) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data dokter berhasil diupdate!',
                    confirmButtonText: 'Lanjut',
                    confirmButtonColor: '#007bff',
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = 'dokter.php';
                });
              </script>";
        exit;
    }
}
?>

<div class="card-edit">
    <h2 class="page-title"><i class="fas fa-user-md text-primary"></i> Edit Data Dokter</h2>
    
    <form method="POST" action="">
        <input type="hidden" name="id_dokter" value="<?= $data['id_dokter'] ?>">
        
        <div class="mb-3">
            <label class="form-label">Nama Dokter</label>
            <input type="text" name="nama_dokter" class="form-control" value="<?= $data['nama_dokter'] ?>" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Spesialisasi</label>
            <input type="text" name="spesialisasi" class="form-control" value="<?= $data['spesialisasi'] ?>" required>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="dokter.php" class="btn btn-secondary px-4">Batal</a>
            <button type="submit" name="update" class="btn btn-primary px-4">Update Data</button>
        </div>
    </form>
</div>

</body>
</html>