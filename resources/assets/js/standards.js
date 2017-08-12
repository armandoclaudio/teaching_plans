window.onload = function() {
    new Vue({
        el: '#standards-form',

        data: {
            id: 0,
            description: '',
            newExpectation: '',
            expectations: [],
            errors: {}
        },

        mounted() {
            let a = this.$el.action.split('/');
            if(!isNaN(a[a.length - 1])) {
                this.id = a[a.length - 1] * 1;

                this.getData();
            }
        },

        methods: {

            getData() {
                axios.get('/standards/' + this.id + '/get')
                    .then(response => {
                        this.description = response.data.description;
                        this.expectations = response.data.expectations.map(e => e.description);
                    })
                    .catch(error => {
                        console.log(error.response);
                    })
            },

            addExpectation() {
                this.expectations.push('');
            },

            submitForm() {

                axios.post(this.$el.action, this.$data)
                    .then(response => {
                        if(response.data.success)
                            location.href = '/standards';
                    })
                    .catch(error => this.errors = error.response.data );
            },

            hasError(field) { return this.errors.hasOwnProperty(field) },
            getError(field) { return this.errors[field][0] },

            clearError(field) {

                if(this.errors.hasOwnProperty(field)) {
                   delete this.errors[field];
                }

            }
        }
    });
}