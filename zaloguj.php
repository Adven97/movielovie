<?php
session_start();
/*
if( (!isset($_POST['login'])) && (!isset($_POST['haslo'])))
{
  header('Location: index.html');
  exit();
}
*/
require_once 'connect.php';

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno !=0){
      echo "Error ".$polaczenie->connect_errno;
    }
    else {
      $login = $_POST['Login'];
      $haslo = $_POST['Hasło'];
      $login=htmlentities($login, ENT_QUOTES, "UTF-8");
      $haslo=htmlentities($haslo, ENT_QUOTES, "UTF-8");
      $haslo =md5($haslo);

      $sql="SELECT * FROM users WHERE login='$login' AND password='$haslo'";

      if($rezultat =@$polaczenie->query($sql) ){
      //  $ilu_userów =$rezultat->num_rows;
        if($rezultat->num_rows>0){
          $_SESSION['zalogowany']=true;

          $wiersz = $rezultat->fetch_assoc();

          $_SESSION['ln'] =$wiersz['lucky_number'];
          $_SESSION['login']=$wiersz['login'];
          $_SESSION['name']= $wiersz['name'];
          $_SESSION['last_name']= $wiersz['last_name'];
          $_SESSION['time_spent']= $wiersz['time_spent'];
          $_SESSION['movies_watched']= $wiersz['movies_watched'];

          unset($_SESSION['blad']);

          $rezultat->free_result();
          header('Location: user.php');
        }
        else{
          $_SESSION['blad']='<div class="error">Nieprawidłowy login lub hasło!</div>';
          header('Location: login.php');
        }
      }
      $polaczenie->close();
    }

?>
