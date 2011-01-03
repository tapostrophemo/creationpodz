<h2>Administer Content</h2>

<p>Choose entries for the front page:</p>

<h3>Blog Entries</h3>
<?=form_open('admin/content')?>
<?php foreach ($entries as $entry): ?>
 <p>
  <label><input type="checkbox" name="entries[]" value="<?=$entry->id?>"<?=$entry->front_page ? ' checked="checked"':''?>/> <?=$entry->title?></label>
  <small>(<?=$entry->posted_on?>)</small><br/>
  <?=$entry->snippet?>...
 </p>
<?php endforeach; ?>
 <input type="submit" value="Save"/>
</form>

