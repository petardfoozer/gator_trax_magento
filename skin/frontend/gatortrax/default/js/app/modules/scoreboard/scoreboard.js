'use strict';

angular.module('wizard.scoreboard', ['ui.router'])

.controller('ScoreboardCtrl', ['$rootScope','$scope',  function($rootScope, $scope) 
{   
    $rootScope.Scoreboard = 
    {
        boatModel: {
            route: 'boatModel',
            activeRules: [],
            selectedElts: []
        },
        hullSize: {
            route: 'hullSize',
            activeRules: [],
            selectedElts: []
        },
        motor: {
            route: 'motor',
            activeRules: [],
            selectedElts: []
        },
        interior: {
            route: 'interior',
            activeRules: [],
            selectedElts: []
        },
        deck: {
            route: 'deck',
            activeRules: [],
            selectedElts: []
        },
        electrical: {
            route: 'electrical',
            activeRules: [],
            selectedElts: []
        },
        flooring: {
            route: 'flooring',
            activeRules: [],
            selectedElts: []
        },
        look: {
            route: 'look',
            activeRules: [],
            selectedElts: []
        },
        fuelTank: {
            route: 'fuelTank',
            activeRules: [],
            selectedElts: []
        },
        trailer: {
            route: 'trailer',
            activeRules: [],
            selectedElts: []
        },
        seatsRacksBrackets: {
            route: 'seatsRacksBrackets',
            activeRules: [],
            selectedElts: []
        },
        accessories: {
            route: 'accessories',
            activeRules: [],
            selectedElts: []
        },

        Update: function(section, model)
        {   
            if(model.type !== undefined)
            {
                this.RemoveModel(this[section].selectedElts, 'type', model);
                this[section].selectedElts.push(model);
            }
            else
            {
                console.log("Error, the model does not contain a 'type' property.");
            }
        },

        RemoveModel: function(input, attribute, model) 
        {
            var cnt = input.length;

            for (var i = 0; i < cnt; i++) 
            {
                if (input[i][attribute] === model.type) 
                {
                    input.splice(i, 1);
                }
            }
        },

        /**
         * Validate all rules, switch result to false if a false statement is present
         * @param {Object} rules
         * @param {Object} section
         * @returns {Boolean}
         */
        ApplyRules: function(rules)
        {   
            var result  = [];
            var cnt     = rules.collection.length;
            
            for(var i = 0; i < cnt; i++)
            {
                var rule = rules.collection[i];
                
                if(rules.operator !== undefined)
                {
                    var selectedElts = this[rule.section].selectedElts;
                    var seCnt  = selectedElts.length;
                    
                    if(seCnt > 0)
                    {
                        for(var j = 0; j < seCnt; j++)
                        {
                                    // we have a match
                            if(rules.operator === "has")
                            {
                                if(selectedElts[j].type.toLowerCase() === rule.type.toLowerCase() && selectedElts[j].id == rule.value)
                                {
                                    result.push(true);
                                }
                                else
                                {
                                    result.push(false);
                                }
                            }
                            
                            if(rules.operator === "has_not")
                            {
                                if(selectedElts[j].type.toLowerCase() === rule.type.toLowerCase() && selectedElts[j].id == rule.value)
                                {
                                    result.push(false);
                                }
                            }
                        }
                    }
                }
            }
            
            return (result.indexOf(false) === -1)? true : false;
        },
        
        /**
         * 
         * @param {Array} elts
         * @param {Object} section
         * @returns {Void}
         */
        ProcesstRules: function(elts, section)
        {
            var cnt = elts.length;

            for(var i = 0; i < cnt; i++)
            {
                        // first of all, do we have values or attributes
                if(elts[i].values !== undefined && elts[i].values.length > 0)
                {
                    var values   = elts[i].values;
                    var valueCnt = values.length;

                    for(var j = 0; j < valueCnt; j++)
                    {
                                // do our values have rules?
                        if(values[j].rules !== undefined && values[j].rules.length > 0)
                        {
                            var ruleCnt = values[j].rules.length;
                            
                            for(var k = 0; k < ruleCnt; k++)
                            {
                                values[j].active = this.ApplyRules(values[j].rules[k]);
                            }
                        }
                    }
                }

                else if(elts[i].attributes !== undefined && elts[i].attributes.length > 0)
                {
                    this.ProcesstRules(elts[i].attributes, section);
                }
            }
        }
    };
}]);