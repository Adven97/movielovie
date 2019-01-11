<?php
session_start();

require_once 'connect.php';

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $polaczenie->set_charset("utf8");

    if($polaczenie->connect_errno !=0){
      echo "Error ".$polaczenie->connect_errno;
    }
    else {

      if($rezultat4 =@$polaczenie->query("SELECT * FROM articles") ){
        if($rezultat4->num_rows>0){

        $i=0;
        while($wiersz = $rezultat4->fetch_assoc()){

          $idd[$i] = $wiersz['id'];
          $tytul[$i] = $wiersz['article_title'];
          $zdj[$i]=$wiersz['image'];

          $i=$i+1;
        }
        $articles="";
        for ($x = $i-1; $x >=$i-4; $x--) {
         $link ="article+".$idd[$x];
         $articles .= "<a class='artic' href='articles/$link.php'><p>$tytul[$x]<img src='style/img/$zdj[$x]' alt='' height='auto' width='620'> </p></a>";
       }

        }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
        $rezultat4->free_result();
      }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}



      if($rezultat44 =@$polaczenie->query("SELECT * FROM trailers")){
        if($rezultat44->num_rows>0){

        $i=0;
        while($wiersz1 = $rezultat44->fetch_assoc()){

          $idd[$i] = $wiersz1['id'];
          $tytul[$i] = $wiersz1['title'];
          $url[$i]=$wiersz1['url'];

          $i=$i+1;
        }
        $trailers="";
        for ($x = $i-1; $x >=$i-3; $x--) {
         $trailers .= "<p>$tytul[$x]</br><iframe width='620' height='360' src='https://www.youtube.com/embed/$url[$x]'></iframe></p>";
       }

        }
        else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
        $rezultat44->free_result();

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
  <link rel="stylesheet" href="style/pasek.css" type="text/css">
  <link rel="stylesheet" href="style/style.css" type="text/css">
  <style>
  .artic:hover{
    transform: scale(1.08);
    transition: .3s
  }
  </style>

  <title>MovieLovie</title>
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
    <a href="#"><div class="top-btn">Seriale</div></a>
    <a href="#"><div class="top-btn">Ludzie kina</div></a>
    <a href="articles.php"><div class="top-btn">Newsy</div></a>
    <a href="reviews.php"><div class="top-btn">Recenzje</div></a>
    <a href="trailers.php"><div class="top-btn">Zwiastuny</div></a>
    </div>
  </div>
    <div class="newsfeed">
      <h2>newsy</h2>
      <article>
        <?php echo $articles ?>

        <h2>zwiastuny</h2>

         <?php echo $trailers ?>

         <h2>dobre filmy</h2>
         <div class="filmy">
           <p class="film"><a class="movi" href="movies/3.php">Cloverfield Lane 10</a></p>
           <p class="film"><a class="movi" href="movies/1.php">Zombiland</a></p>
           <p class="film"><a class="movi" href="movies/2.php">Ciche mjejsce</a></p>
         </div>

      </article>
    </div>
    </div>
  </div>

</body>
</html>
