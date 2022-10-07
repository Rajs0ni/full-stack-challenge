# FULL STACK CHALLENGE

## Project Intro
The repo contains two directories.
1. Panel - This directory is responsible for handling backend CRUD operations. This is more or like admin panel. It'll run on port - 8093
2. Laravel API - This directory is responsible for backend APIs. It'll run on port - 8091.
   
   1. Script to fetch properties is available under DIR - laravel-api\app\Console\Commands
   2. Api routes are under DIR - laravel-api\routes
   3. Business logic is available under DIR - laravel-api\app\Sk (Sk refers as StarterKit)

3. So Laravel app flow is like - Api route -> Controller -> Internal API -> Model.
4. Frontend (Admin Panel) & backend (Laravel API) are completely independent.
5. Frontend is built in VueJs + Vuetify.

All the ports and starting commands are written in the start.sh bash file in case if there is need to edit them

## Project setup
Step 1. Clone the project from Github/Gitlab.

Step 2. Set up MySQL database with the name - "properties_db" and set db username/password in laravel-api .env.local file  (Default username - root | Default password - password)

Step 3. That's it. Rest of things will be taken care of. Run the bash script - start.sh by following command:-

For Linux/Ubuntu - 
```
bash start.sh
```

For Mac - 
```
zsh start.sh
```
Step 4. In order to use the Admin panel, it's recommended to firstly run the fetch properties script to load the data - specially property types.
To run the fetch script use below commands:-

```
cd laravel-api
```
```
php artisan fetch:properties
```