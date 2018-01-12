(function(){
	'use strict';

	angular.module('ProfilesManaging')
	       .controller('ProfileCtrl', function ($scope, $uibModalInstance, user) {
	        	$scope.user = user;
	        })

		   .controller('ProfilesController', ProfilesController);

	function ProfilesController($scope, $http, $uibModal) {

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
	    
	}
})();