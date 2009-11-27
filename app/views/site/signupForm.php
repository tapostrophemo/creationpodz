<h2>signup</h2>

<p>Signup here for your own <em class="siteName">creationpodz</em> account. Fields marked with an
 asterisk (*) are required. Please review and accept the <?=anchor('signup#terms', 'terms and conditions')?>
 at the bottom of this page before registering with our site. You may also wish to review our
 <?=anchor('legal#privacy', 'privacy policy')?>.</p>

<div class="signup">

<?=validation_errors()?>

<?=form_open('signup')?>
 <table>
  <tr>
   <td><label for="username">*username:</label></td>
   <td><input type="text" name="username" value="<?=set_value('username')?>"/></td>
  </tr>
  <tr>
   <td><label for="password">*password:</label></td>
   <td><input type="password" name="password"/></td>
  </tr>
  <tr>
   <td><label for="email">email:</label></td>
   <td><input type="text" name="email" value="<?=set_value('email')?>"/></td>
  </tr>
  <tr>
   <td colspan="2"><br><label>*accept the terms &amp; conditions:</label>
                   &nbsp;&nbsp;<input type="checkbox" name="terms"/></td>
  </tr>
  <tr>
   <td colspan="2"><br><label for="captcha">*please enter the text you see in the following image:</label></td>
  </tr>
  <tr>
   <td></td>
   <td><?=$captcha['image']?></td>
  <tr>
   <td></td>
   <td><input type="text" name="captcha" value=""></td>
  </tr>
  <tr>
   <td colspan="2" align="center"><br><input type="submit" value="signup"/></td>
  </tr>
 </table>
</form>
</div>

<a name="terms"></a>
<?php $this->load->view('site/tnc'); ?>

