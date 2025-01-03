<?php
//query untuk mengambil data article
include "connection.php";
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);

//menghitung jumlah baris data article
$jumlah_article = $hasil1->num_rows;

//query untuk mengambil data gallery
$sql2 = "SELECT * FROM gallery ORDER BY tanggal DESC";
$hasil2 = $conn->query($sql2);

//menghitung jumlah baris data gallery
$jumlah_gallery = $hasil2->num_rows;

//query untuk mengambil data user
$sql3 = "SELECT * FROM user ORDER BY id DESC";
$hasil3 = $conn->query($sql3);

//menghitung jumlah baris data user
$jumlah_user = $hasil3->num_rows;
?>
<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">

    <!-- article -->
    <a href="admin.php?page=article" style="text-decoration: none;">
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-newspaper"></i> Article</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_article; ?></span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
    </a>

    <!-- gallery -->
    <a href="admin.php?page=gallery" style="text-decoration: none;">
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-camera"></i> Gallery</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_gallery; ?></span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
    </a>

    <!-- user -->
    <a href="admin.php?page=user" style="text-decoration: none;">
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-person"></i> User</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_user; ?></span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
    </a>
</div>