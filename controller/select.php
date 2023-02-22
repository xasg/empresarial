<?php
  require ('conexion.php');
  
  $query = "SELECT id_usuario, dt_nombre_comercial FROM empresa ORDER BY dt_razon_social";
  $resultado=$mysqli->query($query);
?> 
<html>
  <head>
    <title>ComboBox Ajax, PHP y MySQL</title>    
    <script language="javascript" src="js/jquery-2.1.3.min.js"></script>    
        <script language="javascript">
      $(document).ready(function(){
        $("#empresa").change(function () {          
          $("#empresa option:selected").each(function () {
            id_usuario = $(this).val();
            $.post("includes/getMunicipio.php", { id_usuario: id_usuario }, function(data){
              $("#vacante").html(data);
            });            
          });
        })
      });
      
    </script>    
  </head>
  
  <body>
    <form id="combo" name="combo" action="guarda.php" method="POST">
      <div>Selecciona Estado : 
        <select name="empresa" id="empresa">
        <option value="0">Seleccionar Empresa</option>
        <?php while($row = $resultado->fetch_assoc()) { ?>
          <option value="<?php echo $row['id_usuario']; ?>"><?php echo $row['dt_nombre_comercial']; ?></option>
        <?php } ?>
      </select></div>
      
      <br />
      
      <div>Selecciona Municipio : <select name="vacante" id="vacante"></select></div>
      
      <br />
      <input type="submit" id="enviar" name="enviar" value="Guardar" />
    </form>
  </body>
</html>