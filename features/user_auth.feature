Feature: User Authentication
  As a user of creationpodz.com
  I want to be able to log into the site

  Scenario: not logged in by default
    When I go to the homepage
    Then I should see "home"
    And I should see "signup"
    And I should see "about"
    And I should see "help"
    But I should not see "profile"
    And I should not see "account"
    And I should not see "write blog"

  Scenario: successful login and logout
    Given an account exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1", salt: "abc123", registered_on: "2010-06-01"
    When I go to the homepage
    And I fill in "username" with "testUser1"
    And I fill in "password" with "Password1"
    And I press "login"
    Then I should see "profile"
    And I should see "account"
    And I should see "write blog"
    When I press "logout"
    Then I should not see "profile"
    And I should not see "account"
    And I should not see "write blog"

