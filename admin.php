<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//check apakah ada variable username yang tersimpan pada session
if (isset($_SESSION['username'])) {
		//jika ada, tampilkan greeting
}else{
		//jika tidak ada, alihkan ke halaman login
    header("location:login.php"); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal | Admin</title>
    <link rel="icon" href="img/logo.png" />
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous"
    /> 
    <!-- CDN Jquery Ajax -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <!-- nav begin -->
    <nav class="navbar navbar-expand-sm sticky-top" style="background-color: #074799;">
    <div class="container">
        <a class="navbar-brand text-light" href=".">My Daily Journal</a>
        <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
        >
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link text-light" href="admin.php?page=dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="admin.php?page=article">Article</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link text-light" href="admin.php?page=gallery">Gallery</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link text-light" href="admin.php?page=user">User</a>
            </li> 
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $_SESSION['username']?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li> 
                </ul>
            </li> 
        </ul>
        </div>
    </div>
    </nav>
    <!-- nav end -->
    <!-- content begin -->
    <section id="content" class="p-5">
        <div class="container">
            <?php
            if(isset($_GET['page'])){
            ?>
                <h4 class="lead display-6 pb-2 border-bottom border-primary-subtle"><?= ucfirst($_GET['page'])?></h4>
                <?php
                include($_GET['page'].".php");
            }else{
            ?>
                <h4 class="lead display-6 pb-2 border-bottom border-primary-subtle">Dashboard</h4>
                <?php
                include("dashboard.php");
            }
            ?>
        </div>
    </section>
<!-- content end -->

    <!-- footer begin -->
    <footer class="text-center p-2 footer fixed-bottom" style="background-color: #074799;">
    <div>
        <a href="https://www.instagram.com/_panjiil/" target="_blank"><i class="bi bi-instagram h2 p-2 text-light fs4"></i></a>
        <a href="https://x.com/dabelYu69" target="_blank"><i class="bi bi-twitter h2 p-2 text-light fs4"></i></a>
        <a href="https://wa.me/+6282314927363?text=olaamigos" target="_blank"><i class="bi bi-whatsapp h2 p-2 text-light fs4"></i></a>
    </div>
    <div class="copyright text-light mt-2">Much Panji Laksono &copy; 2023</div>
    </footer>
    <!-- footer end -->
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
    ></script>
</body>
</html>