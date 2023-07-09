@extends('admin.layouts.main', ['title' => 'Dashboard'])

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h3>Dashboard</h3>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <table id="table" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nama Hotel</th>
                    <th>Harga Sewa</th>
                    <th>Kelas</th>
                    <th>Fasilitas</th>
                    <th>Pelayanan</th>
                    <th>Jarak</th>
                    <th>Kota</th>
                </tr>
            </thead>
            <tbody>
              @foreach (App\Models\Hotel::latest()->get() as $item)
                  <tr>
                      <td>{{ $item->nama_hotel }}</td>
                      <td class="text-nowrap">
                        @currency($item->harga_sewa)
                      </td>
                      <td>{{ $item->kelas_hotel }}</td>
                      <td>
                          @foreach($item->fasilitas as $fs)
                          <span class="badge badge-xs bg-primary">{{ $fs->nama }}</span>
                          @endforeach
                      </td>
                      <td>{{ $item->pelayanan }}</td>
                      <td>{{ $item->jarak }}</td>
                      <td>{{ $item->kota }}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@push('data-tables')
<script>
  $(document).ready(function () {
      $('#table').DataTable();
  });
</script>
@endpush
@endsection
