Feature: post blogs
  As a registered user of this site
  I want to be able to post blogs

  Background:
    Given an account exists with username: "testUser1", password: "Password1", email: "testUser1@somewhere.com", registered_on: "2010-01-01"
    And I am signed in with username: "testUser1", password: "Password1"

  Scenario: post a blog
    Given I follow "write blog"
    And I fill in "title" with "a title"
    And I fill in "entry" with "some text"
    When I press "save"
    Then I should see "new blog entry saved"
    When I follow "profile"
    Then I should see "a title"
    And I should see "some text"

  Scenario: blog posting validations
    Given I follow "write blog"
    And I fill in "title" with " "
    And I fill in "entry" with " "
    And I press "save"
    Then I should see "The title field is required"
    And I should see "The entry field is required"

