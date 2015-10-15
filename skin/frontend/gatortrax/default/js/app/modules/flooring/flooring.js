'use strict';

angular.module('wizard.flooring', ['ui.router'])

.config(['$stateProvider', function($stateProvider)
{
    $stateProvider.state("flooring",
    {
        url: "/flooring",
        controller: 'FlooringCtrl',
        views:
            {
                'flooring@':
                {
                    templateUrl: 'skin/frontend/gatortrax/default/js/app/modules/flooring/flooring.html'
                }
            }
    });
}])

.controller('FlooringCtrl', ['$rootScope', '$scope', '$http', function($rootScope, $scope, $http)
{
    $scope.flooring     = [];

    $http.get(Config.defaultPath + 'mock/getFlooringData.php')
    .success(function(data, status, headers)
    {
        $scope.flooring = data;
    })
    .error(function(data, status, headers, config)
    {
        console.log("Error loading flooring models")
    });
}]);