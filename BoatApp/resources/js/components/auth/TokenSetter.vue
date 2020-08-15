<template>

</template>

<script>

/**
 * Stores the token in local storage
 */
export default {
    props: ['access_token'],

    data() {
        return {
            jean: 'manual'
        }
    },

    mounted() {
        localStorage.setItem('access_token', this.access_token)
        this.$axios.defaults.headers.common = {
            'Authorization': `Bearer ${this.access_token}`,
            'Accept': 'application/json',
        }
    },

    methods: {

    }
}

</script>
