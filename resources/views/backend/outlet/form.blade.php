  <!-- Modal -->
  <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post') 
        
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label for="nama_outlet" class="col-md-2 col-md-offset-1 control-label">Outlet</label>
                <div class="col-md-6">
                    <input class="form-control" type="text" name="nama_outlet" id="nama_outlet" required autofocus>
                    <span class="help-block with-errors"></span>

                </div>
            </div>

            <div class="form-group row">
              <label for="alamat" class="col-md-2 col-md-offset-1 control-label">Alamat</label>
              <div class="col-md-6">
                  <input class="form-control" type="text" name="alamat" id="alamat" required autofocus>
                  <span class="help-block with-errors"></span>

              </div>
          </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
    </div>
  </div>