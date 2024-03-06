## Bnb back end - Laravel 10 + MySQL + DDD + Repository Pattern + Pest on tests

BNB Bank's back end is designed until DDD (Domain-Driven Design) and implemented the Repository Pattern.

![CleanShot 2024-03-06 at 11 07 23](https://github.com/cleitokarloh/bnb-backend/assets/5879585/3804e1db-1c92-4eda-8cfe-fb4675d42656)


## Run the project
- 1 - Clone the project;
- 2 - run `composer install`
- 3 - run `cp .env.example  .env`
- 4 - run `php artisan migrate --seed`
- 5 - run `php artisan serve`

##### Note: For default after running migrations with "--seed" parameters, will be created an admin user with data (username:`admin`, password:`12345678`)

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

## For the back-end specific requirements:
- Automated Tests
    - I used Pest to make the tests in this application. Pest is an elegant way to create tests with PHP.
    - All functionalities are tested with the unit test to assume the correct work in the domain layer.
    - All functonalities are tested with feature test to assume correct external comunication with domain.
    - I maintain example tests not only to make volume 😂 but to assume the correct configuration of the test library.

## And big extra points if you:
- Implement a design pattern (DDD, Repository Pattern, etc.)
    - See the explanation below.
- Make a good and cohesive database design
    - Here I opted to make a lean database. But, if I need to grow the application I will separate purchases of movements into a purchases table, in the movements table I will be relational with "categories" of movements then I will be flexible to create many types of opportunities in my application.
<img src="https://github.com/cleitokarloh/bnb-backend/assets/5879585/a8b0a869-516e-4494-902a-ecb586a4b864" width="600" />

## DDD (Domain-Driven Design)
![CleanShot 2024-03-06 at 11 28 53](https://github.com/cleitokarloh/bnb-backend/assets/5879585/01bec119-c393-4656-b1ac-ab99a9df66db)

I separeted in 3 folder the application: App, Domain, Infraesctructure.
- App
    - Here I put Laravel basic core to work fine.
    - External communication in this specific case API.
- Domain
    - Here the functionalities of the application without the interference of external things/decisions/problems.
    - All data traffic inside here, respect the DTO (Data Transfer Object) to assume consistency of data between layers of application.
    - use cases - I named "actions". Are responsible for realizing the application functionalities. I follow the SOLID principle (single responsibility), and then each file is responsible for a unique functionality. With this, is possible to create a Unit test for each functionality and test all business roles.
- Infraestructure
    - Here, following Clean Architecture principles, I put the implementation of the repository. This layer is responsible for providing the necessary infrastructure for external application communication.

## Repository Pattern
In this project, I chose to use Eloquent, but is easy to implement another method. See:

![code](https://github.com/cleitokarloh/bnb-backend/assets/5879585/aabf60e1-a767-4139-ba49-790152e70157)

I used the amazing dependency inversion provided by Laravel. See, with this configuration, it's possible to use the method of persistence of your choice. And, of course, you can migrate the part-to-part option to use another persistence method without the application being broken.

