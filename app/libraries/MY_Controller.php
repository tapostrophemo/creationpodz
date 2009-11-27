<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends Controller
{
  function __construct() {
    parent::Controller();
    $this->form_validation->set_error_delimiters('<div class="err">', '</div>');
    log_message('debug', 'MY_Controller class initialized');
  }

  function checkLoggedIn($message) {
    if (!$this->session->userdata('loggedIn')) {
      // TODO: check if HTTP_REFERER is from this site; if so, redirect there instead
      $this->redirectWithError($message);
    }
  }

  function redirectWithError($errmsg, $path = '') {
    $this->session->set_flashdata('err', $errmsg);
    redirect($path);
  }

  function redirectWithMessage($msg, $path = '') {
    $this->session->set_flashdata('msg', $msg);
    redirect($path);
  }

  /**
    * common CAPTCHA validation
    */
  function _matches_captcha($captcha) {
    if ($this->session->userdata('captcha') == $captcha) {
      return true;
    }
    else {
      $this->form_validation->set_message('_matches_captcha', 'The text you entered does not match the %s.');
      return false;
    }
  }
}

