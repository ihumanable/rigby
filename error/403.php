<?php
  $page->set('title', 'Whoa, do you want to get Fist Pumped?!');
  $page->place('header');
?>
  <h1>You are trying to get at my sweet gooey insides, not allowed!</h1>
  <p>I'm going to break out some Death Kwon Do on you if you keep acting the fool.</p>
  <p>You could always try <a href="<?php echo rRouter::base() ?>">going back to the park</a>.</p>
  
  <img src="<?php echo rRouter::getRoute('images', '403.png') ?>" />
  
<?php
  $page->place('footer');
?>