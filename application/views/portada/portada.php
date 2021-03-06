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
<style>
    /* Eliminar el scroll de la portada */
    body{
        overflow-x: hidden;
        overFlow-y: hidden;
    }
    /* Centrar vertical y horizontalmente el div que contiene el h1, los parrafos y en boton*/
    .centrado-porcentual {
        text-align: center;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        width: 90%;
    }
    /*Estilos del titulo principal*/
    h1{
        font-size: 6vw; 
        width: 100%;
        text-shadow: 3px 3px 0px rgba(0,0,0,0.5);
    }
    /* Posicionar el pie de pagina al final */
    #footer{
        position: absolute;
        top: 85%;
    }
    /* Boton fantasma */
    .echenique{
        font-size: 20px;
        border: 3px solid;
        border-radius: 10px;
        background-color: rgba(0, 0, 0, 0.5); 
    }
    /*Aplicar una sombra al texto de la descripcion*/
    #descripcion_portada{
        text-shadow: 3px 3px 0px rgba(0,0,0,0.5);
    }

    /*Estilos de la ventana modal*/
    #styleModal{
        background-color: rgba(0,0,0,0.7)!important;
    }
</style>
<script>
    $(document).ready(function(){
        /*Ocultar el titulo y el boton historia al abrir la modal*/ 
        $("#echenique").click(function(){
            $("#titulito").fadeOut("fast");
            $("#footer").fadeOut("fast");
            $(this).fadeOut("fast");
        })
        /* Mostrar el titulo y el boton historia al cerrar la modal*/
        $("#cerrarModal").click(function(){
            $("#titulito").fadeIn("fast");
            $("#footer").fadeIn("fast");
            $("#echenique").fadeIn("fast");
        });
        /* Mostrar el titulo y el boton historia al cerrar la modal cuando haces click fuera de esta*/
        $("#modalHistoria").on('hidden.bs.modal', function () {
            $("#titulito").fadeIn("fast");
            $("#footer").fadeIn("fast");
            $("#echenique").fadeIn("fast");
        });
    });
</script>
<?php
    $color = $portada[9]['opcion_valor'];
    $fuente = $portada[8]['opcion_valor'];
    $titulo_web = $portada[0]['opcion_valor'];
    $show_historia = $portada[7]['opcion_valor'];
   
?>
<div id="slider1_portada" class="container-fluid">

    <div class="centrado-porcentual">

        <h1 style="color:<?php echo $color;?>; font-family: <?php echo $fuente;?>, sans-serif;" id="titulito"><?php echo $titulo_web ?></h1>

        <div id="parrafito">
            <p style="color:<?php echo $color;?>; font-family: <?php echo $fuente;?>, sans-serif; font-size: 3vw;" id="descripcion_portada"></p>
         
        </div>

        <div>
        <?php 
            if ($show_historia == "1") {
                // El botón "Historia" solo se muestra si está configurado así en las opciones de portada
                echo "<a style='border-color:$color; color:$color; font-family: $fuente, sans-serif' class='btn echenique mb-3' id='echenique' role='button' data-toggle='modal' data-target='#modalHistoria'>HISTORIA</a>";
            }
        ?>
        </div>

    </div>

</div>

<div class="container-fluid" id="footer">

    <p class="text-center">
        <span><a style="color:<?php echo $color?>; font-family: <?php echo $fuente;?>, sans-serif;" href="<?php echo site_url("tour/creditos");?>">Créditos |</a></span>                    
        <span><a style="color:<?php echo $color;?>; font-family: <?php echo $fuente;?>, sans-serif;" href="<?php echo site_url("tour/politicaPrivacidad");?>">Política de Privacidad |</a></span>
        <span><a style="color:<?php echo $color;?>; font-family: <?php echo $fuente;?>, sans-serif;" href="<?php echo site_url("tour/avisoLegal");?>">Aviso legal</a></span>
    </p>
    <p class="text-center">
        <span><a style="color:<?php echo $color;?>; font-family: <?php echo $fuente;?>, sans-serif;" href="<?php echo base_url("");?>">Powered by Celia Viñas 2ºDAW 17/19&nbsp;&nbsp;</a></span>
        <img src="<?php echo base_url("assets/imagenes/portada/logo.png");?>" width="20px"/>
    </p>

</div>

<!-- Modal Historia -->
<div class="modal fade" id="modalHistoria" tabindex="-1" role="dialog" width="auto" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" id="styleModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Historia</h5>
        <button type="button" class="close" data-dismiss="modal" id="cerrarModal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if(isset($portada[13]['opcion_valor'])) echo $portada[13]['opcion_valor']; ?>
      </div>
     
    </div>
  </div>
</div>