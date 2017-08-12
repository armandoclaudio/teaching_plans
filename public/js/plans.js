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
/******/ 	return __webpack_require__(__webpack_require__.s = 163);
/******/ })
/************************************************************************/
/******/ ({

/***/ 163:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(164);


/***/ }),

/***/ 164:
/***/ (function(module, exports) {

window.onload = function () {
    new Vue({
        el: '#plans-form',

        data: {
            id: 0,
            title: '',
            grade: '',
            date_from: '',
            date_to: '',
            daily_plan: [],
            available_standards: [],
            standards: [],
            selecting_standards: [],
            expectations: [],
            selecting_expectations: [],
            essential_questions: [],
            objectives: [],
            activities: [],
            evaluations: [],
            observations: '',
            is_standard_modal_open: false,
            errors: {}
        },

        mounted: function mounted() {
            var _this = this;

            this.getPlanId();

            this.calculateDates();

            axios.get('/standards/all').then(function (response) {
                _this.available_standards = response.data;
            }).catch(function (error) {
                return console.log(error);
            });

            this.startAutomaticSaves();
        },


        watch: {
            date_from: function date_from() {
                this.calculateDates();
            },
            date_to: function date_to() {
                this.calculateDates();
            }
        },

        methods: {
            getPlanId: function getPlanId() {
                var url = this.$el.action.split('/');
                if (!isNaN(url[url.length - 1])) {
                    this.id = url[url.length - 1] * 1;

                    this.getData();
                }
            },
            getData: function getData() {
                var _this2 = this;

                axios.get('/plans/' + this.id + '/get').then(function (response) {
                    _this2.title = response.data.title;
                    _this2.grade = response.data.grade;
                    _this2.date_from = response.data.date_from;
                    _this2.date_to = response.data.date_to;
                    _this2.daily_plan = response.data.daily_plan;
                    _this2.standards = response.data.standards;
                    _this2.expectations = response.data.expectations;
                    _this2.essential_questions = response.data.essential_questions;
                    _this2.objectives = response.data.objectives;
                    _this2.evaluations = response.data.evaluations;
                    _this2.activities = response.data.activities;
                    _this2.observations = response.data.observations;
                }).catch(function (error) {
                    console.log(error.response);
                });
            },
            calculateDates: function calculateDates() {
                if (this.date_from == '' || this.date_to == '') return [];

                var range = moment().range(this.date_from, this.date_to);
                var dates = [];
                var _iteratorNormalCompletion = true;
                var _didIteratorError = false;
                var _iteratorError = undefined;

                try {
                    for (var _iterator = range.by('day')[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                        var day = _step.value;

                        var dayOfWeek = day.format('d');
                        if (dayOfWeek == 0 || dayOfWeek == 6) continue;

                        var formatted_date = day.format('dddd MMMM D, YYYY');

                        dates.push({
                            date: formatted_date,
                            plans: this.getPlans(formatted_date)
                        });
                    }
                } catch (err) {
                    _didIteratorError = true;
                    _iteratorError = err;
                } finally {
                    try {
                        if (!_iteratorNormalCompletion && _iterator.return) {
                            _iterator.return();
                        }
                    } finally {
                        if (_didIteratorError) {
                            throw _iteratorError;
                        }
                    }
                }

                this.daily_plan = dates;
            },
            getPlans: function getPlans(date) {

                for (var i = 0; i < this.daily_plan.length; i++) {
                    if (this.daily_plan[i].date == date && this.daily_plan[i].plans.length > 0) return this.daily_plan[i].plans;
                }return [this.getEmptyPlanObject()];
            },
            getEmptyPlanObject: function getEmptyPlanObject() {
                return {
                    plan: '',
                    time: ''
                };
            },
            chooseStandards: function chooseStandards() {
                this.selecting_standards = this.standards;
                this.selecting_expectations = this.expectations;
                this.is_standard_modal_open = true;
            },
            saveStandards: function saveStandards() {
                this.standards = this.selecting_standards;
                this.expectations = this.selecting_expectations;
                this.is_standard_modal_open = false;
            },
            selectedExpectations: function selectedExpectations(expectations) {
                return this.expectations.filter(function (expectation) {
                    return expectations.indexOf(expectation) >= 0;
                });
            },
            addEssentialQuestion: function addEssentialQuestion(standard) {
                standard.essential_questions.push('');
            },
            addPlan: function addPlan(day) {
                this.addEmptyDayPlan(day);
            },
            addEmptyDayPlan: function addEmptyDayPlan(day) {
                day.plans.push(this.getEmptyPlanObject());
            },
            moveToPreviousDay: function moveToPreviousDay(day_index, plan_index) {
                if (day_index - 1 == -1) {
                    do {
                        this.date_from = moment(this.date_from).add(-1, 'days').format('YYYY-MM-DD');
                    } while (moment(this.date_from).format('d') == 0 || moment(this.date_from).format('d') == 6);

                    this.calculateDates();
                }

                var previous_day_index = day_index - 1;
                var original_day_index = day_index;
                if (previous_day_index == -1) {
                    previous_day_index = 0;
                    original_day_index = 1;
                }

                this.daily_plan[previous_day_index].plans.push(this.daily_plan[original_day_index].plans[plan_index]);
                if (day_index - 1 == -1) {
                    // remove the extra plan entry from the created new date
                    this.daily_plan[previous_day_index].plans.splice(0, 1);
                }

                this.daily_plan[original_day_index].plans.splice(plan_index, 1);
                if (this.daily_plan[original_day_index].plans.length == 0) {
                    this.addEmptyDayPlan(this.daily_plan[original_day_index]);
                }
            },
            moveToNextDay: function moveToNextDay(day_index, plan_index) {
                if (day_index + 1 == this.daily_plan.length) {
                    do {
                        this.date_to = moment(this.date_to).add(1, 'days').format('YYYY-MM-DD');
                    } while (moment(this.date_to).format('d') == 0 || moment(this.date_to).format('d') == 6);

                    this.calculateDates();
                }

                this.daily_plan[day_index + 1].plans.unshift(this.daily_plan[day_index].plans[plan_index]);
                if (day_index + 1 == this.daily_plan.length - 1) {
                    // remove the extra plan entry from the created new date
                    this.daily_plan[day_index + 1].plans.splice(1, 1);
                }

                this.daily_plan[day_index].plans.splice(plan_index, 1);
                if (this.daily_plan[day_index].plans.length == 0) {
                    this.addEmptyDayPlan(this.daily_plan[day_index]);
                }
            },
            submitForm: function submitForm() {
                var _this3 = this;

                axios.post(this.$el.action, this.$data).then(function (response) {
                    if (response.data.success) location.href = '/';
                }).catch(function (error) {
                    return _this3.errors = error.response.data;
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
            },
            getRandomInteger: function getRandomInteger() {
                return Math.random() * (1000000 - 0) + 0;
            },
            startAutomaticSaves: function startAutomaticSaves() {
                var _this4 = this;

                setInterval(function () {
                    return _this4.save();
                }, 120 * 1000);
            },
            save: function save() {
                var _this5 = this;

                axios.post(this.$el.action, this.$data).then(function (response) {
                    if (response.data.success) {

                        if (response.data.id) {
                            var id = response.data.id;
                            window.history.replaceState({}, '', '/plans/' + id + '/edit');
                            _this5.$el.action = '/plans/' + id;
                        }
                    }
                }).catch(function (error) {
                    return _this5.errors = error.response.data;
                });
            }
        }
    });
};

/***/ })

/******/ });