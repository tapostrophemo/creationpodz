<?php

/* this class is about the behavior of user-related actions on the site */

class Users extends MY_Controller
{
  var $_uploadData;

  function __construct() {
    parent::__construct();
    $this->load->model('User');
    $this->_uploadDdata = null;
  }

  function profile($name) {
    $user = $this->User->findByUsernameWithBlogEntries($name);

    if (null == $user) {
      $this->redirectWithError('unable to find desired account');
    }
    else {
      $data = array(
        'newsItems' => $this->_loadCreationsView($user),
        'content'   => $this->load->view('user/blogEntries', array('blogEntries' => $user->blogEntries), true));
      $this->load->view('pageTemplate', $data);
    }
  }

  function creation($id) {
    $this->load->model('Creation');
    $creation = $this->Creation->find($id);

    $user = $this->User->findByUsername($creation->creator);

    $data = array(
      'newsItems' => $this->_loadCreationsView($user),
      'content'   => $this->load->view('user/creationDetails', array('creation' => $creation), true));
    $this->load->view('pageTemplate', $data);
  }

  function settings($name) {
    $this->checkLoggedIn('must be logged into alter your account settings');

    if ($this->session->userdata('username') !== $name) {
      $this->redirectWithError('unauthorized access to another account');
    }
    $user = $this->User->findByUsername($name);

    if (!$this->form_validation->run('settings')) {
      $data = array(
        'newsItems' => $this->_loadCreationsView($user),
        'content'   => $this->load->view('user/settingsForm', array('user' => $user), true));
      $this->load->view('pageTemplate', $data);
    }
    else {
      $themeChanged = $this->input->post('theme') != $user->theme;

      $user->email = $this->input->post('email');
      $user->theme = $this->input->post('theme');
      $this->User->update($user);

      if ($themeChanged) $this->session->set_userdata('theme', $user->theme);

      $this->redirectWithMessage('your account has been updated');
    }
  }

  // TODO: reset password separately from other account settings(?)

  function _loadCreationsView($user) {
    return $this->load->view('user/creations', array('user' => $user), true);
  }

  function upload() {
    $this->checkLoggedIn('must be logged in to upload creations');

    $user = $this->User->findByUsername($this->session->userdata('username'));

    if (!$this->form_validation->run('upload')) {
      $data = array(
        'newsItems' => $this->_loadCreationsView($user),
        'content'   => $this->load->view('user/creationForm', null, true));
      $this->load->view('pageTemplate', $data);
    }
    else {
      $this->load->Model('Creation');
      $creationId = $this->Creation->save($user->id,
                                          $this->input->post('title'),
                                          $this->input->post('description'));

      if ($this->input->post('picType') == 'file') {
        $imageName = $thumbnailName = $this->_uploadData['file_name'];

        $imageProcessingConfig = $this->config->item('image_processing_config');
        $imageProcessingConfig['source_image'] .= $imageName;
        $this->load->library('image_lib', $imageProcessingConfig);
        if (!$this->image_lib->resize()) {
          $thumbnailName = '../res/trouble.png';
        }
        $photoInfo = array(array('image_url' => $imageName, 'thumbnail' => $thumbnailName));
        $this->Creation->savePhotos($creationId, $photoInfo);
      }
      else if ($this->input->post('picType') == 'url') {
        $photoInfo = array(array('image_url' => $this->input->post('picUrl'), 'is_remote' => true));
        $this->Creation->savePhotos($creationId, $photoInfo);
      }

      $this->redirectWithMessage('new creation saved');
    }
  }

  function _picOrUrlRequired($picType) {
    switch ($picType) {
    case 'file':
      $this->load->library('upload', $this->config->item('upload_config'));
      if (!$this->upload->do_upload('picFile')) {
        $this->form_validation->set_message('_picOrUrlRequired', 'Errors while uploading file:' . $this->upload->display_errors());
        return false;
      }
      $this->_uploadData = $this->upload->data();
      return true;

    case 'url':
      if (isset($_POST['picUrl']) && '' != $_POST['picUrl']
          /*&& TODO: max_length, xss_clean, etc.; how to call?*/)
      {
        return true;
      }
      $this->form_validation->set_message('_picOrUrlRequired', 'A link to the picture is required');
      return false;

    default:
      log_message('warn', 'invalid file upload or url type specified');
      $this->form_validation->set_message('_picOrUrlRequired', 'A %s is required');
      return false;
    }
  }

  function blog() {
    $this->checkLoggedIn('must be logged in to write blog entry');

    $user = $this->User->findByUsername($this->session->userdata('username'));

    if (!$this->form_validation->run('blog')) {
      $data = array(
        'newsItems' => $this->_loadCreationsView($user),
        'content'   => $this->load->view('user/blogForm', null, true));
      $this->load->view('pageTemplate', $data);
    }
    else {
      $this->User->postBlog($user->id, $this->input->post('title'), $this->input->post('entry'));
      $this->redirectWithMessage('new blog entry saved');
    }
  }
}

