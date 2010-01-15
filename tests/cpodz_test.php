<?php

class CPodz_test extends WebTestCase
{
  function testHomepage() {
    $this->assertTrue($this->get(CPODZ_BASE_URL));
    $this->assertNoLink('profile');
    $this->assertNoLink('account');
    $this->assertNoLink('write blog');
    $this->assertNoLink('invite friend');
    $this->assertField('username', '');
    $this->assertField('password', '');
  }

  function testLoginFormValidation() {
    $this->get(CPODZ_BASE_URL);
    $this->setField('username', 'Sam');
    $this->clickSubmit('login');
    $this->assertText('The password field is required');
    $this->assertNoText('Invalid username or password');
    $this->assertField('username', 'Sam');
    $this->assertField('password', '');
  }

  function testSuccessfulLogin() {
    $this->post(CPODZ_BASE_URL . 'login', array('username' => 'Sam', 'password' => 'Password1'));
    $this->assertLink('profile');
    $this->assertLink('account');
    $this->assertLink('write blog');
    $this->clickSubmit('logout');
  }

  function testSignupFormValidation() {
    $this->assertTrue($this->get(CPODZ_BASE_URL . 'signup'));
    $this->clickSubmit('signup');
    $this->assertText('The username field is required');
    $this->assertText('The password field is required');
    $this->assertText('The terms and conditions field is required');
    $this->assertText('The text in the image field is required');
  }

  function testSignupFailsIfUsernameTaken() {
    $this->get(CPODZ_BASE_URL . 'signup');
    $cookie = unserialize(urldecode($this->getCookie('ci_session')));
    $captcha = $cookie['captcha'];

    $this->post(CPODZ_BASE_URL . 'signup', array(
      'username' => 'Sam',
      'password' => 'asdf',
      'terms'    => 1,
      'captcha'  => $captcha));
    $this->assertText('that username is already taken');
    // TODO: figure out how to prevent SimpleTest from following the redirect; then get this validation
    // error on the same screen as the form
  }
}

