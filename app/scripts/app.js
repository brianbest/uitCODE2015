'use strict';

/**
 * @ngdoc overview
 * @name uitCode2015App
 * @description
 * # uitCode2015App
 *
 * Main module of the application.
 */
angular
  .module('uitCode2015App', [
    'ngRoute'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  })
