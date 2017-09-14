<?php

  if (ISSET($_COOKIE['accepted-terms'])) {
    if ($_COOKIE['accepted-terms'] == true) {
      // Client accpted the terms
      echo "<h1>U heeft onze voorwaarden geaccepteerd!</h1>";
    }

    else {
      // Client deny the terms
      displayCookieAcceptForm();
    }
  }

  else {
    // Client is here for the first time, so the need to accept our coockie terms
    displayCookieAcceptForm();
  }

  if (ISSET($_POST['cookieAcceptation'])) {
    if ($_POST['cookieAcceptation'] === 'toestaan') {
      // They allow to have cookies
      setcookie('accepted-terms', true, time() + 10);
      header("Refresh:0");
    }
  }

  function displayCookieAcceptForm() {
    include 'acceptform.php';
  }

?>
