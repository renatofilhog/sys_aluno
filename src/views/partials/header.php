<!--
=========================================================
* Argon Dashboard - v1.1.1
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)
* Coded by Creative Tim
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Sys Aluno
    </title>
    <!-- Favicon -->
        <link href="<?=$base?>/assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="<?=$base?>/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="<?=$base?>/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="<?=$base?>/assets/css/argon-dashboard.css?v=1.1.1" rel="stylesheet" />
</head>

<?php
if (isset($_SESSION['loginInfos']['user'])){
    $path = $_SESSION['loginInfos']['user']['role'] . '/nav';
    $render($path,$viewData);
}
?>

