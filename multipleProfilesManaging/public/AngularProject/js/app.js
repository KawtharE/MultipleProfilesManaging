(function(){
	'use strict';

	angular.module('ProfilesManaging', [
			'ui.router', 
			'ngMaterial', 
			'ngMessages', 
			'smart-table', 
			'ui.bootstrap'
			])

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
})();
