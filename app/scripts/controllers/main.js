
(function() {
  var app = angular.module('uitCode2015App', [ 'ngRoute' ]);

  app.config(['$routeProvider', function($routeProvider){
    $routeProvider.
        when('/', {
            templateUrl: 'views/main.html',
            controller: 'MainController'
          })
          .otherwise({
            redirectTo: '/'
          });

  }]);
  //app.controller('PostController', function() {
  //  var post = this;
    //post.articles = [];
    //$http.get('../ajax/getPosts.php').success(function (data) {
    //  post.articles = data;
  //});
  //}]);

  //angular.module('uitCode2015App', ['angular', 'uitCode2015App.controllers'])
  //  .config(function ($routeProvider) {
  //    $routeProvider
  //      .when('/', {
  //        templateUrl: 'views/main.html',
  //        controller: 'uitCOCtrl'
  //      })
  //      .otherwise({
  //        redirectTo: '/'
  //      });
  //  });
})();

//.controller('uitCode2015App.loginCtrl', function ($scope,$http) {
  // var isLoggedIn = function() {
  //   $http.get('/u.php?username=' + $scope.username)
  //     .success(function (data) {
  //       $scope.user = data;
  //       return data
  //     })
  //     .error(function (err) {
  //       $scope.err = err;
  //       return new Error('Content-Type header invalid');
  //     })
  // };
  //   //.controller('PostController', function(){
  //   //  this.post={};
  //   //  this.addPost=function(article){
  //   //    alert("helloworld");
  //   //    article.posts.push(this.post);
  //   //  }
  //   //});
  //
  //});
  //
  //
  //
