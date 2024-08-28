<?php
require "header.php";
?>

<header class="header">
    <div class="row">
        <div class="col-md-12 text-center">
            <a class="logo"><img src="img/l2.jpg" alt="logo"></a>
        </div>
        <div class="col-md-12 text-center">
            <button type="button" onclick="window.location.href='reservation.php'" class="btn btn-outline-light btn-lg"><em>Make a Reservation Now!</em></button>
        </div>
    </div>
</header>

<!--about us section-->

<section id="aboutus">
    <div class="container">
        <h3 class="text-center"><br><br>SizzleS</h3>
        <div class="row">
            <!--carousel-->
            <div class="col-sm"><br><br>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="img/b1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="img/b2.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="img/b3.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div><br><br>
            </div>
            <!--end of carousel-->

            <div class="col-sm">
                <div class="arranging"><br><hr>
                    <h4 class="text-center">Our Story</h4>
                    <p><br>The restaurant SizzleS, first opened in 2023 in “Bhimavaram”, one of the oldest districts of Andhra Pradesh in the historical center of the city. In 2024, the restaurant was awarded its first Michelin star and has retained it since.<br><br>
                    <br><br><br></p><hr>
                </div>
            </div>
        </div><br>
    </div>
</section>
<!--end of about us section-->

<div class="header2">
</div>

<!----menu -->
<div class id="menu"><br>
    <div class="container">
        <h3 class="text-center"><br>MENU<br><br></h3>
        <div class="d-flex flex-row flex-wrap justify-content-center">
            <div class="d-flex flex-column">
                <img src="img/menu.jpg" class="img-fluid custom-img-size">
            </div>
        </div>
    </div>
</div><br><br>
<!----end of menu -->

<div class="container" id="reservation">
    <h3 class="text-center"><br><br>Reservation<br><br></h3>
    <img src="img/16.jpg" class="img-fluid rounded">
    <button type="button" onclick="window.location.href='reservation.php'" class="btn btn-outline-dark btn-block btn-lg">Make a reservation Now!</button>
</div><br><br>

<div class="header2">
</div>

<?php
require "footer.php";
?>
