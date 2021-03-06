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
// a continuacion nos encontramos con el css de las ventanas modales de la vista audio.
?>

<div class="container mt-2">
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<h1 class="text-center">Formulario para insertar Hotspots</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<div class="card">
			<div class="card-body">
			<p>Un hotspot es un punto de una escena en el que al hacer click se activará una función, el tipo del hotspot determinará la acción resulante del click, las tipos de hotspot son los siguientes:</p>
			</div>
		</div>
		
		<div class="card mb-2">
			<div class="card-body">
			<div class="col-md-12 text-center">
			<?php
		if($tabla == 1){
			echo '<button class="botondentromapa btn btn-primary ml-1 mr-1" id="btnInsertarPanel">Punto de panel informativo</button>
			<button class="botondentromapa btn btn-primary ml-1 mr-1" id="btnInsertarAudio">Punto audiodescrito</button>
			<button class="botondentromapa btn btn-primary ml-1 mr-1" id="btnInsertarVideo">Punto video</button>';
		}else{
			echo '<button class="botondentromapa btn btn-primary ml-1 mr-1" id="btnInsertarEscena" >Salto a otra escena</button>
			<button class="botondentromapa btn btn-primary ml-1 mr-1" id="btnInsertarPanel">Panel informativo</button>
			<button class="botondentromapa btn btn-primary ml-1 mr-1" id="btnInsertarAudio">Punto audiodescrito</button>
			<button class="botondentromapa btn btn-primary ml-1 mr-1" id="btnInsertarVideo">Punto video</button>
			<button class="botondentromapa btn btn-primary ml-1 mr-1" id="btnInsertarEscaleras">Ascensor</button>
			<button class="botondentromapa btn btn-primary ml-1 mr-1" id="btnHibrido">Super salto</button>
			';
			
		}
	?>
	</div>
			</div>
		</div>
		</div>
		<div id="cosas" class="col-md-12 col-xs-12">
		
		<div id="formularios">
    <div id="puntoEscena"> 
    <div id="caja4">
        <?php
        echo "<form action='".   site_url("hotspots/process_insert_scene")   ."' method='get'>"; ?>
            <input type='hidden' name='id_scene'  readonly="readonly" value='<?php echo $id_scene ?>'>
            <input type='hidden' name='pitch'  readonly="readonly" value=' <?php echo $pitch ?> '> 
            <input type='hidden' name='yaw'  readonly="readonly" value=' <?php echo $yaw ?> '> 
            <input type='hidden' name='cssClass' value='custom-hotspot-salto' readonly="readonly">
            <input type='hidden' name='tipo' value='scene' readonly="readonly">
            <input type='hidden' name='clickHandlerFunc' value='puntos' readonly="readonly">
            <input type='hidden' name='clickHandlerArgs' readonly='readonly'>
            
			<div class="card mt-2 mb-2">
				<div class="card-body">
					<p class="text-center"> Selecciona una escena (en rojo donde estás, amarillo donde se saltará)</p>
				</div>
			</div>
           
            <div id="mapa_escena_hotspot" >
				<div class="row">
					<div class="col-md-8 col-xs-12">
					<?php
                $indice = $this->session->piso;
                
                    
                    echo "<div id='zona".$indice."' class='pisos pisos_hotspots'>";
                    echo "<img src='".base_url($mapa[$indice]['url_img'])."' class='img img-fluid'>";
                    foreach ($puntos as $punto) {
                        if($punto['piso']==$indice){
                            if($punto['id_escena'] == $id_scene){
                                echo "<div id='punto".$punto['id_punto_mapa']."' class='punto_inicial' style='left: ".$punto['left_mapa']."%; top: ".$punto['top_mapa']."%;' escena='".$punto['id_escena']."'></div>";
                            }else{
                                echo "<div id='punto".$punto['id_punto_mapa']."' class='puntos' style='left: ".$punto['left_mapa']."%; top: ".$punto['top_mapa']."%;' escena='".$punto['id_escena']."'></div>";
                            }
                        }
                    }
                    echo "</div>";
                   
            ?>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="card">
							<div class="card-body">
							<div class="form-group">
						<label for="scenesalto">Salto destino</label>
						<input type='text' name='sceneId' placeholder="Selecciona un punto en el mapa" required class="form-control">
					</div>

					<div class="form-group">
						<input type='submit' class="button btn btn-success">
					</div>
							</div>
						</div>
					
					
            		
					</div>
				</div>
        
            
            </div>
            
           
        </form>
            </div>
    </div>

    <div id="puntoPanel"> 
    <div id="caja3">
			<div class="row">
			<div class="col-md-12">
				<div class="card mt-2">
					<div class="card-body">
					<?php
        echo "<form enctype='multipart/form-data' action='".site_url("hotspots/process_insert_panel/".$tabla)."' method='post'>"; ?>
            <input type='hidden' name='id_scene'  readonly="readonly" value='<?php echo $id_scene ?>'> 
			<?php  if(isset($escena_principal))
				echo "<input type='hidden' name='escena_principal'  readonly='readonly' value='$escena_principal'>"
			?>
            <input type='hidden' name='pitch' value='<?php echo $pitch ?>'>
            <input type='hidden' name='yaw' value='<?php echo $yaw ?>'> 
            <input type='hidden' name='cssClass' value='custom-hotspot-info' readonly="readonly">
            <input type='hidden' name='tipo' value='info' readonly="readonly">
            <input type='hidden' name='clickHandlerFunc' value='panelInformacion' readonly="readonly">
            <input type='hidden' name='clickHandlerArgs' value='<?php echo $id_hotspot ?>' readonly='readonly'> 
            <div class="form-group">
				<label for="tituloPanel">Título del panel</label>
				<input class="input-text form-control" type='text' name='titulo' required>
			</div>
			<div class="form-group">
					<label for="descPanel">Texto del panel</label>
					<div id="editor"></div>
			</div>
			
			<input type="hidden" name="texto" id="descripcion_texto">
            <input type="hidden" name="MAX_FILE_SIZE" value="200000000000" />
			<div class="card">
				<div class="card-body">
					<div class="form-group">
					<label  class="blanco" style='text-justify: auto;'>seleccionar PDF (OPCIONAL)<br><span class='panel-informacion-texto'>Permite visionar el documento PDF en el panel</span></label>
					<input type="file" name="documento" class='form-control-file' placeholder="Seleccionar la imagen">
					</div>
					
					<div class="form-group">
					<input type='submit' class="btn btn-success button">
					</div>
				</div>
				
			</div>
            
            
            <!--
            <select name="documentoPanel">
            <option value="ninguno">ninguno</option>
                <?php 
                    /*foreach ($documentos as $doc) {
                        $documento=$doc["documento_url"];
                        $documentoIdentificador= $doc["id_documento"];
                       
                            echo "<option value=$documento>$documento</option>";
                    }*/
                ?>
            </select>
            <br><br>-->
            
        </form>
					</div>
				</div>
			
    </div>
	</div>   
	
	<script>
        var quill = new Quill('#editor', {
            modules: {
        toolbar: [
           ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
           ['blockquote', 'code-block', 'link'],

           [{ 'header': 1 }, { 'header': 2 }],               // custom button values
           [{ 'list': 'ordered'}, { 'list': 'bullet' }],
           [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
           [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
           [{ 'direction': 'rtl' }],                         // text direction

           [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
           [{ 'font': [] }],
           [{ 'align': [] }],

           ['clean']                                         // remove formatting button
       ]
    },
  theme: 'snow'
});

        Quill.prototype.getHtml = function() {
            return this.container.firstChild.innerHTML;
        };

        quill.on('text-change',function(a,b,c){
            document.getElementById('descripcion_texto').value = quill.getHtml();
        });

      </script>
			</div>
			</div>
        
    
    <!-- Seccion hotspot de tipo audio -->
    <div id="puntoAudio"> 
    <div id="caja3">
		<div class="row">
			<div class="col-md-12">
				<div class="card mt-2">
					<div class="card-body">
					<?php
        echo "<form action='".   site_url("hotspots/process_insert_audio/".$tabla)   ."' method='get'>"; ?>
            <input type='hidden' name='id_scene'  readonly="readonly" value='<?php echo $id_scene ?>'>
            <input type='hidden' name='pitch' value='<?php echo $pitch ?>'>
            <input type='hidden' name='yaw' value='<?php echo $yaw ?>'>
            <input type='hidden' name='cssClass' value='custom-hotspot-audio' readonly="readonly">
            <input type='hidden' name='tipo' value='info' readonly="readonly">
            <input type='hidden' name='clickHandlerFunc' value='musica' readonly="readonly">
			
			<div class="form-group">
				<label for="audio">Selecciona el audio en la tabla</label>
				<input type='text' class="form-control" name='clickHandlerArgs' id='idAudioForm' required>
			</div>

			<div class="form-group">
				<input type='submit' class="btn btn-success button">
			</div>

			


            
        </form>
					</div>
				</div>
			
    </div>
        
        
    </div>
			</div>
			<div class="row">
				<div class="col-md-12">
				<div id="listaAudios">
            <?php 
                echo"<table class='tabla_audio table table-hover' id='cont'>
                        <thead>
                            <tr id='cabecera'>
                            <th>ID</th>
                            <th>URL</th>
                            <th>Descripcion</th>
                            <th>Tipo de audio</th>
                            <th>Reproducir</th>
                            <th>Seleccionar</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr id='cabecera'>
                            <th>ID</th>
                            <th>URL</th>
                            <th>Descripcion</th>
                            <th>Tipo de audio</th>
                            <th>Reproducir</th>
                            <th>Seleccionar</th>
                            </tr>
                        </tfoot>
                    <tbody>";

                    foreach ($listaAudios as $re) {

                        $id = $re["id_aud"];
                        echo'<tr id="contenidoaudio' . $id . '">';
                        echo'<td id="id_aud' . $id . '">' . $re["id_aud"] . '</td>';
                        echo'<td id="url_aud' . $id . '">' . $re["url_aud"] . '</td>';
                        echo'<td id="desc_aud' . $id . '">' . $re["desc_aud"] . '</td>';
                        echo'<td id="tipo_aud' . $id . '">' . $re["tipo_aud"] . '</td>';
                        echo"<td><audio controls='controls' preload='auto'>
                            <source src='" . base_url($re["url_aud"]) . "' type='audio/m4a'/>
                            <source src='" . base_url($re["url_aud"]) . "' type='audio/mp3'/>
                            </audio></td>".
                            '<td onClick="seleccionarAudio('.$id.')"><a href="#">Seleccionar</a></td>'.
                            "</tr>";
                    }
                    echo "</tbody>";
                echo "</table>";
            ?>
        </div>
				</div>
			</div>
		</div>
        <!-- Formulario para insertar un hotspot de tipo audio -->
        
    <!-- FIN sección hotspot de tipo audio -->
    
    <div id="puntoVideo">
    <div id="caja3">
		<div class="row">
			<div class="col-md-12">
				<div class="card mt-2">
					<div class="card-body">
					<?php
        echo "<form action='".   site_url("hotspots/process_insert_video/").$tabla   ."' method='get'>"; ?>
			<input type='hidden' name='id_scene'  readonly="readonly" value='<?php echo $id_scene ?>'>
            <input type='hidden' name='pitch' value='<?php echo $pitch ?>'>
             <input type='hidden' name='yaw' value='<?php echo $yaw ?>'>
            <input type='hidden' name='cssClass' value='custom-hotspot-video' readonly="readonly"> 
            <input type='hidden' name='tipo' value='info' readonly="readonly">
            <input type='hidden' name='clickHandlerFunc' value='video' readonly="readonly">
			
			<div class="form-group">
				<label for="video">Selecciona un vídeo en la tabla</label>
				<input type='text' class="form-control" name='clickHandlerArgs' id='idVideoForm' required>
			</div>

			<div class="form-group">
				<input type='submit' class="btn btn-success button">
			</div>

			 

            
        </form>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
			<div id="listaVideos">
            <?php
                echo"<table class='tabla_video table table-hover' id='video'>
                        <thead>
                            <tr id='cabecera'>
                            <th>ID</th>
                            <th>URL</th>
                            <th>Descripcion</th>
                            <th>Ver vídeo</th>
                            <th>Seleccionar</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr id='cabecera'>
                            <th>ID</th>
                            <th>URL</th>
                            <th>Descripcion</th>
                            <th>Ver vídeo</th>
                            <th>Seleccionar</th>
                            </tr>
                        </tfoot>
                    <tbody>";

                    foreach ($listaVideos as $re) {

                        $id = $re["id_vid"];
                        echo'<tr id="contenidovideo' . $id . '">';
                        echo'<td id="id_aud' . $id . '">' . $re["id_vid"] . '</td>';
                        echo'<td id="url_aud' . $id . '">' . $re["url_vid"] . '</td>';
                        echo'<td id="desc_aud' . $id . '">' . $re["desc_vid"] . '</td>';
                        echo'<td><a href="' . $re["url_vid"] . '" target="_blank">Visitar enlace</a></td>'.
                            '<td onClick="seleccionarVideo('.$id.')"><a href="#">Seleccionar</a></td>'.
                            '</tr>';
                    }
                    echo "</tbody>";
                echo "</table>";
            ?>
        </div>
			</div>
		</div>
        
    </div>
        
        
    </div>

    <div id="puntoEscaleras">
    <div id="caja3">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body text-center">
						<p class="text-center"> Esto creará un punto de tipo escalera, el cual conecta las distintas zonas</p>
					
						<?php
        echo "<form action='".   site_url("hotspots/process_insert_escaleras")   ."' method='get'>"; ?>
           
            <input type='hidden' name='id_scene'  readonly="readonly" value='<?php echo $id_scene ?>'> 
            <input type='hidden' name='pitch' value=' <?php echo $pitch ?> '>
            <input type='hidden' name='yaw' value=' <?php echo $yaw ?> '>
            <input type='hidden' name='cssClass' value='custom-hotspot-escaleras' readonly="readonly"> 
            <input type='hidden' name='tipo' value='info' readonly="readonly">
            <input type='hidden' name='clickHandlerFunc' value='escaleras' readonly="readonly"> 
            <input type='submit' class="button btn btn-success">
        </form>
					</div>
				</div>
			</div>
		</div>
       
    </div>
	</div>

	<!-- selecion de planta -->
    <div id="puntoHibrido">
        <div id="caja3">
        <?php
                $mapa = array_reverse($mapa);

                foreach ($mapa as $imagen) {
                $piso = $imagen["piso"];
                $escena_inicial = $imagen["escena_inicial"];
                $punto_inicial = $imagen["punto_inicial"];
                $titulo_piso = $imagen["titulo_piso"];
                echo '<button id="p'.$piso.'" class="plantas bg-secondary" value="'.$piso.'" >'.$titulo_piso.'</button>';
                }
                echo "</div>";//div final de myModal
            ?>
    </div>

	<!-- fin de seleccion de planta-->
	
<!--hibrido entre escaleras y salto de escena -->
<div id="puntoHibridoMapa"> 
    <div id="caja4">
        <?php
        echo "<form action='".   site_url("hotspots/process_insert_scene")   ."' method='get'>"; ?>
            <input type='hidden' name='id_scene'  readonly="readonly" value='<?php echo $id_scene ?>'>
            <input type='hidden' name='pitch'  readonly="readonly" value=' <?php echo $pitch ?> '> 
            <input type='hidden' name='yaw'  readonly="readonly" value=' <?php echo $yaw ?> '> 
            <input type='hidden' name='cssClass' value='custom-hotspot-saltoEspec' readonly="readonly">
            <input type='hidden' name='tipo' value='superSalto' readonly="readonly">
            <input type='hidden' name='clickHandlerFunc' value='puntosEspec' readonly="readonly">
            
			
			
             
            <div id="mapa_escena_hotspot" >
			<div class="row mt-2">
			<div class="col-md-8 col-xs-12">
<?php			
            $numeroPlanta= count($mapa);
            
           for($i=0;$i<=$numeroPlanta-1;$i++){

                    echo "<div id='planta".$i."' class='pisos_hotspots' style='display :none;'>";

                    echo "<img src='".base_url($mapa[$i]['url_img'])."' class='img img-fluid'>";
                    foreach ($puntos as $punto) {

                        $indice = $numeroPlanta - $i;
                        $indice = $indice -1;
                        if($punto['piso']==$indice){
                            
                            if($punto['id_escena'] == $id_scene){
                                echo "<div id='punto".$punto['id_punto_mapa']."' class='punto_inicial' style='left: ".$punto['left_mapa']."%; top: ".$punto['top_mapa']."%;' escena='".$punto['id_escena']."'></div>";
                            }else{
                                echo "<div id='punto".$punto['id_punto_mapa']."' class='puntos' style='left: ".$punto['left_mapa']."%; top: ".$punto['top_mapa']."%;' escena='".$punto['id_escena']."'></div>";
                            }
                        }
                    }
                    echo "</div>";
                
                   

                }
                echo" </div>";
                
            ?>
			 <div class="col-md-4 col-xs-12">
				 <div class="card">
					 <div class="card-body">
					 <div class="form-group">
					<label for="escene">Salto destino</label>
					<input type='text' id='sceneId' name='sceneId' placeholder="Selecciona un punto en el mapa" required class="form-control">
				</div>
				<div class="form-group">
					<label for="actual">Zona actual</label>
					<input  id="plantaDestino" type='text' name='plantaDestino' class="form-control text-info" required readonly>
				</div>
				<div class="form-group">
				<input type='submit' class="button btn btn-success">
				</div>
					 </div>
				 </div>
				
			</div>
			</div>
            
		   <input type='hidden' name='clickHandlerArgs' id="clickHandlerArgs" value='' readonly='readonly'>
           
        </form>
            </div>
			</div>

<!-- FIN hibrido entre escaleras y dalto de escena -->

</div>
</div>
		</div>
	</div>
</div>

    <div id="botones">
    
        
    <div id="botonesderecha">
	
    </div>    
    </div>



    <script>
      $( document).ready(function() {

			// Activamos la paginación y la búsqueda en la tabla de audios/videos
			$("#cont, #video").dataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados en su búsqueda",
                "searchPlaceholder": "Buscar registros",
                "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
                "infoEmpty": "No existen registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "search": "Buscar:",
                "paginate": {
                        "first":    "Primero",
                        "last":    "Último",
                        "next":    "Siguiente",
                        "previous": "Anterior"
                },
            }
            });


        $("#formularios").children().hide();
          
        $("#btnInsertarEscena").click(function() {
			$('input[name="sceneId"]').val('');
            $("#formularios").children().hide();
            $("#puntoEscena").show();
        });
          
        $("#btnInsertarPanel").click(function() {
            $("#formularios").children().hide();
            $("#puntoPanel").show();
        });
          
        $("#btnInsertarAudio").click(function() {
            $("#formularios").children().hide();
            $("#puntoAudio").show();
        });

         $("#btnInsertarVideo").click(function() {
            $("#formularios").children().hide();
            $("#puntoVideo").show();

        });
          
        $("#btnInsertarEscaleras").click(function() {
            $("#formularios").children().hide();
            $("#puntoEscaleras").show();
        });
          
        /*$("#btnModificarPitchYaw").click(function(){
          var resp = confirm("¿Desea que al entrar en esta escena se mire hacia esta dirección?")
            if(resp)
                location.href= '<?php echo site_url("hotspots/") ?>' + "update_escena_pitchyaw/" + <?php echo $pitch ?> + "/" + <?php echo $yaw ?> + "/" + "<?php echo $id_scene ?>"; 
		});*/
		
		$("#btnHibrido").click(function() {
            
			
			clase = document.getElementsByClassName("plantas"); 
            numeroPlanta = clase.length; 
            $("#formularios").children().hide();
           $("#puntoHibrido").show();
			$(".plantas").click(function(){
                
            indice = $(this).attr("value");
            texto = $(this).text();
            
                
				
               $("#puntoHibridoMapa").show();
                indice = numeroPlanta-indice;
                indice = indice-1;
               for(i=0;i<numeroPlanta;i++){
                    $("#planta"+i).hide();
                }
				
                $("#planta"+indice).show();
				$('#puntoHibrido').hide();
                $("#plantaDestino").val(texto);
    
                $("#clickHandlerArgs").val(texto);
              

        });
    

      }); // fin document.ready
		 
	});
         
        function seleccionarAudio(idAudio) {
            document.getElementById("idAudioForm").value = idAudio;
        }
        
        function seleccionarVideo(idVideo) {
            document.getElementById("idVideoForm").value = idVideo;
        }
           
    </script> 



