<!-- Modal -->
<div class="modal fade" id="modal-product" tabindex="-1" role="dialog" aria-labelledby="modal-product">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilih Produk</h4>
      </div>
      <div class="modal-body">
       
        <table class="table table-striped table-bordered table-product">
            <thead>
              <th>Code</th>
              <th>Produk</th>
              <th>Harga Beli</th>
              <th><i class="fa fa-cogs"></i></th>
            </thead>
            <tbody>
              @foreach ($products as $key => $row)
                  <tr>
                    <td><span class="label label-info">{{ $row->product_code }}</span> </td>
                    <td>{{ $row->product_name }}</td>
                    <td>Rp. {{ formatUang($row->purchase_price)  }}</td>
                    <td>
                      <a href="#" class="btn btn-primary btn-xs btn-flat" onclick="pilihProduct('{{ $row->id }}', '{{ $row->product_code }}')">
                        <i class="fa fa-check-circle"></i> Pilih
                      </a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
        </table>

      </div>
    
    </div>
  </div>
</div>
