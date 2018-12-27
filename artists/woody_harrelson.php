
<?php
session_start();

require_once '../connect.php';

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $polaczenie->set_charset("utf8");

    if($polaczenie->connect_errno !=0){
      echo "Error ".$polaczenie->connect_errno;
    }
    else {
      $mainid =1;
      $artist_name ="Woody";
      $artist_lname ="Harrelson";
      $img_name="woody_harrelson";

      //$sql="SELECT * FROM artist WHERE name='$artist_name' and last_name='$artist_lname'";
      if($rezultat =@$polaczenie->query("SELECT * FROM artist WHERE name='$artist_name' and last_name='$artist_lname'") ){
        if($rezultat->num_rows>0){
          $wiersz = $rezultat->fetch_assoc();

          $data= $wiersz['birth_day'];
          $country = $wiersz['country'];

        }else{echo "<script type='text/javascript'>alert('niepyklo 1');</script>";}

          $rezultat->free_result();
        }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}

        $polaczenie->close();
        }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../style/pasek.css" type="text/css">
  <link rel="stylesheet" href="../style/style.css" type="text/css">
  <link rel="stylesheet" href="../style/movie.css" type="text/css">
  <title>Document</title>
</head>
<body>
  <div id="container">
  <div id="main">
  <div class="tyt">
    <a class="active" href="../index.php">MovieLovie.com</a>
    <input class="sb" type="text" placeholder="Szukaj...">
    <?php
    if(isset($_SESSION['zalogowany'])){
      $supr = $_SESSION['ln'];
      $imie= $_SESSION['name'];
      $nazwisko = $_SESSION['last_name'];
      echo "<div id='login_name'><a href='user.php'><img class='avatar' src="."'../style/img/avatars/$supr.jpg'"." height='50' width='50'>ELO $imie $nazwisko</a>";
      echo "<div id='how'>";
      echo '<ul> <li><a href="../logout.php">wyloguj sie</a></li></ul></div></div>';

    }
    else{
    echo '<a href="../register.php"><div class="log-btn">zarejstruj sie</div></a>';
    echo '<a href="../login.php"><div class="log-btn">zaloguj sie</div></a>';
   }
     ?>
    <div style="clear:both"></div>
    <div id="button-bar">
    <a href="#"><div class="top-btn">filmy</div></a>
    <a href="#"><div class="top-btn">seriale</div></a>
    <a href="#"><div class="top-btn">ludzie kina</div></a>
    <a href="#"><div class="top-btn">newsy</div></a>
    <a href="#"><div class="top-btn">premiery</div></a>
    <a href="#"><div class="top-btn">zwiastuny</div></a>
    </div>
  </div>
  <div style="clear:both"></div>
<?php
echo<<<END
    <div class="poster">
     <img src='../style/img/$img_name.jpg' style='max-width: 214px; max-height: 317px;' />
    </div>

    <div class="info-box">
    <h1 class="title">$artist_name $artist_lname</h1>

    <ul>
      <li><p class="credit">Data Urodzenia: <a class="person">$data</a> </p></li>
      <li><p class="credit">Kraj Pochodzenia: <a class="person">$country</a></p></li>
    </ul>

    </div>
    <div class="obsada">
      <h1 class="title">Filmografia</h1>
      <ul>tu bedzie filmografia</ul>
    </div>
END
    ?>

</div>

</div>

</body>
</html>
