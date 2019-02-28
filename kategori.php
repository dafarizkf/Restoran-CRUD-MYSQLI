<?php
session_start();
include 'config/koneksi.php';

if ($_SESSION['level'] == ""){
  header("location:index.php");
  exit;
}elseif ($_SESSION['level'] == "kasir") {
  header("location:dash_kasir.php");
  exit;
}
  if (isset($_POST['simpan'])) {
    $sql = mysqli_query($conn,"INSERT INTO tb_kategori VALUES(null,'$_POST[kategori]')");

    echo "<script>alert('Data Tersimpan');document.location.href='?menu=kategori'</script>";
  }
  $perintah = new oop();
  $table = "tb_kategori";
  $redirect = "?menu=kategori";
  @$where = "kd_kategori = $_GET[id]";
  if(isset($_GET['edit'])){
    $sql = mysqli_query($conn,"SELECT * FROM tb_kategori WHERE kd_kategori = '$_GET[id]'");
    $edit = mysqli_fetch_array($sql);
  }
   if(isset($_GET['hapus'])){
    $sql = mysqli_query($conn,"DELETE FROM tb_kategori WHERE kd_kategori = '$_GET[id]'");

    echo "<script>alert('Data Terhapus');document.location.href='?menu=kategori'</script>";
  }
 if (isset($_POST['updateuser'])) {
    $sql = mysqli_query($conn,"UPDATE tb_kategori SET kd_kategori='$_POST[kd_kategori]',kategori='$_POST[kategori]' WHERE kd_kategori='$_GET[id]'");
    if($sql){

    echo "<script>alert('Data Berhasil Terupdate');document.location.href='kategori.php'</script>";
    }else{
      echo printf("Error : %s\n", mysqli_error($conn));
      exit();
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Form Kategori</title>
</head>
<style type="text/css">
* {margin:0; padding:0;}
	nav{
	position: fixed;
	background-color: rgb(10,101,146);
	 width: 100%;
	 height: 30px;
	 font-family: sans-serif;	 
}
nav ul ul {
 display: none;
}

nav ul li:hover > ul{
display: block;
width: 150px;
}

nav ul {
 background: rgb(10,101,146);
 list-style: none;
 position: relative;
 display: inline-table;
 width: 100%;

}
        

nav ul li{
 float:left;
}

nav ul li:hover{
 background:#666;

}

nav ul li:hover a{
 color:#fff;

}

nav ul li a{
 display: block;
 padding: 20px;
 color: #fff;
 text-decoration: none;

}
input[type=submit] {
      background-color: rgb(10,101,146);
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
	 .col-25 {
      float: left;
      width: 25%;
      margin-top: 20px;
    }

    /*  inputs: 75% width */
    .col-75 {
      float: left;
      width: 75%;
      margin-top: 20px;
    }
    .col-60{
    	float: left;
    	width: 70%;
    	margin-top: 0px;
    }
   
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
    table {
      font-family: Arial, Helvetica, sans-serif;
      background-color:grey;
      border: #212121 0,5px solid;
    
        
        }
       table th {
      padding: 10px 40px;
      border-left:0,5px solid black;
      border-bottom: 0,5px solid #000;
      background: #bdbdbd ;
    }
       table th:first-child{  
        border-left:none;  
    }
       table tr {
      text-align: center;
      padding-left: 20px;
    }
        td,th{
            color:black;
        }

</style>
<body>
	<div class="container">
		<nav>
		<ul>
			<li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="menu.php">Menu</a></li>
      <li><a href="kategori.php">Kategori</a></li>
      <li><a href ="laporan.php">Laporan</a></li>
      <li><a href="user.php">Kelola User</a></li>
      <li><a href="logout.php" onclick="return confirm('Apa anda yakin ?')">Log Out</a></li>
		</ul>
	</nav>
	<br><br><br><br><br><br><br>
  <form method="POST">
		<div class="row">
			<div class="col-25">
				<label for="kt">Kategori</label>
			</div>
			<div class="col-75">
				<input type="text" name="kategori" required style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" id="kt" value="<?php echo @$edit[1]; ?>"> 
        </div>
    </div>
    <br>
    <br>
    <div class="row"><center>
    	<input type="submit" value="Simpan" name="simpan">
      <input type="submit" name="updateuser" value="Update">
    </div></center>
  </form>
    <center><table align="center">
      <br>
      <br>
     <center><table align="center">
      <br>
      <br>
      <tr align="center">
        <th>Kode kategori</th>
        <th>Kategori</th>
        <th colspan="2">Aksi</th>
      </tr>
      <?php
      $sql = "SELECT * FROM tb_kategori";
    if (isset($_POST['cari'])) {
        $sql="SELECT * FROM tb_kategori WHERE kd_kategori LIKE '$_POST[tcari]%' OR kategori LIKE '$_POST[tcari]%'";
      }else{
        $sql="SELECT * FROM tb_kategori";
      }   
      $sql= mysqli_query($conn,"SELECT * FROM tb_kategori");
      while($r=mysqli_fetch_array($sql)){
      ?>
      <tr>
        <td><?php echo $r['kd_kategori'];?></td>
        <td><?php echo $r['kategori'];?></td>
        <td><a onclick="return confirm('Yakin Ingin Menghapus?')" href="kategori.php?hapus&id=<?php echo $r['kd_kategori'];?>">HAPUS</a></td>
          <td><a href="kategori.php?edit&id=<?php echo $r['kd_kategori'];?>">EDIT</a></td>
      </tr>
      <?php } ?>
    </table></center>
	</div>

</body>
</html>