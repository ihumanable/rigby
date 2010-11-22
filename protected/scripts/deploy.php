#!/usr/bin/php
<?php
  $ftpServer = '';
  $ftpUsername = '';
  $ftpPassword = '';
  $ftpRoot = '';
  
  $excludeFiles = array('environment.config.php', '.gitignore', '.rigby-deploy', '.htaccess');
  $excludeDirectories  = array('.git', '.sass-cache', 'sass', 'scripts', 'sql', 'tests');
  
  $binary = array('png', 'gif', 'jpg');
  
  
  /////////////////////////////////////////////////////////////////////////////
  //       You should not need to change anything below this line.           //
  /////////////////////////////////////////////////////////////////////////////
  
  
  require_once 'init.php';
  
  date_default_timezone_set(TIMEZONE);
  
  $minus = '0 seconds';
  $forceDeploy = false;
  
  if($_SERVER['argc'] == 2) {
    $switch = $_SERVER['argv'][1];
    switch(strtolower(trim($switch))) {
      case '--force':
        $forceDeploy = true;
        break;
      default:
        $minus = '-' . $switch . ' minutes';
        break;
    }
  }
  
  $cache = new fCache('file', SRC_ROOT . '/.rigby-deploy');
  
  if(!$forceDeploy) {
    $lastTouch = $cache->get('last-touch', false);
    if($lastTouch) {
      $lastTouch = new fTimestamp($lastTouch);
      $lastTouch = $lastTouch->adjust($minus);
    } else {
      $forceDeploy = true;
    } 
  }
  
  $connection = ftp_connect($ftpServer);
  ftp_login($connection, $ftpUsername, $ftpPassword);
  ftp_pasv($connection, true);
  
  //Set up our root
  ftp_chdir($connection, $ftpRoot);
  chdir(SRC_ROOT);
  $root = new fDirectory(SRC_ROOT);
  
  transfer($connection, $root, 0);  
  
  ftp_close($connection);
  $cache->set('last-touch', mktime());
  exit();
  
  function transfer($ftp, $node, $depth) {
    global $binary, $forceDeploy, $excludeFiles, $excludeDirectories, $lastTouch;
    if($node instanceof fDirectory) {
      if(!in_array($node->getName(), $excludeDirectories)) {
        display($node, $depth, '[ scan ]');
        if($node->getPath() != SRC_ROOT) {
          ftp_chdir($ftp, $node->getName());
          chdir($node->getName());
        }
        $children = $node->scan();
        foreach($children as $child) {
          transfer($ftp, $child, $depth + 1);
        }
        ftp_chdir($ftp, '..');
        chdir('..');
      } else {
        display($node, $depth, '[ skip ]');
      }
    } else if($node instanceof fFile) {
      if(!in_array($node->getName(), $excludeFiles)) {
        if($forceDeploy || $lastTouch->lt($node->getMTime())) {
          display($node, $depth, '[deploy]');
          $mode = (in_array($node->getExtension(), $binary) ? FTP_BINARY : FTP_ASCII);
          ftp_put($ftp, $node->getName(), $node->getName(), $mode);
        } else {
          display($node, $depth, '[ pass ]');
        }
      } else {
        display($node, $depth, '[ skip ]');
      }
    }
  }
  
  function display($node, $depth, $label = '') {
    $entry = spaces($depth * 2) . $node->getName() . ($node instanceof fDirectory ? '/' : '');
    $entry = $entry . periods(80 - strlen($entry));
    echo $entry . $label . "\n";
  }
  
  function spaces($count) {
    $result = '';
    for($i = 0; $i < $count; ++$i) {
      $result .= ' ';
    }
    return $result;
  }
  
  function periods($count) {
    $result = '';
    if($count % 2 == 0) {
      $result .= ' ';
    }
    for($i = 0; $i < $count; $i += 2) {
      $result .= ' .';
    }
    $result .= ' ';
    return $result;
  }
  
?>