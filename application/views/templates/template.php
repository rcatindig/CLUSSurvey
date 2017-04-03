<!DOCTYPE html>
<html>
<head>
  <title>CLUS Survey</title>
  <link href="<?php echo base_url() . PATH_CSS;?>bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url() . PATH_CSS;?>style.css" rel="stylesheet">
</head>
<body>
  <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
  <?php echo $body; ?>

  <script src="<?php echo base_url() . PATH_JS;?>jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() . PATH_JS;?>bootstrap.min.js"></script>
    <script src="<?php echo base_url() . PATH_JS;?>bootbox.min.js"></script>
    
        <?php if(!empty($load_js)) : ?>
         <?php foreach($load_js as $js) : ?>
            <script type="text/javascript" src="<?php echo base_url() . PATH_JS . $js . '.js'; ?>"></script>
          <?php endforeach; ?>
      <?php endif; ?>

</body>
</html>