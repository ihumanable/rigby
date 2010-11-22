<?php

//Bootstrap the core of Rigby
include 'init.php';

$elements = fRouter::parse();

$path   = SRC_ROOT . '/';
$target = null;
$action = null;
$last   = 'root';
$args   = array();
$mode   = 'index';

foreach($elements as $element) {
  if(in_array($element, fRouter::reserved())) {
    $action = $element;
    $last = $element;
    $mode = $element;
  } elseif(is_dir($path . $element)) {
    $path .= $element . '/';
    $last = $element;
    $mode = 'index';
  } elseif(is_file($path . $element . '.php')) {
    $target = $element;
    $last = $element;
    $mode = 'file';
  } else {
    if(array_key_exists($last, $args)) {
      if(is_array($args[$last])) {
        $args[$last][] = $element;
      } else {
        $args[$last] = array($args[$last], $element);
      }
    } else {
      $args[$last] = $element;
    }
    if($mode == 'index') {
      $mode = 'view';
    }
  }
}

foreach($args as $key => $value) {
  $_GET[$key] = $value;
}

$post = ($_SERVER['REQUEST_METHOD'] == 'POST');
$bypass = false;

switch($mode) {
  case 'file':
    $bypass = true;
    break;
  case 'index':
    $target = ($post ? 'post' : 'index');
    break;
  case 'view':
    $target = ($post ? 'process' : 'view');
    break;
  case 'new':
    $target = ($post ? 'create' : 'new');
    break;
  case 'edit':
    $target = ($post ? 'update' : 'edit');
    break;
  case 'delete':
    $target = ($post ? 'destroy' : 'delete');
    break;
}

if($bypass || is_file($path . $target . '.php')) {
  include $path . $target . '.php';
} else {
  fSession::set('error-route', SELF_URL);
  fRouter::error(404);
}

?>