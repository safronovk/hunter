<?php

function clear_data($post){
    global $dbconnect;
    if(!isset($_POST[$post])) return false;
    $post = mysqli_real_escape_string($dbconnect, htmlspecialchars(trim(@$_POST[$post])));
    if(empty($post)) return false;
    return $post;
  }
