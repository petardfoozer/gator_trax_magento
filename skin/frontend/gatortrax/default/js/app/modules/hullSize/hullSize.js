'use strict';

angular.module('wizard.hullSize', ['ui.router'])

.config(['$stateProvider', function($stateProvider) {
    $stateProvider.state("hullSize", 
    {
        url: "/hullSize",
        controller: 'HullSizelCtrl',
        views: 
        {
            'hullSize@': 
            {
                templateUrl: 'skin/frontend/gatortrax/default/js/app/modules/hullSize/hullSize.html'
            }
        }
    });
}])

.controller('HullSizeCtrl', ['$rootScope','$scope', '$http', '$filter', function($rootScope, $scope, $http, $filter)  
{
    $scope.formData         = [];
    $scope.tabs             = [];
    $scope.targetFields     = [{name:'Side'}];
    $scope.fieldAssociates  = [{name:'Side',associate:'Transom'}];
    $scope.bottoms          = {};
    $scope.rake             = {};
    $scope.thickness        = {};
    $scope.huntdeck         = {};
    $scope.transom          = {};

            // Let's get the hull data
    $http.get(Config.ajaxDefaultPath + 'boatbuilder/ajax/boathull')
    .success(function(data, status, headers)
    {
        $scope.bottoms      = data.bottoms;
        $scope.rake         = data.rake;
        $scope.thickness    = data.thickness;
        $scope.huntdeck     = data.huntdeck;
        
        $scope.bottoms.values.forEach(function(elt)
        {
            var item = 
            { 
                title: elt.name, 
                value: elt.value,
                attributes: elt.attributes
            };
                    // dynamically creating properties to support unknown attributes
            $scope.targetFields.forEach(function(target)
            {
                item[target.name.toLowerCase()] = $filter('getByAttribute')(elt.attributes, 'name', target.name);
            });
            
            $scope.tabs.push(item);
        });
        
        $rootScope.Scoreboard.ProcesstRules([
                            $scope.bottoms, 
                            $scope.rake, 
                            $scope.thickness, 
                            $scope.huntdeck, 
                            $scope.transom], $scope.section);
        $scope.bottoms.selected = $scope.tabs[0];
    })
    .error(function(data, status, headers, config) {
        console.log("Error loading hull data");
    });
    
    
    /**
     * 
     * @param {object} tab | UI Tab object
     * @param {object} e
     * @returns {void}
     */
    $scope.SaveTab = function(tab, e)
    {
        if(tab !== null)
        {
            $scope.bottoms.selected = tab;
        }
        
        $scope.bottoms.selected.thickness   = $scope.thickness.selected;
        $scope.bottoms.selected.huntdeck    = $scope.huntdeck.selected;
        $scope.bottoms.selected.rake        = $scope.rake.selected;
        $scope.bottoms.selected.type        = 'hull';
        
        $rootScope.Save($scope.bottoms.selected, $scope.section, e);
    };
    
    $scope.ValidateReadinessToSave = function()
    {
        return true;
        //return ($scope.bottoms.selected.thickness   === undefined ||
        //        $scope.bottoms.selected.huntdeck    === undefined ||
        //        $scope.bottoms.selected.rake        === undefined)? false : true;
    };
    
    /**
     * 
     * @param {object} tab | UI Tab object
     * @param {object} e
     * @returns {void}
     */
    $scope.SaveTabAndNext = function(tab, e)
    {
        if($scope.ValidateReadinessToSave() === false)
        {
            alert('Some data is missing.');
        }
        else
        {
            $scope.SaveTab(tab, e);
            $scope.section.LoadNext(); 
        }
    };
}]);