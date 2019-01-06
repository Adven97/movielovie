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
      $ocenaa ='Zaloguj sie by ocenić';

      $sql="SELECT * FROM movies WHERE id='$mainid'";
      if($rezultat =@$polaczenie->query($sql) ){
        if($rezultat->num_rows>0){
          $wiersz = $rezultat->fetch_assoc();

          $tytul=$wiersz['movie_title'];
          $runtime = $wiersz['runtime'];
          $data= $wiersz['release_date'];
          $opis = $wiersz['synopsis'];
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
           $actor_site =strtolower($actor_name[$x])."_".strtolower($actor_lname[$x]);
           $obsada .= "<li><p class='pcast'><a class='pcast' href='../artists/$actor_site.php'>$actor_name[$x] $actor_lname[$x]</a> - $role[$x]</p></li>";
         }


          }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
          $rezultat4->free_result();
        }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}



        if(isset($_SESSION['zalogowany'])){
          $login = $_SESSION['login'];
          $ocenaa ="Nie oceniono tego filmu";

        if($rezultat5 =@$polaczenie->query("SELECT * FROM movies_rated where title ='$tytul' And login ='$login' ") ){
          if($rezultat5->num_rows>0){


          $wiersz5 = $rezultat5->fetch_assoc();
          $ocenka = $wiersz5['grade'];
          $ocenaa = "Film oceniono na $ocenka / 5";

          }else{
            $ocenaa ="Nie oceniono tego filmu";
          }
          $rezultat5->free_result();
        }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}
      }




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

  <link rel="stylesheet" href="../style/pasek.css" type="text/css">
  <link rel="stylesheet" href="../style/style.css" type="text/css">
  <link rel="stylesheet" href="../style/movie.css" type="text/css">
  <?php
  echo "<title>$tytul</title>"
   ?>
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
      $login = $_SESSION['login'];
      echo "<div id='login_name'><a href='../user.php'><img class='avatar' src="."'../style/img/avatars/$supr.jpg'"." height='50' width='50'>ELO $imie $nazwisko</a>";
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
    <div class="poster">
      <?php
      echo "<img src='../style/img/$mainid.jpg' style='max-width: 300px; max-height: 520px;' />";
      ?>
    </div>

<?php
echo<<<END
<div class="info-box">
<h1 class="title">$tytul ($d)</h1>


<ul>
  <li><span class = "runtime">Czas trwania: $runtime min.</span></li>
  <li><p class="credit">Reżyseria: <a class="person">$directorzy</a> </p></li>
  <li><p class="credit">Scenariusz: <a class="person">$scenary</a></p></li>
</ul>

<article><p class="artic"><i>$opis</i></p></article>

</div>
<div class="rating-box">
<div id="ileg"><p id ="ilegwizd">$ocenaa</p></div>
<div class="rating">
<form method ="post" action="">
  <input type="radio" name="star" class="starr" value ="1" id="star1"><label id ="xddd1" class="lbl" for="star1"></label>
  <input type="radio" name="star" class="starr" value ="2" id="star2"><label class="lbl" for="star2"></label>
  <input type="radio" name="star" class="starr" value ="3" id="star3"><label class="lbl" for="star3"></label>
  <input type="radio" name="star" class="starr" value ="4" id="star4"><label class="lbl" for="star4"></label>
  <input type="radio" name="star" class="starr" value ="5" id="star5"><label class="lbl" for="star5"></label>
  <div style="clear:both"></div>
  <button id ="addstar" onclick="myFunction()">Oceń Film</button>
  </form>

</div>
</div>
<div class="obsada">
  <h1 class="title">Obsada</h1>
  <ul>$obsada</ul>
</div>
END
?>

<script>

function myFunction(){

    <?php
    require_once '../connect.php';

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    $conn->set_charset("utf8");
    $ocena=0;
    $execued=false;

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_SESSION['zalogowany'])){
      $login = $_SESSION['login'];


          $selected_radio = $_POST['star'];
          if ($selected_radio == '5') {
                      $ocena=1;
                }
          else if ($selected_radio == '4') {
                      $ocena=2;
                }
          else if ($selected_radio == '3') {
                      $ocena=3;
                    }
          else if ($selected_radio == '2') {
                      $ocena=4;
                    }
          else if ($selected_radio == '1') {
                        $ocena=5;
                    }


      if ($rr=$conn->query("SELECT * FROM movies_rated WHERE title='$tytul' and login='$login'")) {
        if($rr->num_rows>0){
          $query = "UPDATE movies_rated SET grade = $ocena WHERE title='$tytul' and login='$login'";
        }
        else{
        $query="INSERT into movies_rated(title,grade,login) VALUES ('$tytul',$ocena,'$login')";

        if($execued === false){
        if($rezultat56 =@$conn->query("SELECT * FROM users where login ='$login'") ){
          if($rezultat56->num_rows>0){
            $wiersz56 = $rezultat56->fetch_assoc();
            $liczba_ocen = $wiersz56['movies_watched'];
            $ocenyyy = $liczba_ocen+1;
            $czas = $wiersz56['time_spent'];
            $conn->query("UPDATE users SET movies_watched = $ocenyyy, time_spent=$czas+$runtime where login ='$login'");

            $execued=true;
          }
          $rezultat56->free_result();
      }
    }
      }
    }
    else {
      echo "document.getElementById('ilegwizd').innerHTML ='blad';";
    }
    if($ocena >0){
    if ($conn->query($query)) {

        $ocenaa = "Film oceniono na $ocena / 5";
        echo "document.getElementById('ilegwizd').innerHTML ='Film oceniono na $ocena / 5';";

  }

    else {
        echo "document.getElementById('ilegwizd').innerHTML ='error z updatem';";
    }
  }
  else{
    echo "document.getElementById('ilegwizd').innerHTML ='nie oceniles';";
  }

}
  else{
    echo "document.getElementById('ilegwizd').innerHTML ='zaloguj sie deklu';";
  }

    $conn->close();
    ?>

}

</script>
</body>
</html>
