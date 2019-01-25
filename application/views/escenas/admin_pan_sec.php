<style>

    .cerrar{
        position: relative;
        top:15px;
        left:44%;

    }
    .img-cerrar{
        width: 20px;
        height: 20px;
    }

</style>
<?php 
	echo "Panel de administración de escenas secundarias";
?>
<a class="insert" onclick="mostrar('insertar',0)"><i class='fas fa-plus-circle'></i> Nueva imagen</a>


<table id="cont" class="display" align="center">
	<thead>
	<tr id="cabecera">
		<th>Título</th>
		<th>Fecha</th>
		<th>Imagen - Modificar Pith-Yaw</th>
		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>
	</thead>
	<tfoot>
		<tr id="cabecera">
			<th>Título</th>
			<th>Fecha</th>
			<th>Imagen - Modificar Pith-Yaw</th>
			<th>Modificar</th>
			<th>Eliminar</th>
		</tr>
	</tfoot>
	<tbody>
	<?php 
		if(isset($tabla_escena_secundaria)){
		for($i=0;$i<count($tabla_escena_secundaria);$i++){
			$info = $tabla_escena_secundaria[$i];
			echo "<tr id='imagen-".$info['id_panorama_secundario']."'>
				<td class='titulo-img'>".$info['titulo']."</td>
				<td class='fecha-img'>".$info['fecha_acontecimiento']."</td>
				<td class='url-img'> <a href='".base_url('Panoramas_Secundarios/cargar_escena/'.$info['id_panorama_secundario'])."/update_escena_pitchyaw/'><img src='". base_url($info['panorama'])."' class='imagen-img'></a></td>
				<td><i class='fa fa-edit' style='font-size:30px;' onclick='mostrar(\"modificar\", \"".$info['id_panorama_secundario']."\");'></i></td>
				<td><i class='fa fa-trash delete' id='".$info['id_panorama_secundario']."' style='font-size:30px;'></i></td>
			</tr>";
		}
	}
	?>
	</tbody>
</table>

<div id='insertar'>
    <div id='caja'>
        <!-- CAMPOS DE LA TABLA : id_imagen,  titulo_imagen,  texto_imagen,  url_imagen , fecha -->
        <!-- AQUI EMPIEZA LA VISTA -->
        <?php
        echo"<a class='cerrar' href='#' onclick='cerrar()'><img class='img-cerrar' src='" .
        base_url("assets/css/cerrar_icon.png") . "'></img></a>";
        ?>
        <h1>Insertar imagen</h1>
        <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
        <div id="drag_upload_file">
        <?php 
         if(isset($resultado))
             echo "<h1>". $resultado."</h1>"; 

         ?>
            <p>Arrastra los archivos</p>
            <p>o</p>
            <p><button class="btn btn-primary" value="Selecciona archivos" onclick="file_explorer();">Selecciona las imágenes</button></p>
            <div id="imagenesView">

            </div>

            <input type="file" id="selectfile" name="file[]" multiple accept="image/jpeg">
            <p><button id="btnEnvio" class="btn btn-primary" type="button">Subir imágenes</button></p>
           
        </div>
    </div>
    </div>
</div>

<div id='modificar'>
    <div id='caja'>
        <?php
        echo"<a class='cerrar' href='#' onclick='cerrar()'><img class='img-cerrar' src='" .
        base_url("assets/css/cerrar_icon.png") . "'></img></a>";
        ?>
        <h1>Modificar Imagen</h1>
        <!-- CAMPOS DE LA TABLA : id_imagen,  titulo_imagen,  texto_imagen,  url_imagen , fecha -->
        <form enctype="multipart/form-data"  action='<?php echo site_url("Panoramas_secundarios/updatePanorama"); ?>' method='post'>
            <?php
			echo "<input type='hidden' name='id_escena_principal' id='id_escena_principal' value=''><br/>";
            echo "<input type='hidden' name='id_imagen' id='id_modificar' value=''><br/>";
            echo "T&iacute;tulo:<input type='text' id='titulo_modificar' name='titulo_imagen' value=''><br/>";
            //echo "<br>Descripción:<input type='text' id='texto_imagen_modificar' name='texto_imagen' value=''><br/>";

            echo '<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />';
            echo "<br>Fecha:<input type='date' id='fecha_modificar' name='fecha'  value=''><br/>";
            ?>   
            <input type='submit' name ='actualizar' value = 'Aceptar'>
        </form>
    </div>
</div>

<script>
	 function borrar_imagen(id_imagen) {
        if (confirm("¿Estás seguro?")) {
            $.get("<?php echo site_url('imagen/borrar_imagen/'); ?>" + id_imagen, null, respuesta);
        }
    }

    function respuesta(r) {
        if (r.trim() == "0") {
			document.getElementById("mensajemenu").innerHTML = "<span id='error_cabecera'>Error al borrar la imagen.</span>";
		} else if (r.trim() == "-1") {
			document.getElementById("mensajemenu").innerHTML = "<span id='error_cabecera'>Ésta imagen está en uso en un hotspot y no se puede borrar.</span>";
            
        } else {
            
            document.getElementById("mensajemenu").innerHTML = "<span id='mensaje_cabecera'>Imagen borrada con éxito.</span>";
			
			selector = "#imagen-"+parseInt(r);
			
            $(selector).remove();
			
        }
    }
  
    function mostrar(capa,id){
        if (capa == "insertar") {
            $("#insertar").show();     
        }
        if (capa == "modificar") {
            
           titulo = $("#imagen-"+id).find(".titulo-img").text();
           fecha  = $("#imagen-"+id).find(".fecha-img").text();
           url = $("#imagen-"+id).find(".url-img").text();
		   imagen = $("#imagen-"+id).find(".imagen-img").attr("src");//la imagen
		   id_pan_sec = $("#imagen-"+id).find(".delete").attr("id");

		   id_escena = <?php echo $tabla_escena_secundaria[0]["id_escena"] ?>

            $("#titulo_modificar").val(titulo);
            $("#fecha_modificar").val(fecha);
			$("#id_modificar").val(id_pan_sec);
			$("#id_escena_principal").val(id_escena);
            
            $("#modificar").show();     
        }    
    }

    function cerrar(){
        $("#insertar").hide();
        $("#modificar").hide();
    }  
 
