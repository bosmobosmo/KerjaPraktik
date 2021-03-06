<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }

    require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>List VRS</title>

    <link href="IFOLIB - Informatics Open Library_files/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="IFOLIB - Informatics Open Library_files/sb-admin-2.min.css" rel="stylesheet">

    <link href="IFOLIB - Informatics Open Library_files/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Nav Item - Dashboard -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Perpustakaan ITS</div>
            </a>

            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTables" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span>
                </a>
                <div id="collapseTables" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Tables list:</h6>
                        <a class="collapse-item" href="vrs_list.php">VRS</a>
                        <a class="collapse-item" href="vrs_done.php">Finished VRS</a>
                        <a class="collapse-item" href="request_list.php">Requests</a>
                        <a class="collapse-item" href="request_done.php">Finished Requests</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts --> 
            <li class="nav-item">
                <a class="nav-link" href="stats.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Statistics</span>
                </a>
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

                    <!-- Topbar Navbar --> 
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information --> 
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                            </a>
                            <!--Dropdown - User Information --> 
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout.php">
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
                    <h1 class="h3 mb-2 text-gray-800">VRS selesai</h1>

                    <!-- Table start --> 
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>NIM/NIP</th>
                                            <th>Status</th>
                                            <th>Email</th>
                                            <th>Jenis literatur</th>
                                            <th>Judul buku</th>
                                            <th>Penulis</th>
                                            <th>Link</th>
                                            <th>Tambahan</th>
                                            <th>Tanggal kirim</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama</th>
                                            <th>NIM/NIP</th>
                                            <th>Status</th>
                                            <th>Email</th>
                                            <th>Jenis literatur</th>
                                            <th>Judul buku</th>
                                            <th>Penulis</th>
                                            <th>Link</th>
                                            <th>Tambahan</th>
                                            <th>Tanggal kirim</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $result = mysqli_query($db, "SELECT * FROM lss WHERE respond=TRUE ORDER BY dateReceived ASC;");
                                    while($row = mysqli_fetch_array($result))
                                        {
                                            echo "<tr>";
                                            echo "<td>".$row['name']."</td>";
                                            echo "<td>".$row['nimNip']."</td>";
                                            echo "<td>".$row['status']."</td>";
                                            echo "<td><a href='mailto:".$row['email']."'>Email</td>";
                                            echo "<td>".$row['literatur']."</td>";
                                            echo "<td>".$row['judul'].".</td>";
                                            echo "<td>".$row['author']."</td>";
                                            echo "<td><a href=".$row['link'].">Link</td>";
                                            echo "<td>".$row['extra']."</td>";
                                            echo "<td>".$row['dateResponded']."</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                 </div>

    <!-- Bootstrap core JavaScript--> 
    <script src="IFOLIB - Informatics Open Library_files/vendor/jquery/jquery.min.js"></script>
    <script src="IFOLIB - Informatics Open Library_files/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript--> 
    <script src="IFOLIB - Informatics Open Library_files/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages--> 
    <script src="IFOLIB - Informatics Open Library_files/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins-->
    <script src="IFOLIB - Informatics Open Library_files/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="IFOLIB - Informatics Open Library_files/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts--> 
    <script src="IFOLIB - Informatics Open Library_files/js/demo/datatables-demo.js"></script>

</body>

</html>


                    

                    


  