<?=validation_errors();?>

<?=form_open('login')?>
 <table align="center" width="100%">
  <tr>
   <td><label for="username">user:</label></td>
   <td><input type="text" name="username" value="<?=set_value('username')?>"/></td>
   <td><label for="password">pass:</label></td>
   <td><input type="password" name="password"/></td>
   <td><input type="submit" value="login"/></td>
  </tr>
 </table>
</form>

