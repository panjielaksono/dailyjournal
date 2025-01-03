<?php
include "connection.php";
?>

<div class="container"  style="padding-bottom: 100px;">
    <!-- Button trigger modal -->
<button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
    <i class="bi bi-plus-lg"></i> Tambah User
</button>
    <div class="row">
        <div class="table-responsive" id="user_data">

        </div>
        <!-- Awal Modal Tambah-->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Tuliskan username" required>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Tuliskan Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="foto"> 
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
<!-- Akhir Modal Tambah-->
    </div>
</div>

<!-- Script JQuery Ajax -->
 <script>
    // function load_data
    $(document).ready(function() {
        load_data();
        function load_data(hlm){
            $.ajax({
                url : "user_data.php",
                method : "POST",
                data : {
                    hlm: hlm
                },
                success: function(data){
                    $('#user_data').html(data);
                }
            })
        }

    // function pagination
        $(document).on('click','.halaman',function(){
            var hlm = $(this).attr("id");
            load_data(hlm);
        });

    });
 </script>

<?php
include "upload_foto.php";

//jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    // Get form data
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);
    $tanggal_dibuat = date("Y-m-d H:i:s"); 
    $tanggal_modified = date("Y-m-d H:i:s");
    $foto = ''; 
    $nama_foto = $_FILES['foto']['name']; 

    // new file is uploaded?
    if ($nama_foto != '') {
        // Call the upload_foto function
        $cek_upload = upload_foto($_FILES["foto"]); 

        // Check upload status
        if ($cek_upload['status']) {
            // If true, store the file name
            $foto = $cek_upload['message']; 
        } else {
            // If false, show an error message
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=user';
            </script>";
            die; 
        }
    }

    // Check if an ID is provided (for updating an existing user)
    if (isset($_POST['id'])) {
        // If ID exists, update the record
        $id = $_POST['id'];

        // If no new image is uploaded, keep the old image
        if ($nama_foto == '') {
            $foto = $_POST['foto_lama'];  // Keep the old image
        } else {
            // If a new image is uploaded, delete the old image
            unlink("img/" . $_POST['foto_lama']); 
        }

        // Update query
        $stmt = $conn->prepare("UPDATE user 
                                SET username = ?, 
                                    password = ?, 
                                    tanggal_dibuat = ?,
                                    tanggal_modified = ?, 
                                    foto = ?  // Changed 'gambar' to 'foto' 
                                WHERE id = ?");

        // Bind the parameters to the query
        $stmt->bind_param("sssssi", $username, $password, $tanggal_dibuat ,$tanggal_modified, $foto, $id); 

        // Execute the update query
        $simpan = $stmt->execute();
    } else {
        // If no ID, insert a new user record
        $stmt = $conn->prepare("INSERT INTO user (username, password, tanggal_dibuat, tanggal_modified, foto) 
                                VALUES (?, ?, ?, ?, ?)");

        // Bind the parameters for the insert query
        $stmt->bind_param("sssss", $username, $password, $tanggal_dibuat, $tanggal_modified, $foto); 

        // Execute the insert query
        $simpan = $stmt->execute();
    }

    // Check if the operation was successful
    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=user';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=user';
        </script>";
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
}


//jika tombol hapus diklik
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $foto = $_POST['foto']; 

    if ($foto != '') {
        //hapus file gambar
        unlink("img/" . $foto); 
    }

    $stmt = $conn->prepare("DELETE FROM user WHERE id =?");

    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=user';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=user';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>