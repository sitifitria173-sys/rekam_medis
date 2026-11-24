<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis - Mediva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #f4f7fe; font-family: 'Poppins', sans-serif; color: #333; }
        .sidebar { background-color: #ffffff; min-height: 100vh; box-shadow: 2px 0 5px rgba(0,0,0,0.05); }
        .sidebar h3 { color: #007bff; font-weight: 700; padding: 20px; text-align: center; border-bottom: 1px solid #eee; }
        .sidebar a { display: block; padding: 15px 20px; color: #555; text-decoration: none; font-weight: 500; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #e3f2fd; color: #007bff; border-left: 4px solid #007bff; }
        .sidebar i { width: 25px; }
        .main-content { padding: 30px; }
        .page-title { color: #2c3e50; font-weight: 600; margin-bottom: 20px; }
        .card-custom { background: #fff; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: none; margin-bottom: 20px; }
        
        /* Tabel Rapi Tanpa Scroll Horizontal */
        .table-custom { background: #fff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden; }
        .table-custom table { width: 100%; margin-bottom: 0; table-layout: fixed; } /* table-layout fixed agar lebar kolom stabil */
        .table-custom thead { background-color: #f8f9fa; color: #555; }
        .table-custom th, .table-custom td { 
            padding: 12px; 
            border-bottom: 1px solid #eee; 
            vertical-align: top; 
            font-size: 13px; 
            word-wrap: break-word; /* Teks panjang turun ke bawah */
            white-space: normal; /* Izinkan teks turun ke baris baru */
        }
        
        /* Mengatur lebar kolom agar proporsional */
        .table-custom th:nth-child(1) { width: 3%; }
        .table-custom th:nth-child(2) { width: 9%; }
        .table-custom th:nth-child(3) { width: 10%; }
        .table-custom th:nth-child(4) { width: 10%; }
        .table-custom th:nth-child(5) { width: 10%; }
        .table-custom th:nth-child(6) { width: 12%; }
        .table-custom th:nth-child(7) { width: 10%; }
        .table-custom th:nth-child(8) { width: 15%; }
        .table-custom th:nth-child(9) { width: 15%; }
        .table-custom th:nth-child(10) { width: 6%; }
    </style>
</head>
<body>

<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $id_obat = $_POST['id_obat'];
    $tanggal_periksa = $_POST['tanggal_periksa'];
    $keluhan = $_POST['keluhan'];
    $diagnosa = $_POST['diagnosa'];
    $tindakan = $_POST['tindakan'];
    $resep = $_POST['resep'];

    $query = "INSERT INTO rekam_medis (id_pasien, id_dokter, id_obat, tanggal_periksa, keluhan, diagnosa, tindakan, resep) 
              VALUES ('$id_pasien', '$id_dokter', '$id_obat', '$tanggal_periksa', '$keluhan', '$diagnosa', '$tindakan', '$resep')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Rekam medis berhasil ditambahkan!',
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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-0">
            <h3><i class="fas fa-heartbeat me-2"></i> Mediva</h3>
            <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
            <a href="pasien.php"><i class="fas fa-users"></i> Data Pasien</a>
            <a href="dokter.php"><i class="fas fa-user-md"></i> Data Dokter</a>
            <a href="obat.php"><i class="fas fa-pills"></i> Data Obat</a>
            <a href="rekam_medis.php" class="active"><i class="fas fa-notes-medical"></i> Rekam Medis</a>
        </div>

        <div class="col-md-10 main-content">
            <h2 class="page-title">Form Pemeriksaan (Rekam Medis)</h2>

            <div class="card-custom">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Pilih Pasien</label>
                            <select name="id_pasien" class="form-select" required>
                                <option value="">-- Pilih Pasien --</option>
                                <?php
                                $res_p = mysqli_query($conn, "SELECT * FROM pasien");
                                while ($p = mysqli_fetch_assoc($res_p)) {
                                    echo "<option value='" . $p['id_pasien'] . "'>" . $p['nama_pasien'] . " (RM: " . $p['no_rm'] . ")</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Pilih Dokter</label>
                            <select name="id_dokter" class="form-select" required>
                                <option value="">-- Pilih Dokter --</option>
                                <?php
                                $res_d = mysqli_query($conn, "SELECT * FROM dokter");
                                while ($d = mysqli_fetch_assoc($res_d)) {
                                    echo "<option value='" . $d['id_dokter'] . "'>" . $d['nama_dokter'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Pilih Obat</label>
                            <select name="id_obat" class="form-select" required>
                                <option value="">-- Pilih Obat --</option>
                                <?php
                                $res_o = mysqli_query($conn, "SELECT * FROM obat");
                                while ($o = mysqli_fetch_assoc($res_o)) {
                                    echo "<option value='" . $o['id_obat'] . "'>" . $o['nama_obat'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tanggal Periksa</label>
                            <input type="date" name="tanggal_periksa" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Keluhan</label>
                            <input type="text" name="keluhan" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Diagnosa</label>
                            <input type="text" name="diagnosa" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tindakan</label>
                            <input type="text" name="tindakan" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Resep (Aturan Pakai)</label>
                            <input type="text" name="resep" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" name="tambah" class="btn btn-primary">Simpan Rekam Medis</button>
                </form>
            </div>

            <h4 class="mt-5 mb-3">Riwayat Pemeriksaan</h4>
            <div class="table-custom">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Obat</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Resep</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query_riwayat = "SELECT rekam_medis.*, pasien.nama_pasien, dokter.nama_dokter, obat.nama_obat 
                                          FROM rekam_medis 
                                          JOIN pasien ON rekam_medis.id_pasien = pasien.id_pasien 
                                          JOIN dokter ON rekam_medis.id_dokter = dokter.id_dokter 
                                          JOIN obat ON rekam_medis.id_obat = obat.id_obat 
                                          ORDER BY rekam_medis.tanggal_periksa DESC";
                        $res_r = mysqli_query($conn, $query_riwayat);
                        
                        if (mysqli_num_rows($res_r) > 0) {
                            while ($row = mysqli_fetch_assoc($res_r)) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $row['tanggal_periksa'] . "</td>";
                                echo "<td>" . $row['nama_pasien'] . "</td>";
                                echo "<td>" . $row['nama_dokter'] . "</td>";
                                echo "<td>" . $row['nama_obat'] . "</td>";
                                echo "<td>" . $row['keluhan'] . "</td>";
                                echo "<td>" . $row['diagnosa'] . "</td>";
                                echo "<td>" . $row['tindakan'] . "</td>";
                                echo "<td>" . $row['resep'] . "</td>";
                                echo "<td>
                                        <a href='edit_rekam.php?id=" . $row['id_rekam'] . "' class='btn btn-sm btn-warning text-white mb-1'>Edit</a>
                                        <button type='button' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#modalHapus' data-id='" . $row['id_rekam'] . "'>Hapus</button>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10' class='text-center'>Belum ada riwayat pemeriksaan.</td></tr>"; 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL HAPUS REKAM MEDIS -->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-trash-alt text-danger mb-3" style="font-size: 50px;"></i>
                <p class="mb-0 fs-5">Apakah Anda yakin ingin menghapus riwayat rekam medis ini?</p>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="linkHapus" class="btn btn-danger px-4">Ya, Hapus!</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const modalHapus = document.getElementById('modalHapus');
    modalHapus.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        modalHapus.querySelector('#linkHapus').setAttribute('href', 'hapus_rekam.php?id=' + id);
    });
</script>
</body>
</html>