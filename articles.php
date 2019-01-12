<?php
session_start();

require_once 'connect.php';

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $polaczenie->set_charset("utf8");

    if($polaczenie->connect_errno !=0){
      echo "Error ".$polaczenie->connect_errno;
    }
    else {

      $query4="SELECT * FROM articles";
      if($rezultat4 =@$polaczenie->query($query4) ){
        if($rezultat4->num_rows>0){

        $i=0;
        while($wiersz = $rezultat4->fetch_assoc()){

          $idd[$i] = $wiersz['id'];
          $tytul[$i] = $wiersz['article_title'];
          $zdj[$i]=$wiersz['image'];

          $i=$i+1;
        }
        $articles="";
        for ($x = $i-1; $x >=0; $x--) {
         $link ="article+".$idd[$x];
         $articles .= "<a class='artik' href='articles/$link.php'><p>$tytul[$x]<img src='style/img/$zdj[$x]' alt='' height='auto' width='620'> </p></a>";
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
  <link rel="stylesheet" href="style/pasek.css" type="text/css">
  <link rel="stylesheet" href="style/style.css" type="text/css">
  <style media="screen">
  .btn {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-left:200px;
    cursor: pointer;
}
.artik, .artik:visited, .artik:active{
   text-decoration: none;
   color: #101010;
}
.artik:hover{
  transform: scale(1.08);
  text-decoration: underline;
  color: #000000;
}
  </style>

  <title>MovieLovie - Newsy</title>
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
    <a href="movies.php"><div class="top-btn">filmy</div></a>
    <a href="#"><div class="top-btn">seriale</div></a>
    <a href="#"><div class="top-btn">ludzie kina</div></a>
    <a href="#"><div class="top-btn">newsy</div></a>
    <a href="#"><div class="top-btn">premiery</div></a>
    <a href="#"><div class="top-btn">zwiastuny</div></a>
    </div>
  </div>
    <div class="newsfeed">
      <h2>newsy</h2>
      <a class="artic" href="articles/addNew.php"><button class ="btn">Dodaj nowy artykuł</button></a>
      <article>
        <?php echo $articles ?>

      </article>
    </div>
    </div>
  </div>

<footer><div id='ftr'>&copy; MovieLovie.com - Adam Tomczak (2019),  All rights reserved</div></footer>
</body>
</html>
