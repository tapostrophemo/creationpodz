<?php

class Admin extends MY_Controller
{
  function __construct() {
    parent::__construct();
    $this->checkLoggedIn('Authorized users only');
    if (!$this->session->userdata('isAdmin')) {
      $this->redirectWithError('Authorized administrators only!!');
    }
  }

  function content() {
    // TODO: put DB code in a model(?; which one(s)?)

    if ($this->form_validation->run('admin_content')) {
      $entries = $this->input->post('entries');
      $this->db->set('front_page', false)->update('blogs');
      $this->db->where_in('id', $entries)->set('front_page', true)->update('blogs');
      $this->redirectWithMessage('Entries assigned to front page', 'admin/content');
    }

    $sql = "
      SELECT id, title, front_page, Substr(entry, 1, 32) AS snippet, posted_on
      FROM blogs
      ORDER BY posted_on DESC";
    $entries = $this->db->query($sql)->result();
    $data = array('entries' => $entries);
    $this->load->view('pageTemplate', array('newsItems' => '', 'content' => $this->load->view('admin/content', $data, true)));
  }
}

