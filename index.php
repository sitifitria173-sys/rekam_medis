<?php
include 'koneksi.php';

// Hitung total data
$q_pasien = mysqli_query($conn, "SELECT COUNT(*) AS total FROM pasien");
$total_pasien = mysqli_fetch_assoc($q_pasien)['total'];
$q_dokter = mysqli_query($conn, "SELECT COUNT(*) AS total FROM dokter");
$total_dokter = mysqli_fetch_assoc($q_dokter)['total'];
$q_obat = mysqli_query($conn, "SELECT COUNT(*) AS total FROM obat");
$total_obat = mysqli_fetch_assoc($q_obat)['total'];
$q_rekam = mysqli_query($conn, "SELECT COUNT(*) AS total FROM rekam_medis");
$total_rekam = mysqli_fetch_assoc($q_rekam)['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mediva</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome (Ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { background-color: #f4f7fe; font-family: 'Poppins', sans-serif; color: #333; }
        
        /* Sidebar */
        .sidebar { background-color: #ffffff; min-height: 100vh; box-shadow: 2px 0 5px rgba(0,0,0,0.05); }
        .sidebar h3 { color: #007bff; font-weight: 700; padding: 20px; text-align: center; border-bottom: 1px solid #eee; }
        .sidebar a { display: block; padding: 15px 20px; color: #555; text-decoration: none; font-weight: 500; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #e3f2fd; color: #007bff; border-left: 4px solid #007bff; }
        .sidebar i { width: 25px; }
        
        /* Area Konten */
        .main-content { padding: 30px; }
        
        /* Banner Selamat Datang */
        .welcome-banner {
            background: linear-gradient(135deg, #007bff 0%, #00d2ff 100%);
            border-radius: 15px;
            color: white;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
            position: relative;
            overflow: hidden;
        }
        .welcome-banner h2 { font-weight: 700; margin-bottom: 10px; position: relative; z-index: 2; }
        .welcome-banner p { font-size: 15px; opacity: 0.9; max-width: 65%; position: relative; z-index: 2; }
        
        /* Mengatur posisi gambar SVG */
        .welcome-banner svg {
            position: absolute;
            right: 30px;
            bottom: 0px;
            height: 160px;
            opacity: 0.9;
            z-index: 1;
        }

        /* Kartu Statistik */
        .stat-card { background: #fff; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: none; transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-icon { font-size: 40px; opacity: 0.2; position: absolute; right: 20px; top: 20px; }
        .stat-number { font-size: 32px; font-weight: bold; color: #333; margin: 0; }
        .stat-label { color: #777; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        
        /* Warna Garis Atas Kartu */
        .card-pasien { border-top: 4px solid #007bff; }
        .card-dokter { border-top: 4px solid #28a745; }
        .card-obat { border-top: 4px solid #ffc107; }
        .card-rekam { border-top: 4px solid #dc3545; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR -->
        <div class="col-md-2 sidebar p-0">
            <h3><i class="fas fa-heartbeat me-2"></i> Mediva</h3>
            <a href="index.php" class="active"><i class="fas fa-home"></i> Dashboard</a>
            <a href="pasien.php"><i class="fas fa-users"></i> Data Pasien</a>
            <a href="dokter.php"><i class="fas fa-user-md"></i> Data Dokter</a>
            <a href="obat.php"><i class="fas fa-pills"></i> Data Obat</a>
            <a href="rekam_medis.php"><i class="fas fa-notes-medical"></i> Rekam Medis</a>
        </div>

        <!-- KONTEN UTAMA -->
        <div class="col-md-10 main-content">
            
            <!-- Header dengan Tanggal -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="page-title mb-0">Ringkasan Data</h2>
                </div>
                
                <!-- Kartu Tanggal -->
                <div class="card border-0 shadow-sm" style="border-radius: 10px; background-color: #fff;">
                    <div class="card-body py-2 px-4 text-center">
                        <i class="fas fa-calendar-alt text-primary mb-1" style="font-size: 20px;"></i>
                        <h6 class="mb-0 fw-bold text-dark">
                            <?php 
                                $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                                $bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                echo $hari[date('w')] . ", " . date('j') . " " . $bulan[date('n')] . " " . date('Y'); 
                            ?>
                        </h6>
                    </div>
                </div>
            </div>

            <!-- Banner Selamat Datang dengan Gambar SVG -->
            <div class="welcome-banner">
                <h2>Selamat Datang di Mediva! 👋</h2>
                <p>Sistem informasi manajemen klinik untuk mempermudah pengelolaan data pasien, jadwal dokter, stok obat, dan riwayat pemeriksaan.</p>
                
                <!-- Gambar Ilustrasi Medis (SVG) -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" fill="none">
                    <path d="M420 250C420 350 350 400 250 400C150 400 80 350 80 250C80 150 150 100 250 100C350 100 420 150 420 250Z" fill="rgba(255,255,255,0.1)"/>
                    <path d="M200 300V400H300V300L250 280L200 300Z" fill="#E2E8F0"/>
                    <circle cx="250" cy="220" r="40" fill="#FDE047"/>
                    <path d="M220 260C220 280 230 300 250 300C270 300 280 280 280 260" stroke="#475569" stroke-width="5" stroke-linecap="round"/>
                    <circle cx="280" cy="260" r="8" fill="#475569"/>
                    <rect x="220" y="320" width="60" height="40" rx="5" fill="#3B82F6"/>
                    <rect x="230" y="330" width="40" height="5" fill="white"/>
                    <rect x="230" y="340" width="30" height="5" fill="white"/>
                </svg>
            </div>

            <!-- Baris Kartu Statistik -->
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stat-card card-pasien position-relative">
                        <i class="fas fa-users stat-icon" style="color: #007bff;"></i>
                        <p class="stat-label">Total Pasien</p>
                        <h2 class="stat-number"><?= $total_pasien; ?></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card-dokter position-relative">
                        <i class="fas fa-user-md stat-icon" style="color: #28a745;"></i>
                        <p class="stat-label">Total Dokter</p>
                        <h2 class="stat-number"><?= $total_dokter; ?></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card-obat position-relative">
                        <i class="fas fa-pills stat-icon" style="color: #ffc107;"></i>
                        <p class="stat-label">Total Obat</p>
                        <h2 class="stat-number"><?= $total_obat; ?></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card-rekam position-relative">
                        <i class="fas fa-notes-medical stat-icon" style="color: #dc3545;"></i>
                        <p class="stat-label">Rekam Medis</p>
                        <h2 class="stat-number"><?= $total_rekam; ?></h2>
                    </div>
                </div>
            </div>

            <!-- Kotak Info Tambahan -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                        <div class="card-body p-4 text-center">
                            <h5 class="mb-3 text-primary"><i class="fas fa-info-circle"></i> Informasi</h5>
                            <p class="text-muted mb-0">Gunakan menu di sebelah kiri untuk mengelola data Pasien, Dokter, Obat, dan melihat Riwayat Pemeriksaan. Pastikan data yang dimasukkan adalah data fiktif untuk keperluan simulasi.</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

</body>
</html>