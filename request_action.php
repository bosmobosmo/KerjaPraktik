<?php
    require_once "config.php";

    function Redirect($url, $permanent = false)
    {
        if (headers_sent() === false)
        {
            header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
        }

        exit();
    }


    $name = mysqli_real_escape_string($db, $_REQUEST['fullname']);
    $nimnip = mysqli_real_escape_string($db, $_REQUEST['NIMNIP']);
    $status = mysqli_real_escape_string($db, $_REQUEST['status']);
    $email = mysqli_real_escape_string($db, $_REQUEST['email']);
    $judul = mysqli_real_escape_string($db, $_REQUEST['judul']);
    $author = mysqli_real_escape_string($db, $_REQUEST['author']);
    $publisher = mysqli_real_escape_string($db, $_REQUEST['publisher']);
    $isbn = mysqli_real_escape_string($db, $_REQUEST['ISBN']);
    $year = mysqli_real_escape_string($db, $_REQUEST['year']);
    $price = mysqli_real_escape_string($db, $_REQUEST['price']);
    $link = mysqli_real_escape_string($db, $_REQUEST['link']);
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO bukubaru (name, nimNip, status, email, judul, author, publisher, isbn, year, price, link, dateReceived) 
            VALUES ('$name', '$nimnip', '$status', '$email', '$judul', '$author', '$publisher', '$isbn', '$year', '$price', '$link', '$date')";
    
    mysqli_query($db, $sql);

    mysqli_close($db);
    Redirect('received.html', false);
?>
