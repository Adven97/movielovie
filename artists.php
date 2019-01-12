<?php
session_start();

require_once 'connect.php';

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $polaczenie->set_charset("utf8");

    if($polaczenie->connect_errno !=0){
      echo "Error ".$polaczenie->connect_errno;
    }
    else {
      $mainid =1;
      $director = "reżyseria";
      $writer ="scenariusz";
      $ocenaa ='Zaloguj sie by ocenić';
      $prycisk="";
      $reviews="";
      $recheder='';

      $sql="SELECT * FROM movies WHERE id='$mainid'";
      if($rezultat =@$polaczenie->query($sql) ){
        if($rezultat->num_rows>0){
          $wiersz = $rezultat->fetch_assoc();

          $tytul=$wiersz['movie_title'];
          $runtime = $wiersz['runtime'];
          $kraj = $wiersz['country'];
          $data= $wiersz['release_date'];
          $opis = $wiersz['synopsis'];
          $date = DateTime::createFromFormat("Y-m-d", $data);
          $d = $date->format("Y");

              }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}

          $rezultat->free_result();
        }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}


        $query2="SELECT DISTINCT name, last_name from crew GROUP by last_name";
        if($rezultat2 =@$polaczenie->query($query2) ){
          if($rezultat2->num_rows>0){
            $i=0;
            while($wiersz2 = $rezultat2->fetch_assoc()){

              $director_name[$i] = $wiersz2['name'];
              $director_lname[$i] = $wiersz2['last_name'];

              $i=$i+1;
            }
            $directorzy="";
            for ($x = 0; $x < $i; $x++) {
             $actor_site =strtolower($director_name[$x])."_".strtolower($director_lname[$x]);
             $directorzy .= "<li><p class='pcast'><a class='pcast' href='artists/$actor_site.php'>$director_name[$x] $director_lname[$x]</a></p></li>";
           }
           $directorzy =substr($directorzy, 0, -2);

          }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
          $rezultat2->free_result();
        }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}



        if($rezultat4 =@$polaczenie->query("SELECT DISTINCT name, last_name from cast GROUP by last_name") ){
          if($rezultat4->num_rows>0){

          $i=0;
          while($wiersz4 = $rezultat4->fetch_assoc()){

            $actor_name[$i] = $wiersz4['name'];
            $actor_lname[$i] = $wiersz4['last_name'];


            $i=$i+1;
          }
          $obsada="";
          for ($x = 0; $x < $i; $x++) {
           $actor_site =strtolower($actor_name[$x])."_".strtolower($actor_lname[$x]);
           $obsada .= "<li><p class='pcast'><a class='pcast' href='artists/$actor_site.php'>$actor_name[$x] $actor_lname[$x]</a></p></li>";
         }


          }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
          $rezultat4->free_result();
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
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <link rel="stylesheet" href="style/pasek.css" type="text/css">
  <link rel="stylesheet" href="style/style.css" type="text/css">
  <link rel="stylesheet" href="style/movie.css" type="text/css">

  <style>
  .artik, .artik:visited, .artik:active{
     text-decoration: none;
     color: #100000;
  }
   a.artik:hover{

    text-decoration: underline;
    color: #000000;
  }

  .btn {
    background-color: #606060; /* Green */
    border: none;
    color: white;
    padding: 10px 24px;
    text-align: center;
    text-decoration: none;
     display: inline-block;
    /* display: none; */
    font-size: 16px;
    margin-top: 20px;
    margin-left:135px;
    cursor: pointer;
    border-radius: 10px;
}
.btn:hover{
  transform: scale(1.08);
  transition: .3s;
  background-color: #505050;
}

.btn2 {
  background-color: #606060; /* Green */
  border: none;
  color: white;
  padding: 10px 24px;
  text-align: center;
  text-decoration: none;
   display: inline-block;
  align-self: flex-start;
  font-size: 16px;
  margin-top: 45px;
  margin-left:45px;
  cursor: pointer;
  border-radius: 10px;
}
.btn2:hover{
transform: scale(1.08);
transition: .3s;
background-color: #505050;
}
#tuut{
  display: inline-flex;
}
#tuobsada{
  display: block;
}
#tutworcy{
  display: none;
}
#titlee{
  display: none;
}
.newsfeed222{
  width:330px;
  /* height:350px; */
  margin-left: auto;
  margin-right: auto;
  font-size: 28px;
}
  </style>

  <?php
  echo "<title>$tytul</title>"
   ?>
</head>
<body>
  <div id="container">
  <div id="main">
  <div class="tyt">
    <a class="active" href="index.php">MovieLovie.com</a>
    <input class="sb" type="text" placeholder="Szukaj...">
    <?php
    if(isset($_SESSION['zalogowany'])){
      $supr = $_SESSION['ln'];
      $imie= $_SESSION['name'];
      $nazwisko = $_SESSION['last_name'];
      $login = $_SESSION['login'];
      echo "<div id='login_name'><a href='user.php'><img class='avatar' src="."'style/img/avatars/$supr.jpg'"." height='50' width='50'>ELO $imie $nazwisko</a>";
      echo "<div id='how'>";
      echo '<ul> <li><a href="logout.php">wyloguj sie</a></li></ul></div></div>';

    }
    else{
    echo '<a href="register.php"><div class="log-btn">zarejstruj sie</div></a>';
    echo '<a href="login.php"><div class="log-btn">zaloguj sie</div></a>';
   }
     ?>
    <div style="clear:both"></div>
    <div id="button-bar">
      <a href="movies.php"><div class="top-btn">Filmy</div></a>
      <a href="series.php"><div class="top-btn">Seriale</div></a>
      <a href="artists.php"><div class="top-btn">Ludzie kina</div></a>
      <a href="articles.php"><div class="top-btn">Newsy</div></a>
      <a href="reviews.php"><div class="top-btn">Recenzje</div></a>
      <a href="trailers.php"><div class="top-btn">Zwiastuny</div></a>
    </div>
  </div>

  <div class="newsfeed222">
    <h2>ludzie kina</h2>

      <div id='tuut'><h1 id="titlee">Obsada</h1><button class ='btn2' onClick="showCreators();">Pokaż twórców</button></div>
      <div id='tuobsada'><ul><?php echo $obsada; ?></ul></div>
      <div id='tutworcy'><ul>
        <?php echo $directorzy; ?>
      </ul></div>
  </div>



<script>

function showCreators() {
  if(document.getElementById("titlee").innerHTML== "Obsada"){
   document.getElementById("titlee").innerHTML= "Twórcy";
   document.getElementById("tuobsada").style.display= "none";
   document.getElementById("tutworcy").style.display= "block";
   document.querySelector('.btn2').innerHTML ="Pokaż aktorów";
 }
 else{
   document.getElementById("titlee").innerHTML= "Obsada";
   document.getElementById("tuobsada").style.display= "block";
   document.getElementById("tutworcy").style.display= "none";
   document.querySelector('.btn2').innerHTML ="Pokaż twórców";
 }


}
</script>

}





</script>
</body>
</html>
