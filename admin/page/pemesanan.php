<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    die();
}

require '../../db/koneksi.php';
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

/**
 * ✅ Update status
 * Dipanggil ketika dropdown berubah (POST)
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $id     = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    // Validasi status agar sesuai ENUM
    $allowed = ['pending', 'processing', 'completed', 'cancelled'];
    if (!in_array($status, $allowed, true)) {
        header("Location: pemesanan.php?gagal=invalid_status");
        exit();
    }

    // Pastikan ID valid
    if ($id > 0) {
        $stmt = $koneksi->prepare("UPDATE pemesanan SET status = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("si", $status, $id);
            if ($stmt->execute()) {
                header("Location: pemesanan.php?sukses=update");
            } else {
                header("Location: pemesanan.php?gagal=db_error");
            }
            $stmt->close();
        } else {
            header("Location: pemesanan.php?gagal=stmt_prepare");
        }
    } else {
        header("Location: pemesanan.php?gagal=invalid_id");
    }
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pemesanan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts & Icons -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- SB Admin & DataTables -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-robot"></i>
            </div>
            <div class="sidebar-brand-text mx-3">ULOS.id</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item"><a class="nav-link" href="home.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a class="nav-link" href="produk.php"><i class="fas fa-code"></i><span>Produk</span></a></li>
        <li class="nav-item active"><a class="nav-link" href="pemesanan.php"><i class="fas fa-code"></i><span>Pemesanan</span></a></li>
        <li class="nav-item"><a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline"><button class="rounded-circle border-0" id="sidebarToggle"></button></div>
    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?php echo ucwords($_SESSION['username'] ?? ''); ?>
                            </span>
                            <img class="img-profile rounded-circle" src="../img/undraw_profile.svg" alt="profile">
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Page Content -->
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Pemesanan</h1>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Pemesanan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Barang</th>
                                        <th>Nama Pembeli</th>
                                        <th>Nomor Pembeli</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Catatan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no  = 1;
                                $sql = mysqli_query($koneksi, "SELECT * FROM pemesanan ORDER BY tanggal DESC");
                                while ($data = mysqli_fetch_assoc($sql)) { ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($data['barang'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($data['pembeli'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($data['nowa'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($data['email'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($data['alamat'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($data['pesan'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($data['tanggal'] ?? ''); ?></td>
                                        <td style="min-width: 160px;">
                                            <form method="POST">
                                                <input type="hidden" name="update_status" value="1">
                                                <input type="hidden" name="id" value="<?php echo (int)($data['id'] ?? 0); ?>">

                                                <select name="status" class="form-control" onchange="this.form.submit()">
                                                    <?php
                                                    // ENUM list yang diizinkan
                                                    $statuses = ['pending' => 'Pending', 'processing' => 'Processing', 'completed' => 'Completed', 'cancelled' => 'Cancelled'];
                                                    $current  = $data['status'] ?? 'pending';
                                                    foreach ($statuses as $val => $label) {
                                                        $sel = ($current === $val) ? 'selected' : '';
                                                        echo '<option value="'.htmlspecialchars($val).'" '.$sel.'>'.htmlspecialchars($label).'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <a href="#">Riko Ulos</a> 2025</span>
                </div>
            </div>
        </footer>

    </div>
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<!-- Scripts -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../js/sb-admin-2.min.js"></script>

<!-- SweetAlert2 (karena dipakai di bawah) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Inisialisasi DataTables -->
<script>
  $(document).ready(function () {
    $('#dataTable').DataTable({
      lengthMenu: [5, 10, 25, 50],
      pageLength: 10
    });
  });
</script>

<!-- Notifikasi -->
<?php
if (isset($_GET['sukses'])) {
    echo "<script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Status berhasil diperbarui',
            showConfirmButton: false,
            timer: 1500
        });
    </script>";
} elseif (isset($_GET['gagal'])) {
    $msg = 'Gagal memperbarui status';
    if ($_GET['gagal'] === 'invalid_status') $msg = 'Status tidak valid';
    if ($_GET['gagal'] === 'invalid_id')     $msg = 'ID pesanan tidak valid';
    if ($_GET['gagal'] === 'db_error')       $msg = 'Kesalahan database';
    if ($_GET['gagal'] === 'stmt_prepare')   $msg = 'Gagal menyiapkan statement';
    echo "<script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '".htmlspecialchars($msg, ENT_QUOTES)."',
            showConfirmButton: false,
            timer: 1800
        });
    </script>";
}
?>
</body>
</html>
