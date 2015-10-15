'use strict';

//angular.module('wizard.saveForLater',[])
    app.controller('ButtonCtrl', ['$scope', function($scope){
        $scope.greeting = "This configuration has been saved to be reviewed at a later time!";
        $scope.submitMessage = "This configuration has been submitted for a quote!";
        $scope.saveForLater = function()
        {
            console.log($scope.greeting);
        }
        $scope.submitForQuote = function()
        {
            console.log($scope.submitMessage);
        }
        $scope.advanceToNext = function()
        {

        }
    }]);
