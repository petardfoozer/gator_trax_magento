'use strict';

angular.module('wizard.boatModel', ['ui.router'])

.config(['$stateProvider', function($stateProvider) 
{
    $stateProvider.state("boatModel", 
    {
      url: "/boatModel",
      controller: 'BoatModelCtrl',
      views: 
        {
            'boatModel@': 
            {
                templateUrl: 'skin/frontend/gatortrax/default/js/app/modules/boatModel/boatModel.html'
            }
        }
    });
}])

.controller('BoatModelCtrl', ['$rootScope','$scope', '$http', function($rootScope, $scope, $http) 
{
    $scope.boats = [];
    $http.get(Config.ajaxDefaultPath + 'boatbuilder/ajax/boatmodels')
    .success(function(data, status, headers)
    {
        for (var i=0; i < data.length; i++)
        {
            data[i].image = Config.prodThumImgPath + data[i].image;
        }
        console.log(data);
        
        $scope.boats = data;
    })
    .error(function(data, status, headers, config) 
    {
        console.log("Error loading boat models");
    });
}]);