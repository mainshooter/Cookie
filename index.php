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

  class Cookie {
    public $cookieName;
    public $cookieValue;

    private $cookieAcceptedTerms;


    public function __construct() {
      $termsResult = $this->checkIfCookiesAreAllowed();

      if ($termsResult !== true) {
        // The need to accept the terms
        echo $this->displayAcceptFormForCookies();
      }

      else {
        // We can set cookies
        echo "<h3>We can set cookies!</h3>";
      }
    }

    public function displayAcceptFormForCookies() {
      $form = file_get_contents('acceptform.php');
      return($form);
    }

    private function checkIfCookiesAreAllowed() {
      if (ISSET($_COOKIE['accepted-terms'])) {
        // The have the cookie
        if ($_COOKIE['accepted-terms'] == true) {
          // They have accepted the cookie
          $this->cookieAcceptedTerms = true;
        }

        else {
          $this->cookieAcceptedTerms = false;
        }
      }

      else {
        $this->cookieAcceptedTerms = false;
      }

      return($this->cookieAcceptedTerms);
    }

  }

?>
