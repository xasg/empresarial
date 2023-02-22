<form action="../controller/upload_convenio_empresa.php" enctype="multipart/form-data" method="POST">
<div class="modal fade" id="convenio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">SUBIR EL CONVENIO DE LA EMPRESA</h4>
      </div>
      <div class="modal-body">
			<div id="datos_ajax"></div>          
          <div class="form-group">
            <label for="nombre" class="control-label">Empresa:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
            <input type="hidden" class="form-control" id="id" name="id">
          </div>

          <div class="form-group">
                  <label  class="control-label">Convenio Generado:</label>
                  <div class="input-group input-file" name="convenio">
                    <span class="input-group-btn">
                          <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
          </div>     

      </div>
      <div class="modal-footer">
        <div class="col-md-3 col-md-offset-9"><br><br>
                           <div class="form-group">
                              <input name="uploadFiles" type="submit" class="btn btn-block btn-primary btn-lg" value="Subir">
                              <input name="MM_upload_file" type="hidden" id="MM_upload" value="formDocumentos">
                           </div>
             </div>
      </div>
    </div>
  </div>
</div>
</form>