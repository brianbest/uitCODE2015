'use strict';

/**
 * @ngdoc function
 * @name uitCode2015App.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the uitCode2015App
 */
angular.module('uitCode2015App.controllers', [])
  .controller('uitCode2015App.loginCtrl', function ($scope,$http) {
   var isLoggedIn = function() {
     $http.get('/u.php?username=' + $scope.username)
       .success(function (data) {
         $scope.user = data;
         return data
       })
       .error(function (err) {
         $scope.err = err;
         return new Error('Content-Type header invalid');
       })
   }
     .controller('PostController', function(){
       this.post={};
       this.addPost=function(article){
         alert("helloworld")
         article.posts.push(this.post);
       }
     });

  })



