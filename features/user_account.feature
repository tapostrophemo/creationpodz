Feature: user account activities
  As a registered user of this site
  I want to be able to make modifications to my account

  Background:
    Given an account exists with username: "testUser1", password: "Password1", email: "testUser1@somewhere.com", registered_on: "2010-01-01"
    And I am signed in with username: "testUser1", password: "Password1"

  Scenario: update email
    Given I follow "account"
    And I fill in "email" with "anotherEmail@somewhere.com"
    When I press "save"
    Then an account should exist with username: "testUser1", email: "anotherEmail@somewhere.com"
    And I should see "your account has been updated"

