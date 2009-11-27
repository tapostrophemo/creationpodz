<h2>write blog entry</h2>
<p>Write an article or blog post. Tell us more about yourself, your creations, your ideas.</p>

<?=validation_errors();?>

<?=form_open('blog')?>
<table>
 <tr>
  <td><label for="title">*title:</label></td>
  <td><input type="text" name="title" value="<?=set_value('title')?>"/></td>
 </tr>
 <tr>
  <td valign="top"><label for="entry">*entry:</label></td>
  <td><textarea name="entry" rows="15" cols="45"><?=set_value('entry')?></textarea></td>
 </tr>
 <tr>
  <td colspan="2" align="center"><input type="submit" value="save"/></td>
 </tr>
</table>
</form>

