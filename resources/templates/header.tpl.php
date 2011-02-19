<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title><?php echo $this->prepare('title') ?></title>
    <?php $this->place('css') ?>
    <!--[if lt IE 8]<link rel="stylesheet" href="<?php echo fRouter::getRoute('css', 'blueprint/ie.css') ?>" type="text/css" media="screen, projection"><![endif]-->
    <script type="text/javascript">
      var fRouter = {
        base: '<?php echo fRouter::base() ?>',
        self: '<?php echo fRouter::self() ?>'
      }
    </script>
    <?php $this->place('js') ?>
  </head>
  <body>
    <div id="content" class="container">
      <div id="messaging" class="span-24 last">
        <?php fMessaging::show('error') ?>
        <?php fMessaging::show('warning') ?>
        <?php fMessaging::show('notice') ?>
        <?php fMessaging::show('success') ?>
      </div>