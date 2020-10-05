
# USER PRIVATE CHAT

User private chat is a one to one user chat application, all users must be authenticated(create account login and select a user to chat with).

## Features 
- User one to one instant chat
- User typing event.

## How to get your environment setup
* Ensure you have Apache2, PHP 7.1+, MySQL and Composer up and running, you can get this complete pack with XAMP, LAMP, MAMP or WAMP
* Fork the repository
* Clone your fork into your Apache or XAMPP server
* Navigate to the project folder 
* Copy `.env.example` to `.env`
* Edit the `.env` file with corresponding parameters
      * Set the Database configuration.
      * Set Pusher app configurations.
      * Set the `APP_URL` property. Please avoid serving the application with `php artisan serve`. You should use  `http://localhost/project-folder-name/public`.
* Run `composer install` and then clear the cache with `php  artisan config:cache`

## Contributing
* All pull request are to be made on the `origin/dev` branch of the main repository any pull request on the `master` branch will be ignored.

## Project Structure
* default laravel auth system
* User chat area

## Contributors
-Iyiakod Godlove Abilandou ([@Abilandou](https://github.com/Abilandou))

## Developer/Development tools
- Laravel 8.x
- PHP >= 7.3
- Bootstrap v4

## Packages and third party libraries
- Laravel Echo
- Websockets
- Laravel Pusher

## Usage
- Kepp application running
    --Run the following commands
 *** npm run watch
 - while this is running, open another terminal window/tab
 *** php artisan websocket:serve


## DEMO
- The demo of this application here(([@DEMO](https://govchat.herokuapp.com/)))
- Open demo
- Register, select a user and start chating.
