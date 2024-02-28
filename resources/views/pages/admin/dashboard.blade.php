@extends('temp.sidebar')

@section('con')
<!-- INI BAGIAN DATA APOTEK -->
    <div class="con-da">
        <div class="j-da">
          <span class="ms-2">Data Apotek</span>
        </div>
        <div class="main-da row m-0 px-3">
          <div class="tkotak col-4 col-lg-3 ps-0">
            <div class="con-kotak col bg-white d-flex align-items-center">
              <div class="logo-da">
                <i class="fa-duotone fa-capsules"></i>
              </div>
            </div>
          </div>
          <div class="tkotak col-4 col-lg-3 ps-0">
            <div class="con-kotak col bg-white d-flex align-items-center">
              <div class="logo-da">
                <i class="fa-duotone fa-hospital-user"></i>
              </div>
            </div>
          </div>
          <div class="tkotak col-4 col-lg-3 ps-0">
            <div class="con-kotak col bg-white d-flex align-items-center">
              <div class="logo-da">
                <i class="fa-duotone fa-users"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- PENUTUP DATA APOTEK -->
  
      <!-- INI BAGIAN ANALISIS DATA -->
      <div class="con-ad">
        <div class="col-12 j-ad p-0">
          <span class="ms-4"> Analisi Data </span>
        </div>
        <div id="main-ad" class="main-ad m-0 px-3">
          <div id="main-left" class="main-left col ps-0">
            <div class="ad-left col">
              <div class="l-top bg-white col"></div>
              <div class="l-bottom row row-cols-2 mt-3 p-0 mx-0">
                <div class="col px-0">
                  <div class="col bg-white">
                    <div class="kotak-b"></div>
                    <span></span>
                  </div>
                </div>
                <div class="col px-0">
                  <div class="col bg-white">
                    <div class="kotak-b"></div>
                  </div>
                </div>
                <div class="col px-0 mt-3">
                  <div class="col bg-white">
                    <div class="kotak-b"></div>
                  </div>
                </div>
                <div class="col px-0 mt-3">
                  <div class="col bg-white">
                    <div class="kotak-b"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          <div id="main-right" class="main-right col bg-white">
            <div class="ad-right col">halo</div>
          </div>
        </div>
      </div>
      <!-- PENUTUP ANALISIS] -->
  
      <!-- PEMBUKA STAUS PERSEDIAAN  -->
      <div class="con-sp w-100">
        <div class="main-sp px-3">
          <div class="col-12 j-sp p-0">
            <span class="ms-2">Status Persediaan</span>
          </div>
          <div id="con-pko" class="row  m-0 con-pko">
            <div class="col px-2 pb-3">
              <div class="col bg-white main-pko p-2">
                <div class="col pko-atas py-2">
                  <span>Stok Sedikit</span>
                </div>
              </div>
            </div>
            <div class="col px-2 pb-3">
              <div class="col bg-white main-pko p-2">
                <div class="col pko-atas py-2">
                  <span>Stok Habis</span>
                </div>
              </div>
            </div>
            <div class="col px-2 pb-3">
              <div class="col bg-white main-pko p-2">
                <div class="col pko-atas py-2">
                  <span>Kadaluarsa</span>
                </div>
              </div>
            </div>
            <div class="col px-2 pb-3">
              <div class="col bg-white main-pko p-2">
                <div class="col pko-atas py-2">
                  <span>Terlaris</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- PENUTUP STATUS PERSEDIAAN -->
    @endsection
    