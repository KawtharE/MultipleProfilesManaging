# Multiple Profiles Managing
A Laravel 5.4 &amp; AngularJS example of creating, saving and displaying multiple profiles.

![Starting Screen](https://github.com/KawtharE/MultipleProfilesManaging/blob/master/assets/Screencast%202018-01-12%2014_29_44.gif)

**Form validation**

![Starting Screen](https://github.com/KawtharE/MultipleProfilesManaging/blob/master/assets/Screencast%202018-01-12%2015_57_09.gif)

# Step by Step

**Note:** when downloading this example, make sure first of all to run the following command line, in order to generate the autoload files.
          
          $ composer update --no-scripts
          
 ## 1- Configuring local development environment
 #### - Installing a local server:
 
    -WAMP: Windows,
    -LAMP: Linux,
    -MAMP: MAC,
    -XAMPP: Windows, Linux, OSx
    
#### - Server requirements:
make sure all necessary extensions for Laravel are installed.

[The server requirements](https://laravel.com/docs/5.4/installation#server-requirements) can be found in the official documentation of Laravel 5.4

#### - Install Composer:

    $ sudo apt-get update
    $ curl -sS https://getcomposer.org/installer | php
    $ sudo mv composer.phar /usr/local/bin/composer
    $ sudo chmod +X /usr/local/bin/composer
    
 ## 2- Creating a new Laravel project and developing the server side
 
 #### - Install Laravel and start new project:
 
    $ cd /var/www/html
    $ composer create-project laravel/laravel --prefer-dist multipleProfilesManaging 5.4
    $ cd multipleProfilesManaging
    $ php artisan serve
    
-> The laravel project served on http://localhost:8000

#### - Create and configure the database:
- From the PhpMyAdmin dashboard we need to create new database **profiles**

- Edit **.env** file and remove **.env.example** file:

  *.env*
  
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=profiles
        DB_USERNAME=YOUR_DB_USERNAME
        DB_PASSWORD=YOUR_DB_PASSWORD
        
- Edit the **users table** file which is located under **database/migrations** folder:

        public function up()
        {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('uniqueID');
                $table->string('firstname');
                $table->string('lastname');
                $table->string('gender');            
                $table->string('birthDate');
                $table->string('country');
                $table->string('city');
                $table->string('email')->unique();
                $table->string('mobile');
                $table->timestamps();
            });
        }
    
 From the CLI migrate the local configuration to the development server using the following command
 
     $ php artisan migrate
 
 - Seed the users table by editing **database/seeds/DatabaseSeeder.php** 
 
               ...
               public function run() {
                    Model::unguard();
                    DB::table('users')->delete();
                    $users = array(
                        ['uniqueID'=>uniqid(),'firstname'=>'Kaouther', 'lastname'=>'Mefteh', 'gender'=>'female', 'birthDate'=>'09/29/1992', 'country'=>'Tunisia', 'city'=>'Mahdia', 'email'=>'meftehkaouther@gmail.com', 'mobile'=>'123456789'],
                        ['uniqueID'=>uniqid(),'firstname'=>'Tommie', 'lastname'=>'Seese', 'gender'=>'male', 'birthDate'=>'10/04/1990', 'country'=>'France', 'city'=>'Paris', 'email'=>'TommieSeese@gmail.com', 'mobile'=>'123456789'],
                        ['uniqueID'=>uniqid(),'firstname'=>'Daine', 'lastname'=>'Voorhies', 'gender'=>'male', 'birthDate'=>'10/21/1978', 'country'=>'New Zealand', 'city'=>'Wellington', 'email'=>'DaineVoorhies@gmail.com', 'mobile'=>'123456789'],
                        ['uniqueID'=>uniqid(),'firstname'=>'Lewis', 'lastname'=>'Tawney', 'gender'=>'male', 'birthDate'=>'02/04/1992', 'country'=>'United state', 'city'=>'New York', 'email'=>'LewisTawney@gmail.com', 'mobile'=>'123456789'],
                        ['uniqueID'=>uniqid(),'firstname'=>'Ling', 'lastname'=>'Craft', 'gender'=>'male', 'birthDate'=>'02/13/1971', 'country'=>'Russia', 'city'=>'Moscow', 'email'=>'LingCraft@gmail.com', 'mobile'=>'123456789'],
                        ['uniqueID'=>uniqid(),'firstname'=>'Stephenie', 'lastname'=>'Noguera', 'gender'=>'female', 'birthDate'=>'12/29/1998', 'country'=>'Canada', 'city'=>'Ottawa', 'email'=>'StephenieNoguera@gmail.com', 'mobile'=>'123456789'],
                        ['uniqueID'=>uniqid(),'firstname'=>'Rodrigo', 'lastname'=>'Tulloch', 'gender'=>'male', 'birthDate'=>'01/26/1986', 'country'=>'Australia', 'city'=>'Canberra', 'email'=>'RodrigoTulloch@gmail.com', 'mobile'=>'123456789'] ,
                    );
                    foreach($users as $user){
                      User::create($user);
                    }
                    Model::reguard();
                }
 
 
          $ php artisan db:seed
 
 #### - Developing the server side functions:
 First of all we need to make a small but very important change in the **config/auth.php** file in order to be able to use the laravel project as an **API** and not a web app:
 
           'default' => [
               'guard' => 'api',
               'passwords' => 'users',
          ];
          
 Main functions of the server side are: 
 
   1. creating a new Profile
      
              function saveForm(ProfileFormRequest $request) {
                   $newProfile = $this->user->create([
                      'uniqueID' => uniqid(),
                      'firstname' => $request->get('firstname'),
                      'lastname' => $request->get('lastname'),
                      'gender' => $request->get('gender'),
                      'birthDate' => $request->get('birthDate'),
                      'country' => $request->get('country'),
                      'city' => $request->get('city'),
                      'email' => $request->get('email'),
                      'mobile' => $request->get('mobile')
                  ]);
                 if (!$newProfile) {
                    return response()->json(['failed to create new profile'], 500);
                  } else {
                    return response()->json(['new profile was successfully created'], 200);
                  }
              }


   2. retrieving all saved data from the server
      
              function getProfiles() {
                $users = User::all();
                return $users;
              }
 
 ## 3- Creating the AngularJS project and developing the front-end
 
 
