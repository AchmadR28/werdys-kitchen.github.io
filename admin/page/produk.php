<?php 
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    die();
}
require '../../db/koneksi.php';
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Produk</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ULOS.id</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="produk.php">
                <i class="fas fa-code"></i>
                    <span>Produk</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pemesanan.php">
                <i class="fas fa-code"></i>
                    <span>Pemesanan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo ucwords($_SESSION['username']); ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../logout.php" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Produk</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-10">
                                    <h6 class="m-0 font-weight-bold text-primary pt-2">Etalase</h6>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-icon-split pull-right" data-toggle="modal" data-target="#tambah_produk">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus-circle"></i>
                                        </span>
                                        <span class="text">Tambah Produk</span>
                                    </button>
                                </div>
                            </div>                    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>no</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php 
                                                $no = 1;
                                                $sql = mysqli_query($koneksi, "SELECT * FROM produk");
                                                while ($data = mysqli_fetch_assoc($sql)) {
                                            ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <th><img src="../../assets/produk/<?php echo $data['gambar']; ?>" alt="<?php echo $data['gambar']; ?>" class="img-thumbnail" width="100px"></th>
                                            <td><?php echo $data['nama']; ?></td>
                                            <?php 
                                                $harga_bersih = preg_replace('/[^0-9]/', '', $data['harga']); 
                                                $harga_format = number_format((int)$harga_bersih, 0, ',', '.');
                                                ?>
                                            <td>Rp. <?= $harga_format; ?></td>

                                            <td>
                                                <button 
                                                    class="btn btn-warning btn-icon-split btn-edit" 
                                                    data-id="<?= $data['id']; ?>"
                                                    data-nama="<?= htmlspecialchars($data['nama']); ?>"
                                                    data-harga="<?= htmlspecialchars($data['harga']); ?>"
                                                    data-gambar="<?= htmlspecialchars($data['gambar']); ?>"
                                                >
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                    <span class="text">Edit</span>
                                                </button>

                                                <a href="./include/hapus-produk.php?id=<?= $data['id']; ?>" class="btn btn-danger btn-icon-split btn-del">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <span class="text">Hapus</span>
                                                </a>
                                            </td>
                                        </tr>
                                            <?php 
                                                ini_set("display_errors","Off");
                                                } 
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <a href="#">Riko Ulos</a> 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?php include './include/modal.php' ?>
    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <?php
        if(isset($_GET['sukses'])){
            echo "<script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Berhasil',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>";
        }else if(isset($_GET['gagal'])){
            echo "<script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Gagal',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>";
        }   
    ?>

    <script>
    $('.btn-del').on('click',function(e) {
        e.preventDefault();
        const href = $(this).attr('href')
        Swal.fire({
            title: 'Hapus Produk?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'delete'
        }).then((result) => {
            if (result.value) {
            document.location.href = href;
            }
        })
        })
    </script>

   <!-- edit produk -->
    <script>
        $(".btn-edit").on("click", function() {
            let id     = $(this).data("id");
            let nama   = $(this).data("nama");
            let harga  = $(this).data("harga");
            let gambar = $(this).data("gambar");

            $("#edit-id").val(id);
            $("#edit-nama").val(nama);
            $("#edit-harga").val(harga);
            $("#preview-gambar").attr("src", "../../assets/produk/" + gambar);

            $("#edit_produk").modal("show");
        });
    </script>
    

</body>

</html>
