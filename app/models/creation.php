<?php

function _remoteToBoolean($row) {
  $row['is_remote'] = ('1' == $row['is_remote']);
  return $row;
}

class Creation extends Model
{
  function find($id) {
    $this->db->select('c.name, c.added_on, c.points, c.description, a.username as creator');
    $this->db->where('c.id', $id);
    $this->db->join('accounts a', 'a.id = c.account_id');
    $query = $this->db->get('creations c');
    $creation = $query->row();
    $creation->photos = $this->findPhotos($id);
    return $creation;
  }

  function findPhotos($creationId) {
    $this->db->select('id, image_url, thumbnail, is_remote');
    $this->db->where('creation_id', $creationId);
    $this->db->order_by('id');
    $query = $this->db->get('creation_photos');
    $result = $query->result_array();
    return array_map('_remoteToBoolean', $result);
  }

  function save($accountId, $name, $description) {
    $this->load->helper('date');
    $this->db->insert('creations', array(
      'added_on'    => mdate('%Y-%m-%d %h:%i:%s', time()),
      'account_id'  => $accountId,
      'name'        => $name,
      'description' => $description));
    return $this->db->insert_id();
  }

  function savePhotos($creationId, $photoInfo) {
    foreach ($photoInfo as $info) {
      if (!isset($info['is_remote']) || !$info['is_remote']) {
        $this->db->insert('creation_photos', array(
          'creation_id' => $creationId,
          'image_url'   => $info['image_url'],
          'thumbnail'   => $info['thumbnail']));
      }
      else {
        $this->db->insert('creation_photos', array(
          'creation_id' => $creationId,
          'image_url'   => $info['image_url'],
          'thumbnail'   => '',
          'is_remote'   => true));
      }
    }
  }
}

