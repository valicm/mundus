<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if (!$label_hidden) : ?>
  <h2 class="field-label"<?php print $title_attributes; ?>><?php print $label ?>:&nbsp;</h2>
<?php endif; ?>
<?php if ($element['#view_mode'] == 'full'): ?>
  <ul data-orbit >
    <?php foreach ($items as $delta => $item): ?>
    <li>
      <?php print render($item); ?>
      <?php if ($item['#item']['title']): ?>
      <div class="orbit-caption"><?php print $item['#item']['title']; ?></div>
    <?php endif; ?>
  </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<?php if ($element['#view_mode'] == 'teaser'): ?>
  <?php foreach ($items as $delta => $item): ?>
  <?php print render($item); ?>
<?php endforeach; ?>
<?php endif; ?>
</div>
