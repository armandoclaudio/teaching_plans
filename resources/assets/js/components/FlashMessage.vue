<template>
    <div class="notification is-primary" v-if="is_visible">
        <button class="delete" @click="is_visible = false"></button>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                is_visible: true
            };
        },

        mounted() {
            setTimeout(() => this.is_visible = false, 5000)
        }
    }
</script>

<style>
    .notification {
        position:fixed;
        right: 20px;
        bottom: 20px;
    }
</style>