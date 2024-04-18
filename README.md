# Installation Guide

Follow these steps to install and run the application:

## Requirements

- PHP >= 8.1
- MySQL - 5.7.36
- Composer
- Node.js and npm

### Step 1: Install Dependencies

```bash
composer install
```
This command will install PHP dependencies required for the app.

### Step 2: Set up the Database
Add a fresh database and run this command
```bash
php artisan migrate:fresh --seed
```
This command will create the necessary database tables and seed them with sample data.

### Step 3: Install Frontend Dependencies
```bash
npm install
```
This command will install the Node.js dependencies needed for the frontend.

### Step 4: Build Frontend Assets
```bash
npm run build
```
This command will compile and bundle the frontend assets for production.

### Step 5: Start the Server
```bash
php artisan serve
```
This command will start the PHP development server, and you can access the







