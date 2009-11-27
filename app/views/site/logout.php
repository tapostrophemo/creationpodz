<?php
$username = $this->session->userdata('username');

if (!$this->session->userdata('loggedIn')) {
  echo validation_errors();
}
?>

<?=form_open('logout')?>
 <table align="center" width="100%">
  <tr>
   <td>
    <label>user:</label> <?=$username?>
    (<?=anchor('user/'.$username, 'profile')?>,
     <?=anchor('settings/'.$username, 'account')?>)
   </td>
   <td><input type="submit" value="logout"/></td>
  </tr>
 </table>
</form>

