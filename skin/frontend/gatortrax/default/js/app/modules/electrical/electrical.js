'use strict';

angular.module('wizard.electrical', ['ui.router'])

.config(['$stateProvider', function($stateProvider)
{
    $stateProvider.state("electrical",
    {
        url: "/electrical",
        controller: 'ElectricalCtrl',
        views:
            {
                'electrical@':
                {
                    templateUrl: 'skin/frontend/gatortrax/default/js/app/modules/electrical/electrical.html'
                }
            }
    });
}])

.controller('ElectricalCtrl', ['$rootScope', '$scope', '$http', function($rootScope, $scope, $http)
{
    $scope.electrical   = [];

    $http.get(Config.ajaxDefaultPath + 'boatbuilder/ajax/boatelectical')
    .success(function(data, status, headers)
    {
        $scope.electrical = data;
    })
    .error(function(data, status, headers, config)
    {
        console.log("Error loading electrical options")
    });
}]);