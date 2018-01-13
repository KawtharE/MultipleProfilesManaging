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
 
 Configure the **API** routes in **routes/api.php** that will be used to call the previous functions
 
          Route::post('/saveForm', 'ProfilesController@saveForm');
          Route::post('/getProfiles', 'ProfilesController@getProfiles');
          
 ## 3- Creating the AngularJS project and developing the front-end
 
 #### - create the AngularJS project and install the necessary dependencies:
 
          $ cd public
          $ mkdir AngularProject
          $ cd AngularProject
          $ mkdir css
          $ mkdir js
          $ mkdir templates
          $ npm install angular@1.5.11 angular-ui-router bootstrap@3 angular-material angular-animate@1.5.11 angular-aria@1.5.11 angular-messages@1.5.11 angular-smart-table angular-ui-bootstrap
 
 **note:** The version of angular-animate, angular-aria and angular-messages must be the same version as angularjs!

#### - create the master.php file under resources/views

- Add **ng-app="ProfilesManaging"** to **html** tag.

- Add metas:
         
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">

- Import css and js files:
                    
                    <!--CSS files-->
                    <link href="AngularProject/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link href="AngularProject/node_modules/angular-material/angular-material.css" rel="stylesheet">
                    <link rel="stylesheet" type="text/css" href="AngularProject/css/main.css">

                    <!--JS files-->
                    <script src="AngularProject/node_modules/angular/angular.js"></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    <script src="AngularProject/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
                    <script src="AngularProject/node_modules/angular-ui-router/release/angular-ui-router.js"></script>
                    <script src="AngularProject/node_modules/angular-aria/angular-aria.js"></script>
                    <script src="AngularProject/node_modules/angular-animate/angular-animate.js"></script>
                    <script src="AngularProject/node_modules/angular-material/angular-material.js"></script>
                    <script src="AngularProject/node_modules/angular-messages/angular-messages.js"></script>
                    <script src="AngularProject/node_modules/angular-smart-table/dist/smart-table.js"></script>
                    <script src="AngularProject/node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js"></script>


                    <script src="AngularProject/js/app.js"></script>
                    <script src="AngularProject/js/FormController.js"></script>
                    <script src="AngularProject/js/ProfilesController.js"></script>

- Add the **ui-view** tag

#### - create js/app.js file

- Inject dependencies:

          	angular.module('ProfilesManaging', [
			'ui.router', 
			'ngMaterial', 
			'ngMessages', 
			'smart-table', 
			'ui.bootstrap'
			])
                              
- Configure routing:

		.config(function($stateProvider, $urlRouterProvider){
		        $urlRouterProvider.otherwise('/form');
			$stateProvider
				.state('form', {
			          	url: '/form',
					templateUrl: '/AngularProject/templates/form.html',
					controller: 'FormController',
					controllerAs: 'fm'
				})
				.state('profiles', {
					url: '/profiles',
					templateUrl: 'AngularProject/templates/profiles.html',
					controller: 'ProfilesController',
					controllerAs: 'pf'
				});
		})
                    
#### - create templates/form.html and js/FormController.js
The main function of this controller is saving a new profile, if the form is validate a new profile will be created and the user will be redirected to profiles page.

		    	$http({
		             method: 'POST',
		             url: 'api/saveForm',
		             data: "firstname="+$scope.user.firstname+"&lastname="+$scope.user.lastname+"&gender="
		             		+$scope.user.gender+"&birthDate="+$scope.user.birthDate+"&country="+$scope.user.country
		             		+"&city="+$scope.user.city+"&email="+$scope.user.email+"&mobile="+$scope.user.mobile,
		         	headers: {'Content-Type': 'application/x-www-form-urlencoded'}	    		
		    	}).success(function(response){
		    		console.log(response);
	    		    $window.location.href = '/#/profiles';
		    	}).error(function(response){
		    		console.log(response);
	    			$scope.openAlert('Error', response.email[0]);
		    	});
                    

![Starting Screen](https://github.com/KawtharE/MultipleProfilesManaging/blob/master/assets/Screenshot%20from%202018-01-13%2017-45-34.png)
 
 #### - create templates/profiles.html and js/ProfilesController.js
 - displaying all saved profiles by retrieving them from the server:
 
 	    $scope.getProfiles = function(){
	      $http({
	        method: 'POST',
	        url: '/api/getProfiles',
	        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	      }).success(function(response){
	        $scope.profiles = response;
	      }).error(function(error){

	      });
	    }

![Starting Screen](https://github.com/KawtharE/MultipleProfilesManaging/blob/master/assets/Screenshot%20from%202018-01-13%2017-45-59.png)

- display each one of theme as a Modal
		
		...
	       .controller('ProfileCtrl', function ($scope, $uibModalInstance, user) {
	        	$scope.user = user;
	        })
		...
	    $scope.openProfile = function (_user, size) {

	        var modalInstance = $uibModal.open({
	          animation: true,
	          controller: "ProfileCtrl",
	          templateUrl: 'profile.html',
	          backdrop  : 'static',
	          keyboard  : false,
	          size: size,
	            resolve: {
	                user: function()
	                {
	                    return _user;
	                }
	            }
	        });
	    }
                    
![Starting Screen](https://github.com/KawtharE/MultipleProfilesManaging/blob/master/assets/Screenshot%20from%202018-01-13%2017-46-21.png)                 
                    
                    
                    
