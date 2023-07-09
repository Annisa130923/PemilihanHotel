@extends('admin.layouts.main', ['title' => 'Tambah Hotel'])
<style>
  .yellow {
    color: yellow;
  }
</style>
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <h3>Edit Fasilitas Hotel</h3>
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('admin.fasilitas.update', $fasilitas->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row flex-column">
              <div class="col-lg-6 mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" value="{{ $fasilitas->nama }}" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                @error('nama') <div class='invalid-feedback'> {{ $message }} </div> @enderror
              </div>
              <div class="col-lg-6 mb-3">
                <label for="score" class="form-label">Jumlah Score Fasilitas</label>
                <select name="score" id="score" class="form-control @error('score') is-invalid @enderror">
                  <option value="">Pilih Jumlah Score</option>
                  <option value="1" {{ $fasilitas->score == 1 ? 'selected' : ''}}>1</option>
                  <option value="2" {{ $fasilitas->score == 2 ? 'selected' : ''}}>2</option>
                  <option value="3" {{ $fasilitas->score == 3 ? 'selected' : ''}}>3</option>
                  <option value="4" {{ $fasilitas->score == 4 ? 'selected' : ''}}>4</option>
                  <option value="5" {{ $fasilitas->score == 5 ? 'selected' : ''}}>5</option>
                  <option value="6" {{ $fasilitas->score == 6 ? 'selected' : ''}}>6</option>
                  <option value="7" {{ $fasilitas->score == 7 ? 'selected' : ''}}>7</option>
                  <option value="8" {{ $fasilitas->score == 8 ? 'selected' : ''}}>8</option>
                  <option value="9" {{ $fasilitas->score == 9 ? 'selected' : ''}}>9</option>
                  <option value="10" {{ $fasilitas->score == 10 ? 'selected' : ''}}>10</option>
                </select>
                @error('score') <div class='invalid-feedback'> {{ $message }} </div> @enderror
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
    el.addEventListener('mouseover', (e) => {
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
