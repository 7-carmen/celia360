<!--- por adaptar a codeigniter -->

<!DOCTYPE html>
<html lang="es">
 <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <title>Destacados</title>
     <link rel="stylesheet" href="<?php echo base_url("assets/css/estilo_pd.css");?>">
     <meta name="viewport" content="width=device-width, user-scalable=no ,initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
     <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">

</head>
    //Para acceder al array de celdas: $puntos_d[$fila][$celda]["id_celda"]

    <!--- esto se construirá a partir de un array sacado del modelo -->
    <body>
        <div id="contenedor">
            
        <?php 
              echo'
                 <div class= "slider">
                      <div id="opciones_fila">
                          <button>Mostrar</button>
                          <button>Ocultar</button>
                          <button>Añadir celda</button>
                      </div>
                      <a class="grid-item">
                             <div class="grid-item__image" style="background-image: url('.$puntos_d[$fila][$celda]["imagen_celda"].')"></div>
                             <div class="grid-item__hover"></div>
                             <div class="grid-item__name">'.$puntos_d[$fila][$celda]["titulo_celda"].'</div>
                             <input type="hidden" value="'.$puntos_d[$fila][$celda]["id_celda"].'">
                      </a>
                 </div> 
                 ';
        ?>    
        </div>
           
        <script>
            $(".grid-item").click(function(){
               //location.href= vista() 
                $(this).children().last().val();
            });
        </script>
</body>
</html>