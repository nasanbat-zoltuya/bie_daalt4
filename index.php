<?php
// GET method-оор аль хуудсыг харуулахыг шийднэ
$page = $_GET['page'] ?? 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?php
      if ($page === 'menu')      echo 'Coffee Menu';
      elseif ($page === 'about') echo 'About Us - Coffee Shop';
      else                       echo 'Coffee Shop';
    ?>
  </title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome (Home дээр icon-уудын тулд) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

  <!-- Нэгтгэсэн CSS (style + menu + about) -->
  <style>
    /* ===== Reset & Base ===== */    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-family:"Arial",sans-serif;
    }

    /* ===== Theme Colors ===== */
    :root{
      --coffee-dark:#121212;
      --coffee-accent:#d2911c;
    }

    /* ===== Background Image (Dark Theme) ===== */
    body{
      background:url("image/dark.jpeg") no-repeat center center fixed;
      background-size:cover;
      color:#fff;
      min-height:100vh;
    }

    /* ===== Navbar ===== */
    .navbar{
      background-color:rgba(0,0,0,0.8);
      padding:15px 0;
    }
    .navbar-brand{
      color:#fff!important;
      font-weight:600;
      letter-spacing:1px;
    }
    .navbar-nav{
      display:flex;
      gap:2rem;
    }
    .navbar-dark .nav-link{
      color:#fff!important;
      font-size:1.05rem;
      transition:color .3s ease;
    }
    .navbar-dark .nav-link:hover,
    .navbar-dark .nav-link.active{
      color:var(--coffee-accent)!important;
    }

    /* ===== HOME: Hero Section ===== */
    .hero-section{
      color:#fff;
      padding-top:5rem;
      padding-bottom:5rem;
    }
    .hero-text h2{
      color:var(--coffee-accent);
      font-weight:700;
    }
    .hero-text h1{
      font-weight:700;
      color:#fff;
    }
    .hero-text h1 span{
      color:var(--coffee-accent);
      text-decoration:underline;
      text-underline-offset:6px;
    }
    .hero-text p{
      color:#dcdcdc;
    }
    .hero-section img{
      max-width:90%;
      border-radius:12px;
      box-shadow:0 0.75rem 1.5rem rgba(0,0,0,.3);
    }

    /* ===== HOME: Video Section ===== */
    #video{
      padding-bottom:3rem;
    }

    /* ===== MENU: Hero ===== */
    #menu-hero{
      padding-top:5rem;
      padding-bottom:4rem;
      text-align:center;
    }
    #menu-hero h1{
      color:var(--coffee-accent);
      font-weight:700;
    }
    #menu-hero p{
      color:#dcdcdc;
      max-width:600px;
      margin:0 auto;
      font-size:1.1rem;
    }

    /* ===== MENU: Cards ===== */
    #menu{
      padding:60px 0;
      text-align:center;
    }
    .card{
      background-color:rgba(255,255,255,0.08);
      border:none;
      color:#fff;
      transition:transform .3s ease, box-shadow .3s ease;
    }
    .card:hover{
      transform:translateY(-6px);
      box-shadow:0 0.75rem 1.5rem rgba(0,0,0,.5);
    }
    .card-title{
      color:var(--coffee-accent);
      font-weight:600;
    }
    .card-text{
      color:#dcdcdc;
    }
    .card-img-top{
      height:250px;
      object-fit:cover;
      border-top-left-radius:10px;
      border-top-right-radius:10px;
    }

    /* ===== ABOUT Page ===== */
    .hero{
      color:#fff;
      padding-top:5rem;
      padding-bottom:3rem;
      text-align:center;
    }
    .hero h1{
      color:var(--coffee-accent);
      font-weight:700;
    }
    .hero p{
      color:#dcdcdc;
      max-width:640px;
      margin:0 auto;
    }
    .section-title{
      color:var(--coffee-accent);
      font-weight:700;
    }
    .about-image{
      border-radius:12px;
      box-shadow:0 0.75rem 1.5rem rgba(0,0,0,.4);
    }
    p{color:#e9e9e9;}

    /* ===== Buttons ===== */
    .btn-primary{
      background-color:var(--coffee-accent);
      border-color:var(--coffee-accent);
      color:#000;
      font-weight:600;
    }
    .btn-primary:hover{
      background-color:#b37815;
      border-color:#b37815;
      color:#000;
    }
    .btn-outline-light{
      border-color:#fff;
      color:#fff;
    }
    .btn-outline-light:hover{
      background-color:#fff;
      color:#000;
    }

    /* ===== Footer ===== */
    footer{
      background-color:rgba(0,0,0,.9);
      color:#fff;
      font-size:.9rem;
    }

    /* ===== Responsive ===== */
    @media(max-width:576px){
      body{background-attachment:scroll;}
      .hero-section,.hero,#menu-hero{
        padding-top:2.5rem;
        padding-bottom:2.5rem;
      }
      .card-img-top{height:180px;}
      img{max-width:100%;}
      h1{font-size:1.8rem;}
      .navbar-nav{gap:1rem;}
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-md navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand fw-semibold" href="index.php?page=home">☕ Coffee Shop</a>
      <div class="navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?php echo ($page === 'home') ? 'active' : ''; ?>" href="index.php?page=home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page === 'menu') ? 'active' : ''; ?>" href="index.php?page=menu">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page === 'about') ? 'active' : ''; ?>" href="index.php?page=about">About</a>
          </li>
        </ul>

        <!-- Admin товч – шинэ цонх нээнэ -->
        <a href="admin_login.php" target="_blank" class="btn btn-primary ms-3">
          Admin
        </a>
      </div>
    </div>
  </nav>

  <?php if ($page === 'home'): ?>

    <!-- ========== HOME PAGE ========== -->
    <section class="py-5 hero-section text-light">
      <div class="container">
        <div class="row align-items-center g-4">
          <div class="col-12 col-lg-6 hero-text">
            <h2 class="fs-6 mb-2 text-warning text-uppercase">Exceptional Quality</h2>
            <h1 class="display-5 fw-bold lh-sm mb-3">
              We began with the concept:
              Create amazing <span>coffee</span>
            </h1>
            <hr class="opacity-25 mb-3">
            <p class="mb-4">
              Our mission is to provide sustainably sourced, hand-picked quality coffee.
              Great coffee is our passion and we want to share it with you...
            </p>
            <div class="d-flex align-items-center gap-3">
              <a href="index.php?page=menu" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-mug-hot me-2"></i> Tasty coffee
              </a>
              <a href="#video" class="btn btn-outline-light btn-lg">
                <i class="fa-solid fa-play me-2"></i> Play video
              </a>
            </div>
          </div>
          <div class="col-12 col-lg-6 text-center">
            <img src="image/download77.png" class="img-fluid" alt="coffee image">
          </div>
        </div>
      </div>
    </section>

    <section id="video" class="pb-5">
      <div class="container">
        <div class="ratio ratio-16x9 rounded-4 shadow">
          <iframe src="https://www.youtube.com/embed/wFut2zYOT7k" allowfullscreen></iframe>
        </div>
      </div>
    </section>

  <?php elseif ($page === 'menu'): ?>

    <!-- ========== MENU PAGE ========== -->
    <section id="menu-hero" class="py-5 text-center text-light">
      <div class="container">
        <h1 class="display-5 fw-bold mb-3 text-warning">Our Coffee Menu</h1>
        <p class="lead text-light">
          Explore our freshly brewed, hand-picked coffee. Great taste and aroma in every cup.
        </p>
      </div>
    </section>

    <section id="menu" class="py-5 text-center">
      <div class="container">
        <div class="row g-4 justify-content-center">
          <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm border-0">
              <img src="image/espresso.jpeg" class="card-img-top" alt="Espresso">
              <div class="card-body">
                <h5 class="card-title text-warning">Espresso</h5>
                <p class="card-text text-light">Rich and bold coffee shot.</p>
                <span class="fw-semibold text-warning fs-5">$3</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm border-0">
              <img src="image/latte.jpeg" class="card-img-top" alt="Latte">
              <div class="card-body">
                <h5 class="card-title text-warning">Latte</h5>
                <p class="card-text text-light">Smooth coffee with steamed milk.</p>
                <span class="fw-semibold text-warning fs-5">$4</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm border-0">
              <img src="image/cappuccino.jpeg" class="card-img-top" alt="Cappuccino">
              <div class="card-body">
                <h5 class="card-title text-warning">Cappuccino</h5>
                <p class="card-text text-light">Classic coffee with frothy milk.</p>
                <span class="fw-semibold text-warning fs-5">$4</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  <?php elseif ($page === 'about'): ?>

    <!-- ========== ABOUT PAGE ========== -->
    <section class="py-5 text-center hero">
      <div class="container">
        <h1 class="display-5 fw-bold mb-3">About Us</h1>
        <p class="lead">
          Discover our story and passion for crafting the perfect cup of coffee.
        </p>
      </div>
    </section>

    <section class="py-5">
      <div class="container">
        <div class="row align-items-center g-4">
          <div class="col-12 col-md-6">
            <img src="image/download77.png" alt="Coffee Shop" class="img-fluid rounded-4 shadow about-image">
          </div>
          <div class="col-12 col-md-6">
            <h2 class="section-title mb-3">Our Journey</h2>
            <p class="mb-3">
              Coffee Shop was founded with a simple goal: provide exceptional coffee experiences to our customers.
              From sourcing sustainably grown beans to handcrafting every cup, we take pride in every detail.
            </p>
            <p>
              Join us on our journey and taste the passion in every sip. Great coffee is more than a beverage — it’s an experience.
            </p>
          </div>
        </div>
      </div>
    </section>

  <?php endif; ?>

  <!-- FOOTER -->
  <footer class="text-light py-3 text-center small">
    © 2025 Coffee Shop • All rights reserved
  </footer>

</body>
</html>