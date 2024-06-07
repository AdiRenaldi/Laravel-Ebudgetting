<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-BUDGETING | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <style>
    .bordered{
      border: 1px solid black;
    }
    img{
        margin: 30px;
    }
  </style>
  <body>

    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
	    <div class="row">
	    	<div class="col-lg-4 col-md-8 col-sm-12 offset-md-2 offset-lg-4">
				<div class="row g-0">
					<img src="{{ asset('image/atas.png') }}" class="img-fluid w-75 h-75" alt="..." style="overflow: hidden">
				</div>
		    </div>
	    	<div class="col-lg-4 col-md-8 col-sm-12 offset-md-2 offset-lg-4">
		        <div class="row g-0">
		          <div class="col-4 d-flex justify-content-start">
		            	<img src="{{ asset('image/kiri.png') }}" class="w-75 h-75" alt="...">
		          </div>
		          <div class="col-4 d-flex justify-content-center">
		            	<img src="{{ asset('image/tenah.png') }}" class="w-75 h-75" alt="...">
		          </div> 
		          <div class="col-4 d-flex justify-content-end">
		            	<img src="{{ asset('image/kanan.jpg') }}" class="w-75 h-75" alt="...">
		          </div>
		        </div>
		    </div>
		    <div class="col-lg-4 col-md-8 col-sm-12 offset-md-2 offset-lg-4">
		    	<div class="row">
			        <div class="col-12">
			            <form action="/login" method="POST">
							@csrf
			                <div class="mb-3">
			                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ old('username') }}">
								@error('username')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
			                </div>
			                <div class="mb-3">
				                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
								@error('password')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
			                </div>
			                <div class="mb-3 row">
			                  	<button type="submit" class="btn btn-primary btn-block text-center">LOGIN</button>
			                </div>
			            </form>
			        </div>
		        </div>
		    </div>
	    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>