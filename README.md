IMPORTANT MESSAGE AFTER DOWNLOADING THE MANAGER AND STAFF SYSTEM:
## IMPORTING of "caffe_db" - On your PC:
> Check your .env if the setup is like this:
> ````
> DB_CONNECTION=mysql
> DB_HOST=127.0.0.1
> DB_PORT=3306
> DB_DATABASE=caffe_db
> DB_USERNAME=root
> DB_PASSWORD=
> ````
> Also import the SQL Source file on your phpMyAdmin
> ````
> You can find the caffe_db SQL Source file here:
> /OrderingSystem/database/caffe_db
> (P.S Look for it on your file explorer.)
>
> After finding the file, open your phpMyAdmin then go to "Import" section and select the caffe_db file from this folder. 
> After you have selected the caffe_db file click the import button from Import section and data will be added to your phpMyAdmin.
> ````

## STEP 1 — Install Node.js

> **If you don’t have Node.js:**
>
> Download it here: [https://nodejs.org/en/download](https://nodejs.org/en/download)  
> Choose **Windows Installer (.msi)** and follow the installation instructions.
>
> After installation, open **Command Prompt** and verify your installation:
> ```bash
> node -v
> npm -v
> ```
> Both commands should display version numbers.

---

## STEP 2 — Run the System

> **If you already have Node.js installed:**
>
> 1. Open the **system folder** in **Command Prompt** or **VS Code Terminal**.  
> 2. Run the following commands in order:
>    ```bash
>    npm install
>    npm run dev
>    ```
> 3. Wait for all dependencies to install.
> 4. Once completed, your system should start automatically.
> 5. If it doesn’t open automatically, visit:
>  [http://localhost:3000/](http://localhost:3000/)

---

## STEP 3 — Enable PDF Download (Laravel DomPDF)

> To enable the **Download PDF** functionality:
>
> 1. In your terminal, run:
>    ```bash
>    composer require barryvdh/laravel-dompdf
>    ```
> 2. After installation, publish the package with:
>    ```bash
>    php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
>    ```

---

##  STEP 4 — Database Setup

### If `database.sqlite` does **not** exist:
1. Go to your **database** folder.  
2. Right-click → **New File** → Name it exactly:

### If `database.sqlite` **already exists:**
Run this command to refresh and seed the database with temporary/sample data:
```bash
php artisan migrate:fresh --seed
```
---

## STEP 5 — Environment Files (.env and .env.example)

If .env and .env.example are missing, follow these steps:

Create two files in your project root:

.env

.env.example

Copy and paste the following contents:

Inside .env:
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:4FS8vncWRySLbqm35j0+r32nauU8W9M6u/GpNVnrNwc=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

PHP_CLI_SERVER_WORKERS=4
BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=database/database.sqlite
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

Inside .env.example
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

PHP_CLI_SERVER_WORKERS=4
BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```
Add this to .gitignore:
```
.env
```
---

## STEP 6 — If .env Already Exists

If your .env file already exists but doesn’t include database settings,
add the following lines right below the LOG section:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=caffe_db
DB_USERNAME=root
DB_PASSWORD=
```
---
## P.S If an error like "APP_KEY missing" appeared, 
Enter this in your terminal:
```
php artisan key:generate
```
---
