## About Project

BNB Bank's back end is designed until DDD (Domain-Driven Design).

## First's steps

1 - Clone the project;
2 - run `composer install`
3 - run `cp .env.example  .env`
4 - run `php artisan migrate --seed`

Note: For default after running migrations with "--seed" parameters, will be created an admin user with data (username:`admin`, password:`12345678`)

## Requirements to do the task

-   [x] The system has 2 types of users
-   [x] customer
-   [x] admin

customer user stories:

-   [x] a user can create a new account with a username and password
-   [x] A User starts with a 0 balance (I used events/listeners. I know it's possible to catch model event creation, but in this test scenario, I prefer to show I can implement it)
-   [x] A user can deposit more money into his account by uploading a picture of a check and entering the amount of the check. if the check is approved by an admin, the money is added to the bank account.
-   [x] To buy something, the user enters the amount and description; a user can only buy something if she has enough money to cover the cost.
-   [x] A user can see a list of balance changes including time and description.

admin user stories:

-   [x] An admin account is already created with a hard-coded username and password (use seeders to do that).
-   [x] An admin can see a list of pending check deposit pictures with the amount and picture and click to approve or deny the deposit.
-   [x] An admin can’t be also a customer
