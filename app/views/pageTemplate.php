<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="description" content="creationpodz :: They're not trash; they're found object action figures!"/>
<meta name="keywords" content="found object, action figure, action figures, aluminum foil, handmade, homemade, toys, trash"/>
<title>creationpodz</title>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="/res/cpodz.css"/>
<?php if (!$this->session->userdata('loggedIn')): ?>
<link rel="stylesheet" type="text/css" href="/res/cpodz_dark.css"/>
<?php else: ?>
<?php
switch ($this->session->userdata('theme')) {
  case 1: echo link_tag('res/cpodz_light.css'); break;
  case 2: echo link_tag('res/cpodz_dark.css'); break;
  case 3: echo link_tag('res/cpodz_heliotrope.css'); break;
  default: echo link_tag('res/cpodz_dark.css');
}
?>
<?php endif; ?>
</head>
<body>

<div id="main">

 <div id="header"><h1>creationpodz</h1></div>

 <div id="leftCol">
  <div id="logo"></div>
  <div id="login"><?php $this->load->view('site/loginLogoutForm'); ?></div>
  <div id="nav">
   <table width="100%"><tr>
    <td><?=anchor('', 'home')?></td>
<?php if (!$this->session->userdata('loggedIn')): ?>
    <td><?=anchor('signup', 'signup')?></td>
<?php else: ?>
    <td><?=anchor('blog', 'write blog')?></td>
<?php endif; ?>
    <td><?=anchor('about', 'about')?></td>
    <td><?=anchor('help', 'help')?></td>
   </tr></table>
  </div>
  <div id="news"><?=$newsItems?></div>
 </div>

 <div id="rightCol">
  <div id="info">
    <?php if ($this->session->flashdata('err')): ?>
    <div class="err"><?=$this->session->flashdata('err')?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('msg')): ?>
    <div class="msg"><?=$this->session->flashdata('msg')?></div>
    <?php endif; ?>

    <?=$content?>
  </div>
 </div>

 <div id="footer">
  Comments and uploaded files owned by the poster.<br/>
  All the rest -- Copyright &copy; 2009, 2010, Dan Parks. All Rights Reserved.<br/>
  <?=anchor('legal', 'Legal info.')?><br/>
  <small>version 0.2</small>
 </div>

</div>

</body>
</html>

