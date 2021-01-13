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

    $id = mysqli_real_escape_string($db, $_POST['id']);
    $date = date('Y-m-d H:i:s');
    // echo "$id";
    // $id = $_POST['id'];
    $sql = "UPDATE bukubaru SET respond=TRUE WHERE id=$id";
    mysqli_query($db, $sql);

    mysqli_close($db);
    Redirect('request_list.php',false);
?>