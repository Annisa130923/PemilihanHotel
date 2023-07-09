@extends('admin.layouts.main', ['title' => 'Tambah Hotel'])
<style>
  .yellow {
    color: yellow;
  }
</style>
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <h3>Edit Hotel</h3>
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          @if(session()->has('Error'))
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-warning">{{ session('Error') }}</div>
              </div>
            </div>
          @endif
          <form action="{{ route('admin.hotel.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-lg-6">
                <label for="nama_hotel" class="form-label">Nama Hotel</label>
                <input type="text" class="form-control @error('nama_hotel') is-invalid @enderror" value="{{ $hotel->nama_hotel }}" id="nama_hotel" name="nama_hotel">
                @error('nama_hotel')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-lg-6 mb-3">
                <label for="harga_sewa" class="form-label">Harga Sewa</label>
                <input type="text" class="form-control @error('harga_sewa') is-invalid @enderror" value="{{ $hotel->harga_sewa }}" id="harga_sewa" name="harga_sewa">
                @error('harga_sewa')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-lg-12 mb-3">
                <label for="fasilitas" class="form-label">Pilih Fasilitas</label>
                <select class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas" name="fasilitas[]" multiple>
                  @foreach (App\Models\Fasilitas::all() as $key => $item )
                      <option value="{{ $item->id }}" {{ isset($hotel->fasilitas[$key]) && $hotel->fasilitas[$key]->nama == $item->nama ? 'selected' : '' }}>{{ $item->nama }}</option>
                  @endforeach
                </select>
                @error('fasilitas')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-lg-6 mb-3">
                <label for="pelayanan" class="form-label">Rating Pelayanan</label>
                <select class="form-control @error('pelayanan') is-invalid @enderror" id="pelayanan" name="pelayanan">
                  <option value="">Pilih Jumlah Rating</option>
                  <option value="1" {{ $hotel->pelayanan == 1 ? 'selected' : '' }}>1</option>
                  <option value="2" {{ $hotel->pelayanan == 2 ? 'selected' : '' }}>2</option>
                  <option value="3" {{ $hotel->pelayanan == 3 ? 'selected' : '' }}>3</option>
                  <option value="4" {{ $hotel->pelayanan == 4 ? 'selected' : '' }}>4</option>
                  <option value="5" {{ $hotel->pelayanan == 5 ? 'selected' : '' }}>5</option>
                  <option value="6" {{ $hotel->pelayanan == 6 ? 'selected' : '' }}>6</option>
                  <option value="7" {{ $hotel->pelayanan == 7 ? 'selected' : '' }}>7</option>
                  <option value="8" {{ $hotel->pelayanan == 8 ? 'selected' : '' }}>8</option>
                  <option value="9" {{ $hotel->pelayanan == 9 ? 'selected' : '' }}>9</option>
                  <option value="10" {{ $hotel->pelayanan == 10 ? 'selected' : '' }}>10</option>
                </select>
                @error('pelayanan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
              </div>
              <div class="col-lg-4 mb-3">
                <label for="kelas_hotel" class="form-label">Kelas Hotel</label>
                <div class="d-flex" id="star_hotel">
                  <i class='bx bxs-star me-2' style="font-size: 2em"></i>
                  <i class='bx bxs-star me-2' style="font-size: 2em"></i>
                  <i class='bx bxs-star me-2' style="font-size: 2em"></i>
                  <i class='bx bxs-star me-2' style="font-size: 2em"></i>
                  <i class='bx bxs-star me-2' style="font-size: 2em"></i>
                </div>
                <input type="hidden" class="form-control" value="0" id="kelas_hotel" name="kelas_hotel">
              </div>
              <div class="col-lg-6 mb-3">
                <label for="kota" class="form-label">Kota</label>
                <input type="text" value="{{ $hotel->kota }}" class="form-control @error('kota') is-invalid @enderror" id="kota" name="kota">
                @error('kota')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-lg-6 mb-3">
                <label for="jarak" class="form-label">Jarak Hotel</label>
                <input type="text" value="{{ $hotel->jarak }}" class="form-control @error('jarak') is-invalid @enderror" id="jarak" name="jarak">
                @error('jarak') <div class="invalid-feedback"> {{ $message }} </div> @enderror
              </div>
              <div class="col-lg-12 mb-3">
                <label for="file">Image Thumbnail</label>
                <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
                @error('file') <div class='invalid-feedback'> {{ $message }} </div> @enderror
              </div>
              <div class="col-lg-12">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@push('select2')
<script>
  $(document).ready(function() {
    $('#fasilitas').select2();
  });
</script>
<script>
  const star = document.querySelectorAll('#star_hotel i');
  star.forEach((el, key) => {
    el.addEventListener('click', (e) => {
      for(let i = 0; i <= (star.length - 1); i++) {
        if(i <= key) {
          star[i].classList.add('yellow');
        }else {
          star[i].classList.remove('yellow');
        }
        document.querySelector('#kelas_hotel').value = (key + 1);
        // star[].classList.remove('yellow');
        // const starNone = document.querySelectorAll('.yellow');
        // if(i <= (starNone.length - 1)) {
        //   star[i].classList.remove('yellow');
        // }
      }
    })
  });
</script>
@endpush
@endsection
