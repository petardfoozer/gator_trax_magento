'use strict';

angular.module('wizard.look', ['ui.router'])

.config(['$stateProvider', function($stateProvider)
{
    $stateProvider.state("look",
    {
       url: "/look",
       controller: 'LookCtrl',
       views:
       {
           'look@':
           {
               templateUrl: 'skin/frontend/gatortrax/default/js/app/modules/look/look.html'
           }
       }
    });
}])

.controller('LookCtrl', ['$rootScope', '$scope', '$http', function($rootScope, $scope, $http)
{
    $scope.looks = {};

    $http.get(Config.ajaxDefaultPath + 'boatbuilder/ajax/boatlook')
    .success(function(data, status, headers)
    {
        $scope.looks = data;
    })
    .error(function(data, status, headers, config)
    {
        console.log("Error loading boat colors");
    });
}]);