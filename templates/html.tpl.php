<?php
?>
<!DOCTYPE html>
<html lang="<?php print $language->language ?>">
<head profile="<?php print $grddl_profile ?>">
	<?php print $head ?>
  <title><?php print $head_title ?></title>
  <?php print $styles ?>
  <?php print $scripts ?>
  </head>
  <body class="<?php print $classes ?>"<?php print $attributes ?>>
    <?php print $page_top ?>
    <?php print $page ?>
    <?php print $page_bottom ?>
    <script type="text/javascript"src=<?php global $base_url; echo $base_url.'/'.$directory; ?>/js/vendor/zepto.js></script>
    <script>
    jQuery(document).foundation();
    </script>
  </body>
  </html>
