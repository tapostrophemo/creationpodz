<?php

class User extends Model
{
  function findByUsername($name) {
    $this->db->select('id, username, registered_on, email, theme, salt');
    $this->db->where('username', $name);
    $query = $this->db->get('accounts');
    if (1 == $query->num_rows()) {
      $userAccount = $query->row();
      $userAccount->creations = $this->_findCreationsForAccount($userAccount->id);
      return $userAccount;
    }
    return null;
  }

  function _findCreationsForAccount($id) {
    $this->db->select('id, name, added_on, points, description');
    $this->db->where('account_id', $id);
    $query = $this->db->get('creations');
    return $query->result();
  }

  function findByUsernameWithBlogEntries($name) {
    $userAccount = $this->findByUsername($name);
    if (null != $userAccount) {
      $userAccount->blogEntries = $this->_findBlogEntriesForAccount($userAccount->id);
      return $userAccount;
    }
    return null;
  }

  function _findBlogEntriesForAccount($id) {
    $this->db->select('id, title, posted_on, entry');
    $this->db->where('account_id', $id);
    $this->db->order_by('posted_on', 'desc');
    $query = $this->db->get('blogs');
    return $query->result();
  }

  function postBlog($accountId, $title, $text) {
    // TODO: validate account w/$accountId exists (?)
    $sql = 'insert into blogs(account_id, title, posted_on, entry) values (?, ?, NOW(), ?)';
    $this->db->query($sql, array($accountId, $title, $text));
  }

  function hasAccount($username, $password) {
    $this->db->select('salt');
    $this->db->where('username', $username);
    $query = $this->db->get('accounts');
    if (1 == $query->num_rows()) {
      $row = $query->row();
      $salt = $row->salt;
      $this->db->where('username', $username);
      $this->db->where('password', sha1($password . $salt));
      $query = $this->db->get('accounts');
      return 1 == $query->num_rows();
    }
    else {
      return false;
    }
  }

  function update($userAccount) {
    // TODO: check to see if $userAccount is a user account, exists, etc. (?)
    $this->db->update('accounts', $userAccount, array('id' => $userAccount->id));
  }

  function signup($username, $password, $email) {
    // TODO: figure out how to catch duplicate key errors (instead of the following hack)
    $this->db->where('username', $username);
    $query = $this->db->get('accounts');
    if ($query->num_rows() > 0) {
      return null;
    }

    $this->load->plugin('salt');
    $this->load->helper('date');

    $salt = salt();
    $data = array(
      'username'      => $username,
      'password'      => sha1($password . $salt),
      'salt'          => $salt,
      'email'         => $email,
      'registered_on' => mdate('%Y-%m-%d', time()),
      'theme'         => 1
    );
    $this->db->insert('accounts', $data);
    return $this->db->insert_id();
  }
}

