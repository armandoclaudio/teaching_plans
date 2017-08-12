/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 165);
/******/ })
/************************************************************************/
/******/ ({

/***/ 165:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(166);


/***/ }),

/***/ 166:
/***/ (function(module, exports) {

window.onload = function () {
    new Vue({
        el: '#standards-form',

        data: {
            id: 0,
            description: '',
            newExpectation: '',
            expectations: [],
            errors: {}
        },

        mounted: function mounted() {
            var a = this.$el.action.split('/');
            if (!isNaN(a[a.length - 1])) {
                this.id = a[a.length - 1] * 1;

                this.getData();
            }
        },


        methods: {
            getData: function getData() {
                var _this = this;

                axios.get('/standards/' + this.id + '/get').then(function (response) {
                    _this.description = response.data.description;
                    _this.expectations = response.data.expectations.map(function (e) {
                        return e.description;
                    });
                }).catch(function (error) {
                    console.log(error.response);
                });
            },
            addExpectation: function addExpectation() {
                this.expectations.push('');
            },
            submitForm: function submitForm() {
                var _this2 = this;

                axios.post(this.$el.action, this.$data).then(function (response) {
                    if (response.data.success) location.href = '/standards';
                }).catch(function (error) {
                    return _this2.errors = error.response.data;
                });
            },
            hasError: function hasError(field) {
                return this.errors.hasOwnProperty(field);
            },
            getError: function getError(field) {
                return this.errors[field][0];
            },
            clearError: function clearError(field) {

                if (this.errors.hasOwnProperty(field)) {
                    delete this.errors[field];
                }
            }
        }
    });
};

/***/ })

/******/ });