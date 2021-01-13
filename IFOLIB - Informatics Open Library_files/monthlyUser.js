<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }

    require_once "IFOLIB - Informatics Open Library_files/config.php";
?>

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
        labels: [month[thisMonth-2], month[thisMonth-1], month[thisMonth]],
        datasets: [{
            label: 'Jumlah request',
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
                    max: 3,
                    maxTicksLimit: 5,
                    padding: 10,
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
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + number_format(tooltipItem.yLabel);
                }
            }
        },
    }
});