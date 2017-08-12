<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ title }}</p>
                <button class="delete" @click.prevent="close"></button>
            </header>
            <section class="modal-card-body">
                <slot></slot>
            </section>
            <footer class="modal-card-foot">
                <a class="button is-success" @click.prevent="save">Save changes</a>
                <a class="button" @click.prevent="close">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            title: {
                required:true
            }
        },

        data() {
            return {

            }
        },

        methods: {
            close() {
                this.$emit('close');
            },

            save() {
                this.$emit('save');
            }
        }
    }
</script>