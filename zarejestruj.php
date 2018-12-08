<?php
session_start();
require_once 'connect.php';

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno !=0){
      echo "Error ".$polaczenie->connect_errno;
    }
    else {
      $imie = $_POST['imie'];
      $nazwisko = $_POST['nazwisko'];
      $login = $_POST['login'];
      $email = $_POST['email'];
      $tel = $_POST['tel'];
      $haslo = $_POST['haslo'];
      $haslo2 = $_POST['haslo2'];
      $lucky_num = rand(1, 50);
      $_SESSION['error']="";

      $imie=htmlentities($imie, ENT_QUOTES, "UTF-8");
      $nazwisko=htmlentities($nazwisko, ENT_QUOTES, "UTF-8");
      $login=htmlentities($login, ENT_QUOTES, "UTF-8");
      $email=htmlentities($email, ENT_QUOTES, "UTF-8");
      $tel=htmlentities($tel, ENT_QUOTES, "UTF-8");
      $haslo=htmlentities($haslo, ENT_QUOTES, "UTF-8");
      $haslo2=htmlentities($haslo2, ENT_QUOTES, "UTF-8");

      if(strlen($imie) >0 && strlen($nazwisko) >0 && strlen($login) >0 && strlen($email) >0 && strlen($tel) >0 && strlen($haslo) >0 && strlen($haslo2) >0){

        if($haslo == $haslo2){
          if(strpos($email, '@') && strpos($email, '.')){
          $query1="SELECT * FROM users WHERE login='$login' OR email='$email' OR telefon='$tel'";
          if(@$polaczenie->query($query1)->num_rows == 0){

      $sql="INSERT INTO users (id, name, last_name, login, email, telefon, password, time_spent, movies_watched,lucky_number) VALUES (NULL, '$imie', '$nazwisko', '$login', '$email', '$tel', '$haslo', '0','0','$lucky_num')";

      if($rezultat =@$polaczenie->query($sql) ){

          $_SESSION['zalogowany']=true;

          $_SESSION['login']=$login;
          $_SESSION['name']= $imie;
          $_SESSION['last_name']= $nazwisko;
          $_SESSION['ln'] =$lucky_num;
          $_SESSION['time_spent']= 0;
          $_SESSION['movies_watched']= 0;

        //  $rezultat->free_result();
          header('Location: user.php');

      }
      $polaczenie->close();
    }
      else{
      //  echo "<script type='text/javascript'>alert('W bazie jeż już taki użytkownik');</script>";
    //    header('Location: register.php');
      }
    }
    else{
    //  echo "<script type='text/javascript'>alert('błędny email');</script>";
      //header('Location: register.php');
    }
    }
    else{
      $_SESSION['e_haslo']="Podane hasła nie są identyczne!";
  //    header('Location: register.php');
    }
  }
    else{
      $_SESSION['error']="Wypelnij wszystkie pola mordo";
      //echo "<p></p>";
    //  echo "<script type='text/javascript'>alert('Wypełnij wszystkie pola');</script>";
    //  header('Location: register.php');
    }
  }
 ?>
