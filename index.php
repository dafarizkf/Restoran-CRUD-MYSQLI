<?php
session_start();

$conn = mysqli_connect("localhost","root","","db_restoran");
 if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = mysqli_query($conn,"SELECT * FROM tb_user WHERE username ='$username' and password ='$password'");
    $cek = mysqli_num_rows($sql);
  if ($cek > 0){
  $data  = mysqli_fetch_assoc($sql);
  if ($data['level']=="admin") {
    $_SESSION['username']=$username;
    $_SESSION['level']="admin";
    echo "<script>alert('Selamat Datang $username');document.location.href='dashboard.php'</script>";
  }elseif ($data['level'] == 'kasir') {
    $_SESSION['username']=$username;
    $_SESSION['level']="kasir";
    echo "<script>alert('Selamat Datang $username');document.location.href='dash_kasir.php'</script>";
  }
}else{
    echo "<script>alert('Maaf Username/Password Anda Salah');document.location.href='index.php'</script>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Form Login</title>
	
</head>
<!-- Warna rgb(10,101,146); -->
<body>
<div class="box">
	<form method="post">
		<h1>Form Login</h1>
		<label for="username">Username</label>
		<input type="text" name="username">
		<br>
		<label for="password">Password</label>
		<input type="password" name="password">
		<br>
		<input type="submit" name="login" value="Login" >
		<style type="text/css">
			.box{
            width: 320px;
            height: 420px;
            background-color: rgba(147,147,147);
            color: #000;
            bottom: 50%;
            left: 50%;
            position: absolute;
            transform: translate(-50%,50%);
            box-sizing: border-box;
            padding: 70px 60px;
        }    
        }
        .h1{
            margin: 0;
            padding: 0 0 20px;
            text-align: center;
            font-size: 22px;
            color: black;
            
        }
        .box p{
            margin: 0;
            padding: 0;
            font-weight: bold;
        }
        .box input{
            width: 100%;
            margin-bottom: 20px;
        }
        .box input[type="text"],input[type="password"]{
            border: none;
            border-bottom: 1px solid #fff;
            background:transparent;
            outline: none;
            height: 40px;
            color: black;
            font-size: 16;
        }
        .box input[type="submit"]{
            border: none;
            outline: none;
            height: 40px;
            background-color: rgb(10,101,146);
            color: white;
            font-size: 18px;
            border-radius: 15px;
        }
		</style>
	</form>
</div>
</body>
</html>