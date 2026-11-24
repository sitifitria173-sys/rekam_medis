<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama_dokter = $_POST['nama_dokter'];
    $spesialisasi = $_POST['spesialisasi'];

    $query = "INSERT INTO dokter (nama_dokter, spesialisasi) VALUES ('$nama_dokter', '$spesialisasi')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data dokter berhasil ditambahkan!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'dokter.php';
                });
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dokter - Mediva</title>
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
        .table-custom { background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .table-custom thead { background-color: #f8f9fa; color: #555; }
        .table-custom th, .table-custom td { padding: 15px; border-bottom: 1px solid #eee; vertical-align: middle; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-0">
            <h3><i class="fas fa-heartbeat me-2"></i> Mediva</h3>
            <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
            <a href="pasien.php"><i class="fas fa-users"></i> Data Pasien</a>
            <a href="dokter.php" class="active"><i class="fas fa-user-md"></i> Data Dokter</a>
            <a href="obat.php"><i class="fas fa-pills"></i> Data Obat</a>
            <a href="rekam_medis.php"><i class="fas fa-notes-medical"></i> Rekam Medis</a>
        </div>

        <div class="col-md-10 main-content">
            <h2 class="page-title">Data Dokter</h2>

            <div class="card-custom">
                <h5 class="mb-3">Tambah Dokter Baru</h5>
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Dokter</label>
                            <input type="text" name="nama_dokter" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Spesialisasi</label>
                            <input type="text" name="spesialisasi" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" name="tambah" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>

            <div class="table-custom mt-4">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokter</th>
                            <th>Spesialisasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $result = mysqli_query($conn, "SELECT * FROM dokter");
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $row['nama_dokter'] . "</td>";
                                echo "<td>" . $row['spesialisasi'] . "</td>";
                                echo "<td>
                                        <a href='edit_dokter.php?id=" . $row['id_dokter'] . "' class='btn btn-sm btn-warning text-white'>Edit</a> 
                                        <button type='button' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#modalHapus' data-id='" . $row['id_dokter'] . "'>Hapus</button>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Belum ada data dokter.</td></tr>"; 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL HAPUS DOKTER -->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-trash-alt text-danger mb-3" style="font-size: 50px;"></i>
                <p class="mb-0 fs-5">Apakah Anda yakin ingin menghapus data dokter ini?</p>
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
        modalHapus.querySelector('#linkHapus').setAttribute('href', 'hapus_dokter.php?id=' + id);
    });
</script>
</body>
</html>