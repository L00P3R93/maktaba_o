<!-- Font Awesome Icons -->
<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
<!-- iCheck -->
<link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/jquery-ui/jquery-ui.css">

<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">

<!-- overlayScrollbars -->
<link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

<!-- DataTables -->
<link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" />


<!-- Theme style -->
<link rel="stylesheet" href="assets/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">

<style>
    body{
        font-family: 'Raleway', sans-serif !important;
    }
    .pace {
        -webkit-pointer-events: none;
        pointer-events: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .pace-inactive {
        display: none;
    }

    .pace .pace-progress {
        background: #29d;
        position: fixed;
        z-index: 2000;
        top: 0;
        right: 100%;
        width: 100%;
        height: 2px;
    }

    .pace .pace-progress-inner {
        display: block;
        position: absolute;
        right: 0px;
        width: 100px;
        height: 100%;
        box-shadow: 0 0 10px #29d, 0 0 5px #29d;
        opacity: 1.0;
        -webkit-transform: rotate(3deg) translate(0px, -4px);
        -moz-transform: rotate(3deg) translate(0px, -4px);
        -ms-transform: rotate(3deg) translate(0px, -4px);
        -o-transform: rotate(3deg) translate(0px, -4px);
        transform: rotate(3deg) translate(0px, -4px);
    }

    .pace .pace-activity {
        display: block;
        position: fixed;
        z-index: 2000;
        top: 15px;
        right: 15px;
        width: 14px;
        height: 14px;
        border: solid 2px transparent;
        border-top-color: #29d;
        border-left-color: #29d;
        border-radius: 10px;
        -webkit-animation: pace-spinner 400ms linear infinite;
        -moz-animation: pace-spinner 400ms linear infinite;
        -ms-animation: pace-spinner 400ms linear infinite;
        -o-animation: pace-spinner 400ms linear infinite;
        animation: pace-spinner 400ms linear infinite;
    }

    @-webkit-keyframes pace-spinner {
        0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
    }
    @-moz-keyframes pace-spinner {
        0% { -moz-transform: rotate(0deg); transform: rotate(0deg); }
        100% { -moz-transform: rotate(360deg); transform: rotate(360deg); }
    }
    @-o-keyframes pace-spinner {
        0% { -o-transform: rotate(0deg); transform: rotate(0deg); }
        100% { -o-transform: rotate(360deg); transform: rotate(360deg); }
    }
    @-ms-keyframes pace-spinner {
        0% { -ms-transform: rotate(0deg); transform: rotate(0deg); }
        100% { -ms-transform: rotate(360deg); transform: rotate(360deg); }
    }
    @keyframes pace-spinner {
        0% { transform: rotate(0deg); transform: rotate(0deg); }
        100% { transform: rotate(360deg); transform: rotate(360deg); }
    }
    .croll{
        max-height: 80vh;
        overflow-y: scroll;
    }
    .feed{
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #dc3545;
    }
    .searchform{
        width: 500px;
    }
    @media(min-width: 300px){
        .searchform{
            width: 126px !important;
        }
    }
    @media(min-width: 400px){
        .searchform{
            width: 200px !important;
        }
    }

    @media (min-width: 576px) {
        .searchform {
            width: 350px !important;
        }
    }

    @media (min-width: 768px) {
        .searchform {
            width: 500px !important;
        }
    }

    @media (min-width: 992px) {
        .searchform {
            width: 500px !important;
        }
    }

    @media (min-width: 1200px) {
        .searchform {
            max-width: 500px !important;
        }
    }
    .avatar{border-radius: 50%;}

    /*.search input:focus + .results { display: block }*/

    .search-result{
        border-bottom:solid 1px #BDC7D8;
        padding:5px;
        font-family:Times New Roman;
        font-size: 14px;
        color:blue;
    }

    .search .results {
        display: none;
        position: absolute;
        /*top: 35px;*/
        left: 0;
        right: 0;
        z-index: 10;
        padding: 0;
        margin: 0;
        max-height:50vh;
        overflow-y: scroll !important;
        border-width: 1px;
        border-style: solid;
        border:solid 1px #BDC7D8;
        border-color: #cbcfe2 #c8cee7 #c4c7d7;
        border-radius: 3px;
        background-color: #fdfdfd;

        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fdfdfd), color-stop(100%, #eceef4));
        background-image: -webkit-linear-gradient(top, #fdfdfd, #eceef4);
        background-image: -moz-linear-gradient(top, #fdfdfd, #eceef4);
        background-image: -ms-linear-gradient(top, #fdfdfd, #eceef4);
        background-image: -o-linear-gradient(top, #fdfdfd, #eceef4);
        background-image: linear-gradient(top, #fdfdfd, #eceef4);
        -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        -ms-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        -o-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .search .results li { display: block }

    .search .results li:first-child { margin-top: -1px }

    .search .results li:first-child:before, .search .results li:first-child:after {
        display: block;
        content: '';
        width: 0;
        height: 0;
        position: absolute;
        left: 50%;
        margin-left: -5px;
        border: 5px outset transparent;
    }

    .search .results li:first-child:before {
        border-bottom: 5px solid #c4c7d7;
        top: -11px;
    }

    .search .results li:first-child:after {
        border-bottom: 5px solid #fdfdfd;
        top: -10px;
    }

    .search .results li:first-child:hover:before, .search .results li:first-child:hover:after { display: none }

    .search .results li:last-child { margin-bottom: -1px }

    .search .results a {
        display: block;
        position: relative;
        margin: 0 -1px;
        padding: 6px 40px 6px 10px;
        color: #808394;
        font-weight: 500;
        text-shadow: 0 1px #fff;
        border: 1px solid transparent;
        border-radius: 3px;
    }

    .search .results a span { font-weight: 200 }

    .search .results a:before {
        content: '';
        width: 18px;
        height: 18px;
        position: absolute;
        top: 50%;
        right: 10px;
        margin-top: -9px;
        background: url("https://cssdeck.com/uploads/media/items/7/7BNkBjd.png") 0 0 no-repeat;
    }

    .search .results a:hover {
        text-decoration: none;
        color: #fff;
        text-shadow: 0 -1px rgba(0, 0, 0, 0.3);
        border-color: #2380dd #2179d5 #1a60aa;
        background-color: #338cdf;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #59aaf4), color-stop(100%, #338cdf));
        background-image: -webkit-linear-gradient(top, #59aaf4, #338cdf);
        background-image: -moz-linear-gradient(top, #59aaf4, #338cdf);
        background-image: -ms-linear-gradient(top, #59aaf4, #338cdf);
        background-image: -o-linear-gradient(top, #59aaf4, #338cdf);
        background-image: linear-gradient(top, #59aaf4, #338cdf);
        -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
        -moz-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
        -ms-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
        -o-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
    }

    :-moz-placeholder {
        color: #a7aabc;
        font-weight: 200;
    }

    ::-webkit-input-placeholder {
        color: #a7aabc;
        font-weight: 200;
    }

</style>
