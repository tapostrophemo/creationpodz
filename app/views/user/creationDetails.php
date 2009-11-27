<h2><?=$creation->name?></h2>
<h3><?=$creation->points?> points; added on <?=$creation->added_on?></h3>

<br>

<?php
if (count($creation->photos) > 0) {
  echo '<p>';
  foreach ($creation->photos as $photo) {
    if (!$photo['is_remote']) {
      echo anchor('uploads/'.$photo['image_url'], img('thumbs/'.$photo['thumbnail']));
    }
    else {
      echo anchor($photo['image_url'], null, array('target' => '_blank'));
    }
  }
  echo '</p>';
}
?>

<p><?=$creation->description?></p>

