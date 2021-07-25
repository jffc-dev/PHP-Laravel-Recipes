<template>
    <span v-text="formatearfecha"></span>
</template>

<script>
    export default {
        props: ['fecha'],
        computed: {
            formatearfecha() {
                return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY')
            }
        }
    }
</script>