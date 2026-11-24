<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Obat - Mediva</title>
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
$query = "SELECT * FROM obat WHERE id_obat = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_obat = $_POST['nama_obat'];
    $satuan = $_POST['satuan'];
    $stok = $_POST['stok'];

    $query_update = "UPDATE obat SET nama_obat='$nama_obat', satuan='$satuan', stok='$stok' WHERE id_obat='$id'";
    
    if (mysqli_query($conn, $query_update)) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data obat berhasil diupdate!',
                    confirmButtonText: 'Lanjut',
                    confirmButtonColor: '#007bff',
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = 'obat.php';
                });
              </script>";
        exit;
    }
}
?>

<div class="card-edit">
    <h2 class="page-title"><i class="fas fa-pills text-success"></i> Edit Data Obat</h2>
    
    <form method="POST" action="">
        <input type="hidden" name="id_obat" value="<?= $data['id_obat'] ?>">
        
        <div class="mb-3">
            <label class="form-label">Nama Obat</label>
            <input type="text" name="nama_obat" class="form-control" value="<?= $data['nama_obat'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" name="satuan" class="form-control" value="<?= $data['satuan'] ?>" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="<?= $data['stok'] ?>" required>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="obat.php" class="btn btn-secondary px-4">Batal</a>
            <button type="submit" name="update" class="btn btn-primary px-4">Update Data</button>
        </div>
    </form>
</div>

</body>
</html>