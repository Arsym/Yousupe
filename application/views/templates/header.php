<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= $header; ?></title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/mdb.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/img/icon.ico') ?>" rel="shortcut icon">
  <style>
    .jumbo {
    background-image: url(<?= base_url('assets/img/jumbotron.jpg') ?>);
    background-attachment: fixed;
    background-size: cover;
    background-position: 0 -180px;
    color: #f1f1f1;
    box-shadow: 1px 1px 10px rgba(0,0,0,.5);
    }
    
    hr {
    width: 150px;
    border-top: 3px solid #bd2130;
    }

    .modal-footer {
      border-top: 3px solid #bd2130 !important;
    }

    a {
      text-decoration: unset;
    }

    .card {
      padding-top: 100px;
      padding-bottom: 100px;
    }

    #my_video_list {
      max-width: 100%;
      margin: auto;
    }

    @media screen and (orientation: landscape) and (min-width: 801px) {
      #my_video_list {
        max-width: 100%;
      }
    }

    #my_video_list a {
      margin: 5px;
      width: 24%;
      height: 155px;
      line-height: 15px; /* match height */
      color: #FFF;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      border: 2px solid #000;
      display: inline-table;
      background-size: 100% 100% !important;
    }

    /* media list title overlay */

    #my_video_list a div {
      opacity: 0;
      background: rgba(0, 0, 0, .8);
      transition:.3s;
      height: 100%;
      padding-top:10px;
      padding-bottom: 10px;
    }

    #my_video_list a:hover div {  opacity: 1; transition:.3s; }
    #my_video_list a:hover { border: 2px solid #F00; }

    #my_player {
      display: none;
      background: rgba(0, 0, 0, .8);
      position: fixed;
      width: 100%;
      height: 100%;
      z-index: 20;
      left: 0;
      top: 0;
    }

    #my_player div {
      position: fixed;
      background: #000;
      width: 720px; /* width of YouTube Player */
      height: 400px; /* height of YouTube Player */
      left: calc(50vw - 360px); /* 280 is .5(560), centers x axis*/
      top: calc(50vh - 200px); /* 157 is .5(315), centers y axis*/
    }

    @media (max-width: 1198px) {
      #my_video_list a {
        width: 31.8%;
      }
    }


    @media (max-width: 800px) {
      #my_video_list a {
        width: 48%;
      }

      #my_player div {
      position: fixed;
      background: #000;
      width: 540px; /* width of YouTube Player */
      height: 300px; /* height of YouTube Player */
      left: calc(50vw - 270px); /* 280 is .5(560), centers x axis*/
      top: calc(50vh - 150px); /* 157 is .5(315), centers y axis*/
      }

      iframe {
        width: 540px;
        height: 300px;
      }

      .card-title {
        font-size: 44px;
      }

      .lead {
        font-size: 18px;
      }

      .card {
        height: 300px;
        padding-top: 5%;
        padding-bottom: 0;
      }

      .jumbo {
      background-size: 850px;
      background-position: 0 -100px;
      color: #f1f1f1;
      box-shadow: 1px 1px 10px rgba(0,0,0,.5);
      }
    }

    @media (max-width: 500px) {
      #my_video_list a {
        width: 77%;
      }

      #my_player div {
      position: fixed;
      background: #000;
      width: 330px; /* width of YouTube Player */
      height: 190px; /* height of YouTube Player */
      left: calc(50vw - 165px); /* 280 is .5(560), centers x axis*/
      top: calc(50vh - 95px); /* 157 is .5(315), centers y axis*/
      }

      iframe {
        width: 330px;
        height: 190px;
      }

      .navbar-brand {
        width: 100px;
      }

      .card-title {
        font-size: 30px;
      }

      .lead {
        font-size: 16px;
      }

      .card {
        height: 300px;
        padding-top: 0;
        padding-bottom: 0;
      }

      .jumbo {
      background-size: 550px;
      background-position: -100px 0;
      color: #f1f1f1;
      box-shadow: 1px 1px 10px rgba(0,0,0,.5);
      }
    }

    .active {
      border-bottom: 3px solid #bd2130;
    }

    .img-thubmnail {
      border: 1px solid #aaa;
    }
  </style>
</head>

<body class="elegant-color text-white">
  <nav class="navbar navbar-expand-lg navbar-dark elegant-color-dark sticky-top">
    <div class="container">
    <a class="navbar-brand w-relative" href="<?= base_url() ?>"><img src="<?= base_url('assets/img/logo.png') ?>" alt="logo" style="width: 200px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
  </div>


    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
      <form class="form-inline" method="get">
    <div class="input-group my-0">
      <input type="text" class="form-control" placeholder="Masukkan Channel ID" aria-label="Masukkan Channel ID"
        aria-describedby="MaterialButton-addon2" name="keyword">
      <div class="input-group-append">
        <button class="btn btn-md btn-danger m-0 px-3" type="submit" id="MaterialButton-addon2"><i class="fas fa-search text-white"></i></button>
      </div>
    </div>
    </form>
  </ul>
  <?php 
  if(isset($_GET['keyword'])) {
       $keyword = $_GET['keyword'];
      } else {
        error_reporting(0);
      }; ?>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php if($this->uri->segment(1)==""){echo "active";}?>">
          <a class="nav-link" href="<?= base_url()."?keyword=".$keyword; ?>">Terbaru</a>
        </li>
        <li class="nav-item <?php if($this->uri->segment(1)=="playlist"){echo "active";}?>">
          <a class="nav-link" href="<?= base_url('playlist')."?keyword=".$keyword;  ?>">Playlist</a>
        </li>
      </ul>
      <button class="btn btn-md btn-danger waves-effect w-auto" type="submit"><strong>Login</strong></button>
    </div>
  </div>
  </nav>
<!-- Jumbotron -->
<div class="card card-image jumbo">
  <div class="text-center d-flex img-gradient-overlay px-4">
    <div class="">
      <!-- Content -->
      <h1 class="card-title my-4 py-2 display-4"><strong>Yousupe | </strong>Media Streaming Terbaik!</h1>
      <p class="mb-4 pb-2 px-md-5 mx-md-5 lead">Lorem ipsum dulur amit sek, aku meh liwat kene. Pariatur obcaecati vero aliquid libero doloribus ad, unde tempora maiores, ullam, modi qui quidem minima debitis perferendis vitae cumque et quo impedit.</p>
    </div>
  </div>
</div>
<!-- Jumbotron -->