
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
      $artist_name ="Jessica";
      $artist_lname ="Rothe";
      $img_name="noname";
      $castheader ="";
      $crewheader ="";

      if($rezultat =@$polaczenie->query("SELECT * FROM artist WHERE name='$artist_name' and last_name='$artist_lname'") ){
        if($rezultat->num_rows>0){
          $wiersz = $rezultat->fetch_assoc();

          $dattta= $wiersz['birth_day'];
            $dateexx = DateTime::createFromFormat("Y-m-d", $dattta);
            $ddxx = $dateexx->format("Y");
            if($ddxx<1800){
              $data="";
            }
            else{
              $data=$dattta;
            }
            $country = $wiersz['country'];

        }else{echo "<script type='text/javascript'>alert('niepyklo 10');</script>";}

          $rezultat->free_result();
        }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}

        if($rezultat2 =@$polaczenie->query("SELECT * FROM `cast` INNER JOIN movies ON cast.title = movies.movie_title where name='$artist_name' and last_name='$artist_lname' order by release_date DESC ") ){
          if($rezultat2->num_rows>0){
            $castheader='<h2>Aktor</h2>';
            $i=0;
            while($wiersz2 = $rezultat2->fetch_assoc()){

            $role[$i]= $wiersz2['role'];
            $movie_tit[$i] = $wiersz2['title'];
            $filmidd[$i] = $wiersz2['id'];
            $dataa[$i]= $wiersz2['release_date'];
            $datee[$i] = DateTime::createFromFormat("Y-m-d", $dataa[$i]);
            $dd[$i] = $datee[$i]->format("Y");

            $i =$i+1;
          }
          $rolee='';

         for ($xx = 0; $xx < $i; $xx++) {
          // $key =array_search($dd[$xx], $dd);
         $rolee .= "<li><div class ='aktor'><p class='para'><span class='span0'>$dd[$xx]</span <span class='span1'><a class='axd' href = '../movies/$filmidd[$xx].php'>$movie_tit[$xx]</a></span><span class= 'span2'>$role[$xx]</span> </p></div></li>";
          }

          }else{}

            $rezultat2->free_result();
          }else{}



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
  <style>
  .span0{
    margin-left: 10px;
    margin-right: 25px;
  }
  .span1{
    margin-right: 80px;
  }
  .span2{
    margin-left: 80px;
  }
  .aktor{
    width: 450px;
    height: 35px;
    background-color:#D9D9D9;
  }
  .axd:hover{
    color: #FFa056;
    text-decoration: underline;
  }

  </style>
  <?php  echo"<title>$artist_name $artist_lname</title>"; ?>
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
     <img src='../style/img/people/$img_name.jpg' style='max-width: 214px; max-height: 317px;' />
    </div>

    <div class="info-box">
    <h1 class="title">$artist_name $artist_lname</h1>

    <ul>
      <li><p class="credit">Data Urodzenia: <a class="person">$data</a> </p></li>
      <li><p class="credit">Kraj Pochodzenia: <a class="person">$country</a></p></li>
    </ul>

    </div>
    <div class="obsada">
      <h1 class="title">Filmografia</h1>$castheader
      <ul>$rolee</ul>
    </div>
END
    ?>

</div>

</div>

</body>
</html>

    