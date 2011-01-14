<?php
  $page->set('title', 'Handboning will save your life someday!');
  $page->place('header');
?>
  
  <h1>Protip: Handboning will save your life someday!</h1>
  <img src="<?php echo rRouter::getRoute('images', 'hambone.jpg') ?>" />
  
<?php
  $page->place('footer');
?>