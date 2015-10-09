describe('Unit: BuilderCtrl', function(){
    beforeEach(module('wizard.controllers'));
    var ctrl, scope;

    beforeEach(inject(function($controller, $rootScope){
        scope = $rootScope.$new();
        ctrl = $controller('BuilderCtrl', {
            $scope: scope
        });
    }));
    it('should return true for oneAtATime scope ',
        function(){
            expect(scope.oneAtATime).toEqual(true);
        });
    it('should return true for status.isFirstOpen',
        function(){
            expect(scope.status.isFirstOpen).toEqual(true);
        });
    it('should return false for status.isFirstDisabled',
        function(){
            expect(scope.status.isFirstDisabled).toEqual(false);
        });
})

describe('Unit: BoatModelCtrl', function(){
    beforeEach(module('wizard.boatModel'));
    var ctrl, scope;

    beforeEach(inject(function($controller, $rootScope){
        scope = $rootScope.$new();
        ctrl = $controller('BoatModelCtrl', {
            $scope: scope
        });
    }));
    it('should be an undefined function ',
        function(){
            expect().toEqual(null);
        });
})

describe('Unit: HullSizelCtrl', function(){
    beforeEach(module('wizard.hullSize'));
    var ctrl, scope;

    beforeEach(inject(function($controller, $rootScope){
        scope = $rootScope.$new();
        ctrl = $controller('HullSizeCtrl', {
            $scope: scope
        });
    }));
    it('should be an undefined function ',
        function(){
            expect().toEqual(null);
        });
})

describe('Unit: ButtonCtrl', function(){
    beforeEach(module('wizard.saveForLater'));
    var ctrl, scope;

    beforeEach(inject(function($controller, $rootScope){
        scope = $rootScope.$new();
        ctrl = $controller('ButtonCtrl', {
            $scope: scope
        });
    }));
    it('should be an undefined function ',
        function(){
            expect().toEqual(null);
        });
})

describe('Unit: FormCtrl', function(){
    beforeEach(module('wizard.controllers'));
    var ctrl, scope;

    beforeEach(inject(function($controller, $rootScope){
        scope = $rootScope.new();
        ctrl = $controller('FormCtrl', {
            $scope: scope
        });
    }));
    it('should contain boat model mock data ',
        function(){
            expect().toEqaul(null);
        });
})
