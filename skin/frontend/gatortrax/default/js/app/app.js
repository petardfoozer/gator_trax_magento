'use strict';


var app = angular.module('wizard', 
[
    'ui.router',
    'ui.bootstrap',
    'wizard.controllers',
    'wizard.scoreboard',
    'wizard.boatModel',
    'wizard.hullSize',
    'wizard.motor',
    'wizard.interior',
    'wizard.deck',
    'wizard.look',
    'wizard.electrical',
    'wizard.flooring',
    'wizard.fuelTank',
    'wizard.accessories',
    'wizard.trailer',
    'wizard.seatsRacksBrackets'
])
.run(
  [          '$rootScope', '$state', '$stateParams',
    function ($rootScope,   $state,   $stateParams) 
    {    
        $rootScope.$state = $state;
        $rootScope.$stateParams = $stateParams;
    }
  ]
)

.config([    
             '$stateProvider', '$urlRouterProvider',
    function ($stateProvider,   $urlRouterProvider) 
    {
        $stateProvider
        .state("home", 
        {
            url: "/",
            template: "Welcome to our boat builder.",
            controller: 'BuilderCtrl'
        });
        
        $urlRouterProvider.otherwise('');
    }]
)

.filter('getByAttribute', function() {
    return function(input, attribute, value) 
    {
        var cnt = input.length;
        
        for (var i=0; i<cnt; i++) 
        {
            if (input[i][attribute] === value) 
            {
                return input[i];
            }
        }
        return null;
    };
})

.filter('removeByAttribute', function() {
    return function(input, attribute, value) 
    {
        var cnt = input.length;
        
        for (var i=0; i<cnt; i++) 
        {
            if (input[i][attribute] === value) 
            {
                return input.splice(i, 1);
            }
        }
        return input;
    };
})

.filter('removeFromArray', function() {
    return function(input, target) 
    {
        var index = input.indexOf(target);
        return (index > -1) ? input.splice(index, 1) : [];
    };
})

.filter('active', function() 
{
    return function(item) 
    {
        console.log(item);
        return Boolean(item.active) === false ? null : item;
    };
});
