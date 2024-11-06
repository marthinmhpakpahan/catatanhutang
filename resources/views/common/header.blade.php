<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{ $title }}
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/assets/css/font-awesome.min.css') }}" />

    <!--   Core JS Files   -->
    <script src="{{ url('/assets/js/jquery.min.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="p-4">
    <div class="container">
        <div class="card mt-4 border-success">
            <div class="card-header text-center text-bg-success">
                <div class="row">
                    <div class="col text-start"><a href="{{ route('debt.index') }}"><div class="btn btn-sm btn-success btn-outline-light"><i class="fas fa-home"> HOMEPAGE</i></div></a></div>
                    <div class="col">
                        <h4>CATATAN HUTANG</h4>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
            <div class="card-body">