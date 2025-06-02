<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        .bg-pal-red {
            background: #EE6464 !important;
        }

        .home-card {
            min-height: 180px !important;
        }

        html *
        {
        font-family: Arial, Helvetica, sans-serif !important;
        }
    </style>
</head>

<body>
    @include('partials.navbar')

    <div class="container">
        <div class="row text-center">
            <h1>Welcome {{ $username }}!</h1>
        </div>

        <div class="row d-flex justify-content-center mt-3">
            <div class="col-12 col-md-10 col-lg-8">
                <div class = "row"> 
                    <div class="col-lg-6 col-6 pe-3 pe-md-4 pe-lg-5">
                        <div class="card bg-pal-red border-2 rounded-4 border-dark home-card w-100">
                            
                        </div>
                    </div>

                    <div class="col-lg-6 col-6 ps-3 ps-md-4 ps-lg-5">
                        <div class="card bg-pal-red border-2 rounded-4 border-dark home-card w-100">
                            
                        </div>
                    </div>
                </div>

                <h3 class = "mt-3">Continue Learning</h3>

            </div>  
        </div>
    </div>
</body>