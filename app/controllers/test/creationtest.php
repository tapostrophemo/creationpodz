<?php

require_once(APPPATH . '/libraries/MY_TestController.php');

class CreationTest extends MY_TestController
{
  // NB: data from testdata.sql

  var $newId; // NB: assumption is that a single test will not create more than one Creation

  function __construct() {
    parent::MY_TestController(__FILE__);
    $this->load->model('Creation');
  }

  function setup() {
    $this->newId = -1; // setup "harmless" delete for these tests
  }

  function teardown() {
    $this->db->query('delete from creations where id = ?', array($this->newId));
  }

  function testCreationFind() {
    $c = $this->Creation->find(1);
    $this->unit->run($c->name, 'dph', 'should retrieve known Creation');
    $this->unit->run($c->creator, 'Daddy', 'should include creator name');
    $this->unit->run(count($c->photos), 2, 'should include all photos');
  }

  function testSave() {
    $this->newId = $this->Creation->save(2, 'new name', 'new description');
    $whenAdded = time();

    $c = $this->Creation->find($this->newId);
    $this->unit->run($c->name, 'new name', 'should save creation name');
    $this->unit->run($c->description, 'new description', 'should save description');
    $this->load->helper('date');
    $this->unit->run($c->added_on, mdate('%Y-%m-%d %h:%i:%s', $whenAdded), 'should save upload timestamp');
    $this->unit->run($c->points, 0, 'should have default # of points');
  }

  function testSavePhotos() {
    $photos = array(
      array('image_url' => 'a.jpg', 'thumbnail' => 'a_thm.jpg'),
      array('image_url' => 'b.jpg', 'thumbnail' => 'b_thm.jpg'),
      array('image_url' => 'http://some.where.com/a.jpg', 'is_remote' => true));
    $this->newId = $this->Creation->save(2, 'name', 'description');
    $this->Creation->savePhotos($this->newId, $photos);

    $c = $this->Creation->find($this->newId);
    $this->unit->run(count($c->photos), 3, 'should include all photos');
    $first = $c->photos[0];
    $second = $c->photos[1];
    $third = $c->photos[2];
    $this->unit->run($first['image_url'], 'a.jpg', 'should save image url');
    $this->unit->run($first['thumbnail'], 'a_thm.jpg', 'should save thumbnail url');
    $this->unit->assert_false($first['is_remote'], 'should not mark uploaded files as remote');
    $this->unit->run($second['image_url'], 'b.jpg', 'should save 2nd image url');
    $this->unit->run($second['thumbnail'], 'b_thm.jpg', 'should save 2nd thumbnail url');
    $this->unit->assert_false($second['is_remote'], 'should not mark uploaded files as remote');
    $this->unit->run($third['image_url'], 'http://some.where.com/a.jpg', 'should save remote url reference');
    $this->unit->run($third['thumbnail'], '', 'should not save thumbnail for remote url reference');
    $this->unit->assert_true($third['is_remote'], 'should mark remote images as remote');

    $this->db->query('delete from creation_photos where id in (?, ?)',
      array($first['id'], $second['id'], $third['id']));
  }
}

