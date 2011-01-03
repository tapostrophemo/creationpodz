@wip
Feature:
  As an administrator of creationpodz.com
  I want to be able to manage the entries that appear on the front page
  So that I can provide fresh content to site visitors

  Background:
    Given an account exists with is_admin: 1, username: "testAdmin1", password: "AdminPassword1", email: "testAdmin1@somewhere.com", registered_on: "2010-01-01"
    And an account exists with username: "testUser1", password: "Password1", email: "testUser1@somewhere.com", registered_on: "2010-01-01"
    And a blog exists with account_id: 2, title: "Blog Post #1", entry: "this is what I wrote...", posted_on: "2010-01-01"
    And I am signed in with username: "testAdmin1", password: "AdminPassword1"

  Scenario: administrator must choose content for it to appear on the front page
    When I go to the home page
    Then I should not see "Blog Post #1"
    When I go to the admin select content page
    And I check "Blog Post #1"
    And I press "Save"
    Then I should see "Entries assigned to front page"
    When go to the home page
    Then I should see "Blog Post #1"

