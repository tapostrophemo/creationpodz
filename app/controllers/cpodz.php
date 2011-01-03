<?php

/* this class is about the behavior of the site as a whole */

class CPodz extends MY_Controller
{
  function index() {
    // TODO: put DB code in a model(?; which one(s)?)
    $entries = $this->db->select('title, posted_on, entry')->where('front_page', true)->get('blogs')->result();
    $data = array(
      'newsItems' => $this->load->view('site/news', null, true),
      'content'   => $this->load->view('site/mainContent', array('entries' => $entries), true));
    $this->load->view('pageTemplate', $data);
  }

  function signup() {
    if (!$this->form_validation->run('signup')) {
      $this->load->plugin('captcha');
      $cap = create_captcha(array(
        'img_path'   => $this->config->item('app_captcha_path'),
        'img_url'    => base_url().'captcha/',
        'expiration' => $this->config->item('app_captcha_expire')));
      $this->session->set_userdata('captcha', $cap['word']);
      $data = array(
        'loginLogoutForm' => '',
        'newsItems'       => '',
        'content'         => $this->load->view('site/signupForm', array('captcha' => $cap), true));
      $this->load->view('pageTemplate', $data);
    }
    else {
      $username = $this->input->post('username');

      $this->load->model('User');
      $id = $this->User->signup($username, $this->input->post('password'), $this->input->post('email'));
      if (null == $id) {
        $this->redirectWithError('that username is already taken');
      }

      $this->session->set_userdata('loggedIn', true);
      $this->session->set_userdata('username', $username);
      $this->session->set_userdata('theme', 1);
      $this->redirectWithMessage("thanks for signing up, $username", "user/$username");
    }
  }

  function login() {
    if (!$this->form_validation->run('login')) {
      $this->index(); // TODO: go back to where they came from instead of just index
    }
    else {
      $this->session->set_userdata('loggedIn', true);
      $this->session->set_userdata('username', $this->input->post('username'));
      $this->load->model('User');
      $user = $this->User->findByUsername($this->input->post('username'));
      $this->session->set_userdata('theme', $user->theme);
      $this->session->set_userdata('isAdmin', $user->is_admin);
      redirect();
    }
  }

  function _has_user_account($junk) {
    if ($this->form_validation->can_short_circut('_has_user_account')) {
      return false;
    }

    $this->load->model('User');
    if (!$this->User->hasAccount($this->input->post('username'), $this->input->post('password'))) {
      $this->form_validation->set_message('_has_user_account', 'Invalid username or password');
      return false;
    }
    else {
      return true;
    }
  }

  function logout() {
    $this->session->sess_destroy();
    redirect();
  }

  function about() { $this->_readonly('site/about'); }

  function help() { $this->_readonly('site/help'); }

  function legal() { $this->_readonly('site/legal'); }

  function _readonly($pagename) {
    $data = array('newsItems' => '', 'content' => $this->load->view($pagename, null, true));
    $this->load->view('pageTemplate', $data);
  }
}

