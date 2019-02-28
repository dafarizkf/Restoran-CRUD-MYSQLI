<?php
date_default_timezone_set("Asia/Jakarta");
session_start();
  include 'config/koneksi.php';
if(isset($_GET['batal'])){
    $hapus = mysqli_query ($conn,"DELETE FROM tb_transaksi WHERE kd_transaksi = '$_GET[id]'");
}

if (isset($_POST['simpan'])) {
  @$menu = $_POST['menu'];
  $sql2 = mysqli_query($conn,"SELECT * FROM tb_menu WHERE menu ='$menu'");
  $tgl = date('Y-m-d H:i:s');
  @$a = $_POST['subtotal']; 
  $sql = mysqli_query($conn,"INSERT INTO tb_transaksi VALUES ('$_POST[kd_transaksi]','13','$_POST[jumlah]','$a','$tgl','18','$_POST[meja]')");
  if ($sql){
  echo "<script>alert('Pesanan Selesai');document.location.href='transaksi.php'</script>";
  }else {
  echo printf("Error: %s\n", mysqli_error($conn));
  exit();
}
}
if (isset($_GET['hapus'])) {
  $b = mysqli_query($conn,"DELETE FROM tb_transaksi WHERE kd_transaksi = '$_GET[id]'");
  echo "<script>alert('Berhasil Dihapus');document.location.href='transaksi.php'</script>";
}

