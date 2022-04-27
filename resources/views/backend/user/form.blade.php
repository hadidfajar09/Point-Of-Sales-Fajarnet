  <!-- Modal -->
  <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
        <form action="" method="post" class="form-horizontal" data-toogle="validator">
            @csrf
            @method('post') 
        
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-md-offset control-label">Nama</label>
                <div class="col-md-6">
                    <input class="form-control" type="text" name="name" id="name" required autofocus>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        
          <div class="form-group row">
              <label for="email" class="col-md-4 col-md-offset control-label">Email</label>
              <div class="col-md-6">
                  <input class="form-control" type="email" name="email" id="email" required>
                  <span class="help-block with-errors"></span>
              </div>
          </div>
        <div class="form-group row">
            <label for="password" class="col-md-4 col-md-offset control-label">Password</label>
            <div class="col-md-6">
                <input class="form-control" type="password" name="password" id="password" required>
                <span class="help-block with-errors"></span>
            </div>
        </div>
      <div class="form-group row">
          <label for="password_confirmation" class="col-md-4 col-md-offset control-label">Konfirmasi Password</label>
          <div class="col-md-6">
              <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required data-match="#password">
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