<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Celia Tour</title>
 <!-- Javascript de pannellum framework -->
    <script>
      ruta_base = "<?php echo $redireccion_jotpoch; ?>";
      hotspot_base = "<?php echo $idhotspot; ?>"; 
      
    </script>
    <script src="<?php echo base_url("assets/js/pannellum/src/js/pannellum2.js"); ?>"></script>
	<script src="<?php echo base_url("assets/js/pannellum/src/js/libpannellum.js"); ?>"></script>
    <!-- Css de pannellum framework -->
    <link rel="stylesheet" href="<?php echo base_url("assets/js/pannellum/src/css/pannellum.css");?>"/>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/estilos_pannellum.css");?>">
    <!--librerias JQuery & JQuery ui-->
    <script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/jqueryui/jquery-ui.min.js"); ?>"></script>
    
	<style>
	
	</style>
</head>

<body>
	<div class="contenedor">
		<div id="panorama">   
           <div class="boton_menu" id="botoncico"></div> <!--boton menu --> 
         <div id="titulo">MODO INSERCCIÓN DE PUNTOS HOTSPOT</div> 
         <div class="ctrl" id="fullscreen"></div>
        </div>
	</div>
	
<script type="text/javascript">
escena_base="";


    
$(document).ready(function() {
    
$("#botoncico").click(function(){
    location.href="<?php echo site_url("escenas");?>"
}); 
    
  function ayax(){
    $.ajax({
        url: '<?php echo base_url("tour/get_json_plataforma/".$escenaInicial) ?>',
        type: 'GET',
        dataType: 'json',
    }).done(function(data) {
                
        $.each(data.scenes, function(i){
          var escenas = data.scenes[i];
          $.each(escenas.hotSpots, function(j){
            escenas.hotSpots[j].clickHandlerFunc = eval(escenas.hotSpots[j].clickHandlerFunc);
          });
        });
        viewer = pannellum.viewer("panorama", data);
        escena_base = data.default.firstScene;
    }).fail(function() {
        console.log("error");
    })
} 
 
    function modificarHotspot(hotspotDiv, idjotpoch){
        location.href= "<?php echo site_url("/hotspots/show_update_hotspot/"); ?>"+idjotpoch+"/"+escena_base;

    }

  //boton fullscreen.
  document.getElementById('fullscreen').addEventListener('click', function(e) {
        viewer.toggleFullscreen();
  });
  ayax();
});
    
// meter en json en un string para poder modificarlo   

  
</script>
    </body>
</html>