<?php include "koneksi/db.php"; ?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <title>Tambah Mahasiswa</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
</head> 
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="#">MyApp</a>
    <div class="ms-auto">
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
    </nav>
    <div class="container mt-8">
        <h2>Tambah User</h2> 
    <form method="POST"> 
        <div class="mb-3"> 
            <label>Username</label> 
            <input type="text" name="username" class="form-control" required> 
        </div> 
        <div class="mb-3"> 
            <label>Password</label> 
            <input type="password" name="password" class="form-control" required> 
        </div>
        <div>
            <label>Foto Profil</label>
            <input type="file" name="foto" class="form-control" accept="img/*" required>
        </div>
        <button type="submit" name="simpan" class="btn btn success mt-3">Simpan</button> 
        <a href="index.php" class="btn btn-secondary mt-3">Kembali</a> 
    </form> 
<?php 
if (isset($_POST['simpan'])) {
    $username = $_POST['username']; 
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $foto = $_FILES['foto'];
    $foto_name = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $upload_path = 'img/' . $foto_name;
    move_uploaded_file($foto_tmp, $upload_path);

    $query = "INSERT INTO users (username, fullname, password, foto) 
              VALUES ('$username', '$password', '$foto')";

    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success mt-3'>User berhasil disimpan.</div>
              <script>
                alert('User berhasil ditambahkan');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Gagal menyimpan user: " . mysqli_error($conn) . "</div>";
    }
}
?> 
    </div>
    
</body> 
</html> 