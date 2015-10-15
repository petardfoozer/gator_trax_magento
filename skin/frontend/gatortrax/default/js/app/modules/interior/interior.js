'use strict';

angular.module('wizard.interior', ['ui.router'])

.config(['$stateProvider', function($stateProvider) 
{
    $stateProvider.state("interior", 
    {
      url: "/interior",
      controller: 'InteriorCtrl',
      views: 
        {
            'interior@': 
            {
                templateUrl: 'skin/frontend/gatortrax/default/js/app/modules/interior/interior.html'
            }
        }
    });
}])
.controller('InteriorCtrl', ['$rootScope','$scope', '$http', function($rootScope, $scope, $http) 
{
    $scope.data = {};
    $scope.positions = [];
    $scope.interior = [];
    $scope.accessories = [];
    
    $http.get(Config.defaultPath + 'mock/getInteriorData.php') 
    .success(function(data, status, headers)
    {
        $scope.data = data;
        $scope.interior = data;
        $scope.positions = data.positions;
    })
    .error(function(data, status, headers, config) 
    {
        console.log("Error loading interior.");
    });
}]);