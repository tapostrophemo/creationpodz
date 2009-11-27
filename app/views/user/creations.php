<h2>creations</h2>

<p><?=count($user->creations)?> creations by <?=$this->session->userdata('username')?>:</p>

<?php foreach ($user->creations as $creation): ?>
<p><?=anchor('/creation/'.$creation->id, $creation->name)?> (<?=$creation->points?> points)</p>
<?php endforeach; ?>

<br><br>

<?=$this->session->userdata('loggedIn') ? anchor('upload', 'upload new creation') : ''?>

