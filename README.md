<br/>

## RENHEAD PHP developer task

<br/>

Task was to write an API (using Laravel framework) based on a given database model:

**[Database Model](https://dbdiagram.io/d/6230b53b0ac038740c3bf80b/)**

Following things needs to be implemented:

1. Make an authentication system using Sanctum.
2. Make CRUD API for payments and travel payments.
3. Make API route for payments approval.
4. Make an API report that will return the sum of approved payments for every approver.

    - The user is an approver if he has the ‘APPROVER’ type.
    - Travel payments and payments should be on this API route.
    - Payment is approved when all approver votes are ‘APPROVED’.
    - Consider a minimum of 200 payments per user.

<br/>

## Process

### _Authentication system using Sanctum_

This is a default authentication system in Laravel, so we don't need to do much here. We are getting whole authentication system out of the box. There is no need for package such as _Laravel Passport_, as I use to work with him in my earlier projects.

### _CRUD API for payments and travel payments_

For this I created 2 controllers class in API folder _ApiPaymentsController.php_ and _ApiTravelPaymentsController.php_, including models _Payment_ and _TravelPayment_

### _Make API route for payments approval_

Class responsible for this logic is _ApiPaymentApprovalController_

### Make an API report that will return the sum of approved payments for every approver.

Logic for this occuring in class _ApiReportsApproverPaymentsController_

<br/>

## Steps

Run composer install

```properties
composer install
```

Copy example of .env file

```properties
cp .env.example .env
```

Run migrations to create a database tables:

```properties
php artisan migrate
```

After that you can run seeders if you want to populate created tables:

```properties
php artisan db:seed
```

#### _This command will create 500 payments (at least 200 payments per user), create also two users randomly with type = 'APPROVER|BASIC'_.

_This command will also first truncate all data from tables_.
