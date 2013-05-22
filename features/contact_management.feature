Feature: Contact management
  As an site owner
  I want to be able to manage contact
  In order to have better life :)

  Scenario: My contact list access
    Given I am on the home page
    When I follow list contact link
    Then I should be on the contacts index


  Scenario: Look at contact list
    Given I have available contacts:
    | firstName | lastName   |
    | Szymon    | Skowroński |
    | Leszek    | Prabucki   |
    When I am on the contacts index
    And show last response
    Then I should see 2 contacts in


  Scenario: Add success new contact
    Given I am on the contacts new
    When I am fill "Szymon" in the first name field in contact form
    And I am fill "Skowroński" in the last name field in contact form
    And I send contact form
    Then I should be on the contacts index
    And I should see 1 contacts in
    And I should see success add contact notification
