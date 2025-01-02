<?php
    session_start();
    include "connection.php";

    //cek login
    if (!isset($_SESSION['username'])) {
        header("location:login.php");
        exit(); 
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Latihan PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CDN buat icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- logo web -->
    <link rel="icon" href="img/exercise.png" />
</head>

<body>
    <!-- ini navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">My Daily Journal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto text-dark">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#hero">Hero</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#schedule">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#profil">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ini hero -->
    <section id="hero" class="text-center p-5 bg-info-subtle text-sm-start">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="img/cr7.jpg" alt="" class="img-fluid" width="300">
                <div class="txt">
                    <h1 class="fw-bold display-4">Diary Journal </h1>
                    <h4 class="lead display-6">Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali</h4>
                    <p> - Much Panji Laksono</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ini artikel -->
    <!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">Article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->
    <!-- ini gallery -->
    <section id="gallery" class="text-center p-5 bg-info-subtle">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Gallery</h1>
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/badminton.jpg" class="d-block w-100" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="img/cow.jpg" class="d-block w-100" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="img/badminton1.jpg" class="d-block w-100" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="img/diskrit.jpg" class="d-block w-100" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="img/sapi.jpg" class="d-block w-100" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="img/snowi.jpg" class="d-block w-100" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="img/chill.jpg" class="d-block w-100" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="img/hotwheels.jpg" class="d-block w-100" alt="">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <section id="schedule" class="text-center">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3 mt-5">Jadwal Kuliah & Kegiatan Mahasiswa</h1>
            <div class="row p-5 justify-content-center">
                <div class="col-md-3 mb-4">
                    <div class="card mb-3" style="max-width: 18rem; border-color: #0d6efd;">
                        <div class="card-header bg-primary text-white">Senin</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title mb-0">12:30-15:00</h5>
                            <p class="card-text mb-0">Probabilitas dan Statistika</p>
                            <p class="card-text">Ruang H.4.8</p>
                            <h5 class="card-title mb-0">15:30-18:00</h5>
                            <p class="card-text mb-0">Sistem Operasi</p>
                            <p class="card-text">Ruang H.4.9</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card mb-3" style="max-width: 18rem; border-color: #00a738;">
                        <div class="card-header bg-success text-white">Selasa</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title mb-0">09:30-12:00</h5>
                            <p class="card-text mb-0">Rekayasa Perangkat Lunak</p>
                            <p class="card-text">Ruang H.4.10</p>
                            <h5 class="card-title mb-0">15:30-18:00</h5>
                            <p class="card-text mb-0">Data Mining</p>
                            <p class="card-text">Ruang H.3.1</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card mb-3" style="max-width: 18rem; border-color: #fd4d0d;">
                        <div class="card-header bg-danger text-white">Rabu</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title mb-0">09:30-12:00</h5>
                            <p class="card-text mb-0">Kriptografi</p>
                            <p class="card-text">Ruang H.4.11</p>
                            <h5 class="card-title mb-0">15:30-18:00</h5>
                            <p class="card-text mb-0">Self Develop</p>
                            <p class="card-text">TreeTop Fitness</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card mb-3" style="max-width: 18rem; border-color: #E4A11B;">
                        <div class="card-header bg-warning text-white">Kamis</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title mb-0">09:30-12:00</h5>
                            <p class="card-text mb-0">Logika Informatika</p>
                            <p class="card-text">Ruang H.4.8</p>
                            <h5 class="card-title mb-0">14:10-15:50</h5>
                            <p class="card-text mb-0">Basis Data</p>
                            <p class="card-text">Ruang H.4.9</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card mb-3" style="max-width: 18rem; border-color: #0dddfd;">
                        <div class="card-header bg-info text-white">Jumat</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title mb-0">10:20-12:00</h5>
                            <p class="card-text mb-0">Pemrograman Berbasis web</p>
                            <p class="card-text">Ruang D.2.J</p>
                            <h5 class="card-title mb-0">14:10-15:50</h5>
                            <p class="card-text mb-0">Basis Data</p>
                            <p class="card-text">Ruang D.3.M</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card mb-3" style="max-width: 18rem; border-color: #696969;">
                        <div class="card-header bg-secondary text-white">Sabtu</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title mb-0">15:00-17:00</h5>
                            <p class="card-text mb-0">Self Develop</p>
                            <p class="card-text">TreeTop Fittness</p>
                            <h5 class="card-title mb-0">14:10-15:50</h5>
                            <p class="card-text mb-0">Basis Data</p>
                            <p class="card-text">Ruang H.4.9</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card mb-3" style="max-width: 18rem; border-color: #000000;">
                        <div class="card-header bg-dark text-white">Minggu</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title mb-0">07:00-07:30</h5>
                            <p class="card-text mb-0">Bubur Ayam</p>
                            <p class="card-text">Dimana saja</p>
                            <h5 class="card-title mb-0">20:30-12:00</h5>
                            <p class="card-text mb-0">Menjaga Perdamaian</p>
                            <p class="card-text">Enlisted</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ini profile -->
        <section id="profil">
            <div class="container p-5">
                <h1 class="fw-bold display-4 pb-3 text-center mb-5">Profil Mahasiswa</h1>
                <div class="row align-items-center">
                    <div class="col-md-4 text-center p-3">
                        <img src="img/f2.png" alt="" class="rounded-circle">
                    </div>
                    <div class="col-md-8">
                        <div class="card text-center" style="border: none;">
                            <div class="mb-3">
                                <h2>Much Panji Laksono</h2>
                            </div>
                            <div class="row p-5">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th class="text-start">NIM</th>
                                            <td class="text-start">: A11.2023.15237</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Program Studi</th>
                                            <td class="text-start">: Teknik Informatika</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Email</th>
                                            <td class="text-start">: 111202315237@mhs.dinus.id</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Telepon</th>
                                            <td class="text-start">: +6282314927363</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Alamat</th>
                                            <td class="text-start">: Jl. Pisang No. 8, West Virginia</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ini footer -->
        <footer class="text-center p-5">
            <div class="icon text-center">
                <a href="https://www.instagram.com/_panjiil/" target="_blank" class="text-dark"><i
                        class="bi bi-instagram h2 p-2 text-dark"></i></a>
                <a href="https://www.youtube.com/@phucc69" target="_blank" class="text-dark"><i
                        class="bi bi-youtube h2 p-2 text-dark"></i></a>
                <a href="https://wa.me/6282314927363?text=olaamigos" target="_blank" class="text-dark"><i
                        class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
            </div>
            <div class="copyright">Much Panji Laksono &copy 2024</div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>

</html>