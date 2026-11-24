<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pasien - Mediva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- PANGGIL SWEETALERT DI PALING ATAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #f4f7fe; font-family: 'Poppins', sans-serif; color: #333; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card-edit { background: #fff; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); width: 100%; max-width: 600px; }
        .page-title { color: #2c3e50; font-weight: 600; margin-bottom: 20px; text-align: center; }
    </style>
</head>
<body>

<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM pasien WHERE id_pasien = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $no_rm = $_POST['no_rm'];
    $nama_pasien = $_POST['nama_pasien'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];

    $query_update = "UPDATE pasien SET 
                        no_rm='$no_rm', 
                        nama_pasien='$nama_pasien', 
                        jenis_kelamin='$jenis_kelamin', 
                        tanggal_lahir='$tanggal_lahir', 
                        alamat='$alamat' 
                     WHERE id_pasien='$id'";
    
    if (mysqli_query($conn, $query_update)) {
        // SweetAlert Berhenti (Tidak Ada Timer) sampai tombol diklik
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data pasien berhasil diupdate!',
                    confirmButtonText: 'Lanjut',
                    confirmButtonColor: '#007bff',
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = 'pasien.php';
                });
              </script>";
        exit;
    }
}
?>

<div class="card-edit">
    <h2 class="page-title"><i class="fas fa-user-edit text-warning"></i> Edit Data Pasien</h2>
    
    <form method="POST" action="">
        <input type="hidden" name="id_pasien" value="<?= $data['id_pasien'] ?>">
        
        <div class="mb-3">
            <label class="form-label">No. RM</label>
            <input type="text" name="no_rm" class="form-control" value="<?= $data['no_rm'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Pasien</label>
            <input type="text" name="nama_pasien" class="form-control" value="<?= $data['nama_pasien'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="L" <?= ($data['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>Laki-laki (L)</option>
                <option value="P" <?= ($data['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>Perempuan (P)</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir'] ?>" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required><?= $data['alamat'] ?></textarea>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="pasien.php" class="btn btn-secondary px-4">Batal</a>
            <button type="submit" name="update" class="btn btn-primary px-4">Update Data</button>
        </div>
    </form>
</div>

</body>
</html>