'use strict';

angular.module('wizard.controllers',[])
.controller('BuilderCtrl', ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope) 
{
    $rootScope.currentSection;
    $scope.sections = [];
    
    $http.get(Config.defaultPath + 'mock/getSections.php') 
    .success(function(data, status, headers)
    {
        var cnt = data.length - 1;
        
        for(var i=0; i<cnt; i++)
        {
            data[i].next = data[i+1];
            
            /**
             * @param {object} e
             * @returns {void}
             */
            data[i].LoadNext = function(e)
            {
                if(e !== undefined)
                {
                    e.stopPropagation();
                }
                
                $rootScope.LoadNextSection(this.next);
            };
            
            /**
             * @param {object} item optionValue
             * @param {object} e
             * @returns {void}
             */
            data[i].SaveAndNext = function(item, e)
            {
                if(e !== undefined)
                {
                    e.stopPropagation();
                }

                        // if section 
                $rootScope.Scoreboard.Update(this.route, item);
                this.LoadNext();
            };
        }
        
        $scope.sections = data;
        $rootScope.currentSection = $scope.sections[0];
        $rootScope.InitLoadSection($rootScope.currentSection);
    })
    .error(function(data, status, headers, config) 
    {
        console.log("Error loading sections");
    });

    $scope.oneAtATime = true;

    $scope.status = 
    {
        isFirstOpen: true,
        isFirstDisabled: false
    };
    
    // RuleEngine
    $scope.processElementRule = function()
    {
        
    };
    
    $scope.SelectElt = function(elt)
    {
//        $scoreBoard.hull.selectedElts.push(elt);
    };
    
    $rootScope.LoadSection = function(section)
    {
        var page = (section !== undefined)? section : $rootScope.currentSection; 
        $rootScope.$state.go(page.route);
        $rootScope.currentSection = page;
    };
    
    $rootScope.CollapseAccordion = function(section)
    {
        section.open =! section.open;
    };
    
    $rootScope.LoadNextSection = function(section) 
    {
        $rootScope.LoadSection(section);
        $rootScope.CollapseAccordion(section);
    };
    
    $rootScope.InitLoadSection = function(section)
    {
        $rootScope.CollapseAccordion(section);
        $rootScope.LoadSection(section);
    };
    
    $rootScope.Save = function(item, section, e)
    {
        if(e !== undefined)
        {
            e.stopPropagation();
        }
        
        $rootScope.Scoreboard.Update(section.route, item);
    };
}]);