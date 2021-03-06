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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=MedievalSharp" rel="stylesheet">
	<script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
   	<link rel="stylesheet" href=" https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/ultimo-estilo.css"); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/biblio/css/default.css");?>" /> 
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/biblio/css/bookblock.css");?>" />
	<!-- custom demo style -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/biblio/css/demo1.css");?>" />
	<script src="<?php echo base_url("assets/biblio/js/modernizr.custom.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/biblio/js/jquery-3.2.1.js");?>"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
    <!-- TODO: Revisar esta fuente que se está tomando de iescelia.org/carmen-de-burgos (un sitio web que ni siquiera existe): -->
	<script src="http://iescelia.org/carmen-de-burgos/mapa/js/libs/jquery-mousewheel/jquery.mousewheel.min.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url("assets/css/estilos_portada.css"); ?>"/>

	<style type="text/css">

	</style>

<script >
	$(document).ready(function(){
		/**
		* Función encargada de abrir el libro
		*/
		$('.efectBook').click(function(){
		  //$('.modalita2').toggle('slow');
		    idlibro = $(this).attr("idlibro");
		    apaisado = $(this).attr("apaisado");
		    tipo = $(this).attr("tipo");
		    location.href = '<?php echo site_url("biblioteca/vertodosloslibros/");?>'+parseInt(idlibro)+'/'+apaisado+'/'+tipo;
		    //$('.modalita2').load('<?php //echo site_url("biblioteca/ver_biblioteca_ajax/");?>'+parseInt(idlibro)+'/'+apaisado+'/'+tipo);
		});

		/**
		* Función encargada de cerrar el libro
		*/
		$('.cerrarBook').click(function(){
		  //$('.modalita2').toggle('slow');
		    idlibro = $(this).attr("idlibro");
		    apaisado = $(this).attr("apaisado");
		    tipo = $(this).attr("tipo");
		    location.href = '<?php echo site_url("biblioteca/vertodosloslibros/");?>';
		    //$('.modalita2').load('<?php //echo site_url("biblioteca/ver_biblioteca_ajax/");?>'+parseInt(idlibro)+'/'+apaisado+'/'+tipo);
		          
		});

		/**
		* Función encargada de cerrar el libro con la tecla Esc '27'
		*/
		$(document).keyup(function(e) {
		    if (e.keyCode == 27) { // escape key maps to keycode `27`
		   	 location.href = '<?php echo site_url("biblioteca/vertodosloslibros/");?>';
		    }
		});

	}); 
</script>

<style>
	.contenedorLibro{
		position: relative;
		overflow: auto;
	};
		
	.mySlides, #persona{
    	position:absolute;
    };
	/* Color de fondo para el nav */
	nav {
    	background-color: rgba(0, 0, 0, 0.5)!important;
	}
	/* Eliminar imagen de fondo y establecer un color de fondo*/
	body{
        background-color: #2B3E50 !important;
		background-image: none!important;
	}
	td img{
		width:200px;
		height:250px;
	}

	td{
		margin-right:15px;
		margin-left:15px;
	}

	.tablatodo{
		width:200px !important;
		height:200px !important;
		padding:30px;
	}

	.headerbiblioteca{
		width:100%;
		height:115px;
		color:white;
		background:#000000d9;
	}

	.headerbiblioteca h1{
		width: 90%;
    	padding: 20px;
    	height:54px;
	}

	.iniciologo{
		width:90px;
		height:110px;
		margin-left:30px;
		margin-top:-75px;
	}

	#contenedorbiblioteca{
	    background: url('<?php echo base_url();?>assets/bibliocss/marc.jpeg');
	    width:100%;
 	} 

	.cerrarBook{
		width: 40px;
		height: 40px;
		background:#208cbf;
		color:white;
		text-align:center;
		font-size:30px;
		top: 20px;
		left: 85%;
		position: absolute;
		border-radius:5px;
	}

	#numeropag{
		position: relative;
		/*left: 45%;*/
		height: 20px;
		width: 51px;
		text-align: right;
		padding:10px;
	}

	#cantpag{
		position: relative;
		/*left: 45%;*/
		height: 20px;
		width: 51px;
		padding:10px;
	}
