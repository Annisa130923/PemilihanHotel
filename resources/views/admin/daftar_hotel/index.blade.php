@extends('admin.layouts.main', ['title' => 'Daftar Hotel'])

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h3>Daftar Hotel</h3>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-12">
              <a href="{{ route('admin.hotel.create') }}" class="btn btn-primary">Tambah Hotel</a>
            </div>
          </div>
          <div class="table-responsive">
            <table id="table" class="table table-striped" style="width:100%">
              <thead>
                  <tr>
                      <th>Nama Hotel</th>
                      <th>Harga Sewa</th>
                      <th>Kelas</th>
                      <th>Fasilitas</th>
                      <th>Pelayanan</th>
                      <th>Jarak</th>
                      <th style="min-width: 150px;">Kota</th>
                      <th>Action</th>
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
                          <td style="white-space: nowrap;">
                              <a href="{{ route('admin.hotel.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                              <form class="d-inline" action="{{ route('admin.hotel.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                              </form>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
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
