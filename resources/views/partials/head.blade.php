<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Kwanso
    </title>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <style>
        .loader {
            width: 70px;
            aspect-ratio: 1;
            background:
                radial-gradient(farthest-side, #ffa516 90%, #0000) center/16px 16px,
                radial-gradient(farthest-side, green 90%, #0000) bottom/12px 12px;
            background-repeat: no-repeat;
            animation: l17 1s infinite linear;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        .loader::before {
            content: "";
            position: absolute;
            width: 8px;
            aspect-ratio: 1;
            inset: auto 0 16px;
            margin: auto;
            background: #ccc;
            border-radius: 50%;
            transform-origin: 50% calc(100% + 10px);
            animation: inherit;
            animation-duration: 0.5s;
        }

        @keyframes l17 {
            100% {
                transform: rotate(1turn)
            }
        }

        .blur-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 9999;
        }
    </style>
</head>
