<?php
include "connection.php";

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $foto = $_POST['foto'];

    // If there's an image associated with the article, delete the image file
    if ($foto != '') {
        unlink("img/" . $foto);
    }

    // Prepare SQL query for deleting the article
    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    // Check if the delete operation was successful
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

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

?>

<div class="container" style="padding-bottom: 100px;">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah User
    </button>
    <div class="row">
        <div class="table-responsive" id="user_data"></div>
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
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="guest" name="role">Guest</option>
                                    <option value="admin" name="role">Admin</option>
                                </select>
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
    $(document).ready(function() {
        load_data();
        function load_data(hlm){
            $.ajax({
                url : "user_data.php",
                method : "POST",
                data : { hlm: hlm },
                success: function(data){
                    $('#user_data').html(data);
                }
            });
        }

        $(document).on('click','.halaman',function(){
            var hlm = $(this).attr("id");
            load_data(hlm);
        });
    });
</script>

<?php
include "connection.php";

// Simpan data (Insert / Update)
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? hash('sha256', $_POST['password']) : null;
    $role = $_POST['role'];
    $foto = $_FILES['foto']['name'];

    if (!empty($id)) {
        // Update User
        if ($foto) {
            // Upload foto baru jika ada
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);
        } else {
            $foto = $_POST['foto_lama']; // jika foto tidak diganti, pakai foto lama
        }

        $sql = "UPDATE user SET username = ?, password = ?, role = ?, foto = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $username, $password, $role, $foto, $id);
    } else {
        // Insert User Baru
        if ($foto) {
            // Upload foto baru jika ada
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);
        }

        $sql = "INSERT INTO user (username, password, role, foto) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $password, $role, $foto);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil disimpan!');</script>";
    } else {
        echo "<script>alert('Data gagal disimpan.');</script>";
    }
}

// Hapus User
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $foto = $_POST['foto']; 

    // Hapus file foto jika ada
    if ($foto && file_exists('img/' . $foto)) {
        unlink('img/' . $foto);
    }

    $sql = "DELETE FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('User berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus user');</script>";
    }
}
?>
