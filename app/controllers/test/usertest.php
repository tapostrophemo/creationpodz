<?php

require_once(APPPATH . '/libraries/MY_TestController.php');

class UserTest extends MY_TestController
{
  // NB: "known/bogus" user(s) tied to testdata.sql

  function __construct() {
    parent::MY_TestController(__FILE__);
    $this->load->model('User');
  }

  function setup() {
    parent::setup();
    $this->db->query('update accounts set email = null');
    $this->db->query('delete from accounts where username = ?', array('newSignup'));
  }

  function testHasAccount() {
    $this->unit->assert_true($this->User->hasAccount('Sam', 'Password1'), 'known user should have account');
    $this->unit->assert_false($this->User->hasAccount('bogusUser', 'bogusPassword'), 'bogus user should not have account');
    $this->unit->assert_false($this->User->hasAccount('Sam', 'bogusPassword'), 'known user/bogus password should not have account');
    $this->unit->assert_false($this->User->hasAccount('bogusUser', 'Password1'), 'bogus user/known password should not have account');
  }

  function testFindByUsername() {
    $dbSam = $this->User->findByUsername('Sam');
    $this->unit->run($dbSam->id, 1, 'should have known user account ID');
    $this->unit->run($dbSam->username, 'Sam', 'should have known username');
    $this->unit->run($dbSam->email, 'is_null', 'should have known email');
    $this->unit->run($dbSam->theme, 1, 'should have known theme');
    $this->unit->run(count($dbSam->creations), 0, 'should have no creations');
    $this->unit->assert_not_null($dbSam->registered_on, 'should have registered_on timestamp');

    $bogus = $this->User->findByUsername('bogusUsername');
    $this->unit->assert_null($bogus, 'should not return bogus user account');
  }

  function testUserWithCreations() {
    $dbDad = $this->User->findByUsername('Daddy');
    $this->unit->run(count($dbDad->creations), 1, 'should have known number of creations');
    $creation = $dbDad->creations[0];
    $this->unit->run($creation->id, 1, 'should have known creation ID');
    $this->unit->run($creation->name, 'dph', 'should have known creation name');
    $this->unit->run($creation->points, 0, 'should start with no points');
  }

  function testFindUserWithBlogEntries() {
    $dbSam = $this->User->findByUsernameWithBlogEntries('Sam');
    $row = $this->db->query('select count(*) as c from blogs where account_id = ?', array($dbSam->id))->row();
    $blogCount = $row->c;
    $this->unit->run(count($dbSam->blogEntries), $blogCount, 'should have blog entries');
    $this->unit->run(count($dbSam->creations), 0, 'should also have (or not have) creations');

    $dbDad = $this->User->findByUsernameWithBlogEntries('Daddy');
    $row = $this->db->query('select count(*) as c from blogs where account_id = ?', array($dbDad->id))->row();
    $blogCount = $row->c;
    $this->unit->run(count($dbDad->blogEntries), $blogCount, '(ditto)');
    $this->unit->run(count($dbDad->creations), 1, '(ditto)');
  }

  function testPostBlog() {
    $dbSam = $this->User->findByUsernameWithBlogEntries('Sam');
    $countBefore = count($dbSam->blogEntries);
    $this->User->postBlog($dbSam->id, 'title', 'text');
    $dbSam = $this->User->findByUsernameWithBlogEntries('Sam');
    $this->unit->run(count($dbSam->blogEntries), $countBefore + 1, 'should save new blog');

    $blog = $dbSam->blogEntries[0];
    $this->unit->run($blog->title, 'title', 'should have newest blog entry first');
  }

  function testUpdatesAccount() {
    $original = $this->User->findByUsername('Daddy');
    $this->unit->assert_null($original->email, 'should not yet have email');
    $original->email = 'ralph@johnson.com';
    $this->User->update($original);
    $updated = $this->User->findByUsername('Daddy');
    $this->unit->run($updated->email, 'ralph@johnson.com', 'should update/persist data');
  }

  function testSignup() {
    $nobody = $this->User->findByUsername('newSignup');
    $this->unit->assert_null($nobody, 'should not be signed up yet');

    $newId = $this->User->signup('newSignup', 'Password1', 'e@mail.com');

    $somebody = $this->User->findByUsername('newSignup');
    $this->unit->assert_not_null($somebody, 'should have signed up');
    $this->unit->run($somebody->id, $newId, 'should have returned new id');
    $this->unit->assert_not_null($somebody->registered_on, 'should have default date');
    $this->unit->run($somebody->theme, 1, 'should have default theme');
    $this->unit->run($somebody->email, 'e@mail.com', 'should have saved email');
    $this->load->helper('date');
    $this->unit->run($somebody->registered_on, mdate('%Y-%m-%d', time()), 'should set reg. date to now');
    $this->unit->assert_not_null($somebody->salt, 'should have salt');
    // TODO: I don't really want password in memory; how to test this?
    //$this->unit->run($somebody->password, sha1('Password1' . $somebody->salt), 'should hash password');
  }

  function testSignupPreventsDuplicateUsernames() {
    $this->User->signup('newSignup', 'Password1', null);
    $id = $this->User->signup('newSignup', 'Password2', null);
    $this->unit->assert_null($id, 'should not allow duplicate usernames');
  }
}

