<?php

if (!isset($loginLogoutForm)) {
  if ($this->session->userdata('loggedIn')) {
    $this->load->view('site/logout');
  }
  else {
    $this->load->view('site/login');
  }
}
else {
  echo $loginLogoutForm;
}

