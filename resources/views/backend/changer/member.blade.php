<!-- Modal -->
<div class="modal fade" id="modal-member" tabindex="-1" role="dialog" aria-labelledby="modal-member">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">PIlih Member</h4>
      </div>
      <div class="modal-body">
       
        <table class="table table-striped table-bordered table-member">
            <thead>
              <th>Nama</th>
              <th>Phone</th>
              <th>Alamat</th>
              <th>Sisa Poin</th>
              <th><i class="fa fa-cogs"></i></th>
            </thead>
            <tbody>
              @foreach ($member as $key => $row)
                  <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->address }}</td>
                    <td>{{ $row->poin }}</td>
                    
                    @if ( $row->poin === 0 )
                    <td>
                    <a href="{{ route('changer.create', $row->id) }}" class="btn btn-primary btn-xs btn-flat" aria-disabled="true">
                      <i class="fa fa-check-circle"></i> Pilih
                    </a>
                    </td>
                    @else
                    <td>
                    <a href="{{ route('changer.create', $row->id) }}" class="btn btn-primary btn-xs btn-flat">
                      <i class="fa fa-check-circle"></i> Pilih
                    </a>
                  </td>
                    @endif
                     
                    
                  </tr>
              @endforeach
            </tbody>
        </table>

      </div>
    
    </div>
  </div>
</div>
