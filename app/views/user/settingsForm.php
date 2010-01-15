<h2>your account</h2>

<?=validation_errors()?>

<?=form_open('settings/'.$user->username)?>
<table>
 <tr>
  <td><label>username:</label></td>
  <td><?=$user->username?></td>
 </tr>
 <tr>
  <td><label>registered:</label></td>
  <td><?=$user->registered_on?></td>
 </tr>
 <tr>
  <td><label for="email">email:</label></td>
  <td><input type="text" name="email" value="<?=set_value('email', $user->email)?>"/></td>
 </tr>
 <tr>
  <td><label>password:</label></td>
  <td>(<a href="">click to change password</a>)</td>
 </tr>
 <tr>
  <td><label for="theme">theme:</label></td>
  <td><table id="themeSelect">
   <tr>
    <td><input type="radio" name="theme" value="1" <?=set_radio('theme', 1, 1 == $user->theme)?>/> light</td>
    <td><?=img(array('src' => 'res/light_theme.png', 'alt' => 'light theme'))?></td>
   </tr>
   <tr>
    <td><input type="radio" name="theme" value="2" <?=set_radio('theme', 2, 2 == $user->theme)?>/> dark</td>
    <td><?=img(array('src' => 'res/dark_theme.png', 'alt' => 'dark theme'))?></td>
   </tr>
   <tr>
    <td><input type="radio" name="theme" value="3" <?=set_radio('theme', 3, 3 == $user->theme)?>/> heliotrope</td>
    <td><?=img(array('src' => 'res/heli_theme.png', 'alt' => 'heliotrope theme'))?></td>
   </tr>
  </table></td>
 </tr>
 <tr>
  <td colspan="2" align="center"><input type="submit" value="save"/></td>
 </tr>
</table>
</form>

