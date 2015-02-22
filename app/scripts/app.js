
(function() {

  var app = angular.module('home', []);

  app.controller('HomeController', function ($scope, $http) {
    //this.posts = articles;
    $http.get('/project1/ajax/getPosts.php?amount=100').success(function (data, status) {
      $scope.posts = data;
      console.log(data);
      console.log(data[0].post_id);
      return status;
    });
  });



  app.controller('PostController', ['$scope', '$http', function($scope, $http) {
    this.newPost={};
    console.log("loading with page");

    this.addPost=function() {
      console.log("called on click");
      var content = $('#article-content').val();
      //product.newPosts.push(this.newPost);
      //this.newPost = {};
      $http.post('/project1/ajax/post.php',{content: content}).success(function(data,status){
        console.log("this is after post submit!");
      })
    };
  }]);

  //  $scope.url="/project1/ajax/post.php";
  //  alert('ajax is happening!');
  //  $scope.posts= function(json){
  //    $http.post($scope.url, {'content': $scope.post.body}).success(function(data, status){
  //      $scope.json.status= status;
  //      $scope.json.data=  data;
  //      $scope.json.result= data;
  //    })
  //  };
  //});
  //
  //  http://localhost:8888/project1/ajax/getPosts.php
  //
  //
  //  this.posts = {};
  //  this.addPost = function(post){
  //    console.log('articles', post);
  //    articles.push({name:'Carol', description: post.body, vote:9});
  //
  //    //this.post={}
  //  }

  //});

  app.controller('TabController', function(){
    this.tab=1;
    this.setTab = function(newValue){
      this.tab=newValue;
    };
    this.isSet=function(tabName){
      return this.tab === tabName;
    };
  });

  //app.controller('NewPostController', function(){
  //  this.newPost={};
  //  this.addPost=function(product){
  //    product.newPosts.push(this.newPost);
  //    this.newPost={};
  //  };
  //});


  //var articles = [{
  //  name: 'Carol',
  //  description: "http://www.keyboardninja.eu/webdevelopment/a-simple-search-with-angularjs-and-php",
  //  vote: 8
  //},
  //  {
  //    name: 'Lawrence',
  //    description: "http://stackoverflow.com/questions/21673404/error-ngareq-from-angular-controller",
  //    vote: 19
  //  },
  //  {
  //    name: 'Matt',
  //    description: "alskdjfa;lsd",
  //    vote:9

  //newPosts[{
  //  name: 'Dianna',
  //  Description: 'aosdfalskdjf',
  //  vote: 15
  //}, {
  //  name:Pat,
  //  Description: 'alskdjf',
  //  vote: 15
  //
  //}];


})();


////alert('ajax is happening!');
//$http.get('/project1/ajax/getPosts.php').success(function(data, status){
//  //alert('ajax is giving us a callback!! ');
//
//  $scope.posts= data;
//  console.log(data);
//  console.log(data[0].post_id);
//  return status;
//})
//
//var req= {
//  url: '/project1/ajax/getPosts.php',
//  method: 'GET',
//
//  headers:{
//    'Content-Type': 'application/json'
//  },
//  data: {test: 'test'}
//}
//
//$http(req).success(function (data, status) {
//  alert('ajax is giving us a callback!! ');
//
//  $scope.posts = data;
//  console.log(data);
//  console.log(data[0].post_id);
//  return status;
//});
