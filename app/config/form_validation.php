<?php

$config = array(
  'signup' => array(
    array('field' => 'username', 'label' => 'username', 'rules' => 'trim|required|max_length[32]|xss_clean'),
    array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required'),
    array('field' => 'email', 'label' => 'email', 'rules' => 'trim|max_length[255]|valid_email|xss_clean'),
    array('field' => 'terms', 'label' => 'terms and conditions', 'rules' => 'required'),
    array('field' => 'captcha', 'label' => 'text in the image', 'rules' => 'trim|required|callback__matches_captcha')
  ),

  'login' => array(
    array('field' => 'username', 'label' => 'username', 'rules' => 'trim|required|max_length[32]|xss_clean'),
    array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required'),
    array('field' => 'account', 'label' => 'account', 'rules' => 'callback__has_user_account')
  ),

  'settings' => array(
    array('field' => 'email', 'label' => 'email', 'rules' => 'trim|max_length[255]|valid_email|xss_clean'),
    array('field' => 'theme', 'label' => 'theme', 'rules' => 'trim|integer|required')
  ),

  'blog' => array(
    array('field' => 'title', 'label' => 'title', 'rules' => 'trim|required|max_length[255]|xss_clean'),
    array('field' => 'entry', 'label' => 'entry', 'rules' => 'trim|required|xss_clean|htmlspecialchars|nl2br')
  ),

  'upload' => array(
    array('field' => 'title', 'label' => 'title', 'rules' => 'trim|required|max_length[32]|xss_clean'),
    array('field' => 'description', 'label' => 'description', 'rules' => 'trim|xss_clean|htmlspecialchars|nl2br'),
    array('field' => 'picType', 'label' => 'picture', 'rules' => 'callback__picOrUrlRequired')
  )
);

