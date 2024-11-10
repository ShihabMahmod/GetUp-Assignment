
# Laravel Developer Task Showcase: API, Authentication, Optimization, and Queueing

This repository serves as a showcase of key Laravel development skills, including API building with authentication, database optimization, role-based access control, queue handling, and complex query optimization. The project is designed to demonstrate advanced proficiency in Laravel through a structured, multi-functional application setup.




## Table of Contents Feature

- Sign In & Sign Up System 
- CRUD operations for Products.
- Making Order
- Implement Role-Based Access Control Using Spetia Package
- Top five best selling product
- Top five recent order
- Implement a Simple Queue for Email Notifications(Using Laravel Observer)
- Finding orders by category name(Solving N+1 problem)



## Technologies Used



**Backend:** Laravel-11

**For Authentication** Sanctum

**Database:** MySQL

**Email:** Laravel Queue, Mail, Observer




## Installation Requirement

Prerequisites Ensure you have the following installed

- PHP 8.2+

- Composer 

- MySQL


## Installation

Steps 1 : Clone the repository

```bash
  https://github.com/ShihabMahmod/GetUp-Assignment.git

```


Steps 2 : Goto Project

```bash
  cd GetUp-Assignment

```

Steps 3 : Set Up Environment Variables

```bash
  cp .env.example .env

```


Steps 5 : migrate the databse

```bash
  php artisan db:seed --class=RolesAndPermissionsSeeder

```

Steps 5 : Generate Permission

```bash
  php artisan db:seed --class=RolesAndPermissionsSeeder

```
Steps 5 : Generate Fake(User,Category,Product,Order)

```bash
  php artisan db:seed

```

Steps 6 : Generate Application  Key

```bash
  php artisan key:generate

```


Steps 8 : Start server

```bash
  php artisan server

```

Steps 7 : listen queue

```bash
  php artisan queue:work or php artisan queue:listen

```
    