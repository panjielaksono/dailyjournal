<?php
// Check if the session is already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file
include "connection.php";  
include "upload_foto.php"; 
// Check if the 'simpan' button was clicked (for saving data)
if (isset($_POST['simpan'])) {
    // Get form data
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];  
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    // Check if a file was uploaded
    if ($nama_gambar != '') {
        // Call function to handle file upload
        $cek_upload = upload_foto($_FILES["gambar"]);

        // Check upload status
        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            // If upload fails, show an error and stop further execution
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=article';
            </script>";
            die; // Stop execution if there's an error
        }
    }

    // Check if there is an 'id' for updating existing data
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // If no new image was uploaded, keep the old image
        if ($nama_gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            // If a new image was uploaded, delete the old image
            unlink("img/" . $_POST['gambar_lama']);
        }

        // Prepare SQL query for updating the article
        $stmt = $conn->prepare("UPDATE article 
                                SET 
                                judul = ?, 
                                isi = ?, 
                                gambar = ?, 
                                tanggal = ?, 
                                username = ? 
                                WHERE id = ?");
        $stmt->bind_param("sssssi", $judul, $isi, $gambar, $tanggal, $username, $id);
        $simpan = $stmt->execute();
    } else {
        // If no 'id', perform insert operation to add a new article
        $stmt = $conn->prepare("INSERT INTO article (judul, isi, gambar, tanggal, username)
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $judul, $isi, $gambar, $tanggal, $username);
        $simpan = $stmt->execute();
    }

    // Check if the save operation was successful
    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=article';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=article';
        </script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

// Check if the 'hapus' button was clicked (for deleting data)
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    // If there's an image associated with the article, delete the image file
    if ($gambar != '') {
        unlink("img/" . $gambar);
    }

    // Prepare SQL query for deleting the article
    $stmt = $conn->prepare("DELETE FROM article WHERE id = ?");
    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    // Check if the delete operation was successful
    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=article';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=article';
        </script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<div class="container" style="padding-bottom: 100px;">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Article
    </button>
    <div class="row">
        <div class="table-responsive" id="article_data">
        </div>
        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Article</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Artikel" required>
                            </div>
                            <div class="mb-3">
                                <label for="floatingTextarea2">Isi</label>
                                <textarea class="form-control" placeholder="Tuliskan Isi Artikel" name="isi" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Tambah -->
    </div>
</div>

<!-- Script JQuery Ajax -->
<script>
    $(document).ready(function() {
        load_data();
        
        function load_data(hlm){
            $.ajax({
                url: "article_data.php",
                method: "POST",
                data: { hlm: hlm },
                success: function(data) {
                    $('#article_data').html(data);
                }
            })
        }

        // Pagination
        $(document).on('click', '.halaman', function(){
            var hlm = $(this).attr("id");
            load_data(hlm);
        });
    });
</script>

