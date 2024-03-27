<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Login E-Perpus SDN 024t</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>
<body class="text-center">


<main class="form-signin">
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong>
            <p class="fs-6">
                {{session('error')}}
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>BERHASIL</strong>
            <p class="fs-6">
                {{session('success')}}
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form method="POST" action="/login">
        @csrf
        <img class="mb-4" src="img/logo_tut.png" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">ADMIN E-PERPUS 024</h1>

        <div class="form-floating my-2">
            <input type="text" class="form-control" id="floatingInput" name="username" placeholder="username">
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Log in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/dashboard.js"></script>
</body>
</html>
