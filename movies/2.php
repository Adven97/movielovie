<?php
session_start();

require_once '../connect.php';

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $polaczenie->set_charset("utf8");

    if($polaczenie->connect_errno !=0){
      echo "Error ".$polaczenie->connect_errno;
    }
    else {
      $mainid =2;
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


        if($rezultat00 =@$polaczenie->query("SELECT * FROM genres WHERE title='$tytul'") ){
          if($rezultat00->num_rows>0){
            $i=0;
            while($wiersz00 = $rezultat00->fetch_assoc()){

              $genn[$i] = $wiersz00['genre'];


              $i=$i+1;
            }
            $genress="";
            for ($x = 0; $x < $i; $x++) {
             $genress .= "$genn[$x]";
             $genress .= ", ";
           }
           $genres =substr($genress, 0, -2);

          }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
          $rezultat00->free_result();
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
             $actor_site =strtolower($director_name[$x])."_".strtolower($director_lname[$x]);
             $directorzy .= "<a class='pcast2' href='../artists/$actor_site.php'>$director_name[$x] $director_lname[$x]</a>";
             $directorzy .= ", ";
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
           $actor_site =strtolower($writer_name[$x])."_".strtolower($writer_lname[$x]);
           $scenary .= "<a class='pcast2' href='../artists/$actor_site.php'>$writer_name[$x] $writer_lname[$x]</a> ";
           $scenary .= ", ";
           if(($x%2) ==1){
             $scenary .= "<br>";
           }
         }
         $scenary =substr($scenary, 0, -2);


          }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
          $rezultat3->free_result();
        }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}

        if($rezultatx1 =@$polaczenie->query("SELECT * FROM crew WHERE title='$tytul' and credit='zdjęcia' ") ){
          if($rezultatx1->num_rows>0){

          $wierszx1 = $rezultatx1->fetch_assoc();
            $op_name = $wierszx1['name'];
            $op_lname = $wierszx1['last_name'];
            $actor_site =strtolower($op_name)."_".strtolower($op_lname);
           $zdje= "<a class='pcast2' href='../artists/$actor_site.php'>$op_name $op_lname</a> ";

          }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
          $rezultatx1->free_result();
        }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}


        if($rezultatx2 =@$polaczenie->query("SELECT * FROM crew WHERE title='$tytul' and credit='muzyka' ") ){
          if($rezultatx2->num_rows>0){

          $wierszx2 = $rezultatx2->fetch_assoc();
            $muz_name = $wierszx2['name'];
            $muz_lname = $wierszx2['last_name'];
            $actor_site =strtolower($muz_name)."_".strtolower($muz_lname);
           $muzz= "<a class='pcast2' href='../artists/$actor_site.php'>$muz_name $muz_lname</a> ";

          }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
          $rezultatx2->free_result();
        }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}


        if($rezultatx3 =@$polaczenie->query("SELECT * FROM crew WHERE title='$tytul' and credit='montaż' ") ){
          if($rezultatx3->num_rows>0){

          $wierszx3 = $rezultatx3->fetch_assoc();
            $mont_name = $wierszx3['name'];
            $mont_lname = $wierszx3['last_name'];
            $actor_site =strtolower($mont_name)."_".strtolower($mont_lname);
           $mont= "<a class='pcast2' href='../artists/$actor_site.php'>$mont_name $mont_lname</a> ";

          }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
          $rezultatx3->free_result();
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
          $prycisk= "<div id ='dodajrec'><a class='artic' href='../reviews/addReview.php'><button class ='btn'>Dodaj recenzję</button></a></div>";
          $_SESSION['tytdorec'] = $tytul;
          $_SESSION['ocenadorec'] = $ocenka;
          }else{
            $ocenaa ="Nie oceniono tego filmu";
          }
          $rezultat5->free_result();
        }else{}
      }

      if($rezultat6 =@$polaczenie->query("SELECT AVG(grade) as avgrade FROM movies_rated WHERE title='$tytul' ") ){
        if($rezultat6->num_rows>0){

        $wiersz6 = $rezultat6->fetch_assoc();
        $srednia = $wiersz6['avgrade'];
        //$ocenaa = "Film oceniono na $ocenka / 5";


        }else{
        //  $ocenaa ="Nie oceniono tego filmu";
        }
        $rezultat6->free_result();
      }else{}

        if($rezultat44 =@$polaczenie->query("SELECT * FROM reviews where title='$tytul'") ){
          if($rezultat44->num_rows>0){
          $recheder='<h2>Recenzje użytkownika</h2>';
          $i=0;
          while($wiersz44 = $rezultat44->fetch_assoc()){

            $iddd[$i] = $wiersz44['id'];
            $tytxdxd[$i] = $wiersz44['title'];
            $tytulrec[$i] = $wiersz44['review_title'];

            $imierec[$i] = $wiersz44['author_name'];
            $nazwiskorec[$i] = $wiersz44['author_last_name'];

            $zdj[$i]=$wiersz44['image'];
            $calytyt[$i] = $tytulrec[$i].' - Recenzja filmu '.$tytxdxd[$i];

            $i=$i+1;
          }

          for ($x = $i-1; $x >=0; $x--) {
           $link ="reviews/review+".$iddd[$x];
           $reviews .= "<a class='artik' href='reviews/$link.php'><p>$calytyt[$x]<br><i> Autor: $imierec[$x] $nazwiskorec[$x]</i></p></a>";
         }

          }else{}
          $rezultat44->free_result();
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
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <link rel="stylesheet" href="../style/pasek.css" type="text/css">
  <link rel="stylesheet" href="../style/style.css" type="text/css">
  <link rel="stylesheet" href="../style/movie.css" type="text/css">

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
  margin-left:15px;
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
  </style>

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
      <a href="../movies.php"><div class="top-btn">Filmy</div></a>
      <a href="../series.php"><div class="top-btn">Seriale</div></a>
      <a href="../artists.php"><div class="top-btn">Ludzie kina</div></a>
      <a href="../articles.php"><div class="top-btn">Newsy</div></a>
      <a href="../reviews.php"><div class="top-btn">Recenzje</div></a>
      <a href="../trailers.php"><div class="top-btn">Zwiastuny</div></a>
    </div>
  </div>
    <div class="poster">
      <?php
      echo "<img src='../style/img/movieposters/$mainid.jpg' style='max-width: 300px; max-height: 520px;' />";
      ?>
    </div>

<?php
echo<<<END
<div class="info-box">
<h1 class="title">$tytul ($d)</h1>


<ul>
  <li><span class = "runtime">Czas trwania: $runtime min.</span></li>
  <li><div class ='kred'><p class="credit">Reżyseria: <a class="person">$directorzy</a> </p></div></li>
  <li><div class ='kredmain'><p class="credit">Scenariusz: <a class="person">$scenary</a></p></div></li>
  <li><div class ='kred'><p class="credit">Gatunek: <a class="person">$genres</a></p></div></li>
  <li><div class ='kred'><p class="credit">Produkcja: <a class="person">$kraj</a></p></div></li>
  <li><div class ='kred'><p class="credit">Premiera: <a class="person">$data</a></p></div></li>
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
  <button id ="addstar" onclick="myFunction(); insertKurwa();">Oceń Film</button>
  </form>

</div>
<div id="ileg"><p id ="ilegwizd2">Średnia ocena: $srednia</p></div>

</div>
$prycisk
<div class="obsada">
  <div id='tuut'><h1 id="titlee">Obsada</h1><button class ='btn2' onClick="showCreators();">Pokaż twórców</button></div>
  <div id='tuobsada'><ul>$obsada</ul></div>
  <div id='tutworcy'><ul>
    <li><p class='pcast'>Reżyseria: <a class="person">$directorzy</a> </p></li>
    <li><p class='pcast'>Scenariusz: <a class="person">$scenary</a> </p></li>
    <li><p class='pcast'>Zdjęcia: <a class="person">$zdje</a> </p></li>
    <li><p class='pcast'>Muzyka: <a class="person">$muzz</a> </p></li>
    <li><p class='pcast'>Montaż: <a class="person">$mont</a> </p></li>
  </ul></div>
  <div class="newsfeed_rev">
    $recheder
    <article>
       $reviews
    </article>
  </div>
</div>

END
?>

<script>

function showCreators() {
  if(document.getElementById("titlee").innerHTML== "Obsada"){
   document.getElementById("titlee").innerHTML= "Twórcy";
   document.getElementById("tuobsada").style.display= "none";
   document.getElementById("tutworcy").style.display= "block";
   document.querySelector('.btn2').innerHTML ="Pokaż obsadę";
 }
 else{
   document.getElementById("titlee").innerHTML= "Obsada";
   document.getElementById("tuobsada").style.display= "block";
   document.getElementById("tutworcy").style.display= "none";
   document.querySelector('.btn2').innerHTML ="Pokaż twórców";
 }


}
</script>

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


        //if($execued === false){
      //   if($rezultat56 =@$conn->query("SELECT * FROM users where login ='$login'") ){
      //     if($rezultat56->num_rows>0){
      //       $wiersz56 = $rezultat56->fetch_assoc();
      //       $liczba_ocen = $wiersz56['movies_watched'];
      //       $ocenyyy = $liczba_ocen+1;
      //       $czas = $wiersz56['time_spent'];
      //       if($conn->query("UPDATE users SET movies_watched = movies_watched+1, time_spent=time_spent+$runtime/2 where login ='$login'")){
      //         echo "document.getElementById('ilegwizd').innerHTML ='Film oceniono dobazzy';";
      //         //$execued=true;
      //       }
      //       else{
      //         echo "document.getElementById('ilegwizd').innerHTML ='chuj nieocenino';";
      //       }
      //
      //
      //     }
      //     $rezultat56->free_result();
      // }
      $query="INSERT into movies_rated(title,grade,login) VALUES ('$tytul',$ocena,'$login')";
      }
    //  }
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

function insertKurwa(){

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
      if($rr->num_rows==0){

          if($conn->query("UPDATE users SET movies_watched = movies_watched+1, time_spent=time_spent+$runtime where login ='$login'")){
            echo "document.getElementById('ilegwizd').innerHTML ='Film oceniono dobazzy';";
            //$execued=true;
          }
          else{
            echo "document.getElementById('ilegwizd').innerHTML ='chuj nieocenino';";
          }



        $rezultat56->free_result();

  }

  }
  else {
    echo "document.getElementById('ilegwizd').innerHTML ='blad';";
  }


  $conn->close();
}
   ?>
}





</script>
</body>
</html>