</style>

<body>
	
	<div id="contenedorbiblioteca">
	
	<div style='width: 280px;margin-left: 40%;padding-top: 1%;'>
		<form method='POST' action='<?php echo site_url("biblioteca/vertodosloslibros/-1/-1/-1/0") ?>'>
			<input style='padding: 2%;border-radius: 5px;border: none;' type='text' name='libro' placeholder='Buscar...'>
			<input style='border-radius: 5px;padding: 2%;background: beige;margin-left: 3%;' type='submit' value='Buscar'>
		</form>
	</div>

	<?php
		/** Mostramos todas las portadas de los libros que estén dados de alta en la Biblioteca   */
            echo "<table class='display' style='margin:0 auto'>";  
			echo "<tr>";  

		 	$i = 0;
		    foreach ($tabla as $ides){
		      //if($ides['tipo']==0){
		        $i++;
		        echo "<td class='tablatodo'>";
		        echo "<a href='#' ><img id='verlibro' idlibro='".$ides['id_libro']."' apaisado='".$ides['apaisado']."' tipo='".$ides['tipo']."' class='efectBook ocultar' src='".base_url("assets/libros/$ides[id_libro]/0.jpg")."' ></a>";echo "<div style='text-align:center;background:#1b1b1bd4;color:white;margin-top:20px;height:auto;overflow:hidden;padding:10px;'>'".$ides['titulo']."'";
		        echo "</td>";
		      //}
			
			  if ($i%4 == 0)  echo "</tr><tr class=''>";
		    }
			echo "</tr></table><div style='clear:both;'></div>";
	?>

<!-- ******************* Capa modal para mostrar el libro ****************** --> 

<?php
// Si no hay ningún libro seleccionado, no cargaremos nada en la modal
if ($id_libro == -1) return;		
?>

