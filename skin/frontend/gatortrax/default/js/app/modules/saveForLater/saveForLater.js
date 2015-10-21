'use strict';

angular.module('wizard.saveForLater', ['ui.router'])

.controller('ButtonCtrl', ['$rootScope', '$scope', '$http', function($rootScope, $scope, $http){

        $scope.saveForLater = function()
        {
            $http.get(Config.ajaxDefaultPath + 'boatbuilder/ajax/save')
            .success(function(data, status, headers){
                $scope.message = data;
                console.log("Boat profile has been successfully saved!");
            })
            .error(function(data, status, headers, config){
                console.log("There was an error saving your boat build, please try again later")
            });
        };

        $scope.submitForQuote = function()
        {
            console.log($scope.submitMessage);
        };

    }]);
