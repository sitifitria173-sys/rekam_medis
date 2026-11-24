<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rekam Medis - Mediva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- PANGGIL SWEETALERT DI PALING ATAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #f4f7fe; font-family: 'Poppins', sans-serif; color: #333; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .card-edit { background: #fff; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); width: 100%; max-width: 800px; }
        .page-title { color: #2c3e50; font-weight: 600; margin-bottom: 20px; text-align: center; }
    </style>
</head>
<body>

<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM rekam_medis WHERE id_rekam = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $id_obat = $_POST['id_obat'];
    $tanggal_periksa = $_POST['tanggal_periksa'];
    $keluhan = $_POST['keluhan'];
    $diagnosa = $_POST['diagnosa'];
    $tindakan = $_POST['tindakan'];
    $resep = $_POST['resep'];

    $query_update = "UPDATE rekam_medis SET 
                        id_pasien='$id_pasien', 
                        id_dokter='$id_dokter', 
                        id_obat='$id_obat', 
                        tanggal_periksa='$tanggal_periksa', 
                        keluhan='$keluhan', 
                        diagnosa='$diagnosa', 
                        tindakan='$tindakan', 
                        resep='$resep' 
                     WHERE id_rekam='$id'";
    
    if (mysqli_query($conn, $query_update)) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Rekam medis berhasil diupdate!',
                    confirmButtonText: 'Lanjut',
                    confirmButtonColor: '#007bff',
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = 'rekam_medis.php';
                });
              </script>";
        exit;
    }
}
?>

<div class="card-edit">
    <h2 class="page-title"><i class="fas fa-notes-medical text-primary"></i> Edit Rekam Medis</h2>
    
    <form method="POST" action="">
        <input type="hidden" name="id_rekam" value="<?= $data['id_rekam'] ?>">
        
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Pilih Pasien</label>
                <select name="id_pasien" class="form-select" required>
                    <?php
                    $res_p = mysqli_query($conn, "SELECT * FROM pasien");
                    while ($p = mysqli_fetch_assoc($res_p)) {
                        $selected = ($p['id_pasien'] == $data['id_pasien']) ? 'selected' : '';
                        echo "<option value='" . $p['id_pasien'] . "' $selected>" . $p['nama_pasien'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Pilih Dokter</label>
                <select name="id_dokter" class="form-select" required>
                    <?php
                    $res_d = mysqli_query($conn, "SELECT * FROM dokter");
                    while ($d = mysqli_fetch_assoc($res_d)) {
                        $selected = ($d['id_dokter'] == $data['id_dokter']) ? 'selected' : '';
                        echo "<option value='" . $d['id_dokter'] . "' $selected>" . $d['nama_dokter'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Pilih Obat</label>
                <select name="id_obat" class="form-select" required>
                    <?php
                    $res_o = mysqli_query($conn, "SELECT * FROM obat");
                    while ($o = mysqli_fetch_assoc($res_o)) {
                        $selected = ($o['id_obat'] == $data['id_obat']) ? 'selected' : '';
                        echo "<option value='" . $o['id_obat'] . "' $selected>" . $o['nama_obat'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Periksa</label>
                <input type="date" name="tanggal_periksa" class="form-control" value="<?= $data['tanggal_periksa'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Keluhan</label>
                <input type="text" name="keluhan" class="form-control" value="<?= $data['keluhan'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Diagnosa</label>
                <input type="text" name="diagnosa" class="form-control" value="<?= $data['diagnosa'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tindakan</label>
                <input type="text" name="tindakan" class="form-control" value="<?= $data['tindakan'] ?>" required>
            </div>
            <div class="col-md-12 mb-4">
                <label class="form-label">Resep (Aturan Pakai)</label>
                <input type="text" name="resep" class="form-control" value="<?= $data['resep'] ?>" required>
            </div>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="rekam_medis.php" class="btn btn-secondary px-4">Batal</a>
            <button type="submit" name="update" class="btn btn-primary px-4">Update Rekam Medis</button>
        </div>
    </form>
</div>

</body>
</html>