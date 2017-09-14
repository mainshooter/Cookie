<?php

  class Cookie {
    public $cookieName;
    public $cookieValue;

    private $cookieAcceptedTerms;


    /**
     * Checks on start if we can set cookies
     * If we can't we show the cookie form
     */
    public function __construct() {
      $termsResult = $this->checkIfCookiesAreAllowed();

      if ($termsResult !== true) {
        // The need to accept the terms
        echo $this->getDisplayAcceptFormForCookies();
      }

      else {
        // We can set cookies

      }
    }

    /**
     * Gets the form we use to let clients accept our terms
     * @return [type] [description]
     */
    public function getDisplayAcceptFormForCookies() {
      $form = file_get_contents('acceptform.php');
      return($form);
    }

    /**
     * Checks if cookies are allowed by the client
     * @return [boolean] [If we can set coockies, we send true else we send false]
     */
    public function checkIfCookiesAreAllowed() {
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

    /**
     * Saves that the client wan't cookies is we get a true!
     * @param  [sting] $cookieTermsFromClient [If the client is allowing cookies they send: toestaan]
     */
    public function saveClientCookieTerms($cookieTermsFromClient) {
      if ($cookieTermsFromClient == 'toestaan') {
        // If they want cookies
        $this->cookieAcceptedTerms = true;
        setcookie('accepted-terms', true, time() + 10);
      }

      else {
        // The don't want cookies
        setcookie('accepted-terms', false, time() + 10);
        $this->cookieAcceptedTerms = false;
      }

      header("Refresh:0");
      // To show them the real website, we redirect
    }

  }



   $Cookie = new Cookie();

  if (ISSET($_POST['cookieAcceptation'])) {
    $Cookie->saveClientCookieTerms($_POST['cookieAcceptation']);
  }

  if ($Cookie->checkIfCookiesAreAllowed()) {
    // Cookies are allowed
    echo "<h1>Cookies zijn toegestaan!</h1>";
  }

?>
