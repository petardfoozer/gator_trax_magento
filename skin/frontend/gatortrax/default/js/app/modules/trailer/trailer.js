'use strict';

angular.module('wizard.trailer', ['ui.router'])

    .config(['$stateProvider', function($stateProvider)
    {
        $stateProvider.state("trailer",
            {
                url: "/trailer",
                controller: 'TrailerCtrl',
                views:
                {
                    'trailer@':
                    {
                        templateUrl: 'skin/frontend/gatortrax/default/js/app/modules/trailer/trailer.html'
                    }
                }
            });
    }])

    .controller('TrailerCtrl', ['$rootScope', '$scope', '$http', function($rootScope, $scope, $http)
    {
        $scope.trailer = {};

        $http.get(Config.defaultPath + 'mock/getTrailerData.php')
            .success(function(data, status, headers)
            {
                $scope.trailer = data;
            })
            .error(function(data, status, headers, config)
            {
                console.log("Error loading boat colors");
            });
    }]);