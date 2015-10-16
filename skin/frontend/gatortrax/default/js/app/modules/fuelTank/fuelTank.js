'use strict';

angular.module('wizard.fuelTank', ['ui.router'])

    .config(['$stateProvider', function($stateProvider)
    {
        $stateProvider.state("fuelTank",
            {
                url: "/fuelTank",
                controller: 'FuelTankCtrl',
                views:
                {
                    'fuelTank@':
                    {
                        templateUrl: 'skin/frontend/gatortrax/default/js/app/modules/fuelTank/fuelTank.html'
                    }
                }
            });
    }])

    .controller('FuelTankCtrl', ['$rootScope', '$scope', '$http', function($rootScope, $scope, $http)
    {
        $scope.fuelTank    = [];

        $http.get(Config.ajaxDefaultPath + 'boatbuilder/ajax/boatfuel')
            .success(function(data, status, headers)
            {
                console.log(data);
                $scope.fuelTank = data;

            })
            .error(function(data, status, headers, config)
            {
                console.log("Error loading Fuel Tank models")
            });
    }]);