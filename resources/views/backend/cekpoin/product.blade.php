<!-- Modal -->
<div class="modal fade" id="modal-product" tabindex="-1" role="dialog" aria-labelledby="modal-product">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilihan Produk</h4>
      </div>
      <div class="modal-body">
       
        <table class="table table-striped table-bordered table-product">
            <thead>
              <th>Code</th>
              <th>Category</th>
              <th>Produk</th>
              <th>Harga Poin</th>
            </thead>
            <tbody>

              @foreach ($products as $row)
                  <tr>
                    <td><span class="label label-info">{{ $row->product_code }}</span> </td>
                    <td>{{ $row->category_name }}</td>
                    <td>{{ $row->product_name }}</td>
                    <td>{{  $row->poin }}</td>
                   
                  </tr>
              @endforeach
            </tbody>
        </table>

      </div>
    
    </div>
  </div>
</div>
