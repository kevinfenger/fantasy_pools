<!-- robot speak -->	
<meta charset="utf-8">
<title><?php if (!empty($title)) echo $title.' | '; ?> Fantasy Games for Fun</title>
<?php echo chrome_frame(); ?>
<?php echo view_port(); ?>
<?php echo apple_mobile('black-translucent'); ?>
<?php echo $meta; ?>

<!-- icons and icons and icons and icons and icons and a tile -->
<?php echo windows_tile(array('name' => 'Stencil', 'image' => base_url().'/assets/img/icons/tile.png', 'color' => '#4eb4e5')); ?>
<?php echo favicons(); ?>

<!-- crayons and paint -->	
<?php echo //add_css(array('bootstrap', 'bootstrap-responsive', 'style')); 
          add_css(array('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css'));
          //add_css(array('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap.min.css', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css', 'core'));
//          add_css(array('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css', 'style'));
?>
<?php echo $css; ?>

<!-- magical wizardry -->
<?php echo jquery('1.9.1'); ?>
<?php echo shiv(); ?>
<?php echo add_js(array('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', 'scripts', 'fb_login', 'login_funcs')); ?>
<?php echo $js; ?>
