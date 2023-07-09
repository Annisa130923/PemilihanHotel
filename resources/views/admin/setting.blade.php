@extends('admin.layouts.main', ['title' => 'Setting App'])
<style>
  .yellow {
    color: yellow;
  }
</style>
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <h3>Setting Aplikasi</h3>
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('admin.setting.edit') }}" method="POST">
            @csrf
            <div class="row flex-column">
              <div class="col-lg-6 mb-3">
                <label for="app_name" class="form-label">App Name</label>
                <input type="text" value="{{ App\Models\App::first()->app_name }}" class="form-control @error('app_name') is-invalid @enderror" id="app_name" name="app_name">
                @error('app_name') <div class='invalid-feedback'> {{ $message }} </div> @enderror
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
@endsection
