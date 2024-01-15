<?php
include_once('../model/databases_empresa.php');
session_start();
if($_POST)
{
 $correo = isset( $_POST['correo']) ? $_POST['correo'] : '';
 $password = isset( $_POST['password']) ? $_POST['password'] : '';
 $user =get_user_acces($correo);


 if($user['dt_password']==$password and $user['tp_usuario']==3)
 		{    
			$_SESSION["id"]=$user['id_usuario'];
			$_SESSION["tp_user"]=$user['tp_usuario'];
 ?>
				<script>
					window.location="../view/index.php"
				</script>
<?php
 }elseif($user['dt_password']==$password and $user['tp_usuario']==4){
?>
				<script>
					window.location="../view/empresarial_juridico.php"
				</script>

<?php  
 }elseif($user['dt_password']==$password and $user['tp_usuario']==5){
 ?>
 				<script>
					window.location="../view/administracion.php"
				</script>

<?php
}else{
?>

				<script>
					window.location="../login.php"
				</script>

<?php	
}
} 
?>