<template>
    <a class="navbar-item" :href="link">
        <slot></slot>
    </a>
</template>

<script>
    export default {
        props: ['link'],

        data() {
            return {
                
            }
        }
    }
</script>
