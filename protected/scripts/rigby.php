#!/usr/bin/php
<?php
  include 'init.php';
  
  $args = array_map('trim', array_map('strtolower', $_SERVER['argv']));
  
  switch($args[1]) {
    case 'init':
      echo 'Initializing ' . $args[2] . ' as a new Rigby project';
      $target = realpath(SRC_ROOT . '../');
      echo "\n";
      if(is_dir($target . '/' . $args[2])) {
        echo 'Dude, what are you thinking, that\'s already something!';
      } else {
        echo 'We are getting around to figuring out how to do this, FIST PUMP!';
      }
      break;
    default:
      echo 'What is all that noise, do you want me to Death Kwon Do you?!';
      break;
  }
  
  echo "\n";
?>