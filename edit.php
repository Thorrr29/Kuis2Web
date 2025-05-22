<?php 
include "koneksi/db.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: url('img/bg.jpg') no-repeat center center fixed; background-size:100%; min-height: 100vh; backdrop-filter:blur(6px);">
    <nav class="navbar navbar-expand-lg px-3" style="background-color: rgba(0, 0, 0, 0.3); backdrop-filter: blur(10px);">
        <a class="navbar-brand" href="dashboard.php" style="color: aliceblue;">MyApp</a>
        <div class="ms-auto">
            <a href="logout.php" class="btn btn-outline-light">Logout</a>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="card mb-4" style="background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(10px);">
            <div class="card-body">
                <h2 style="color: aliceblue;">Edit User</h2>
                <form method="POST" enctype="multipart/form-data">
            <div class="mb-3" style="color: aliceblue;">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required value="<?php echo $data['username']; ?>">
            </div>
            <div class="mb-3"style="color: aliceblue;">
                <label>Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo $data['password']; ?>">
            </div>
            <div class="mb-3" style="color: aliceblue;">
                <label>Foto Profil</label>
                <input type="file" name="foto" class="form-control" accept="image/*" value="<?php echo $data['foto']; ?>">
            </div>
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </div>
                
        </form>

        <?php
        if (isset($_POST['update'])) {
            $username = $_POST['username'];
            $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $data['password'];

            $foto_name = $data['foto']; 
            if (isset($_FILES['foto']) && $_FILES['foto']['name'] != '') {
                $foto_tmp = $_FILES['foto']['tmp_name'];
                $foto_name = $_FILES['foto']['name'];
                $upload_path = 'img/' . $foto_name;
                move_uploaded_file($foto_tmp, $upload_path);
            }

            $query = "UPDATE users SET username='$username', password='$password', foto='$foto_name' WHERE id=$id";
            if (mysqli_query($conn, $query)) {
                echo "<div class='alert alert-success mt-3'>User berhasil diperbarui.</div>
                      <script>
                        alert('Data berhasil diperbarui');
                        window.location.href = 'dashboard.php';
                      </script>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Gagal memperbarui user: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>
            </div>
        
        
    </div>
</body>
</html>
