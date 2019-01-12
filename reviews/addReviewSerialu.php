<?php
session_start();

$content = <<<'END'

<?php
session_start();

require_once '../connect.php';

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $polaczenie->set_charset("utf8");

    $mainid=tujestglowneid;

    if($polaczenie->connect_errno !=0){
      echo "Error ".$polaczenie->connect_errno;
    }
    else {

      $query4="SELECT * FROM reviews where id =$mainid";
      if($rezultat4 =@$polaczenie->query($query4) ){
        if($rezultat4->num_rows>0){

        $wiersz = $rezultat4->fetch_assoc();

          $aname =$wiersz['author_name'];
          $alastname =$wiersz['author_last_name'];

          $idd = $wiersz['id'];
          $tytt = $wiersz['title'];
          $tytul = $wiersz['review_title'];
          $tresc = $wiersz['review'];

          $zddj = $wiersz['image'];
          $calytyt = $tytul.' - Recenzja serialu'.$tytt;


        }else{}
        $rezultat4->free_result();
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
  <style media="screen">
  #main2{
    box-shadow: -10px 0 10px -10px #333, 10px 0 10px -10px #333;
    width: 88%;
    margin-top: 0px;
    padding-top: 0px;
    overflow: hidden;
    margin-left: auto;
    margin-right: auto;
    background-color:  #C8C8C8;
  }
  </style>

  <title>MovieLovie</title>
</head>
<body>
  <div id="container">
  <div id="main2">
  <div class="tyt">
    <a class="active" href="../index.php">MovieLovie.com</a>
    <input class="sb" type="text" placeholder="Szukaj...">
    <?php
    if(isset($_SESSION['zalogowany'])){
      $supr = $_SESSION['ln'];
      $imie= $_SESSION['name'];
      $nazwisko = $_SESSION['last_name'];
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
    <div class="newsfeed">

<?php
ECHO<<<ENDx
<h2 class="tyt-newsa">$calytyt</h2>
<article>
  <p class ="autor"><i>Autor: $aname $alastname</i></p>
  <p>$tresc</p>
  <p><i><b>Ocena serialu : ocenauserra/5</b></i></p>
  <img src="../style/img/$zddj" alt="" height="auto" width="620"></p></a>
ENDx
 ?>
      </article>
    </div>
    </div>
  </div>


</body>
</html>

END;

  if(!isset($_SESSION['zalogowany'])){
        header('Location: ../login.php');
      }
      else{
        if(isset($_POST['submit'])){
        $wszystko_OK=true;

        //if(isset($_FILES['filexd']) || isset($_POST['filexd'])){

        $file = $_FILES['filexd'];

        $fileName = $_FILES['filexd']['name'];
        if(strlen($fileName) != 0){
        $fileTmpName = $_FILES['filexd']['tmp_name'];
        $fileSize = $_FILES['filexd']['size'];
        $fileError = $_FILES['filexd']['error'];
        $fileType = $_FILES['filexd']['type'];


        $fileExt =explode('.',$fileName);
        $fileActualExt =strtolower(end($fileExt));

        $allowed =array('jpg','jpeg','png','pdf');

        if(in_array('jpg', $allowed)){
          if($fileError === 0){
            if($fileSize<9990000){
                $fileNameNew = uniqid('',true).'.'.$fileActualExt;
                $fileDest ='../style/img/'.$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDest);
            }
            else {
              $wszystko_OK=false;
              $_SESSION['e3']="za duzy obraz";
            }

          }
          else {
            $wszystko_OK=false;
            if($fileError === 1){
            $_SESSION['e3']="file error numer 1";
            }
            if($fileError === 2){
            $_SESSION['e3']="file error numer 2";
            }
            if($fileError === 3){
            $_SESSION['e3']="file error numer 3";
            }
            if($fileError === 4){
            $_SESSION['e3']="file error numer 4";
            }
            if($fileError === 5){
            $_SESSION['e3']="file error numer 5";
            }
            if($fileError === 6){
            $_SESSION['e3']="file error numer 6";
            }
            if($fileError === 7){
            $_SESSION['e3']="file error numer 7";
            }
            if($fileError === 8){
            $_SESSION['e3']="file error numer 8";
            }
            else{
          //    echo "<script type='text/javascript'>alert($fileError);</script>";
            $_SESSION['e3']="f dupa  i chuj";
            }
          }
        }
        else{
          $wszystko_OK=false;
          $_SESSION['e3']="cos z tablica";
        }
      }

        $imie= $_SESSION['name'];
        $nazwisko = $_SESSION['last_name'];
        $login = $_SESSION['login'];

        $tyt = $_POST['tyt'];
        $artykul = $_POST['tresc'];
        $artykul=nl2br($artykul);


        if (strlen($artykul)<80)
        {
            $wszystko_OK=false;
            $_SESSION['e2']="Troche za krótka ta recenzja";
        }


        require_once "../connect.php";
       mysqli_report(MYSQLI_REPORT_STRICT);

       try
       {
           $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
           $polaczenie->set_charset("utf8");
           if ($polaczenie->connect_errno!=0)
           {
               throw new Exception(mysqli_connect_errno());
           }
           else{

              if ($wszystko_OK==true){
                $tytfilmu=$_SESSION['tytdorec'];
                $sql="INSERT INTO reviews (id, author_name, author_last_name, author_nick, image, review_title, review, title) VALUES (null, '$imie', '$nazwisko', '$login', '$fileNameNew', '$tyt', '$artykul','$tytfilmu');";

                if($rezultat =@$polaczenie->query($sql) ){
                  header('Location: ../index.php');
              }
              else{
                  throw new Exception($polaczenie->error);
                  }

                  if($rezultat2 =@$polaczenie->query("SELECT * from reviews where review_title='$tyt'") ){
                    if($rezultat2->num_rows>0){
                      $wiersz = $rezultat2->fetch_assoc();
                        $iidd = $wiersz['id'];
                        $ocenuserka2 = $_SESSION['ocenadorece'];

                        $allcontent =str_replace('tujestglowneid',$iidd,$content);
                        $allcontent2 =str_replace('ocenauserra',$ocenuserka2,$allcontent);


                        $fp=fopen("review+$iidd.php",'w');
                        fwrite($fp, "$allcontent2");
                        fclose($fp);
                    }
                    else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
                    $rezultat2->free_result();
                  }

                else{
                    throw new Exception($polaczenie->error);
                    echo "piizda cos z tym 2";
                    }

              $polaczenie->close();
           }
         }

    }
    catch(Exception $e)
        {
            echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
            echo '<br />Informacja developerska: '.$e;
        }
  }
}


?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../style/style_register.css" type="text/css">
  <link rel="stylesheet" href="../style/pasek.css" type="text/css">
  <title>Dodaj recenzję</title>
  <style media="screen">
  .boxx{
      border-radius: 12px;
      background-color: #54657a;
      margin-left: auto;
      margin-right: auto;
      margin-top:60px;
      width: 900px;
      height:850px;
  }
  .inp2{
    font-family: 'Raleway', sans-serif;
    font-size: 16px;
    border-style: hidden hidden solid hidden;
    border-color: #101010;
    background-color: #54657a;
    opacity: 0.9;
    height: 35px;
    width: 500px;
    margin-left: 120px;
  }
  textarea{
    font-family: 'Raleway', sans-serif;
    font-size: 16px;
    margin-left: 25px;
    border-style: hidden hidden solid hidden;
    border-color: #101010;
    background-color: #D8D8D8;
    opacity: 0.9;
    border-radius: 0 15px 15px 15px;
  }

  .btn2{
    font-size: 16px;
    background-color: #c8c8c8;
    border-radius: 7px;
    font-family: 'Raleway', sans-serif;
    margin-top: 35px;
    width: 200px;
    height: 50px;
    margin-left: 100px;
  }
  .btn2:hover{
    background-color: #b7b7b7;
    cursor: pointer;
    cursor: pointer;
}
  </style>

</head>
<body>
  <div id="container">
  <div id="main">
  <div class="tyt">
    <a class="active" href="../index.php">MovieLovie.com</a>
    <input class="sb" type="text" placeholder="Search..">
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
  }?>
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
<div class="boxx">
    <div class="login">
    <form method="post" enctype="multipart/form-data">
      <h1 class="hhh">Dodaj nową recenzję</h2>
      <input class="inp2" type="text" name="tyt" placeholder="Tytuł" /><br /><br />
      <?php
          if (isset($_SESSION['e1']))
          {
              echo '<div class="error">'.$_SESSION['e1'].'</div>';
              unset($_SESSION['e1']);
          }
      ?>
     <textarea rows="26" cols="90" name="tresc"  placeholder="Treść" /></textarea> </br/></br/>
      <?php
          if (isset($_SESSION['e2']))
          {
              echo '<div class="error">'.$_SESSION['e2'].'</div>';
              unset($_SESSION['e2']);
          }
      ?>
      <input type="file" name="filexd" >
      <?php
          if (isset($_SESSION['e3']))
          {
              echo '<div class="error">'.$_SESSION['e3'].'</div>';
              unset($_SESSION['e3']);
          }
      ?>
      <input class="btn2" type="submit" name="submit" value="Dodaj recenzję">

    </form>
    </div>
    </div>
  </div>
  </div>

</body>
</html>
