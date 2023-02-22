<?php
include_once('../model/databases_empresa.php');
session_start();
if($_POST)
{
 $correo = isset( $_POST['correo']) ? $_POST['correo'] : '';
 $password = isset( $_POST['password']) ? $_POST['password'] : '';
 $user =get_user_acces($correo);
 if( $user['dt_password']==$password and $user['tp_usuario']==1)
 {    
	$_SESSION["id"]=$user['id_usuario'];
  ?>
				<script>
				<?php if($user['tp_estatus']==NULL) { ?>
					window.location="../view/datos_empresa.php"
				<?php } elseif($user['tp_estatus']==1) { ?>
					window.location="../view/digital_empresa.php"				
				<?php } elseif($user['tp_estatus']==2) { ?>
					window.location="../view/vacantes.php"				
				<?php } ?> 
				</script>
<?php
     die();
 }else{
?>
				<script>
					window.location="../"
				</script>
			<?php
    
 }

} 
?>