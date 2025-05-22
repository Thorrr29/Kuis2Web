<?php include "koneksi/db.php"; ?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <title>Tambah Mahasiswa</title> 
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
                <h2 style="color: aliceblue;">Tambah User</h2> 
            <form method="POST" enctype="multipart/form-data"> 
                <div class="mb-3" style="color: aliceblue;"> 
                    <label>Username</label> 
                    <input type="text" name="username" class="form-control" required> 
                </div> 
                <div class="mb-3" style="color: aliceblue;"> 
                    <label>Password</label> 
                    <input type="password" name="password" class="form-control" required> 
                </div>
                <div class="mb-3" style="color: aliceblue;">
                    <label>Foto Profil</label>
                    <input type="file" name="foto" class="form-control" accept="img/*" required>
                </div>
                <button type="submit" name="simpan" class="btn btn-success mt-3">Simpan</button> 
                <a href="dashboard.php" class="btn btn-secondary mt-3">Kembali</a> 
            </form> 
<?php 
if (isset($_POST['simpan'])) {
    $username = $_POST['username']; 
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $foto_name = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $upload_path = 'img/' . $foto_name;

    if (move_uploaded_file($foto_tmp, $upload_path)) {
        $query = "INSERT INTO users (username, password, foto) 
                  VALUES ('$username', '$password', '$foto_name')";

        if (mysqli_query($conn, $query)) {
            echo "<div class='alert alert-success mt-3'>User berhasil disimpan.</div>
                  <script>
                    alert('User berhasil ditambahkan');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Gagal menyimpan user: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger mt-3'>Gagal upload foto.</div>";
    }
}
?> 
            </div>
            
        </div>
        
    </div>
    
</body> 
</html> 