<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title>Celia Tour</title>
    <!-- CSS SLICK -->

    <link href="<?php base_url("assets/css/admin_style.css"); ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?php base_url("assets/imagenes/portada/icono.ico"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/estilos_pannellum.css");?>">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/mapa.js"); ?>"></script>


       
    <!-- CSS CMS -->
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/admin_style.css"); ?>"/>
    <style type="text/css">
        p{
            text-align: center;
        }
    </style>
    
    <?php 
        error_reporting(7);
            if (!ini_get('display_errors')) {
                ini_set('display_errors', '0');
            }
    ?>
</head>
	
<body>
    <?php
	if (isset($error)) {
		echo "<p style='color:red'>".$error."</p>";
	}
	if (isset($mensaje)) {
		echo "<p style='color:green'>".$mensaje."</p>";
	}

    ?>

<div id="fondo">