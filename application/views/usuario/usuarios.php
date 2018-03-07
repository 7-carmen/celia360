
<style type="text/css">
    
    
    #modificar{
        display:none;
        z-index: 1;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        border: 3px solid ;
        background-color:rgb(0,0,0); 
        background-color:rgba(0,0,0,0.4);
    }

    #insertar{
        display:none;
        z-index: 1;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        border: 3px solid ;
        background-color:rgb(0,0,0); 
        background-color:rgba(0,0,0,0.4);
    }

</style>

<?php
//Tabla usuarios
 echo"<a class='insert' onclick='mostrar()' > Insertar Usuario</a>";
echo "<table id='cont'>
       <tr id='cabecera'> 
        <th>Nick</th>
        <th>Contraseña</th>
        <th>Correo</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Tipo</th>
        <th>Modificar</th>
        <th>Borrar</th>
       </tr>     
        ";
        
foreach ($tablaUsuarios as $usu) {
   
   $idusu = $usu["id_usuario"];
    echo"<tr id='usu".$idusu."'>
            <td id='nick_usuario_".$idusu."'>".$usu["nombre_usuario"]."</td>
            <td>".$usu["password"]."</td>
            <td id='email_usuario_".$idusu."'>".$usu["email"]."</td>
            <td id='name_usuario_".$idusu."'>".$usu["nombre"]."</td>
            <td id='ape_usuario_".$idusu."'>".$usu["apellido"]."</td>";
        if($usu["tipo_usuario"]==0){
            echo "<td id='tipo_usuario".$idusu."'style='color:red;'>Usuario pendiente de asignación</td>";
        }elseif ($usu["tipo_usuario"]==1) {
            echo "<td id='tipo_usuario".$idusu."'>Admin</td>";
        }elseif ($usu["tipo_usuario"]==2) {
            echo "<td id='tipo_usuario".$idusu."'>Mapero</td>";
        }elseif ($usu["tipo_usuario"]==3) {
            echo "<td id='tipo_usuario".$idusu."'>Bibliotecario</td>";
        }    
     
    

    echo"   <td>
                <a href='#' onclick='modusuario(".$usu["id_usuario"].")'><i class='fa fa-edit'></i></a>
            </td>
            <td>
                <a href='#' onclick='borrarusuario(".$usu["id_usuario"].")'><i class='fa fa-trash'></i></a>
            </td>
        </tr>";
}
echo "</table>";

//Capa formulario modificar
echo "
<div id='modificar'>
    <div id='caja'>
    <h1>Modificar usuario</h1>
    <form action='".site_url("usuario/modUsuario")."' method='get'>

        <label for='username'>Nombre de usuario</label>
        <input type='text' name='username' id='form_modif_nick'><br/>
        <br/>
        <label for='pass'>Password</label>
        <input type='text' name='pass' required><br/><br/>
        <label for='email'>Email</label><br/>
        <input type='text' name='email' id='form_modif_email'><br/><br/>
        <label for='name'>Nombre</label>
        <input type='text' name='nombre' id='form_modif_nombre' ><br/><br/>
        <label for='subname'>Apellidos</label>
        <input type='text' name='apellidos' id='form_modif_ape'><br/><br/>
        <label for='tipo'>Tipo</label><br/>
        <select name='tipo' id='form_modif_tipo'>
                <option value='0'>Pendiente asignación</option>
                <option value='1'>Admin</option>
                <option value='2'>Mapero</option>
                <option value='3'>Bibliotecario</option>
        </select>
        <input type='hidden' name='id' id='form_modif_id'><br/>
        <input type=submit value='Modificar'>
         <input type='button' onclick='cerrar()' value='Cerrar'>
    </form>
   
    </div>
</div>";

//Capa formulario insertar
echo"
<div id='insertar'>
    <div id='caja'>
<h1>Registro de usuarios</h1>
<form action='".site_url("usuario/processregisterform")."' method='get'>

    <label for='username'>Nombre de usuario</label>
    <input type='text' name='username' id='username'>
    <label for='pass'>Password</label>
    <input type='password' id='pass' name='pass'>
    <label for='email'>Correo</label>
    <input type='text' name='email' id='email'>
    <label for='name'>Nombre</label>
    <input type='text' name='nombre' id='nombre'>
    <label for='subname'>Apellidos</label>
    <input type='text' name='subname' id='subname'>
    <input type='submit'>
    <input type='button' onclick='cerrar()' value='Cerrar'>
    
</form>
    </div>    
</div>";

?>




<script>

        function borrarusuario(idusu){
            resultado=confirm("¿Desea borrar el usuario?");
            if(resultado){ 
            $.get("<?php echo base_url('usuario/borrarusuario/'); ?>" + idusu, null, respuesta);
            }
        }

        function respuesta(r) {
            if (r == 0) {
                alert("Ha ocurrido un error al borrar");
            }
            else {
                selector = "#usu"+parseInt(r);
                $(selector).remove();
            }
        }

        function modusuario(idusu){
            email = "email_usuario_"+idusu;
            nick = "nick_usuario_"+idusu;
            nombre = "name_usuario_"+idusu;
            ape = "ape_usuario_"+idusu;
            tipo = "tipo_usuario"+idusu;
            document.getElementById("form_modif_email").value = document.getElementById(email).innerHTML;
            document.getElementById("form_modif_nick").value = document.getElementById(nick).innerHTML;
            document.getElementById("form_modif_nombre").value = document.getElementById(nombre).innerHTML;
            document.getElementById("form_modif_ape").value = document.getElementById(ape).innerHTML;
            aux = document.getElementById(tipo).innerHTML;
            
            if(aux=='Admin'){
                document.getElementById("form_modif_tipo").selectedIndex='1';
            }else if(aux=='Mapero'){
                document.getElementById("form_modif_tipo").selectedIndex='2';
            }else if(aux=='Bibliotecario'){
                document.getElementById("form_modif_tipo").selectedIndex='3';
            }else{
                document.getElementById("form_modif_tipo").selectedIndex='0';
            }
            
            document.getElementById("form_modif_id").value = idusu;
            
            $("#modificar").css('display','block');
        }

        function mostrar(){
            $("#insertar").show();
        }

        function cerrar(){
            $("#insertar").hide();
             $("#modificar").hide();
        }    
       
</script>
