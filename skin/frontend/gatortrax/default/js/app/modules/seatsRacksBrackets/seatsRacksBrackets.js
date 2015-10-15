'use strict';

angular.module('wizard.seatsRacksBrackets', ['ui.router'])

    .config(['$stateProvider', function($stateProvider)
    {
        $stateProvider.state("seatsRacksBrackets",
            {
                url: "/seatsRacksBrackets",
                controller: 'SeatsCtrl',
                views:
                {
                    'seatsRacksBrackets@':
                    {
                        templateUrl: 'skin/frontend/gatortrax/default/js/app/modules/seatsRacksBrackets/seatsRacksBrackets.html'
                    }
                }
            });
    }])
    .controller('SeatsCtrl', ['$rootScope','$scope', '$http', function($rootScope, $scope, $http)
    {
        $scope.data = {};
        $scope.seatsRacksAndBrackets = [];

        $http.get(Config.ajaxDefaultPath + 'boatbuilder/ajax/boatseats')
            .success(function(data, status, headers)
            {
                $scope.data = data;
                $scope.seatsRacksAndBrackets = data;
            })
            .error(function(data, status, headers, config)
            {
                console.log("Error loading seats racks and brackets.");
            });
    }]);