<?php
session_start();

if (isset($_POST['email']))
    {
        //Udana walidacja? Załóżmy, że tak!
        $wszystko_OK=true;

        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $login = $_POST['login'];
        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

        $tel = $_POST['tel'];
        $haslo1 = $_POST['haslo1'];
        $haslo2 = $_POST['haslo2'];
        $lucky_num = rand(1, 50);

        if ((strlen($login)<3) || (strlen($login)>20))
        {
            $wszystko_OK=false;
            $_SESSION['e_login']="Login musi posiadać od 3 do 20 znaków!";
        }

        if (strlen($tel)<3)
        {
            $wszystko_OK=false;
            $_SESSION['e_tel']="Proszę podać poprawny numer telefonu";
        }
        if (strlen($imie)<2)
        {
            $wszystko_OK=false;
            $_SESSION['e_imie']="Proszę podać imię";
        }
        if (strlen($nazwisko)<2)
        {
            $wszystko_OK=false;
            $_SESSION['e_nazwisko']="Proszę podać nazwisko";
        }

        if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
        {
            $wszystko_OK=false;
            $_SESSION['e_email']="Podaj poprawny adres e-mail!";
        }

        if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
        {
            $wszystko_OK=false;
            $_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
        }

        if ($haslo1!=$haslo2)
        {
            $wszystko_OK=false;
            $_SESSION['e_haslo']="Podane hasła nie są identyczne!";
        }

        //$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
          $haslo1 = md5($haslo1);
        $_SESSION['fr_imie'] = $imie;
        $_SESSION['fr_nazwisko'] = $nazwisko;
        $_SESSION['fr_login'] = $login;
        $_SESSION['fr_email'] = $email;
        $_SESSION['fr_haslo1'] = $haslo1;
        $_SESSION['fr_haslo2'] = $haslo2;

        require_once "connect.php";
       mysqli_report(MYSQLI_REPORT_STRICT);

       try
       {
           $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
           if ($polaczenie->connect_errno!=0)
           {
               throw new Exception(mysqli_connect_errno());
           }
           else{

             $rezultat =@$polaczenie->query("SELECT * FROM users WHERE email='$email'");

             if (!$rezultat) throw new Exception($polaczenie->error);
             $ile_takich_maili = $rezultat->num_rows;
                if($ile_takich_maili>0)
                {
                    $wszystko_OK=false;
                    $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
                }


              $rezultat =@$polaczenie->query("SELECT * FROM users WHERE login='$login'");
              if (!$rezultat) throw new Exception($polaczenie->error);
              $ile_takich_maili = $rezultat->num_rows;
                 if($ile_takich_maili>0)
                 {
                   $wszystko_OK=false;
                   $_SESSION['e_login']="Istnieje już konto przypisane do tego loginu!";
                 }


              $rezultat =@$polaczenie->query("SELECT * FROM users WHERE telefon='$tel'");
              if (!$rezultat) throw new Exception($polaczenie->error);
              $ile_takich_maili = $rezultat->num_rows;
                    if($ile_takich_maili>0)
                    {
                      $wszystko_OK=false;
                      $_SESSION['e_tel']="Istnieje już konto z tym numerem telefonu";
                    }

              if ($wszystko_OK==true){
                $sql="INSERT INTO users (id, name, last_name, login, email, telefon, password, time_spent, movies_watched,lucky_number) VALUES (NULL, '$imie', '$nazwisko', '$login', '$email', '$tel', '$haslo1', '0','0','$lucky_num')";

                if($rezultat =@$polaczenie->query($sql) ){
                  $_SESSION['zalogowany']=true;

                  $_SESSION['login']=$login;
                  $_SESSION['name']= $imie;
                  $_SESSION['last_name']= $nazwisko;
                  $_SESSION['ln'] =$lucky_num;
                  $_SESSION['time_spent']= 0;
                  $_SESSION['movies_watched']= 0;
                  $_SESSION['udanarejestracja']=true;

                  header('Location: user.php');
              }
              else{
                  throw new Exception($polaczenie->error);
                  }

              }
              $polaczenie->close();
           }

    }
    catch(Exception $e)
        {
            echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
            echo '<br />Informacja developerska: '.$e;
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
  <title>Rejestracja</title>

</head>
<body>
  <div id="container">
  <div id="main">
  <div class="tyt">
    <a class="active" href="index.php">MovieLovie.com</a>
    <input class="sb" type="text" placeholder="Search..">
    <a href="register.php"><div class="log-btn">zarejstruj sie</div></a>
    <a href="login.php"><div class="log-btn">zaloguj sie</div></a>
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
<div class="box">
    <div class="login">
    <form method="post">
      <h1 class="hhh">Rejestracja</h2>
      <input class="inp" type="text" name="imie" onkeyup="lettersOnly(this)" placeholder="Imię" /><br /><br />
      <?php
          if (isset($_SESSION['e_imie']))
          {
              echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
              unset($_SESSION['e_imie']);
          }
      ?>
      <input class="inp" type="text" name="nazwisko" onkeyup="lettersOnly(this)"  placeholder="Nazwisko" /> </br/></br/>
      <?php
          if (isset($_SESSION['e_nazwisko']))
          {
              echo '<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
              unset($_SESSION['e_nazwisko']);
          }
      ?>
      <input class="inp" type="text" placeholder="Login" name="login" /><br /><br />
        <?php
            if (isset($_SESSION['e_login']))
            {
                echo '<div class="error">'.$_SESSION['e_login'].'</div>';
                unset($_SESSION['e_login']);
            }
        ?>
      <input class="inp" type="text" placeholder="E-Mail" name="email" /><br /><br />

        <?php
            if (isset($_SESSION['e_email']))
            {
                echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                unset($_SESSION['e_email']);
            }
        ?>

      <input class="inp" type="text" name="tel" onkeyup="numbersOnly(this)" placeholder="Numer telefonu" /> </br/></br/>
      <?php
          if (isset($_SESSION['e_tel']))
          {
              echo '<div class="error">'.$_SESSION['e_tel'].'</div>';
              unset($_SESSION['e_tel']);
          }
      ?>
      <input class="inp" type="password"  placeholder="Hasło" name="haslo1" /><br /><br />

        <?php
            if (isset($_SESSION['e_haslo']))
            {
                echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                unset($_SESSION['e_haslo']);
            }
        ?>
      <input class="inp" type="password" placeholder="Powtórz Hasło" name="haslo2" /><br /><br />
      <input class="btn" type="submit" value="Zarejestruj się">


    </form>
    </div>
    </div>
  </div>
  </div>

<script>
function lettersOnly(inp){
  let regex = /[^qwertyuiopasdfghjklzxcvbnmąężłóź]/gi;
  inp.value = inp.value.replace(regex,"");
}

function numbersOnly(inp){
  let regex = /[a-z]/gi;
  inp.value = inp.value.replace(regex,"");
}

</script>

</body>
</html>
