/*
 * NG_Slider

 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */
 
var config = {
    map: {
        '*': {
            'ngslider': 'NG_Slider/js/ng-slider.min',
        },
    },
    paths: {
        'ngslider': 'NG_Slider/js/ng-slider.min',
    },
    shim: {
        'ngslider': {
            deps: ['jquery']
        }
    }
};