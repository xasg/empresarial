<?php
include_once('../model/databases_beneficiario.php');
session_start();
if($_POST)
{
 $correo = isset( $_POST['correo']) ? $_POST['correo'] : '';
 $password = isset( $_POST['password']) ? $_POST['password'] : '';
 $user =get_user_acces($correo);
 if($user['dt_password']==$password and $user['tp_usuario']==2)
 {    
	$_SESSION["id"]=$user['id_usuario'];
  ?>
				<script>
					<?php if($user['tp_estatus']==NULL) { ?>
					window.location="../view/datospersonales.php"
				<?php } elseif ($user['tp_estatus']==1) { ?>
					window.location="../view/datosacademicos.php"
				<?php } elseif ($user['tp_estatus']==2) { ?>
					window.location="../view/datoscomplementarios.php"
				<?php } elseif ($user['tp_estatus']==3) { ?>
					window.location="../view/digitales.php"
				<?php } elseif ($user['tp_estatus']==4) { ?>
					window.location="../view/select_vacante.php"
				<?php } ?>  
				</script>
<?php
     
 }else{
?>
				<script>
					window.location="existe.php"
				</script>
			<?php
    
 }
die();
} 
?>