//PAGINACIÓN CON JQUERY LOLI
    $(document).ready(function() {
        $('#cont').dataTable({
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
    });


	    var fileobj = [];
    function upload_file(e) {
        e.preventDefault();
          for(i=0;i<e.dataTransfer.files.length;i++){
            fileobj.push(e.dataTransfer.files[i]);
          }
		  previewfile(fileobj);
          ajax_file_upload(fileobj);
		}

 
    function file_explorer() {
		salir = false;
		document.getElementById('selectfile').click();
        itemPadre = document.getElementById("drag_upload_file");
        document.getElementById('selectfile').onchange = function() {

          for(i=0;i<document.getElementById('selectfile').files.length;i++){
            fileobj.push(document.getElementById('selectfile').files[i]);

			if(fileobj[i].name.includes('png')){
				salir = true;
			}
          }

		  if(salir){
			fileobj = [];
			document.getElementById("error_cabecera").innerHTML = "Solo se aceptan formatos jpg";

		  }else{
          	previewfile(fileobj);
          	ajax_file_upload(fileobj);
		  }
        };
    }
    var contador = 1;
    var acumulable = 0;

    function previewfile(file) {
      for(i = 0;i<file.length;i++){
        if(file[i].name.includes("JPG") || file[i].name.includes('jpg')){
          var reader = new FileReader();
          reader.onload = function (event) {
			var image = new Image();
			image.setAttribute("class","imagenesDragDrop");
            var inputName = document.createElement("input");
            var label = document.createElement("label");
            var label2 = document.createElement("label");
            var fecna = document.createElement("input");
            fecna.setAttribute("type",'date');
            fecna.setAttribute('name','fecha'+contador);
            fecna.setAttribute("id","fecha"+contador);
            var contentLabel = document.createTextNode("Título de imágen "+contador+": ");
            var contentLabelFecna = document.createTextNode("Fecha de imágen "+contador+": ");
            label.setAttribute("for","nombre"+contador);
            label.appendChild(contentLabel);
            label2.setAttribute("for","fecha"+contador);
            label2.appendChild(contentLabelFecna);
            inputName.setAttribute("type","text");
            inputName.setAttribute("name","nombre"+contador);
			inputName.setAttribute("id","nombre"+contador);
			inputName.setAttribute("class","nombresClass");
            contador++;
            image.src = event.target.result;
            image.width = 250; // a fake resize
            image.height = 250;
            document.getElementById("imagenesView").appendChild(label);
            document.getElementById("imagenesView").appendChild(inputName);
            document.getElementById("imagenesView").appendChild(label2);
            document.getElementById("imagenesView").appendChild(fecna);
            document.getElementById("imagenesView").appendChild(image);
            acumulable++;
          }
		  reader.readAsDataURL(file[i]);
        }
      }
	}

	

	function compruebaCampo(){
		for(i=0;i<$("input[class=nombresClass]").length;i++){
			valor = document.getElementById("nombre"+(i+1)).value;
			if(valor == ""){
				return false;
			}
		}

		return true;
	}

 
    function ajax_file_upload(file_obj) {
      document.getElementById("btnEnvio").addEventListener('click',function(){
		if(compruebaCampo()){
			var form_data = new FormData();
            for(var i = 0;i<file_obj.length;i++){                 
              form_data.append('file[]', file_obj[i]);
            }

            for(var j = 1;j<=acumulable;j++){
              form_data.append('nombre'+j,document.getElementById("nombre"+j).value);
              form_data.append('fecha'+j,document.getElementById("fecha"+j).value);
            }
            var myNode = document.getElementById("imagenesView");
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('Panoramas_Secundarios/insertSecondaryPanorama/'.$datos_escena[0]['id_escena']); ?>',
                contentType: false,
                processData: false,
                data: form_data,
                success:function(result){
                  console.log(result);

                  if(result == 0){
                    document.getElementById("mensaje_cabecera").innerHTML = "Imágenes subidas con éxito";
                    document.getElementById("error_cabecera").innerHTML= '';
                  }else{
                    document.getElementById("error_cabecera").innerHTML = "Error al insertar todas las imágenes";
                   
                  }
				}
            });
		}else{
			alert("FALTAN CAMPOS POR RELLENAR");
		}   
		});
		fileobj = [];
		contador = 1;
		acumulable = 0;
		form_data = "";
	}

 //DELETE POR AJAX

 $(document).ready(function(){
	 $(".delete").click(function(){

		respuesta = confirm("¿Estás seguro?");
		if(respuesta == true){

		id = $(this).attr("id");
		eliminar = $(this).parent().parent().remove();
		url = "<?php echo base_url('Panoramas_secundarios/deletePanorama/');?>"+id;
		$.get( url, function( data ) {
			switch (data.trim()) {
				case "-1":
					$("#error_cabecera").html("Hubo problemas al eliminar la imagen.");
				break;

				case "1": 
					$("#mensaje_cabecera").html("Imagen borrada con éxito");
					eliminar;
				break;
			
			}
			});
		}
	 });
 });
</script>


