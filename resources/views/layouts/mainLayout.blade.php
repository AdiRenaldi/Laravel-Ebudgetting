<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('image/url.png') }}">
    <title>E-budgetting | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
  </head>
  <style>
    body{
      background-color: hsl(0, 0%, 99%);
      font-family: 'Varela Round', sans-serif;
    }
   .bordered{
      border: 2px solid black;
    }
    .Active {
        background: #080808;
        border-right: 10px solid salmon;
    }
    .fokus a:hover {
        background: #080808;
        border-right: 10px solid salmon;
    }
    .button{
      width: 60%;
    }

  </style>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: rgb(19, 39, 138)">
      <div class="container-fluid">
        <span class="navbar-brand ms-5">E-budgeting</span>
        <div class="justify-content-end">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active me-5" aria-current="page" href="/logout" style="font-size: 20px;">Logout <i class="bi bi-box-arrow-right"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid min-vh-80 ">
      <div class="col-12 mt-5">
        {{-- <h2 class="text-center my-4 text-uppercase">HALAMAN : {{ Auth::user()->nama; }}</h2> --}}
      </div>
      <div class="col-12">
        <div class="row g-0">
          <div class="col-2 ">
            <div class="d-flex align-items-end me-2 flex-column fokus">
              
              @php
                  $notif = DB::table('dipa')->where('spn', 'ajukan')->get();
                  $dipaNotif = DB::table('dipa')->where('spn', 'no')->get();
                  $dipa = DB::table('dipa')->where('catatan', 'setuju')->get();
                  $kebutuhanAnggaran = DB::table('kebutuhan_anggaran')->where('catatan', 'ada')->get();
                  $realisasi = DB::table('realisasi_anggaran')->where('staf_id', Auth::user()->id)->where('notifikasi', 'realisasi')->get();
              @endphp

              {{-- Admin --}}
                @if (Auth::user()->role_id == 1)
                  <a href="/dashboard" class="btn btn-secondary border-dark border my-3 button @if (request()->route()->uri == 'dashboard')? Active @endif">Dashboard</a>
                  <a href="/renmi-data" class="btn btn-secondary border-dark border my-3 button @if (request()->route()->uri == 'renmi-data' || request()->route()->uri == 'renmi-add' || request()->route()->uri == 'renmi-edit/{slug}')? Active @endif">Kelola Data Renmin</a>
                  <a href="/spn-data" class="btn btn-secondary border-dark border my-3 button @if (request()->route()->uri == 'spn-data' || request()->route()->uri == 'spn-add' || request()->route()->uri == 'spn-edit/{slug}')? Active @endif">Kelola Data Ka Spn</a>
                  <a href="/staf-data" class="btn btn-secondary border-dark border my-3 button @if (request()->route()->uri == 'staf-data' || request()->route()->uri == 'staf-add' || request()->route()->uri == 'staf-edit/{slug}')? Active @endif">Kelola Data Staf</a>
                @endif
                
                {{-- Renmin --}}
                @if (Auth::user()->role_id == 2)
                  <a href="/renmi-dashboard" class="btn btn-secondary border-dark border my-3 button @if (request()->route()->uri == 'renmi-dashboard')? Active @endif">Dashboard</a>


                  <a href="/dipa" class="btn btn-secondary border-dark border my-3 position-relative button @if (request()->route()->uri == 'dipa' || request()->route()->uri == 'dipa-diajukan' || request()->route()->uri == 'dipa-disetujui' || request()->route()->uri == 'anggaranStaf' || request()->route()->uri == 'dipa-add' || request()->route()->uri == 'anggaran' || request()->route()->uri == 'kegiatan' || request()->route()->uri == 'program-kegiatan' || request()->route()->uri == 'dana-staf' || request()->route()->uri == 'penyaluran-dana' || request()->route()->uri == 'edit-dana-staf/{id}' || request()->route()->uri == 'edit-kegiatan/{slug}' || request()->route()->uri == 'program-add' || request()->route()->uri == 'tambah-dana-dipa/{slug}' || request()->route()->uri == 'tambah-dana-staf/{id}' || request()->route()->uri == 'kurang-dana-staf/{id}' || request()->route()->uri == 'kurang-dana-dipa/{slug}')? Active @endif" id="toggleButton">DIPA
                    @if (count($dipa) > 0)
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        !
                        <span class="visually-hidden">unread messages</span>
                      </span>    
                    @endif
                  </a>

                  <div id="content" class="ms-5 text-end" style="display: none;">
                      <a href="/dipa-add" class="btn btn-secondary border-dark border my-3 button @if (request()->route()->uri == 'dipa-add')? Active @endif">Tambah Dipa</a>


                      <a href="/dipa-diajukan" class="btn btn-secondary border-dark border my-3 position-relative button @if (request()->route()->uri == 'dipa-diajukan')? Active @endif">Pengajuan Dipa
                        @if (count($dipaNotif) > 0)
                          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            !
                            <span class="visually-hidden">unread messages</span>
                          </span>    
                        @endif
                      </a>


                      <a href="/dipa" class="btn btn-secondary border-dark border my-3 position-relative button @if (request()->route()->uri == 'dipa' || request()->route()->uri == 'tambah-dana-dipa/{slug}' || request()->route()->uri == 'kurang-dana-dipa/{slug}')? Active @endif">Dipa Berjalan</a>


                      <a href="/anggaranStaf" class="btn btn-secondary border-dark border my-3 button @if (request()->route()->uri == 'anggaranStaf' || request()->route()->uri == 'tambah-dana-staf/{id}' || request()->route()->uri == 'kurang-dana-staf/{id}')? Active @endif">Dipa Staf</a>
                      <a href="/kegiatan" class="btn btn-secondary border-dark border my-3 button  @if (request()->route()->uri == 'kegiatan')? Active @endif">Kode Kegiatan</a>
                      <a href="/program-kegiatan" class="btn btn-secondary border-dark border my-3 button  @if (request()->route()->uri == 'program-kegiatan')? Active @endif">Kode Program</a>
                  </div>
                  {{-- <div id="content" style="display: none;">
                    <a href="#">saya</a>
                  </div> --}}


                  <a href="/halaman-realisasi" class="btn btn-secondary border-dark border my-3 position-relative button @if (request()->route()->uri == 'halaman-realisasi' || request()->route()->uri == 'realisasi-anggaran/{slug}' || request()->route()->uri == 'edit-program/{slug}')? Active @endif">Realisasi Anggaran
                    @if (count($kebutuhanAnggaran) > 0)
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        !
                        <span class="visually-hidden">unread messages</span>
                      </span>    
                    @endif
                  </a>
                  <a href="/laporan" class="btn btn-secondary border-dark border my-3 button @if (request()->route()->uri == 'laporan')? Active @endif">Laporan Realisasi Anggaran</a>
                  <a href="/laporan-revisi" class="btn btn-secondary border-dark border my-3 button @if (request()->route()->uri == 'laporan-revisi')? Active @endif">Laporan Revisi Anggaran</a>
                @endif

                {{-- Staf --}}
                @if (Auth::user()->role_id == 3)
                  <a href="/staf-dashboard" class="btn btn-secondary border-dark border border-2 my-3 button @if (request()->route()->uri == 'staf-dashboard')? Active @endif">Dashboard</a>
                  <a href="/staf-kebutuhan-anggaran" class="btn btn-secondary border-dark border border-2 my-3 position-relative button @if (request()->route()->uri == 'staf-kebutuhan-anggaran' || request()->route()->uri == 'anggaran-diajukan' || request()->route()->uri == 'edit-kebutuhan-anggaran/{slug}' || request()->route()->uri == 'anggaran-disetujui' || request()->route()->uri == 'anggaran-direalisasikan' || request()->route()->uri == 'Staf_add_kebutuhan_anggaran')? Active @endif">Rencana List Kebutuhan Anggaran
                    @if (count($realisasi) > 0)
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        !
                        <span class="visually-hidden">unread messages</span>
                      </span>    
                    @endif
                  </a>
                @endif
                
                {{-- Spn --}}
                @if (Auth::user()->role_id == 4)
                  <a href="/spn-dashboard" class="btn btn-secondary border-dark border border-2 my-3 button @if (request()->route()->uri == 'spn-dashboard')? Active @endif">Dashboard</a>
                  <a href="/dipa-spn" class="btn btn-secondary border-dark border border-2 my-3 button position-relative @if (request()->route()->uri == 'dipa-spn' || request()->route()->uri == 'pengajuan-dipa-spn' || request()->route()->uri == 'tolak-dipa/{slug}')? Active @endif">DIPA
                    @if (count($notif) > 0)
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        !
                        <span class="visually-hidden">unread messages</span>
                      </span>    
                    @endif
                  </a>
                  <a href="/meyetujui-anggaran" class="btn btn-secondary border-dark border border-2 my-3 button  position-relative  @if (request()->route()->uri == 'meyetujui-anggaran' || request()->route()->uri == 'anggaran-disetuju-spn' || request()->route()->uri == 'tolak-anggaran/{slug}')? Active @endif">Rencana List Kebutuhan Anggaran</a>
                  <a href="/rekap-laporan" class="btn btn-secondary border-dark border border-2 my-3 button @if (request()->route()->uri == 'rekap-laporan')? Active @endif">Laporan Rekap Realisasi Anggaran</a>
                  <a href="/laporan-revisi-spn" class="btn btn-secondary border-dark border my-3 button @if (request()->route()->uri == 'laporan-revisi-spn')? Active @endif">Laporan Revisi Anggaran</a>
                @endif
            </div>
          </div>
          <div class="col-10 border border-dark border-2 overflow-auto" style="height: 80vh">
            <div class="col-10 offset-1 mt-2">
                @yield('content')
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    @yield('footer')

    <script>
      document.addEventListener('DOMContentLoaded', function () {
          var toggleButton = document.getElementById('toggleButton');
          var content = document.getElementById('content');

          toggleButton.addEventListener('click', function (event) {
              event.preventDefault();

              if (content.style.display === 'none') {
                  content.style.display = 'block';
                  localStorage.setItem('collapseStatus', 'expanded');
              } else {
                  content.style.display = 'none';
                  localStorage.setItem('collapseStatus', 'collapsed');
              }
          });

          // Cek status collapse saat halaman dimuat
          var collapseStatus = localStorage.getItem('collapseStatus');

          if (collapseStatus === 'expanded') {
              content.style.display = 'block';
          } else {
              content.style.display = 'none';
          }
      });
    </script>
  </body>
</html>