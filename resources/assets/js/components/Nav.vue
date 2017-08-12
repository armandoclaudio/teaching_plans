<template>
    <div>
        <nav class="navbar">
            <div class="navbar-brand">

                <a class="navbar-item" :href="home_path">
                    {{ app_name }}
                    <slot name="logo"></slot>
                </a>

                <div class="navbar-burger burger" :class="{ 'is-active' : is_open }" @click="is_open = ! is_open">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="navbar-menu" :class="{ 'is-active' : is_open }">
                <div class="navbar-start">
                    <slot></slot>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        props: {
            app_name: {required: true},
            home_path: {required: true}
        },

        data() {
            return {
                is_open: false
            }
        }
    }
</script>
