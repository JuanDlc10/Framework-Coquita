<?php

use config\Config;

require_once realpath('./vendor/autoload.php');
$config = new Config();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./public/img/Hektakun-Pokemon-094-Gengar.72.png" type="image/x-icon">
    <title>Proyecto Final</title>
    <link rel="stylesheet" href="<?= $config->depCss('bootstrap.min.css') ?>">
    </link>
    <link rel="stylesheet" href="<?= $config->depCss('style.css') ?>">
    </link>
    <link rel="stylesheet" href="<?= $config->depCss('sweetalert.min.css') ?>">
    </link>
    <script src="<?= $config->depJs('sweetalert.all.min.js') ?>"></script>
    <script src="<?= $config->depJs('coquita.controller.js') ?>"></script>
</head>

<body>
    <?php require_once './app/config/MyRoutes.php'; ?>
    <script src="<?= $config->depJs('bootstrap.bundle.min.js') ?>" crossorigin="anonymous"></script>
</body>

</html>
