<style>
body{   background-color: yellow;}


:active, :hover, :focus {
    outline: 0!important;
    outline-offset: 0;
  }
  ::before,
  ::after {
    position: absolute;
    content: "";
  }

.btn {
    position: relative;
    display: inline-block;
    width: auto; height: auto;
    background-color: transparent;
    border: none;
    cursor: pointer;
    margin: 0px 25px 15px;
    min-width: 150px;
  }

  .btn span {
    position: relative;
    display: inline-block;
    font-size: 12px;
    font-weight: bold;
    letter-spacing: 2px;
    text-transform: uppercase;
    top: 0;
    left: 0;
    /* width: 100%; */
    padding: 8px 6px;
    transition: 0.3s;
    background-color: white;
}

  /*--- btn-2 ---*/
.btn-2::before {
    background-color: rgb(28, 31, 30);
    transition: 0.3s ease-out;
    z-index: 50;
  }
  .btn-2 span {
    color: rgb(28, 31, 30);
    border: 1px solid rgb(28, 31, 30);
    transition: 0.2s;
  }  
  .btn-2 span:hover {
    color: rgb(255,255,255);
    transition: 0.2s 0.1s;
   }

  /* 9. hover-slide-right */
.btn.hover-slide-right::before {
    top: 0; bottom: 0; left: 0; 
    height: 100%; width: 0%;
  }
  .btn.hover-slide-right:hover::before {
    width: 100%;
  }
</style>

<button class="btn btn-2 hover-slide-right">
    <span>Acceder au site</span>
  </button>



<?php

// $url = "http://ww.localhost/metropolis/metropolis/index.php";

// $verif = preg_match('/^(http|https):\/\/(www).([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?\/?/i', $url);

// echo $verif;

// if ($verif) {
//     echo "URL ok";
// } else {
//     echo "URL faux";
// }

