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
                <label for="id_category" class="col-md-2 col-md-offset-1 control-label">Category</label>
                <div class="col-md-8">
                    <select class="form-control" name="id_category" id="id_category" required autofocus>
                      <option value="">Pilih Category</option>
                      @foreach ($category as $key => $row)
                          <option value="{{ $key }}">{{ $row }}</option>
                      @endforeach

                    </select>
                    <span class="help-block with-errors"></span>

                </div>
            </div>

            <div class="form-group row">
              <label for="product_name" class="col-md-2 col-md-offset-1 control-label">Product</label>
              <div class="col-md-8">
                  <input class="form-control" type="text" name="product_name" id="product_name" required autofocus>
                  <span class="help-block with-errors"></span>

              </div>
          </div>

          <div class="form-group row">
            <label for="product_name" class="col-md-2 col-md-offset-1 control-label">Brand</label>
            <div class="col-md-8">
                <input class="form-control" type="text" name="brand" id="brand">
                <span class="help-block with-errors"></span>

            </div>
        </div>

        <div class="form-group row">
          <label for="purchase_price" class="col-md-2 col-md-offset-1 control-label">Purchase Price</label>
          <div class="col-md-8">
              <input class="form-control" type="number" name="purchase_price" id="purchase_price" required>
              <span class="help-block with-errors"></span>

          </div>
      </div>

      <div class="form-group row">
        <label for="sale_price" class="col-md-2 col-md-offset-1 control-label">Sale Price</label>
        <div class="col-md-8">
            <input class="form-control" type="number" name="sale_price" id="sale_price" required>
            <span class="help-block with-errors"></span>

        </div>
    </div>

    <div class="form-group row">
      <label for="discount" class="col-md-2 col-md-offset-1 control-label">Discount</label>
      <div class="col-md-8">
          <input class="form-control" type="number" name="discount" id="discount" value="0">
          <span class="help-block with-errors"></span>

      </div>
  </div>

  <div class="form-group row">
    <label for="stock" class="col-md-2 col-md-offset-1 control-label">Stock</label>
    <div class="col-md-8">
        <input class="form-control" type="number" name="stock" id="stock" value="0" required>
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