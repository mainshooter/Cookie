<?php

  if (ISSET($_COOKIE['accepted-terms'])) {
    if ($_COOKIE['accepted-terms'] === true) {
      // Client accpted the terms
    }

    else {
      // Client deny the terms
    }
  }

  else {
    // Client is here for the first time
  }

?>
