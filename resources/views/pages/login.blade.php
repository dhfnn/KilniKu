<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Login</title>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" />
    <script src="https://kit.fontawesome.com/9494185896.js" crossorigin="anonymous"></script>
    <script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.js') }}"></script>
  </head>
  <body>
    <section class="container-fluid vh-100  d-flex justify-content-center ailgn-items-center con">
      <div class="con-tl d-flex flex-column ailgn-items-center ">
        <div class="text-login text-center d-flex flex-column">
          <span class="judul p-0 m-0">klini<span>K</span>u</span>
        </div>
        <form action="/" method="post">
            @csrf
            <div class="con-login p-3">
                <div class="con-Jlogin">
                  <span>LOGIN</span>
                  <span>Masukan data untuk melakukan login</span>
                </div>
                <div class="con-input">
                  <div class="con-iId d-flex  flex-column">
                    <div class="col d-flex justify-content-between">
                        <span>Username</span>
                        @error('username')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('salah')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="text" name="username" placeholder="Masukan Username" class="px-3" value="{{ old('username') }}" id=""/>
                  </div>
                  <div class="con-iPas d-flex flex-column pt-3">
                    <div class="col d-flex justify-content-between">
                        <span>Password</span>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="password" name="password" placeholder="Masukan Password" class="px-3" value="{{ old('password') }}"/>
                    <div class="text-end d-flex ailgn-items-center justify-content-end mt-2">
                      <span class="">lupa password ?</span> <i class="fa-solid fa-circle-info  mx-1"></i>
                    </div>
                  </div>
                </div>

                <div class="con-btn d-flex justify-content-center " >
                  <button type="submit">Login</button>
                </div>
              </div>

        </form>
      </div>
    </section>

  </body>
</html>
