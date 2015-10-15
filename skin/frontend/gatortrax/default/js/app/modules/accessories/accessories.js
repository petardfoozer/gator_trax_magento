'use strict';

angular.module('wizard.accessories', ['ui.router'])

.config(['$stateProvider', function($stateProvider)
{
    $stateProvider.state("accessories",
    {
        url: "/accessories",
        controller: 'AccessoriesCtrl',
        views:
        {
            'accessories@':
            {
                templateUrl: 'skin/frontend/gatortrax/default/js/app/modules/accessories/accessories.html'
            }
        }
    });
}])

.controller('AccessoriesCtrl', ['$rootScope', '$scope', '$http', function($rootScope, $scope, $http)
{
    $scope.accessories  = [];
    $scope.product_options = [];

    $http.get(Config.ajaxDefaultPath + 'boatbuilder/ajax/boataccessories')
    .success(function(data, status, headers)
    {
        $scope.accessories = data;
        angular.forEach($scope.accessories.products, function(product){
            angular.forEach(product.product_options, function(product_option){
                $scope.product_options.push(product_option);
            })
        })
    })
    .error(function(data, status, headers, config)
    {
        console.log("Error loading accessories model")
    });
}]);