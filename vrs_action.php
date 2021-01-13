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
    $literatur = mysqli_real_escape_string($db, $_REQUEST['literatur']);
    $judul = mysqli_real_escape_string($db, $_REQUEST['judul']);
    $author = mysqli_real_escape_string($db, $_REQUEST['author']);
    $link = mysqli_real_escape_string($db, $_REQUEST['link']);
    $extra = mysqli_real_escape_string($db, $_REQUEST['extra']);
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO lss (name, nimNip, status, email, literatur, judul, author, link, extra, dateReceived) VALUES ('$name', '$nimnip', '$status', '$email', ' $literatur', '$judul', '$author', '$link', '$extra', '$date')";
    
    mysqli_query($db, $sql);

    mysqli_close($db);
    Redirect('received.html', false);
?>
