Feature: User Registration
  As a visitor of creationpodz.com
  I want to register as a user of the site

  Scenario: basic validation
    Given I go to the registration page
    And I fill in "username" with " "
    And I fill in "password" with " "
    And I fill in "captcha" with " "
    When I press "signup"
    Then I should see "The username field is required"
    And I should see "The password field is required"
    And I should see "The terms and conditions field is required"
    And I should see "The text in the image field is required"

  Scenario: validates usernames are unique
    Given an account exists with username: "testUser1", password: "Password1", email: "testUser1@somewhere.com", registered_on: "2010-01-01"
    And I go to the registration page
    And I fill in "username" with "testUser1"
    And I fill in "password" with "asdf"
    And I fill in "email" with "testUser1@somewhere.com"
    And I check "terms"
    And I fill in the captcha
    When I press "signup"
    Then I should see "that username is already taken"

