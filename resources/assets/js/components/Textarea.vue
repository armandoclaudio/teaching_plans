<template>
    <article class="media">
    <div class="media-content">
        <div class="field">
        <p class="control">
            <textarea class="textarea" :placeholder="placeholder" v-model="invalue"></textarea>
        </p>
        </div>
    </div>
    <div class="media-right">
        <button class="delete" @click.prevent="$emit('close')"></button>
    </div>
    </article>
</template>

<script>
    export default {
        props: ['value', 'placeholder', 'index'],

        data() {
            return {
                invalue: ''
            }
        },

        created() {
            this.invalue = this.value;
        },

        watch: {
            invalue(value) {
                this.$emit('input', value)
            }   
        }
    }
</script>