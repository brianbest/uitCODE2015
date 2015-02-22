
(function() {

  var app = angular.module('home', []);

  app.controller('HomeController', function () {
    this.posts = {};
    this.addPost = function(articles){
      articles.posts.push(this.post);
      this.post={}
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
    description: "Some gems have hidden qualities beyond their luster, beyond their shine... Azurite is one of those gems.",
    vote: 8
  },
    {
      name: 'Lawrence',
      description: "Some gems have hidden qualities beyond their luster, beyond their shine... Azurite is one of those gems.",
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
