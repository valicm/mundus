<?php

/**
* @file
* Custom theme implementation to display the bar for a single choice in a
* poll.
*/

?>
<?php print $title ?>
<span class="percent">
  <?php print $percentage; ?>%
</span>
<div class="radius progress">
  <div class="meter" style="width: <?php print $percentage ?>%"></div>
</div>
