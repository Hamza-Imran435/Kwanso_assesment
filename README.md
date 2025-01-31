<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel Task Management System

This is a Laravel-based task management system that includes role-based access control, task management, client invitation via email, and a front-end built using Blade templates, jQuery, and DataTables.

## Features

1. **Role-Based Access Control (RBAC):**
   - Two roles: **Admin** and **Client**.
   - Admins can create, update, delete, and view tasks for themselves and other users.
   - Clients can only view and manage their own tasks.

2. **Task Management:**
   - Tasks can be created, updated, and deleted.
   - Tasks have two statuses: **Pending** and **Completed**.
   - Admins can assign tasks to multiple clients.

3. **Client Invitation:**
   - Admins can send email invitations to clients.
   - Invitations are valid for 7 days and expire after the client signs up.
   - Resending an invitation resets the expiration date.

4. **Client Signup:**
   - Clients can sign up only via an invitation link sent by an admin.
   - The invitation token expires after the first verification or after 7 days.

5. **Front-End:**
   - Built using **Blade** templates.
   - **jQuery** for dynamic interactions.
   - **DataTables** for displaying tasks with search functionality.

## Technologies Used

- **Backend:** Laravel 11
- **Database:** MySQL
- **Frontend:** Blade, jQuery, DataTables

## Installation

Follow these steps to set up the project locally:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/your-repo-name.git
   cd your-repo-name
   composer install
   php artisan key:generate
   manage Database Credentials in .env file.
   php artisan migrate --seed
   manage Mail Smtp in .env file.
   run php artisan queue:work in terminal for mail sending
