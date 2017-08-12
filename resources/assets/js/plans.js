window.onload = function() {
    new Vue({
        el: '#plans-form',

        data: {
            id: 0,
            title: '',
            grade: '',
            date_from: '',
            date_to : '',
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

        mounted() {
            this.getPlanId();

            this.calculateDates();

            axios.get('/standards/all')
                .then(response => {
                    this.available_standards = response.data;
                })
                .catch(error => console.log(error));

            this.startAutomaticSaves();
        },

        watch: {
            date_from() {
                this.calculateDates();
            },

            date_to() {
                this.calculateDates();
            }
        },

        methods: {
            
            getPlanId() {
                let url = this.$el.action.split('/');
                if(!isNaN(url[url.length - 1])) {
                    this.id = url[url.length - 1] * 1;

                    this.getData();
                }
            },

            getData() {
                axios.get('/plans/' + this.id + '/get')
                    .then(response => {
                        this.title = response.data.title;
                        this.grade = response.data.grade;
                        this.date_from = response.data.date_from;
                        this.date_to = response.data.date_to;
                        this.daily_plan = response.data.daily_plan;
                        this.standards = response.data.standards;
                        this.expectations = response.data.expectations;
                        this.essential_questions = response.data.essential_questions;
                        this.objectives = response.data.objectives;
                        this.evaluations = response.data.evaluations;
                        this.activities = response.data.activities;
                        this.observations = response.data.observations;
                    })
                    .catch(error => {
                        console.log(error.response);
                    })
            },

            calculateDates() {
                if(this.date_from == '' || this.date_to == '')
                    return [];

                const range = moment().range(this.date_from, this.date_to);
                let dates = [];
                for (let day of range.by('day')) {
                    let dayOfWeek = day.format('d');
                    if(dayOfWeek == 0 || dayOfWeek == 6)
                        continue;

                    let formatted_date = day.format('dddd MMMM D, YYYY');

                    dates.push({
                        date: formatted_date,
                        plans: this.getPlans(formatted_date)
                    });
                }

                this.daily_plan = dates;
            },

            getPlans(date) {

                for(let i = 0; i < this.daily_plan.length; i++)
                    if(this.daily_plan[i].date == date && this.daily_plan[i].plans.length > 0)
                        return this.daily_plan[i].plans;

                return [this.getEmptyPlanObject()];
            },

            getEmptyPlanObject() {
                return {
                    plan: '',
                    time: ''
                };
            },

            chooseStandards() {
                this.selecting_standards = this.standards;
                this.selecting_expectations = this.expectations;
                this.is_standard_modal_open = true;
            },

            saveStandards() {
                this.standards = this.selecting_standards;
                this.expectations = this.selecting_expectations;
                this.is_standard_modal_open = false;
            },

            selectedExpectations(expectations) {
                return this.expectations.filter(expectation => expectations.indexOf(expectation) >= 0);
            },

            addEssentialQuestion(standard) {
                standard.essential_questions.push('');
            },

            addPlan(day) {
                this.addEmptyDayPlan(day);
            },

            addEmptyDayPlan(day) {
                day.plans.push(this.getEmptyPlanObject());
            },

            moveToPreviousDay(day_index, plan_index) {
                if(day_index - 1 == -1) {
                    do {
                        this.date_from = moment(this.date_from).add(-1, 'days').format('YYYY-MM-DD');
                    }
                    while(moment(this.date_from).format('d') == 0 || moment(this.date_from).format('d') == 6);

                    this.calculateDates();
                }

                let previous_day_index = day_index - 1;
                let original_day_index = day_index;
                if(previous_day_index == -1) {
                    previous_day_index = 0;
                    original_day_index = 1;
                }

                this.daily_plan[previous_day_index].plans.push(this.daily_plan[original_day_index].plans[plan_index]);
                if(day_index - 1 == -1) {
                    // remove the extra plan entry from the created new date
                    this.daily_plan[previous_day_index].plans.splice(0, 1);
                }

                this.daily_plan[original_day_index].plans.splice(plan_index, 1);
                if(this.daily_plan[original_day_index].plans.length == 0) {
                    this.addEmptyDayPlan(this.daily_plan[original_day_index]);
                }
            },

            moveToNextDay(day_index, plan_index) {
                if(day_index + 1 == this.daily_plan.length) {
                    do {
                        this.date_to = moment(this.date_to).add(1, 'days').format('YYYY-MM-DD');
                    }
                    while(moment(this.date_to).format('d') == 0 || moment(this.date_to).format('d') == 6);

                    this.calculateDates();
                }

                this.daily_plan[day_index + 1].plans.unshift(this.daily_plan[day_index].plans[plan_index]);
                if(day_index + 1 == this.daily_plan.length - 1) {
                    // remove the extra plan entry from the created new date
                    this.daily_plan[day_index + 1].plans.splice(1, 1);
                }

                this.daily_plan[day_index].plans.splice(plan_index, 1);
                if(this.daily_plan[day_index].plans.length == 0) {
                    this.addEmptyDayPlan(this.daily_plan[day_index]);
                }
            },

            submitForm() {

                axios.post(this.$el.action, this.$data)
                    .then(response => {
                        if(response.data.success)
                            location.href = '/';
                    })
                    .catch(error => this.errors = error.response.data );
            },

            hasError(field) { return this.errors.hasOwnProperty(field) },
            getError(field) { return this.errors[field][0] },

            clearError(field) {

                if(this.errors.hasOwnProperty(field)) {
                   delete this.errors[field];
                }

            },

            getRandomInteger() {
                return Math.random() * (1000000 - 0) + 0;
            },

            startAutomaticSaves() {
                setInterval(() => this.save(), 120 * 1000);
            },

            save() {
                axios.post(this.$el.action, this.$data)
                    .then(response => {
                        if(response.data.success) {
                            
                            if(response.data.id) {
                                let id = response.data.id;
                                window.history.replaceState({}, '', `/plans/${id}/edit`);
                                this.$el.action = `/plans/${id}`;
                            }

                        }
                    })
                    .catch(error => this.errors = error.response.data );
            }
        }
    });
}