<?php foreach ($entries as $entry): ?>
<h2><?=$entry->title?></h2>
<h3><?=$entry->posted_on?></h3>
<p><?=nl2br($entry->entry)?></p>
<?php endforeach; ?>

<hr/>

<h2>first image</h2>
<?=anchor('uploads/DSC06537.JPG', img('thumbs/cp_left.jpg'))?>
<p>This is our first entry to the site. This creation was made by SamP.</p>
<p>SamP first started making creations when he was in the kitchen with his mother. He got bored one day of just watching her cook, grabbed a sheet of aluminum foil, and away he went.</p>

<h2>another fine creation</h2>
<?=anchor('uploads/DSC06536.JPG', img('thumbs/cp_right.jpg'))?>
<p>Another fine creation from our founder, SamP.</p>

<h2>creation of the day</h2>
<?=anchor('uploads/DSC06538.JPG', img('thumbs/cp_center.jpg'))?>
<p>This creation was randomly chosen for today. It's creator is SamP.</p>

