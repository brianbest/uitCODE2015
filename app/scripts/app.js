
(function() {
  var article = {
    name: 'Carol',
    description: "Some gems have hidden qualities beyond their luster, beyond their shine... Azurite is one of those gems.",
    vote: 8
  };
  var app = angular.module('home', []);
  app.controller('HomeController', function () {
    this.post = article;

  });


})();
