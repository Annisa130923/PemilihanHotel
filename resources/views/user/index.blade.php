<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css') }}" />

    <title>Daftar Hotel Terbaik</title>
  </head>
  <body class="bg-dark">
    <header class="header p-3 py-4">
      <div class="container">
        <div class="row">
          <div class="col-6">
            <div class="logo">
              <h1 class="h4 text-light">{{ config('name') }}</h1>
            </div>
          </div>
          <div class="col-6">
            <div class="menu">
              <nav class="d-flex justify-content-end align-items-center">
                @auth
                  <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-primary">Dashboard</a>
                @else
                  <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login Dashboard</a>
                @endauth
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>

    <main id="main">
      <div class="container">
        <h3 class="h4 mt-4 text-light">Berikut Adalah 10 Daftar Hotel Terbaik Di Kota Tegal, Jawa Tengah</h3>
        <div class="row mt-4">
          @foreach($hotels as $hotel)
          <div class="col-lg-6 mb-3">
            <div class="card h-100">
              <div class="card-body shadow-lg">
                <div class="row flex-column h-100">
                  <div class="col-12 mb-4">
                    <div class="image w-100 h-100 d-flex justify-content-center align-items-center">
                      <img width="100%" src="{{ asset('images/') }}/{{ $hotel->image }}" alt="{{ $hotel->image }}">
                    </div>
                  </div>
                  <div class="col-12">
                    <h4 class="h5 mb-2"><strong>{{ $hotel->nama_hotel }}</strong></h4>
                    <div class="d-flex flex-lg-row flex-md-row flex-column">
                      <div>
                        @for ($i = 1; $i <= 5; $i++)
                        <i class='bx bxs-star me-1 {{ $i <= $hotel->rating_pelayanan ? ' text-warning' : '' }}' style="font-size: 1em"></i>
                        @endfor
                      </div>
                      <span class="me-2">Hotel Bintang {{ $hotel->kelas_hotel }}</span>
                    </div>
                    <p class="mt-3 mb-2"><strong>Fasilitas:</strong></p>
                    <div class="d-flex flex-wrap">
                      @foreach($hotel->fasilitas as $fs)
                      <span class="badge badge-sm bg-warning me-1 flex-grow-1 mb-2">{{ $fs->nama }}</span>
                      @endforeach
                    </div>
                    <span class="d-block mb-3" style="font-size: 1.5em;"><strong>Harga Sewa : @currency($hotel->harga_sewa)</strong></span>
                    <span class="d-block mb-2" style="font-size: 0.8em;"><strong>Jarak Ke Pusat Kota : {{ $hotel->jarak }}</strong></span>
                    <span class="d-block" style="font-size: 1em;"><strong>{{ $hotel->kota }}</strong></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </main>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>