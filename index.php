<?php
include_once (__DIR__.'./view/header.php');
?>

<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="content/img/slide1.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Painel Não Luminoso</h5>
                <p>Publicite a sua empresa connosco!</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="content/img/slide2-novo.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Painel Não Luminoso</h5>
                <p>Promova o seu negócio connosco!</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="content/img/slide3.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Painel Luminoso</h5>
                <p>Aumente a sua visibilidade connosco!</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<h5 class="text-center mt-5">Alguns tipos outdoors</h5>
<div class="d-flex justify-content-around mt-5 mb-5">
    <div class="card" style="width: 18rem;">
        <img src="content/img/card1.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Painel Não Luminoso</h5>
            <p class="card-text">Faça já o seu aluguel.</p>
            <a class="btn btn-primary" href=view/login.php>Alugar</a>
        </div>
    </div>

    <div class="card" style="width: 18rem;">
        <img src="content/img/card2.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Painel Luminoso</h5>
            <p class="card-text">Faça já o seu aluguel.</p>
            <a class="btn btn-primary" href=view/login.php>Alugar</a>
        </div>
    </div>
    
    <div class="card" style="width: 18rem;">
        <img src="content/img/card4.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Painel Não Luminoso</h5>
            <p class="card-text">Faça já o seu aluguel.</p>
            <a class="btn btn-primary" href=view/login.php>Alugar</a>
        </div>
    </div>
</div>

<?php include_once (__DIR__.'./view/footer.php');
