<!-- Modal -->
<div class="modal fade" id="modal-supplier" tabindex="-1" role="dialog" aria-labelledby="modal-supplier">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">PIlih Supplier</h4>
      </div>
      <div class="modal-body">
       
        <table class="table table-striped table-bordered table-supplier">
            <thead>
              <th>Nama</th>
              <th>Phone</th>
              <th>Alamat</th>
              <th><i class="fa fa-cogs"></i></th>
            </thead>
            <tbody>
              @foreach ($supplier as $key => $row)
                  <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->address }}</td>
                    <td>
                      <a href="{{ route('purchase.create', $row->id) }}" class="btn btn-primary btn-xs btn-flat">
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
