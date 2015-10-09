'use strict';

angular.module('wizard.deck', ['ui.router'])

.config(['$stateProvider', function($stateProvider)
{
    $stateProvider.state("deck",
    {
      url: "/deck",
      controller: 'DeckCtrl',
      views:
        {
            'deck@':
            {
                templateUrl: 'skin/frontend/gatortrax/default/js/app/modules/deck/deck.html'
            }
        }
    });
}])

.controller('DeckCtrl', ['$rootScope', '$scope', '$http', function($rootScope, $scope, $http)
{
    $scope.deck_style    = {};

    $http.get(Config.defaultPath + 'mock/getDeckData.php')
    .success(function(data, status, headers)
    {
        $scope.deck_style = data;
        $rootScope.Scoreboard.ProcesstRules([$scope.deck_style], $scope.section);

    })
    .error(function(data, status, headers, config)
    {
        console.log("Error loading decks models")
    });

}]);