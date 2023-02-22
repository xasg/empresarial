<form action="../controller/postular_admin.php" method="POST">
<div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">VALIDACIÓN PARA BENEFICIARIO</h4>
      </div>
      <div class="modal-body">
			<div id="datos_ajax"></div>
          <div class="form-group">
            <label for="nombre" class="control-label">Candidato:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="45">
            <input type="hidden" class="form-control" id="id" name="id">
          </div>	
           <div class="form-group">
            <label for="nombre" class="control-label">Empresa:</label>
            <input type="text" class="form-control" id="empresa" name="empresa" required maxlength="45">
          </div>
          <div class="form-group">
                <br>
                <label class="radio-inline"><h4><input type="radio" value="1" name="aplica" required>Aplica</h4></label>
                <label class="radio-inline"><h4><input type="radio" value="2" name="aplica" required>No Aplica</h4></label> <br>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Postular</button>
      </div>
    </div>
  </div>
</div>
</form>