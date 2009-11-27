<h2>new creation</h2>
<p>Tell us about your creation. Upload a picture** of it to show to everybody else.</p>
<p>You can upload a file from your computer, or refer to a file you've uploaded to other sites (like flickr).</p>

<?=validation_errors()?>

<?=form_open_multipart('upload')?>
<table>
 <tr>
  <td><label for="title">*title:</label></td>
  <td><input type="text" name="title" value="<?=set_value('title')?>"/></td>
 </tr>
 <tr>
  <td>
   <input type="radio" name="picType" value="file" checked onclick="toggleUploadSource(this, this.form)"/>
   <label for="picFile">*picture:</label>
  </td>
  <td><input type="file" name="picFile"/></td>
 </tr>
 <tr>
  <td>
   <input type="radio" name="picType" value="url" onclick="toggleUploadSource(this, this.form)"/>
   <label for="picUrl">... or url:</label>
  </td>
  <td><input type="text" name="picUrl" disabled class="disabled" value="enter link"/></td>
 </tr>
 <!--tr><td colspan="2">TODO: allow multiple image uploads</td></tr-->
 <tr>
  <td><label for="description">description:</label></td>
  <td><textarea name="description" rows="7" cols="42"></textarea></td>
 </tr>
 <tr>
  <td colspan="2" align="center"><input type="submit" value="save"/></td>
 </tr>
</table>
</form>

<p class="finePrint">** Images inappropriate for pre-teen audiences will be removed by moderators;
 please keep things PG-13 or milder. Only GIF, JPG, PNG, and BMP files under 1024x768 pixels and
 500kb may be uploaded directly to this site.</p>

<script type="text/javascript">
function toggleUploadSource(radio, form) {
  if ("file" == radio.value) { // file upload
    form.picFile.disabled = false;
    form.picFile.className = "";

    form.picUrl.disabled = true;
    form.picUrl.className = "disabled";
    if ("" == form.picUrl.value) form.picUrl.value = "enter link";
  }
  else { // remote URL
    form.picFile.disabled = true;
    form.picFile.className = "disabled";

    form.picUrl.disabled = false;
    form.picUrl.className = "";
    if ("enter link" == form.picUrl.value) form.picUrl.value = "";
    form.picUrl.focus();
  }
}
</script>