$kembali="";
if (isset($_POST['tbayar'])) {
  $kembali = $_POST['kembali'];
  $total = $_POST['total'];
  $bayar = $_POST['bayar'];
  $kembali = $bayar - $total;
  echo "<script>alert('Transaksi Selesai Terima Kasih');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Transaksi</title>
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
input[type=submit] {
      background-color: rgb(10,101,146);
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
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
	<nav>
		<ul>
			<li><a href="dash_kasir.php">Dashboard</a></li>
      <li><a href="transaksi.php">Transaksi</a></li>
      <li><a href="logout.php" onclick="return confirm('Apa anda yakin ?')">Log Out</a></li>
		</ul>
	</nav>
	<br>
	<br><br>
	<h1 style="font-family:sans-serif; color:rgba(10,101,146);">Form Transaksi</h1>
	<center><form  method="post" name="autoSumForm" style="margin-left: 50px;">
    <!--<a href="javascript:window.print();" class="btn btn-secondary btn-lg offset-sm-11" role="button" aria-disabled="true">Print</a>
    <br><br><br>-->
    <div class="row">
      <div class="col-25">
        <label for="js">No. Transaksi</label>
      </div>
      <div class="col-75">
        <input type="text" name="kd_transaksi" id="js" required style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" value="<?php echo @$ambil[0]; ?>">
        </div>
      </div>
		<div class="row">
      <div class="col-25">
        <label for="barang">Menu</label>
      </div>
      <div class="col-75">
        <td>
          <select name="menu" onchange="price();" id="barang" required style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;">
            <option disabled selected>--Pilih--</option>
            <?php 
            $a = "SELECT * FROM tb_menu";
            $b = mysqli_query($conn,$a);
            while ($row = mysqli_fetch_array($b)) {
             ?>
              <option value="<?php echo $row[3];?>"><?= $row[1]?></option>
            <?php } ?>
              
          </select>
        </td>
      </div>
    </div>
     <div class="row">
      <div class="col-25">
        <label for="harga">Harga</label>
      </div>
      <div class="col-75">
        <input type="text" name="harga" id="harga" onblur="return hit();" readonly style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" value="<?php echo @$ambil[2]; ?>">
        </div>
      </div>
       <div class="row">
      <div class="col-25">
        <label for="jumlah">Jumlah</label>
      </div>
      <div class="col-75">
        <input type="text" name="jumlah" id="jumlah" required onblur="return hit();" style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" value="<?php echo @$ambil[3]; ?>">
        </div>
      </div>
       <div class="row">
      <div class="col-25">
        <label for="w">Subtotal</label>
      </div>
      <div class="col-75">
        <input type="text" name="subtotal" id="w" readonly style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" value="<?php echo @$ambil[0]; ?>">
        </div>
      </div>
      <div class="row">
      <div class="col-25">
        <label for="lvl">Kode User</label>
      </div>
      <div class="col-75">
        <td>
       <select name="user" id="lvl" style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;"><option disabled selected>--Pilih--</option>
        <?php 
              $s = mysqli_query($conn, "SELECT * FROM tb_user");
              while ($z = mysqli_fetch_array($s)){
               ?>
              <option value="<?php echo @$_POST['user'] ?>"><?= $z[1];?></option>
              <?php } ?>
        </select>
      </td>
      </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label>No Meja</label>
        </div>
        <div class="col-75">
          <td><select name="meja" required style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;">
            <option disabled selected>--Pilih--</option>
            <?php 
            
            for ($a = 1; $a <= 100; $a++){
             ?>
            <option><?= $a;?></option>
          <?php } ?>
          </select></td>
        </div>
      </div>
      <br>
    <div class="row">
      <input type="submit" value="Pesan" name="simpan">
    </div>
	</form></center>
 <br>
      <!--<input type="text" name="tcari" placeholder="cari" style=" width: 8%;padding: 2px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;">
      <input type="submit" name="cari" value="cari">
    </form>-->
    <center><form method="post">
      <table border="1" style="margin-top: 30px;">
        <tr>
          <th>No Transaksi</th>
          <th>Menu</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
          <th>Tgl Transaksi</th>
          <th>Kode User</th>
          <th>No Meja</th>
          <th>Aksi</th>
        </tr>
        <?php 
        @$a = "SELECT * FROM tb_transaksi";
        @$b = mysqli_query(@$conn,$a);
        while (@$c = mysqli_fetch_array($b)) {
         ?>
        <tr>
          <td><?= $c[0]; ?></td>
          <td><?= $c[1]; ?></td>
          <td><?= $c[2]; ?></td>
          <td>Rp.<?=number_format($c[3],2,',','.');  ?></td>
          <td><?= $c[4]; ?></td>
          <td><?= $c[5]; ?></td>
          <td><?= $c[6]; ?></td>
          <td><a href="transaksi.php?batal&id=<?php echo $c[0];?>">Batal</a></td>
        </tr>
      <?php } ?>
      </table><br><br>
      <?php 
      @$a1 = mysqli_query($conn,"SELECT SUM(tb_transaksi.subtotal) FROM tb_transaksi");
      @$a2 = mysqli_fetch_row($a1);
       ?>
       <div class="row">
       <div class="col-25">
      <p>Total</p>
      </div>
      <div class="col-75"><input  type="text" name="total" value="<?php echo $a2[0]; ?>" style=" width: 60%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;">
        </div>
      <div class="col-25">
      <p>Bayar</p>
      </div>
      <div class="col-75"><input type="text" name="bayar" style=" width: 60%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;">
      </div>
      
      <div class="col-25">
    <h3>Kembali</h3>
    </div>
    <div class="col-75"><input type="text" name="kembali" value="<?= $kembali;?>" style=" width: 60%;padding: 12px;border: 3px solid #ccc;border-radius: 8px;box-sizing: border-box;resize: vertical; font-size: 18px;"></div>
    <input type="submit" name="tbayar" value="Bayar">
    </form></center><br>
    <br>
    <br>
<script type="text/javascript">
  function price(){
    var tes = document.getElementById("barang").value;
       document.getElementById("harga").value = tes;
  }
</script>
<script type="text/javascript">
  function hit(){
    var b1 = parseFloat(document.autoSumForm.harga.value);
    var b2 = parseFloat(document.autoSumForm.jumlah.value);
    document.autoSumForm.subtotal.value = b1 * b2;
  }
</script>
</body>
</html>
