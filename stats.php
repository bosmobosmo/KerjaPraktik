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

    <title>Statistik</title>

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
                <div class="sidebar-brand-text mx-3">IFOLIB</div>
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

                    <div class="row">
                        
                        <!-- Grafik pengguna bulanan -->
                        <div class="col-xl-8 col-lg-7">

                            <div class='card shadow mb-4'>
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik pengguna bulanan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="monthlyUser"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Tabel pengguna bulanan -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tabel pengguna bulanan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="monthlyTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <?php
                                                    $months = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember");
                                                    echo "<th>".$months[(date('m')+9) % 12]."</th>";
                                                    echo "<th>".$months[(date('m')+10) % 12]."</th>";
                                                    echo "<th>".$months[(date('m')+11) % 12]."</th>";
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $twoMonthsAgoUsers = mysqli_query($db, "SELECT * FROM lss WHERE (MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 2 MONTH)))");
                                                $lastMonthUsers = mysqli_query($db, "SELECT * FROM lss WHERE (MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                                                $thisMonthUsers = mysqli_query($db, "SELECT * FROM lss WHERE (MONTH(dateReceived) = MONTH(NOW()))");
                                                echo "<tr>";
                                                echo "<td>".mysqli_num_rows($twoMonthsAgoUsers)."</td>";
                                                echo "<td>".mysqli_num_rows($lastMonthUsers)."</td>";
                                                echo "<td>".mysqli_num_rows($thisMonthUsers)."</td>";                                                    
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Grafik permintaan informasi bulan lalu-->
                        <div class="col-xl-8 col-lg-7">

                            <div class='card shadow mb-4'>
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik permintaan informasi bulan lalu</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <canvas id="requestType"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!--Tabel permintaan informasi bulan lalu--> 
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tabel permintaan informasi bulan lalu</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="requestTypeTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Buku Teks</th>
                                                    <th>Artikel Jurnal</th>
                                                    <th>Skripsi/Thesis/Disertasi</th>
                                                    <th>Laporan Penelitian</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $bukuTeks = mysqli_query($db, "SELECT * FROM lss WHERE (literatur LIKE '%Buku Teks%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                                                $jurnal = mysqli_query($db, "SELECT * FROM lss WHERE (literatur LIKE '%Artikel Jurnal%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                                                $skripsi = mysqli_query($db, "SELECT * FROM lss WHERE (literatur LIKE '%Skripsi/Thesis/Disertasi%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                                                $laporan = mysqli_query($db, "SELECT * FROM lss WHERE (literatur LIKE '%Laporan Penelitian%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                                                echo "<tr>";
                                                echo "<td>".mysqli_num_rows($bukuTeks)."</td>";
                                                echo "<td>".mysqli_num_rows($jurnal)."</td>";
                                                echo "<td>".mysqli_num_rows($skripsi)."</td>";
                                                echo "<td>".mysqli_num_rows($laporan)."</td>";
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Grafik pengguna bulan lalu-->
                        <div class="col-xl-8 col-lg-7">

                            <div class='card shadow mb-4'>
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik pengguna bulan lalu</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie">
                                        <canvas id="userTypes"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!--Tabel pengguna bulan lalu--> 
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tabel pengguna bulan lalu</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="userTypeTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Dosen</th>
                                                    <th>Tendik</th>
                                                    <th>Mahasiswa S1</th>
                                                    <th>Mahasiswa S2</th>
                                                    <th>Mahasiswa S3</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $dosen = mysqli_query($db, "SELECT * FROM lss WHERE (`status` LIKE '%Dosen%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                                                $tendik = mysqli_query($db, "SELECT * FROM lss WHERE (`status` LIKE '%Tendik%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                                                $s1 = mysqli_query($db, "SELECT * FROM lss WHERE (`status` LIKE '%Mahasiswa S1%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                                                $s2 = mysqli_query($db, "SELECT * FROM lss WHERE (`status` LIKE '%Mahasiswa S2%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                                                $s3 = mysqli_query($db, "SELECT * FROM lss WHERE (`status` LIKE '%Mahasiswa S3%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                                                echo "<tr>";
                                                echo "<td>".mysqli_num_rows($dosen)."</td>";
                                                echo "<td>".mysqli_num_rows($tendik)."</td>";
                                                echo "<td>".mysqli_num_rows($s1)."</td>";
                                                echo "<td>".mysqli_num_rows($s2)."</td>";
                                                echo "<td>".mysqli_num_rows($s3)."</td>";
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    <script src="IFOLIB - Informatics Open Library_files/vendor/chart.js/Chart.min.js"></script>
    
    <!-- Page level custom scripts--> 
    <script>
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';
        var d = new Date();
        var month = new Array();
        month[0] = "Januari";
        month[1] = "Februari";
        month[2] = "Maret";
        month[3] = "April";
        month[4] = "Mei";
        month[5] = "Juni";
        month[6] = "Juli";
        month[7] = "Agustus";
        month[8] = "September";
        month[9] = "Oktober";
        month[10] = "Nopember";
        month[11] = "Desember";

        var thisMonth = d.getMonth();

        var ctx = document.getElementById("monthlyUser");
        var monthlyUser = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [month[(thisMonth+10) % 12], month[(thisMonth + 11) % 12], month[thisMonth]],
                datasets: [{
                    label: "lss",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: [
                        <?php
                        $dua_bulan_lalu = mysqli_query($db, "SELECT * FROM lss WHERE (MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 2 MONTH)))");
                        echo mysqli_num_rows($dua_bulan_lalu);
                        ?>,
                        <?php
                        $bulan_lalu = mysqli_query($db, "SELECT * FROM lss WHERE (MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                        echo mysqli_num_rows($bulan_lalu);
                        ?>,
                        <?php
                        $bulan_ini = mysqli_query($db, "SELECT * FROM lss WHERE (MONTH(dateReceived) = MONTH(NOW()))");
                        echo mysqli_num_rows($bulan_ini);
                        ?>
                    ]
                },
                {
                    label: "bukubaru",
                    backgroundColor: "#1cc88a",
                    hoverBackgroundColor: "#17a673",
                    borderColor: "#1cc88a",
                    data: [
                        <?php
                        $dua_bulan_lalu = mysqli_query($db, "SELECT * FROM bukubaru WHERE (MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 2 MONTH)))");
                        echo mysqli_num_rows($dua_bulan_lalu);
                        ?>,
                        <?php
                        $bulan_lalu = mysqli_query($db, "SELECT * FROM bukubaru WHERE (MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                        echo mysqli_num_rows($bulan_lalu);
                        ?>,
                        <?php
                        $bulan_ini = mysqli_query($db, "SELECT * FROM bukubaru WHERE (MONTH(dateReceived) = MONTH(NOW()))");
                        echo mysqli_num_rows($bulan_ini);
                        ?>
                    ]
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        },
                            maxBarThickness: 25,
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 200,
                                maxTicksLimit: 5,
                                padding: 10
                                
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                                }
                            }],
                        },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10
                },
            }
        });
    </script>

    <script>
        var ctx = document.getElementById("requestType");
        var requestType = new Chart(ctx, {
            type: 'pie',
            data:{
                labels: ["Buku Teks", "Jurnal", "Skripsi/Thesis/Disertasi", "Laporan Penelitian"],
                datasets:[{
                    data: [
                        <?php
                        $textBook = mysqli_query($db, "SELECT * FROM lss WHERE (literatur LIKE '%Buku Teks%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                        echo mysqli_num_rows($textBook);
                        ?>,
                        <?php
                        $jurnal = mysqli_query($db, "SELECT * FROM lss WHERE (literatur LIKE '%Artikel Jurnal%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                        echo mysqli_num_rows($jurnal);
                        ?>,
                        <?php
                        $skripsi = mysqli_query($db, "SELECT * FROM lss WHERE (literatur LIKE '%Skripsi/Thesis/Disertasi%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                        echo mysqli_num_rows($skripsi);
                        ?>,
                        <?php
                        $laporan = mysqli_query($db, "SELECT * FROM lss WHERE (literatur LIKE '%Laporan Penelitian%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                        echo mysqli_num_rows($laporan);
                        ?>
                    ],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#6FDEB9'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#3CC0BD'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: true
                },
                cutoutPercentage: 65
            }
        });
    </script>

    <script>
        var ctx = document.getElementById("userTypes");
        var userTypes = new Chart(ctx, {
            type: 'pie',
            data:{
                labels: ["Dosen", "Tendik", "Mahasiswa S1", "Mahasiswa S2", "Mahasiswa S3"],
                datasets:[{
                    data: [
                        <?php
                        $dosen = mysqli_query($db, "SELECT * FROM lss WHERE (`status` LIKE '%Dosen%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                        echo mysqli_num_rows($dosen);
                        ?>,
                        <?php
                        $tendik = mysqli_query($db, "SELECT * FROM lss WHERE (`status` LIKE '%Tendik%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                        echo mysqli_num_rows($tendik);
                        ?>,
                        <?php
                        $s1 = mysqli_query($db, "SELECT * FROM lss WHERE (`status` LIKE '%Mahasiswa S1%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                        echo mysqli_num_rows($s1);
                        ?>,
                        <?php
                        $s2 = mysqli_query($db, "SELECT * FROM lss WHERE (`status` LIKE '%Mahasiswa S2%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                        echo mysqli_num_rows($s2);
                        ?>,
                        <?php
                        $s3 = mysqli_query($db, "SELECT * FROM lss WHERE (`status` LIKE '%Mahasiswa S3%' AND MONTH(dateReceived) = (MONTH(NOW() - INTERVAL 1 MONTH)))");
                        echo mysqli_num_rows($s3);
                        ?>
                    ],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#6FDEB9', '#BCE8D8'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#3CC0BD', '#B3D2D0'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: true
                },
                cutoutPercentage: 65
            }
        });
    </script>


</body>

</html>


                    

                    


  