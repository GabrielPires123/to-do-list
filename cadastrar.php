<?php

include("db.php");
if (!empty($_POST)) {


    $name = $_POST["name"];
    $date = $_POST["date"];

    $sql = "INSERT INTO cadastro (name, date) VALUES (:name, :date)";
    $st = $db->prepare($sql);
    $st->bindparam(':name', $name);
    $st->bindparam(':date', $date);
    $st->execute();
    header('Location: index.php');
    exit();
}
?>