<?php
  $page->set('title', 'Page is probably on the moon');
  $page->place('header');
?>
  <h1>Page is probably on the Moon</h1>
  <p>Whoa, you wanted to go to <?php echo fSession::get('rigby-error-route', 'someplace') ?>, but that page got sent to the moon.</p>
  <p>You could always try <a href="<?php echo fRouter::base() ?>">going back to the park</a>.</p>
  
  <img src="<?php echo fRouter::getRoute('images', '404.png') ?>" />
  
<?php
  $page->place('footer');
?>