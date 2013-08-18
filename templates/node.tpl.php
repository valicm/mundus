<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <header>
    <?php if ($title && !$page): ?>
      <h1<?php print $title_attributes; ?>>
        <a href="<?php print $node_url; ?>" rel="bookmark"><?php print $title; ?></a>
      </h1>
    <?php endif; ?>
  </header>
  <?php print render($title_suffix); ?>

  <div<?php print $content_attributes; ?>>
    <?php
    hide($content['comments']);
    hide($content['links']);
    hide($content['links']['#links']['node-readmore']);
    print render($content);
    ?>
  </div>
  <footer>
    <?php if ($links = render($content['links'])): ?>
      <nav><?php print $links; ?></nav>
    <?php endif; ?>

    <?php if ($display_submitted): ?>
      <div class="submitted"><?php print $submitted; ?></div>
    <?php endif; ?>
  </footer>

  <?php if ($view_mode == 'full') : ?>
    <?php print render($node_block); ?>
  <?php endif; ?>
  <?php print render($content['comments']); ?>

</article>