<!-- Mostramos el libro que se ha seleccionado -->
<div class="modalita2">
		<div class="container">
			<!-- Top Navigation -->
			<a href="#" class="cerrarBook" style="background:#303031e0;">x</a>
			<div class="mainBiblioteca clearfix">
				<div class="bb-custom-wrapper">
					<div id="bb-bookblock" class="bb-bookblock contenedorLibro" style="margin-top:5%;">
				<?php
					$directorio = "assets/libros/$id_libro";
					$arrayPag = scandir($directorio);
					$num_pag = count($arrayPag)-2;

					$directorio_PDF ="assets/pdf/$id_libro";
					$arrayPDF = scandir($directorio_PDF);
					$num_pdf = count($arrayPDF)-1;
					
				if($apaisado == 1){
					?>
					<script type="text/javascript">
					$(".contenedorLibro").css("width", "1200px");
					$(".contenedorLibro").css("height", "450px");
					$(".contenedorLibro").css("margin-left", "0%");
					</script>
					<?php
					for($i = 0; $i < $num_pag; $i++){
						if($i == 0){
							echo "<div class='bb-item'>";
							echo "<img class='book-page-image' id='".($i+1)."' src='".base_url("assets/libros/$id_libro/$i.jpg")."' data-src='".base_url("assets/libros/$id_libro/$i.jpg")."' alt='image01' style='left:300px;' width='600' height='450'>";
							echo "</div>";
						} else {
							echo " <div class='bb-item'>";
							echo "<img class='mySlides book-page-image' id='".($i+1)."' src='".base_url("assets/libros/blank.jpg")."' data-src='".base_url("assets/libros/$id_libro/$i.jpg")."' alt='image01' style='' width='1200' height='450'>";
							echo "</div>";
						 }
					}
				}else{
					?>
					<script type="text/javascript">
					$(".contenedorLibro").css("width", "900px");
					$(".contenedorLibro").css("height", "550px");
					$(".contenedorLibro").css("", "");
					</script>
					<?php
					for($i = 0; $i < $num_pag; $i++){
						if($i == 0 || $i == $num_pag-1){
							echo "<div class='bb-item'>";
							echo "<img class='book-page-image' id='".($i+1)."' src='".base_url("assets/libros/$id_libro/$i.jpg")."' data-src='".base_url("assets/libros/$id_libro/$i.jpg")."' alt='image01' style='left:224px;' width='450' height='550'>";
							echo "</div> ";
						} else {
							echo " <div class='bb-item'>";
							echo "<img class='mySlides book-page-image' id='".($i+1)."' src='".base_url("assets/libros/blank.jpg")."' data-src='".base_url("assets/libros/$id_libro/$i.jpg")."' alt='image01' style='' width='900' height='550'>";
							echo "</div> ";
						 }
					}
				}

				?>
					</div>
					<nav style="width:100%;">
						<a id="bb-nav-first" href="#" class="bb-custom-icon bb-custom-icon-first">Primera Pagina</a>
						<a id="bb-nav-prev" href="#" class="bb-custom-icon bb-custom-icon-arrow-left">Anterior</a>
						<!--  AQUI  esta el numero de pagina -->
						<span style="position:relative; top:-10px;">
						<input type='text' id='numeropag' value="1" style="width:40px;padding:5px;background:#303031e0;border:none;color:white;"><?php echo "<input type='text'  style='width:40px;padding:5px;background:#303031e0;border:none;color:white;' id='cantpag' value=' $num_pag' readonly>";?> 
						</span>
						
						<a id="bb-nav-next" href="#" class="bb-custom-icon bb-custom-icon-arrow-right">Siguiente</a>
						<a id="bb-nav-last" href="#" class="bb-custom-icon bb-custom-icon-last">Ultima Pagina</a>
					</nav>
				</div>
				<!-- Comprueba si existe un fichero de tipo PDF para el libro y si es asi muestra un boton de descargar PDF, SI NO existe dicho fichero no muestra ningun boton para descargar -->
				<?php 
					$nombre_fichero = "assets/pdf/$id_libro.pdf";
					if (file_exists($nombre_fichero)) {
						echo " 
						<div class='descargar' style=''> 
							<a href='".base_url("assets/pdf/$id_libro.pdf")."' target='_blank' style='text-decoration: none; background:#303031f5;padding:15px;color:white;border-radius:10px;float:right;position: absolute;left: 62%;top: 89%;' >Descargar PDF &nbsp;&nbsp;<i class='far fa-file-pdf'></i></a> 
						</div>"; 
					} else {
						echo " 
							<div class='descargar' style='display:none;'> 
								<a href='".base_url("assets/pdf/$id_libro.pdf")."' target='_blank' style='text-decoration: none; background:#303031f5;padding:15px;color:white;border-radius:10px;float:right;position: absolute;left: 62%;top: 89%;' >Descargar PDF &nbsp;&nbsp;<i class='far fa-file-pdf'></i></a> 
							</div>"; 
					}
				?>
			</div>

		</div>
		<!-- /container -->
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
		<script src="<?php echo base_url("assets/biblio/js/jquerypp.custom.js");?>"></script>
		<script src="<?php echo base_url("assets/biblio/js/jquery.bookblock.js");?>"></script>
		<script>
			const NUMBER_OF_PREFETCHED_PAGES = 4;

			function loadBookImages(currentPage){
				console.log(currentPage);

				let bookImages = document.getElementsByClassName('book-page-image');
				
				let firstPage = currentPage - NUMBER_OF_PREFETCHED_PAGES;
				if (firstPage < 0) firstPage = 0;

				let lastPage = currentPage + NUMBER_OF_PREFETCHED_PAGES;
				if (lastPage >= bookImages.length) lastPage = bookImages.length - 1;

				for(let i = firstPage; i < lastPage + 1; i++){
					bookImages[i].src = bookImages[i].getAttribute('data-src');
				}
			}

			var Page = (function() {
				var config = {
						$bookBlock : $( '#bb-bookblock' ),
						$navNext : $( '#bb-nav-next' ),
						$navPrev : $( '#bb-nav-prev' ),
						$navFirst : $( '#bb-nav-first' ),
						$navLast : $( '#bb-nav-last' )
					},
					init = function() {
						config.$bookBlock.bookblock( {
							speed : 800,
							shadowSides : 0.8,
							shadowFlip : 0.7
						} );
						initEvents();
					},
					initEvents = function() {
						var guardado = 1;

						// Add navigation events
						config.$navNext.on('click touchstart', function() {
							var pg = $("#numeropag").val();
							var maxpg =$("#cantpag").val();							

							pg = parseInt(pg);
							maxpg = parseInt(maxpg);

							// Desargamos algunas de las imágenes del libro
							loadBookImages(pg);

							if (pg < maxpg) {
								var newpg = parseInt(pg) + 1;
								$("#numeropag").val(newpg);
								guardado = newpg;
							}else{
								$("#numeropag").val(maxpg);
								guardado = maxpg;
							}

							config.$bookBlock.bookblock('next');
							
							$("#bb-nav-next").css("pointer-events", "none");

							setTimeout(function(){$("#bb-nav-next").css("pointer-events", "auto");}, 1000);
							return false;
						} );

						config.$navPrev.on( 'click touchstart', function() {
							var pg = $("#numeropag").val();

							// Desargamos algunas de las imágenes del libro
							loadBookImages(pg);

							if (pg != 1) {
								var newpg = parseInt(pg) - 1; 
								$("#numeropag").val(newpg);
								guardado = newpg;
							} else {
								$("#numeropag").val(1);
								guardado = 1;
							}
							config.$bookBlock.bookblock('prev');

							$("#bb-nav-prev").css("pointer-events", "none");

							setTimeout(function(){$("#bb-nav-prev").css("pointer-events", "auto");}, 1000);
							return false;
						} );

						config.$navFirst.on( 'click touchstart', function() {
							$("#numeropag").val(1);
							config.$bookBlock.bookblock( 'first' );
							guardado=1;
							// Desargamos algunas de las imágenes del libro
							loadBookImages(0);
							return false;
						} );

						config.$navLast.on( 'click touchstart', function() {
							var maxpg = $("#cantpag").val();
							$("#numeropag").val(maxpg);
							guardado = maxpg;
							config.$bookBlock.bookblock( 'last' );
							// Desargamos algunas de las imágenes del libro
							loadBookImages(ultpg);
							return false;
						} );
						
						// Add keyboard events
						$( document ).keydown( function(e) {
							var keyCode = e.keyCode || e.which,
								arrow = {
									left : 37,
									up : 38,
									right : 39,
									down : 40,
									enter : 13
								};

							switch (keyCode) {
								case arrow.left:
									var pg = $("#numeropag").val();
									pg= parseInt(pg);
									
									if (pg != 1) {
										setTimeout(function(){$("#numeropag").val(parseInt(pg)-1);}, 800);
										guardado = parseInt(pg) - 1;
									} else {
										$("#numeropag").val(1);
										guardado = 1;
									}

									// Desargamos algunas de las imágenes del libro
									loadBookImages(pg);

									config.$bookBlock.bookblock( 'prev' );
									break;

								case arrow.right:
									var pg = $("#numeropag").val();
									var maxpg =$("#cantpag").val();

									pg = parseInt(pg);
									maxpg = parseInt(maxpg);
									
									if (pg < maxpg) {
										setTimeout(function(){$("#numeropag").val(parseInt(pg) + 1);}, 800);
										guardado = parseInt(pg) + 1;
									} else {
										$("#numeropag").val(maxpg);
										guardado = maxpg;
									}

									// Desargamos algunas de las imágenes del libro
									loadBookImages(pg);

									config.$bookBlock.bookblock( 'next' );
									break;

								case arrow.enter:
									var pg = $("#numeropag").val();
									var maxpg = $("#cantpag").val();
									
									pg = parseInt(pg);
									maxpag = parseInt(maxpg);
									
									if (Number.isNaN(pg)) {
										pg = guardado;
									}

									if (pg > maxpg) {
										$("#numeropag").val(maxpg);
										config.$bookBlock.bookblock('jump', maxpg);
										guardado = maxpg;
									} else {
										$("#numeropag").val(pg);
										config.$bookBlock.bookblock('jump', pg);
										guardado = pg;
									}

									// Desargamos algunas de las imágenes del libro
									loadBookImages(pg);
									break;
							}
						} );
					};

					return { init : init };
			})();
		</script>
		<script>
				Page.init();
		</script>
		<script>
		      $(document).ready(function(){
				
			        $('.mySlides').draggable({

			           drag: function(evt,ui)
			                {
			                    var anchura = parseInt($('.mySlides').css('width').split('px')[0]);
			                    var altura = parseInt($('.mySlides').css('height').split('px')[0]);
			                    
								<?php 
			                    	if($apaisado==1){
			                    		echo"
						                    if (ui.position.left < 1200 - $(this).width() )
						                         ui.position.left = 1200 - $(this).width(); 
						                    if (ui.position.left + $(this).width()> anchura)
						                          ui.position.left = 0;
						                    if (ui.position.top < -altura+450 )
						                        ui.position.top = 450 - $(this).height();
						                    if (ui.position.top + $(this).height() > altura)
						                            ui.position.top = 0;

						                    $('html, body').scrollTop(280)";
			                    	}else{
			                    		echo"
						                    if (ui.position.left < 900 - $(this).width() )
						                         ui.position.left = 900 - $(this).width(); 
						                    if (ui.position.left + $(this).width()> anchura)
						                          ui.position.left = 0;
						                    if (ui.position.top < -altura+550 )
						                        ui.position.top = 550 - $(this).height();
						                    if (ui.position.top + $(this).height() > altura)
						                            ui.position.top = 0;

						                    $('html, body').scrollTop(280)";
			                    	}
			                    ?>			                    
			                }  
			         });
<?php 
                	if($apaisado==1){
                		echo" 
                			$('.mySlides').mousewheel(function(event, delta){
			                    x=event.pageX;
							    y=event.pageY;
								var anchura=parseInt($('.mySlides').css('width').split('px')[0]);
			                    var altura=parseInt($('.mySlides').css('height').split('px')[0]);
			                    var izquierda=parseInt($(this).css('left').split('px')[0]);
			                    var arriba=parseInt($(this).css('top').split('px')[0]);				 
								var aux1=anchura / (x-izquierda);
			                    var aux2=altura / (y-arriba);
			                    var contador=0;
			                    console.log($apaisado)
							  if(delta>0){
			                      
								  anchura+=200*delta;
								  altura+=108*delta;
								  contador+=1*delta;
								  
								  if(anchura>7700 || altura>4179){
			                            anchura=7700;
			                          altura=4179;
			                        }else{
										izquierda=(izquierda-(200*delta/aux1));
			                            arriba=(arriba-(108*delta/aux2));
			                            }
			                      
			                     
								  
							  }else{
			                      anchura-=200
			                      altura-=108
			                      
								  if(anchura<1200 || altura<450){
			                          altura=450;
			                          anchura=1200;
			                      }else{
			                          
			                          izquierda=(izquierda+(200/aux1));
			                          arriba=(arriba+(108/aux2));
			                      }
							  }
							  if (izquierda < 1200 - anchura ){
								  		var antIz=izquierda;
			                            izquierda = 1200 - anchura; 
			                            console.log('primer left: '+antIz+' < '+izquierda);
			                        }
			                         
			                        if (izquierda + anchura > anchura){
										var antIz=izquierda+anchura;
										console.log('segundo left : '+izquierda+' < '+anchura)
			                          	izquierda = 0;
			                          	console.log('segundo left despues: '+izquierda)
			                        }

			                        if (arriba < 450-altura ){
										var antAr = 450-altura;
			                            arriba = 450 - altura;
			                           console.log('primer top: '+arriba+' < '+antAr);
			                        }
			                        if (arriba + altura > altura){
										console.log(arriba+altura>altura);
										//console.log('arriba+altura: '+arriba+altura+' altura: '+altura);
			                            arriba = 0;
			                           console.log('segundo top: '+arriba)

			                        }
							  //, 
							  $('.mySlides').css({'width':anchura+'px', 'height': altura+'px','top': arriba+'px', 'left': izquierda+'px'})
							  
						  	});";
                	}else{
                		echo"
                			$('.mySlides').mousewheel(function(event, delta){
			                    x=event.pageX;
							    y=event.pageY;
								var anchura=parseInt($('.mySlides').css('width').split('px')[0]);
			                    var altura=parseInt($('.mySlides').css('height').split('px')[0]);
			                    var izquierda=parseInt($(this).css('left').split('px')[0]);
			                    var arriba=parseInt($(this).css('top').split('px')[0]);				 
								var aux1=anchura / (x-izquierda);
			                    var aux2=altura / (y-arriba);
			                    var contador=0;
			                    console.log(typeof(izquierda)+' / '+typeof(arriba))
							  if(delta>0){
			                      
								  anchura+=200*delta;
								  altura+=108*delta;
								  contador+=1*delta;
								  
								  if(anchura>7700 || altura>4179){
			                            anchura=7700;
			                          altura=4179;
			                        }else{
										izquierda=(izquierda-(200*delta/aux1));
			                            arriba=(arriba-(108*delta/aux2));
			                            }			                     
								  
							  }else{
			                      anchura-=200
			                      altura-=108
			                      
								  if(anchura<900 || altura<550){
			                          altura=550;
			                          anchura=900;
			                      }else{
			                          
			                          izquierda=(izquierda+(200/aux1));
			                          arriba=(arriba+(108/aux2));
			                      }
							  }
							  if (izquierda < 900 - anchura ){
								  		var antIz=izquierda;
			                            izquierda = 900 - anchura; 
			                            console.log('primer left: '+antIz+' < '+izquierda);
			                        }
			                         
			                        if (izquierda + anchura > anchura){
										var antIz=izquierda+anchura;
										console.log('segundo left : '+izquierda+' < '+anchura)
			                          	izquierda = 0;
			                          	console.log('segundo left despues: '+izquierda)
			                        }

			                        if (arriba < 550-altura ){
										var antAr = 550-altura;
			                            arriba = 550 - altura;
			                           console.log('primer top: '+arriba+' < '+antAr);
			                        }
			                        if (arriba + altura > altura){
										console.log(arriba+altura>altura);
										//console.log('arriba+altura: '+arriba+altura+ altura: '+altura);
			                            arriba = 0;
			                           console.log('segundo top: '+arriba)

			                        }
							  //, 
							  $('.mySlides').css({'width':anchura+'px', 'height': altura+'px','top': arriba+'px', 'left': izquierda+'px'})
							  
						  	});
			                		";
                	}

                ?>
		      });

			  $( '.mySlides' ).on( 'mousewheel DOMMouseScroll', function ( e ) {
                var e0 = e.originalEvent,
                    delta = e0.wheelDelta || -e0.detail;

                this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
                e.preventDefault();
            	});

  </script>   

</div>