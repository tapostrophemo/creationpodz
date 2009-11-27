<?php foreach ($blogEntries as $blog): ?>
<h2><?=$blog->title?></h2>
<h3><?=$blog->posted_on?></h3>
<p><?=$blog->entry?></p>
<?php endforeach; ?>

