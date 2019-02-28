<?php 
include 'config/koneksi.php';

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
</head>
<style type="text/css">
* {margin:0; padding:0;}
nav{
	position: fixed;
	background-color: rgb(10,101,146);
	 width: 100%;
	 height: 50px;
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
	<br><br><br><br>
	<br><br><br><br>
	<form method="post">
		<center><table >
			<h1>Laporan</h1>
			<tr>
				<td><input type="date" name="tgl_awal" style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" placeholder="Tanggal Awal"></td>
				<td><input type="date" name="tgl_akhir" style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" placeholder="Tanggal Akhir"></td>
				<td><input type="submit" name="filter" value="Filter" style=" background-color: rgb(10,101,146);color: white;padding: 12px 20px;border: none;border-radius: 4px;cursor: pointer;float: right;"></td>
			</tr>
		</table></center>
		<center><table>
			<tr>
				<th>Nomor</th>
				<th>Kode Transaksi</th>
				<th>Nama Menu</th>
				<th>Harga</th>
				<th>Subtotal</th>
				<th>Tanggal Transaksi</th>
				<th>No Meja</th>
			</tr>
			<?php 
			if(isset($_POST['filter'])){
				$tanggal_awal = $_POST['tgl_awal'];
				$tanggal_akhir = $_POST['tgl_akhir'];
				$sql = mysqli_query($conn, "SELECT * FROM laporan WHERE tgl_transaksi BETWEEN '$tanggal_awal' and '$tanggal_akhir'");
			}
			$i = 0;
			$mysql = mysqli_query($conn,"SELECT*FROM laporan");
			while ($rows = mysqli_fetch_array($mysql)) {
				$i++;
			 ?>
			<tr>
				<td><?= $i; ?></td>
				<td><?= $rows[0] ?></td>
				<td><?= $rows[1] ?></td>
				<td>Rp.<?= number_format($rows[2],2,',','.');  ?></td>
				<td>Rp.<?= number_format($rows[3],2,',','.'); ?></td>
				<td><?= $rows[4] ?></td>
				<td><?= $rows[5] ?></td>
			</tr>
		<?php } ?>
            </table></center>
	</form>
        </div>
</body>
</html>