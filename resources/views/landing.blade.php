<!DOCTYPE html>
<html lang="en">

<head>
    <title>Clefinspire</title>

    @include('partials.style_head')
    
    <style>
        body {
            display: flex;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body class="bg-gradient-pal-red">
    <div class="container" style="min-width: 120px">
        <div style="text-align: center; color: #000000">
            <h1 class="fw-bold" style="font-size: 80px">Clefinspire</h1>
            <p style="font-size: 20px; margin-bottom: 30px">Fun ways to learn music!</p>
            <div>
                <a href="/register"><button class=btn
                        style="width: 200px; margin: 10px; background-color: #000; color: #fff;">Register</button></a><br>
                <a href="/signin"><button class=btn
                        style="width: 200px; margin: 10px; background-color:#fff; color:#000; border:2px solid #000;">Sign
                        in</button></a>
            </div>
        </div>
    </div>
</body>

</html>
