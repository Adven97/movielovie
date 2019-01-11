<?php
session_start();


  if(!isset($_SESSION['zalogowany'])){
        header('Location: login.php');
      }
      else{
        if(isset($_POST['submit'])){
        $wszystko_OK=true;

        $tyt = $_POST['tyt'];
        $urla = $_POST['url'];
        $url = substr($urla, -11);



        if ((strlen($url)!=11))
        {
            $wszystko_OK=false;
            $_SESSION['e1']="Za krotki ten URL - $url";
        }

        if (strlen($tyt)<2)
        {
            $wszystko_OK=false;
            $_SESSION['e2']="Troche za krótki ten tytuł filmu";
        }


        require_once "connect.php";
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
                //$sql="INSERT INTO articles (id, author_name, author_last_name, author_nick, image, article_title, article) VALUES (NULL, '$imie', '$nazwisko', '$login','xd' '$tyt', '$artykul');";
                $sql="INSERT INTO trailers (id, title,url) VALUES (null, '$tyt', '$url');";

                if($rezultat =@$polaczenie->query($sql) ){
                  header('Location: trailers.php');
              }
              else{
                  throw new Exception($polaczenie->error);
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
  <link rel="stylesheet" href="style/style_register.css" type="text/css">
  <link rel="stylesheet" href="style/pasek.css" type="text/css">
  <title>Dodaj nowy post</title>
  <style media="screen">
  .boxx{
      border-radius: 12px;
      background-color: #54657a;
      margin-left: auto;
      margin-right: auto;
      margin-top:60px;
      width: 600px;
      height:400px;
  }
  .inp2{
    font-family: 'Raleway', sans-serif;
    font-size: 13px;
    border-style: hidden hidden solid hidden;
    border-color: #101010;
    background-color: #54657a;
    opacity: 0.9;
    height: 35px;
    width: 500px;
    margin-left: 2px;
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
    width: 400px;
    height: 50px;
    margin-left: 50px;
  }
  .btn2:hover{
    background-color: #b7b7b7;
    cursor: pointer;
    cursor: pointer;
}
#maina{
  box-shadow: -10px 0 10px -10px #333, 10px 0 10px -10px #333;
  width: 88%;
  margin-top: 0px;
  padding-top: 0px;
   min-height: 660px;
  overflow: hidden;
  margin-left: auto;
  margin-right: auto;
  background-color:  #C8C8C8;
}
  </style>

</head>
<body>
  <div id="container">
  <div id="maina">
  <div class="tyt">
    <a class="active" href="index.php">MovieLovie.com</a>
    <input class="sb" type="text" placeholder="Search..">
    <a href="register.php"><div class="log-btn">zarejstruj sie</div></a>
    <a href="login.php"><div class="log-btn">zaloguj sie</div></a>
    <div style="clear:both"></div>
    <div id="button-bar">
    <a href="movies.php"><div class="top-btn">filmy</div></a>
    <a href="#"><div class="top-btn">seriale</div></a>
    <a href="#"><div class="top-btn">ludzie kina</div></a>
    <a href="articles.php"><div class="top-btn">newsy</div></a>
    <a href="#"><div class="top-btn">premiery</div></a>
    <a href="#"><div class="top-btn">zwiastuny</div></a>
    </div>
  </div>
<div class="boxx">
    <div class="login">
    <form method="post" enctype="multipart/form-data">
      <h1 class="hhh">Dodaj nowy zwiastun</h2>
      <input class="inp2" type="text" name="tyt" placeholder="Tytuł" /><br /><br />
      <?php
          if (isset($_SESSION['e1']))
          {
              echo '<div class="error">'.$_SESSION['e1'].'</div>';
              unset($_SESSION['e1']);
          }
      ?>
     <input class="inp2" type="text" name="url" placeholder="URL" /><br /><br />
      <?php
          if (isset($_SESSION['e2']))
          {
              echo '<div class="error">'.$_SESSION['e2'].'</div>';
              unset($_SESSION['e2']);
          }
      ?>
      <input class="btn2" type="submit" name="submit" value="Dodaj">

    </form>
    </div>
    </div>
  </div>
  </div>

</body>
</html>
