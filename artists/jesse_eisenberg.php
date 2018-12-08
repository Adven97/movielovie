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
      $director = "reżyseria";
      $writer ="scenariusz";

      $sql="SELECT * FROM movies WHERE id='$mainid'";
      if($rezultat =@$polaczenie->query($sql) ){
        if($rezultat->num_rows>0){
          $wiersz = $rezultat->fetch_assoc();

          $tytul=$wiersz['movie_title'];
          $runtime = $wiersz['runtime'];
          $data= $wiersz['release_date'];
          $date = DateTime::createFromFormat("Y-m-d", $data);
          $d = $date->format("Y");

              }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}

          $rezultat->free_result();
        }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}


        $query2="SELECT * FROM crew WHERE title='$tytul' and credit='$director' ";
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
             $directorzy .= " $director_name[$x] $director_lname[$x] ,";
           }
           $directorzy =substr($directorzy, 0, -2);

          }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
          $rezultat2->free_result();
        }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}


        $query3="SELECT * FROM crew WHERE title='$tytul' and credit='$writer' ";
        if($rezultat3 =@$polaczenie->query($query3) ){
          if($rezultat3->num_rows>0){

          $i=0;
          while($wiersz3 = $rezultat3->fetch_assoc()){

            $writer_name[$i] = $wiersz3['name'];
            $writer_lname[$i] = $wiersz3['last_name'];

            $i=$i+1;
          }
          $scenary="";
          for ($x = 0; $x < $i; $x++) {
           $scenary .= " $writer_name[$x] $writer_lname[$x] ,";
         }
         $scenary =substr($scenary, 0, -2);


          }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
          $rezultat3->free_result();
        }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}


        $query4="SELECT * FROM cast WHERE title='$tytul'";
        if($rezultat4 =@$polaczenie->query($query4) ){
          if($rezultat4->num_rows>0){

          $i=0;
          while($wiersz4 = $rezultat4->fetch_assoc()){

            $actor_name[$i] = $wiersz4['name'];
            $actor_lname[$i] = $wiersz4['last_name'];
            $role[$i] = $wiersz4['role'];

            $i=$i+1;
          }
          $obsada="";
          for ($x = 0; $x < $i; $x++) {
           $obsada .= "<li><p><a href=''>$actor_name[$x] $actor_lname[$x]</a> - $role[$x]</p></li>";
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
    <input class="sb" type="text" placeholder="Search..">
    <a href="../register.php"><div class="log-btn">zarejstruj sie</div></a>
    <a href="../login.php"><div class="log-btn">zaloguj sie</div></a>
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
    <div class="poster">
     <img src='../style/img/jesse_eisenberg.jpg' style='max-width: 214px; max-height: 317px;' />
    </div>

</div>

</div>

</body>
</html>
