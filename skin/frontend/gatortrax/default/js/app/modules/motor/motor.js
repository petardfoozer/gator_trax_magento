'use strict';

angular.module('wizard.motor', ['ui.router'])

.config(['$stateProvider', function($stateProvider) 
{
    $stateProvider.state("motor", 
    {
      url: "/motor",
      controller: 'MotorCtrl',
      views: 
        {
            'motor@': 
            {
                templateUrl: 'skin/frontend/gatortrax/default/js/app/modules/motor/motor.html'
            }
        }
    });
}])

.controller('MotorCtrl', ['$rootScope', '$scope', '$http', function($rootScope, $scope, $http) 
{
    $scope.motorData = {};
    $scope.motors = [];
    $scope.steering = {};
    
    
    $http.get(Config.ajaxDefaultPath + 'boatbuilder/ajax/boatmotor')
    .success(function(data, status, headers)
    {
        $scope.motorData = data;
        $rootScope.Scoreboard.ProcesstRules([$scope.motorData], $scope.section);
    })
    .error(function(data, status, headers, config) 
    {
        console.log("Error loading motor types");
    });
    
    
    $scope.LoadMotors = function()
    {
        var target = $scope.motorData.motors.list.id - 1;
        $scope.motors = $scope.motorData.motors.types[target];
    };
    
    
    $scope.SaveAndNext = function(e)
    {
        var data = {};
        
        data.motor      = $scope.motorData.motors.selected;
        data.steering   = $scope.motorData.steering.selected;
        data.type       = $scope.section.route;
        
        $rootScope.Save(data, $scope.section, e);
        $scope.section.LoadNext();
    };
}]);