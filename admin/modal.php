<style>
.modal-body {
    max-height: 400px; /* Ajuste a altura máxima conforme necessário */
    overflow-y: auto;  /* Permite rolagem vertical se o conteúdo exceder a altura */
    word-wrap: break-word; /* Permite que palavras longas quebrem a linha */
    white-space: normal; /* Permite a quebra de linha normal */
}

.modal-dialog {
    max-width: 600px; /* Ajuste a largura máxima conforme necessário */
    width: auto; /* Define a largura automaticamente */
}
</style>
            
            <!-- Notifications: MODALs -->              
            <div class="example-modal">
                <div class="modal modal-danger" id="alertModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modal Danger</h4>
                      </div>
                      <div class="modal-body">
                        <p id="modalBodyContent">One fine body&hellip;</p> <!-- ID adicionado -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline">Save changes</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
              </div><!-- /.example-modal -->