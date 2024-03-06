@extends('temp.sidebar')

@section('con')
<!-- INI BAGIAN DATA APOTEK -->
    <div class="con-da">
        <div class="j-da">
          <span class="ms-2">Data Apotek</span>
        </div>
        <div class="main-da row m-0 px-3">
          <div class="tkotak col-4 col-lg-3 ps-0">
            <div class="con-kotak  bg-white d-flex align-items-center">
              <div class="logo-da">
                <i class="fa-duotone fa-capsules"></i>
              </div>
              <div class="ms-3 col d-flex flex-column ">
                <span class="tj-das">
                    Jumlah produk
                </span>
                <span class="ti-das" id="jp">

                </span>

            </div>
            </div>


          </div>
          <div class="tkotak col-4 col-lg-3 ps-0">
            <div class="con-kotak bg-white d-flex align-items-center">
              <div class="logo-da">
                <i class="fa-duotone fa-hospital-user"></i>
              </div>
              <div class="ms-3 col d-flex flex-column ">
                <span class="tj-das">
                    Jumlah Pasien
                </span>
                <span class="ti-das" id="jpa">
                </span>

            </div>
            </div>
          </div>


          <div class="tkotak col-4 col-lg-3 ps-0">
            <div class="con-kotak bg-white d-flex align-items-center">
              <div class="logo-da">
                <i class="fa-duotone fa-users"></i>
              </div>

              <div class="ms-3 col d-flex flex-column ">
                <span class="tj-das">
                    Jumlah Karyawan
                </span>
                <span class="ti-das" id="jk">

                </span>

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
              <div class="l-top bg-white col">
                <canvas id="myChart" class="w-100"></canvas>
              </div>
              <div class="l-bottom row row-cols-2 mt-3 p-0 mx-0">
                <div class="col px-0">
                  <div class="col bg-white opp">
                    <div class="kotak-b">
                        <i class="fa-duotone fa-money-bills-simple"></i>

                    </div>
                    <div class="ms-3 d-flex flex-column ">
                        <span class="tj-das">
                            Jumlah Transaksi


                        </span>
                        <div class="col">

                            <span class="ti-das fw-bold" id="jpe">
                            </span>
                            <span class="or-text" id="jpe">
                            /bulan
                            </span>
                        </div>

                    </div>
                  </div>
                </div>
                <div class="col px-0">
                    <div class="col bg-white opp">
                      <div class="kotak-b">
                        <i class="fa-duotone fa-box-dollar"></i>

                      </div>
                      <div class="ms-3 d-flex flex-column ">
                          <span class="tj-das">
                              Produk Terjual
                          </span>
                          <div class="col">

                              <span class="ti-das fw-bold" id="jpt">
                               </span>
                               <span class="or-text">
                               /bulan
                               </span>
                          </div>

                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>

          <div id="main-right" class="main-right col bg-white px-0">
            <div class="ad-right col position-relative ">
                <table  class="table table-responsive table-standart " style="width: 100%; table-layout: fixed;">
                    <thead>
                        <tr>
                            <th class="text-start">NO</th>
                            <th class="text-start">TANGGAL</th>
                            <th class="text-start">TOTAL HARGA</th>
                        </tr>
                    </thead>
                    <tbody id="halo">

                    </tbody>
                  </table>
            </div>
          </div>
        </div>
      </div>
      <!-- PENUTUP ANALISIS] -->

      <!-- PEMBUKA STAUS PERSEDIAAN  -->
      {{-- <div class="con-sp w-100">
        <div class="main-sp px-3">
          <div class="col-12 j-sp p-0">
            <span class="ms-2">Status Persediaan</span>
          </div>
          <div id="con-pko" class="row  m-0 con-pko">
            <div class="col px-2 pb-3">
              <div class="col bg-white main-pko p-2">
                <div class="col pko-atas py-2">
                  <span class="t-pko">Stok Sedikit</span>
                </div>
              </div>
            </div>
            <div class="col px-2 pb-3">
              <div class="col bg-white main-pko p-2">
                <div class="col pko-atas py-2">
                  <span class="t-pko">Stok Habis</span>
                </div>
              </div>
            </div>
            <div class="col px-2 pb-3">
              <div class="col bg-white main-pko p-2">
                <div class="col pko-atas py-2">
                  <span class="t-pko">Kadaluarsa</span>
                </div>
              </div>
            </div>
            <div class="col px-2 pb-3">
              <div class="col bg-white main-pko p-2">
                <div class="col pko-atas py-2">
                  <span class="t-pko">Terlaris</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
      <!-- PENUTUP STATUS PERSEDIAAN -->


      <script>
        $(document).ready(function() {

          $.ajax({
              url:'/getDataDash',
            type:'GET',
            success: function (response) {
                $('#jp').text(response.jp)
                $('#jpa').text(response.jpa)
                $('#jk').text(response.jk)
                $('#jpe').text(response.jpe)
                $('#jpt').text(response.jpt)

            }
          })

          $.ajax({
    url: '/getDataTP',
    type: 'GET',
    success: function(response) {

        var ctx = document.getElementById('myChart').getContext('2d');

        var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        var dataLabels = response.map(function(item) {
            return monthNames[item.month - 1];
        });

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dataLabels,
                datasets: [{
                    label: 'Total Price',
                    data: response.map(function(item) {
                        return item.total;
                    }),
                    borderWidth: 1
                }]
            },
            options: {
                // Tambahkan opsi tambahan di sini
            }
        });
    }
});


$.ajax({
    url:'/dataTransDash',
    type:'GET',
    success: function(res) {
        let data = res.data;

        let tableBody = $('tbody#halo');
        tableBody.empty();

        $.each(data, function(index, item) {
            let row = '<tr>' +
                '<td class="text-start">' + (index + 1) + '</td>' +
                '<td class="text-start">' + item.transactionDate+ '</td>' +
                '<td class="text-start">' + 'Rp.'+ item.totalPrice + '</td>' +
                '</tr>';
            tableBody.append(row);
        });

    },
        error: function(xhr, status, error) {
                console.error(xhr.responseText);
                }
})



})


      </script>
    @endsection
