<?php
session_start();
ini_set("display_errors", 0);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);
//if (!isset($_SESSION["user"])){
 //header( "Refresh:1; url=login.html", true, 303);
 //}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Quote Generator </title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap/css/business-casual.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.min.js"></script>
  <script>
  function f(){

  var ins=document.getElementById('category');
  var cat = ins.value;
  alert(cat);

var resource_url = 'searchC.php?cat=' + cat;
$.get(resource_url, function (data) {
    //data: { meta: {<metadata>}, data: {<array[Practice]>} }
     var template = Handlebars.compile(document.getElementById('docs-template').innerHTML);
      document.getElementById('content-placeholder').innerHTML = template(data);
  });
}

  </script>

  </head>

  <body>

    <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3"> Welcome To Our Page!</span>
      <span class="site-heading-lower"> Come To Us For Your Quote Needs </span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="generator.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="qod.php">QOD </a>
            </li>
            <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="favourite.php">Favourites </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="friends.php"> Friends </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="logout.php"> Log Out </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="page-section about-heading">
      <div class="container">
        <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="http://bootstrap/img/about.jpg" alt="">
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded rounded p-5">
                <h2 class="section-heading mb-4">
                  <br>
                  <p>
                    <p>
                  <center> <span class="section-heading-lower"> Generator </span>
                  <span class="section-heading-upper">
                    <form>
                      <select id="category">

                            <option value="inspire">Inspire</option>
                            <option value="management">Management</option>
                            <option value="sports">Sports</option>
                            <option value="life">Life</option>
                            <option value="funny">Funny</option>
                            <option value="love">Love</option>
                            <option value="art">Art</option>
                            <option value="students">Students</option>
                            <input type=button onclick="f()" value="submit">
                      </select>
                    </form>
                   </span> </center>
                </h2>
                <div id="content-placeholder"></div>
                <script id="docs-template" type="text/x-handlebars-template">
                    <table>
                        <thead>
                            <th>Quote</th>
                        </thead>
                        <tbody>

                        <tr>
                          {{#contents.quotes}}
                          <td>{{quote}}</td>
                        </tr>
                        <tr>
                          <td><a href="save.php?quote={{quote}}" target="_new">Save</a><br></td>
                              {{/contents.quotes}}
                        </tr>

                        </tbody>
                    </table>
                </script>
              </div>
            </div>
          </div>
        </div>


      </div>
    </section>

    <footer class="footer text-faded text-center py-5">
      <div class="container">
        <p class="m-0 small">Copyright &copy; Quote Generator 2018</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
    <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
