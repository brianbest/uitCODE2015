
(function() {

  var app = angular.module('home', []);

  app.controller('HomeController', function () {
    this.posts = articles;

  });

  app.controller('PostController', function(){
    this.posts = {};
    this.addPost = function(post){
      console.log('articles', post);
      articles.push({name:'Carol', description: post.body, vote:9});

      //this.post={}
    }

  });

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


  var articles = [{
    name: 'Carol',
    description: "http://www.keyboardninja.eu/webdevelopment/a-simple-search-with-angularjs-and-php",
    vote: 8
  },
    {
      name: 'Lawrence',
      description: "http://stackoverflow.com/questions/21673404/error-ngareq-from-angular-controller",
      vote: 19
    },
    {
      name: 'Matt',
      description: "alskdjfa;lsd",
      vote:9

  //newPosts[{
  //  name: 'Dianna',
  //  Description: 'aosdfalskdjf',
  //  vote: 15
  //}, {
  //  name:Pat,
  //  Description: 'alskdjf',
  //  vote: 15
  //
  }];


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
