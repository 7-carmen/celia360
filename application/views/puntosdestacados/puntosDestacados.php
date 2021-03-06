<?php
/*
    Este archivo es parte de la aplicación web Celia360. 

    Celia 360 es software libre: usted puede redistribuirlo y/o modificarlo
    bajo los términos de la GNU General Public License tal y como está publicada por
    la Free Software Foundation en su versión 3.
 
    Celia 360 se distribuye con el propósito de resultar útil,
    pero SIN NINGUNA GARANTÍA de ningún tipo. 
    Véase la GNU General Public License para más detalles.

    Puede obtener una copia de la licencia en <http://www.gnu.org/licenses/>.
*/
?>
<!DOCTYPE html>
<html lang="es">
 <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <title>Destacados</title>
     <link rel="stylesheet" href="<?php echo base_url("assets/css/estilo_pd.css");?>">
     <meta name="viewport" content="width=device-width, user-scalable=no ,initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
     <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
         <!-- Javascript de pannellum framework -->
    <script src="<?php echo base_url("assets/js/pannellum/src/js/pannellum.js"); ?>"></script>
	<script src="<?php echo base_url("assets/js/pannellum/src/js/libpannellum.js"); ?>"></script>
    <!-- Css de pannellum framework -->
    <link rel="stylesheet" href="<?php echo base_url("assets/js/pannellum/src/css/pannellum.css");?>"/>
    <!-- Css de pannellum -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/estilos_pannellum.css");?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/estilos_mapa_panellum.css");?>">
</head>
    <body>
        <div id="contenedor" style="z-index:1000; background: white;">
            <div class="boton_menu" id="botoncico"></div> <!--boton menu --> 
        <?php 
            
						$contador = 0 ;
							$cuenta = 0; //comprueba que haya puntos destacados
							for($i=0;$i<5;$i++){
								if(count($puntos_d[$i]) > 0){
									$cuenta++;
								}
							}

							if($cuenta > 0){
						
						// este for saca las celdas y las va colocando según su fila
						foreach($puntos_d as $fila){ 
                $longitud = count($fila);
                if($longitud!=0){
                    echo '<div class="slider">';
                          $contador = $contador + 1;
                          foreach($fila as $celda){
                              echo ' <a class="grid-item" onclick=saltarEscena("'.$celda["escena_celda"].'")>
                                         <div class="grid-item__image" style="background-image: url('.base_url($celda["imagen_celda"]).')"></div>
                                         <div class="grid-item__hover"></div>
                                         <div class="grid-item__name">'.$celda["titulo_celda"].'</div>
                                         <input type="hidden" value="'.$celda["id_celda"].'">
                                    </a>';
                          }
                   echo '</div>';
                }
						}

						?>
						<?php

					}else{
						echo '<div id="error_guiada" style="display:block;">
						<h3 style="text-align: center;">Puntos destacados</h3>
						<div class="mensaje_guiada_inicio_recomendacion">
							<hr class="mensaje_separador"> 
							
							<h1 style="text-align: center">Pendiente de introducción de datos para el desarrollo del mismo</h1>
							
							<hr class="mensaje_separador">
						</div>
	
						<a href="'. base_url() .'" id="hrefVolver">
							<div id="volverPrincipal"></div>
						</a>
					</div>';
					}
					
        ?>    
        </div>
        
        <div class="contenedor">
          <div id="panorama"> <!--div donde se carga pannellum -->
           <div class="boton_menu"></div> <!--boton menu --> 
          <div class="ctrl" id="fullscreen"></div> <!--boton full screen-->
         </div> 
       </div>  
        
        <script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>

        <script>
            $("#botoncico").click(function(){
                location.href="<?php echo site_url("index.php");?>"
            });
            
            function saltarEscena(codscene){
                viewer.loadScene(codscene);
                $("#contenedor").fadeOut();
                $(".contenedor").fadeIn();
            }
            
            $(".boton_menu").click(function(){
                $("#contenedor").fadeIn();
                $(".contenedor").fadeOut();         
            });
            
            
						$.ajax({
                url: "<?php echo base_url("tour/get_json_destacados"); ?>",
                type: 'GET',
                dataType: 'json'
              }).done(function(data) {
                  $.each(data.scenes, function(i){
                    var escenas = data.scenes[i];
                    $.each(escenas.hotSpots, function(j){
                      escenas.hotSpots[j].clickHandlerFunc = eval(escenas.hotSpots[j].clickHandlerFunc);
                    });
                  });
                  viewer = pannellum.viewer("panorama", data);
            });
            

            
            function panelInformacion(hotspotDiv,args){
                  $(".modal").css("visibility","visible");
                  var peticion = $.ajax({
                    url: "<?php echo base_url("hotspots/load_panel"); ?>",
                    type:"post",
                    data:{id_hotspost : args},
                    beforeSend: function(){
                      //Cambiar el valor del texto y titulo
                      $("#titulo").html("Cargando...");
                      $("#texto").html("Cargando...");
                      //Borrar las tiras creadas en el punto anterior
                      $(".GmySlides").each(function(){
                        $(this).remove();
                      });
                    }
                  });

                peticion.done(function(datos){
                  var prueba = JSON.parse(datos);
                  //Cargamos una vez los datos basicos
                  $("#titulo").html(prueba[0].titulo_panel);
                  $("#texto").html(prueba[0].texto_panel);
                  //La primera imagen que sale al abrir el panel
                  var enlace_img =  "<?php echo base_url("assets/imagenes/imagenes-hotspots/")?>"+prueba[0].url_imagen;
                  $("#gallery").find("img").attr("src",enlace_img);
                  //Por cada indice del array creamos la imagen de la galeria
                  for(var i=0;i<prueba.length;i++){
                    //Para poner bien el enlace con codeigniter guardamos en la variable la url y luego se la pasamos
                    var enlace = "<?php echo base_url("assets/imagenes/imagenes-hotspots/")?>"+prueba[i].url_imagen;
                    $(".Gmodal-content").append("<img class='GmySlides' src='"+enlace+"' style='width:100%'>");
                  }
                  //Pone el indice
                  var slideIndex = 1;
                  showSlides(slideIndex);  
                });

                  $('.modal').css('display','block');
                  $(window).click(function(event){
                    if($(event.target).hasClass("modal")){ 
                     $('.modal').css('display','none');
                    }
                  });

                  $('#close').click(function(event){
                    $('.modal').css('display','none');
                  });
                
                }
            
              //boton fullscreen.
            document.getElementById('fullscreen').addEventListener('click', function(e) {
              viewer.toggleFullscreen();
            });
        </script>
        <script src="<?php echo base_url("assets/js/metodosHotspots.js");?>"></script>
</body>
</html>
