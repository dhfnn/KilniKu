<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Halaman Login</title>
    <!-- <script src="https://kit.fontawesome.com/9494185896.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="{{ asset('style/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('DataTables/DataTables-1.13.10/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-pro-6.5.1-web/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('simple-notify\dist\simple-notify.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('sweetalert2/src/sweetalert2.scss') }}"> --}}
    <link rel="stylesheet" href="{{ asset('sweetalert2/dist/sweetalert2.css') }}">
    <script src="{{ asset('sweetalert2/dist/sweetalert2.js') }}"></script>
  <script src="{{ asset('DataTables/jQuery-3.7.0/jquery-3.7.0.js') }}"></script>
  <script src="{{ asset('DataTables/datatables.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.css') }}">
  <script src="{{ asset('select2/dist/js/select2.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



  </head>
  <style>
.invoice {
        width: 400px;
        margin: 0 auto;
        border: 1px solid #ccc;
        padding: 20px;
    }
    .invoice-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .invoice-header h2 {
        margin: 0;
    }
    .invoice-details {
        margin-bottom: 20px;
    }
    .invoice-details p {
        margin: 5px 0;
    }
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
    }
    .invoice-table th,
    .invoice-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .invoice-table th {
        background-color: #f2f2f2;
    }
    .total {
        margin-top: 10px;
        text-align: left;
    }
    #checkup-name,
    #transaction-id,
    #transaction-date,
    #namaPelanggan{
        font-size:14px;
        font-weight: 600;
    }
    .col.yo{
        margin-top: 20px
    }
    #total-price{

        font-size:16px;
        font-weight: 600;
    }

.fixed_header tbody{
  width: 100%;
  overflow: auto;
  height: 100px;
}


    .select2-container{

        z-index: 1000000;
        width: 100% !important
    }
    .select2-dropdown{
        z-index: 1000000;

    }
    #modaltdProduk{
        z-index: 100000;

    }

    .dt-buttons{
        margin-left: 20px !important;
    }
    .btn .btn-secondary {
        background-color: red !important;
    }
  </style>
  <body>



    <section class="w-100 vh-100 container-main d-flex ">
      <aside class="con-side" id="sidebar" style="display: block">
        <div class="side-main d-flex flex-column">

          <div class="con-logo d-flex justify-content-center align-items-center">
            <div class="logo rounded"><img src="{{asset('img/logo.png')}}" alt=""/></div>
            <span class="text-logo">Klini<span class="tl-orange">K</span>u</span>
          </div>

          <div class="side-nav col">
            <div class="con-si">
                <a href="{{ Request::is('admin/dashboard*') ? '#' : '/admin/dashboard'  }}" class="l-dash" >
                    <div  class="col side-item {{ Request::is('admin/dashboard*') ? 'si-active' : '' }}">
                      <div class="logo-item {{ Request::is('admin/dashboard*') ? 'li-active' : '' }}">
                        <i class="fa-duotone fa-objects-column" style=""></i>
                      </div>
                      <span>Dashboard<span>
                    </div>
                </a>
            </div>


            <div class="con-si">
              <div onclick="toggleSubMenu('submenu1')" class="col side-item {{ Request::is('data*') ? 'si-active' : '' }}  d-flex justify-content-between">
                <div class="d-flex align-items-center">
                  <div class="logo-item {{ Request::is('data*') ? 'li-active' : '' }}">
                    <i class="fa-duotone fa-folders"></i>
                  </div>
                  <span>Data</span>
                </div>
                <i class="fa-solid fa-angle-right me-3 panah-si"></i>

              </div>
              <div class="submenu-side" id="submenu1">
                <div class="submenu-item">
                    <span class="{{ Request::is('/data/dataSupplier') ? 'text-act' : '' }}"><a href="{{ Request::is('/data/dataSupplier') ? '#' : '/data/dataSupplier' }}">Data supplier</a></span>
                </div>
                <div class="submenu-item">
                    <span class="{{ Request::is('/data/dataPelanggan') ? 'text-act' : '' }}"><a href="{{ Request::is('/data/dataPelanggan') ? '#' : '/data/dataPelanggan' }}">Data Pasien</a></span>
                </div>
                <div class="submenu-item">
                    <span class="{{ Request::is('/data/dataKaryawan') ? 'text-act' : '' }}"><a href="{{ Request::is('/data/dataKaryawan') ? '#' : '/data/dataKaryawan' }}">Data Karyawan</a></span>
                </div>
                <div class="submenu-item">
                  <span class="{{ Request::is('/data/dataAkun') ? 'text-act' : '' }}"><a href="{{ Request::is('/data/dataAkun') ? '#' :  '/data/dataAkun'  }}">Data Akun</a></span>
                </div>
              </div>
            </div>

            <div class="con-si">
                <a href="{{ Request::is('produk*') ? '#' : '/produk'  }}" class="l-dash" >
                    <div  class="col side-item {{ Request::is('produk*') ? 'si-active' : '' }}">
                      <div class="logo-item {{ Request::is('produk*') ? 'li-active' : '' }}">
                        <i class="fa-duotone fa-box-archive"></i>
                      </div>
                      <span>Produk<span>
                    </div>
                </a>
            </div>

            <div class="con-si">
              <div onclick="toggleSubMenu('submenu3')" class="col side-item {{ Request::is('admin/transaksi') ? 'si-active' : '' }} d-flex justify-content-between">
                <div class="d-flex align-items-center">
                  <div class="logo-item {{ Request::is('admin/transaksi*') ? 'li-active' : '' }}">
                    <i class="fa-duotone fa-chart-pie-simple-circle-dollar" ></i>
                  </div>
                  <span>Penjualan</span>
                </div>
                <i class="fa-solid fa-angle-right me-3 panah-si"></i>
              </div>
              <div class="submenu-side" id="submenu3">
                <div class="submenu-item">
                    <span class="{{ Request::is('/admin/transaksi') ? 'text-act' : '' }}"><a href="{{ Request::is('/admin/transaksi') ? '#' :  '/admin/transaksi'  }}">Transaksi</a></span>
                </div>
                <div class="submenu-item">
                    <span class="{{ Request::is('/admin/riwayat') ? 'text-act' : '' }}"><a href="{{ Request::is('/admin/riwayat') ? '#' :  '/admin/riwayat'  }}">Riwayat</a></span>
                </div>
              </div>
            </div>

          </div>

          <div class="con-log">
            <div class="con-si mb-4">
              <div  class="col side-item">
              <a type="button" data-bs-toggle="modal" data-bs-target="#halo" class="d-flex align-items-center">
                <div class="logo-item2">
                  <i class="fa-duotone fa-right-from-bracket fa-flip-horizontal" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>
                </div>
                <span>Keluar<span>
              </a>
              @include('modals.logout')
              @include('modals.hapusAkun')
              </div>
            </div>
          </div>

        </div>
      </aside>

      <section class="main overflow-hidden " id="main-pri">
        <section class="overflow-y-auto w-100 h-100  " >
          <section class="con-main  " id="con-main">
            <nav class="navbar d-flex justify-content-between px-2">
              <div class="d-flex align-items-center">
                <div id="burger-menu">
                  <span></span>
                </div>
                <span id="namePage" class="page ms-2">Halaman/<span></span></span>
              </div>
              {{-- <i class="fa-solid fa-circle-user fs-4"></i> --}}
            </nav>
            <div class="main w-100 px-3">
                @yield('con')
                </div>
            </div>
          </section>
        </section>
      </section>
    </section>
    <script src="{{ asset('simple-notify\dist\simple-notify.min.js') }}"></script>
    <script src="{{ asset('script/script.js') }}"></script>
  <script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.js') }}"></script>

  <script>

    $.ajaxSetup({
    headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
    });
    $('.it-data, .slt-data, .tt-data').on('input change', function() {
                    console.log('teks dihaous')
                    var inputId = $(this).attr('id')
                    $('#' + inputId + '-error').text('');

                })
                $('.close-crud').click(function() {
                      $('.text-error').text('');
                      $('.it-data, .slt-data, .tt-data').val('')

                  })
  </script>
</body>
</html>