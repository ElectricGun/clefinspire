<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Theory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .main-content {
            padding: 20px;
            width: 100%;
        }
        footer {
            position: fixed;
            bottom: 0;
            left: 210px;
            width: calc(100% - 240px);
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 -2px 1px rgba(0, 0, 0, 0.1);
        }
        .progress-bar {
            background-color: #f89d9d;
        }
    </style>
</head>
<body>
@include('partials.sidebar')
@foreach ($user as $p)
        <div class="main-content">
            <div class="container">
                <div class="row mt-4 d-flex justify-content-between">
                    <div class="col-4">
                        <h2>Music Theory</h2>
                    </div>
                    <div class="col-3 py-4 px-0">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-0"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control border-0 border-5 rounded-0 py-0 shadow-none" placeholder="Search">
                        </div>
                        <hr class="mt-1 border-3">
                    </div>
                    <div class="col-4">
                        <div class="row d-flex justify-content-end">
                            <div class="col-7 text-end">
                                <h4>Beginner</h4>
                                <h5 class="text-muted">Level {{ $p->user_level }}</h5>
                            </div>
                            <div class="col-5 d-flex align-items-center">
                                <div class="card ratio ratio-1x1 rounded-circle overflow-hidden" style="max-height: 75px; max-width: 75px;">
                                    <img src="https://picsum.photos/200" class="img-fluid w-100 h-100 object-fit-cover" alt="Profile image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mt-2 border-3">

                <div class="row">
                    <div class="col-12">
                        <div class="card mb-3 border-2 border-danger">
                            <div class="card-body">
                                <h5 class="card-title">Basics</h5>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 10%;">10% Complete</div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 border-2 border-danger">
                            <div class="card-body">
                                <h5 class="card-title">Rhythm</h5>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 0%;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 border-2 border-danger">
                            <div class="card-body">
                                <h5 class="card-title">Scales and Key Signatures</h5>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 0%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="d-flex align-items-center justify-content-between">
            <span>Lv. {{ $p->user_level }}</span>
            <div class="progress flex-grow-1 mx-3" style="height: 20px;">
                <div class="progress-bar" style="width: 50%;">{{ $p->user_xp }}/[requiredxp here] XP</div>
            </div>
            <span>Lv. {{ $p->user_level + 1}}</span>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endforeach
</html>