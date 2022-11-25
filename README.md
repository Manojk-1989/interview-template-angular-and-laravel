# Instructions:

- General documentations can be used and found at
  - Laravel - [https://laravel.com/docs](https://laravel.com/docs)
  - Angular - [https://angular.io/docs](https://angular.io/docs)
- You are free to use any opensource components/templates/plugins
- After the tasks are done submit a merger request to the master

## Backend

- Create a Laravel Application that authenticates the APIs using JWT Token.
- Integrate roles &amp; permissions
  - Roles
    - User
    - Admin
  - Permissions
    - calculate
    - calculate\_with\_steps
  - Admin user permission
    - calculate\_with\_steps
  - General user permission
    - calculate
- APIs
  - Registration
  - Login
  - Get\_users

## Frontend

- Create a Angular Application with : 
  - Registration form
  - Login form
  - Dashboard
    - In dashboard create a text field that takes in a math formula (number as variables and operators +×/-%) and display its result
  - For a user with calculate permission display the final result
  - For a user with calculate\_with\_steps permission, also display the steps taken to get to the final result

## Calc Example

- 100 * 50 + 300 - 5
  - Result for User : 
  
    Result : 5295

  - Result for Admin : 
    
    Step 1 : 100 * 50 + 300 - 5

    Step 2 : 5000 + 300 - 5

    Step 3 : 5300 - 5

    Step 4 : 5295

    Result : 5295

## Example Calc Test Cases

  - 100 * 50 + 300 - 5 * 10
  - 50 / 10 * 200 - 50 / 10
  - 0.4 + 0.2 - 0.3 + 0.2
