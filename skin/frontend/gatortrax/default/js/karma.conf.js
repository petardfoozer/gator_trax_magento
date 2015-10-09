module.exports = function(config){
  config.set({

    basePath : './',

    frameworks: ['jasmine'],

    files : [
      'bower_components/angular/angular.js',
      'bower_components/angular-mocks/angular-mocks.js',
      'bower_components/angular-ui-router/release/angular-ui-router.js',
      'app/modules/boatModel/boatModel.js',
      'app/modules/hullSize/hullSize.js',
      'app/modules/saveForLater/saveForLater.js',
      'app/js/controllers.js',
      'karma_tests/spec/controllers/main.js'

    ],

    exclude: [],

    autoWatch : true,

    browsers : ['Chrome'],

    plugins : [
            'karma-chrome-launcher',
            'karma-firefox-launcher',
            'karma-jasmine',
            'karma-junit-reporter'
            ],

    junitReporter : {
      outputFile: 'test_out/unit.xml',
      suite: 'unit'
    }

  });
};
