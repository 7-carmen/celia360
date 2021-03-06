<!-- MENU PRINCIPAL DEL HOMEPAGE -->
<!-- Incluye enlaces a todas las funciones accesibles desde el homepage -->
<script>
    /* Ocultar el contenido central al pulsar el boton del menu*/
    $(document).ready(function(){
        $("#botonMenu").click(function(){
            $("#slider1_portada").toggle("display");
        });
    });
</script>
<style>
    ul{
        text-align:center;
    }
    ul a{
        font-size: 30px;
        color: white;
    }
    nav{
        background-color: rgba(0, 0, 0, 0.5)!important;
    }
    .menu {
        padding-left: 0!important;
        padding-right: 0!important;
    }
    html {
        height: 100%;
        margin: 0;
    }
    /* Imagen de portada que ocupa el 100% de la pantalla */
   body{
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }
    @media (min-width: 992px) {   
        /* Centrar nav */
        ul.navbar-nav.mx-auto {
            padding-right: 50px!important;
        }
    } 
</style>
<?php
    $color = $portada[9]['opcion_valor'];
    $fuente = $portada[8]['opcion_valor']; 
?>
<div class="container-fluid menu">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="<?php echo site_url();?>">
            <img width="50px" src="<?php echo site_url("assets/imagenes/portada/".$portada[10]["opcion_valor"]); ?>"/>
        </a>
        <button id="botonMenu" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" id="opcionlibre_portada" href="<?php echo site_url("tour/visita/libre");?>" onclick="visita_opcion('get_json_libre')" style="color:<?php echo $portada[9]['opcion_valor'];?>; font-family: <?php echo $portada[8]['opcion_valor'] ;?>, sans-serif;">Visita libre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="opcionguiada_portada" href="<?php echo site_url("tour/visita/guiada");?>" onclick="/*visita_opcion('get_json_guiada')*/ getAllVisita()" style="color:<?php echo $portada[9]['opcion_valor'];?>; font-family: <?php echo $portada[8]['opcion_valor'] ;?>, sans-serif;">Visita Guiada</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="opciondestacada_portada" href="<?php echo site_url("PuntosDestacados");?>" style="color:<?php echo $portada[9]['opcion_valor'];?>; font-family: <?php echo $portada[8]['opcion_valor'] ;?>, sans-serif;">Destacados</a>
                </li>
                <li>
                    <?php 
                    // La opción de menú "biblioteca" solo se muestra si está configurado así en las opciones de portada
                    if ($portada[6]["opcion_valor"]== "1") {  
                        echo "<a class='nav-link' id='clickbiblio' href='".site_url("biblioteca/vertodosloslibros")."'style='color:$color; font-family:$fuente , sans-serif;'>Biblioteca</a>";
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav> 
      
</div><!-- Final de container-fluid -->




    
