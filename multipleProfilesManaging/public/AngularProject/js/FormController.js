(function(){
	'use strict';

	angular.module('ProfilesManaging')
		   .controller('FormController', FormController)

	function FormController($scope, $http, $mdDialog, $filter, $window) {
		var vm = this;
	    $scope.user = {};
	    $scope.defaultHid = false;

	    $scope.gender = ['Male', 'Female'];
	    $scope.countries = ('AL AK AZ AR CA CO CT DE FL GA HI ID IL IN IA KS KY LA ME MD MA MI MN MS ' +
	    'MO MT NE NV NH NJ NM NY NC ND OH OK OR PA RI SC SD TN TX UT VT VA WA WV WI ' +
	    'WY').split(' ').map(function(country) {
	        return {abbrev: country};
	      });
		  $scope.openAlert = function(title, text) {
		    $mdDialog.show(
		      $mdDialog.alert()
		        .clickOutsideToClose(false)
		        .title(title)
		        .textContent(text)
		        .ariaLabel('warning alert')
		        .ok('Ok')
		    );
		  };
	    vm.saveNewProfile = function() {
	    	if ($scope.user.firstname !== undefined && $scope.user.lastname !== undefined 
	    		&& $scope.user.gender !== undefined && $scope.user.birthDate !== undefined
	    		&& $scope.user.country !== undefined && $scope.user.city !== undefined
	    		&& $scope.user.mobile !== undefined) {

	    		var d = new Date($scope.user.birthDate);
       			$scope.user.birthDate =$filter('date')(d, "MM/dd/yyyy");
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
	    	} else {
	    		$scope.openAlert('Warning', 'You can not save yet!! Please fill out all the fields of this form!');
	    	}

	    };


	}
})();