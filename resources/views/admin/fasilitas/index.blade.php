@extends('admin.layouts.main', ['title' => 'Fasilitas Hotel'])

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h3>Daftar Fasilitas Hotel</h3>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-12">
              <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary">Tambah Fasilitas Hotel</a>
            </div>
          </div>
          <div class="table-responsive">
            <table id="table" class="table table-striped" style="width:100%">
              <thead>
                  <tr>
                      <th>Nama</th>
                      <th>Jumlah Score</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach(App\Models\Fasilitas::latest()->get() as $item)
                  <tr>
                      <td>{{ $item->nama }}</td>
                      <td>{{ $item->score }}</td>
                      <td>
                          <a href="{{ route('admin.fasilitas.edit', $item->id) }}" class="btn btn-sm btn-success">Edit</a>
                          <form action="{{ route('admin.fasilitas.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
