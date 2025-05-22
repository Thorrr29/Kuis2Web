<?php
include 'koneksi/db.php';
?>
<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <title>Data Mahasiswa</title> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
</head> 
<body >
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="#">MyApp</a>
    <div class="ms-auto">
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
    </nav>
    
    <div class="container mt-8">
        <h2>User</h2> 
  <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah User</a> 
  <table class="table table-bordered"> 
    <thead class="table-dark"> 
    <tr>
        <th>No</th>
        <th>Foto Profil</th>
        <th>Username</th>
        <th>Password</th>
        <th>Aksi</th>
    </tr> 
    </thead> 
    <tbody> 
      <?php 
      $no = 1; 
      $result = mysqli_query($conn, "SELECT * FROM users"); 
      while ($row = mysqli_fetch_assoc($result)) { 
        echo "<tr> 
                <td>$no</td> 
                <td>{$row['foto']}</td>
                <td>{$row['username']}</td> 
                <td>{$row['password']}</td> 
                <td> 
                  <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a> 
                  <a href='hapus.php?id={$row['id']}' class='btn btn-danger btn-sm' 
                  onclick='return confirm(\"Hapus data ini?\")'>Hapus</a> 
                </td> 
              </tr>"; 
        $no++; 
      } 
      ?> 
    </tbody> 
  </table> 
    </div>
    
</body> 
</html> 