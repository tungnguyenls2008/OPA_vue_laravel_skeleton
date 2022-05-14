<template>
    <section id="test_show">
        <div class="text-center">
            {{ test.name }}
        </div>
    </section>
</template>

<script>
import testApi from '../api'

export default {
    name: 'TestView',
    components: {},
    data() {
        return {
            test: {},
        }
    },
    methods: {
        async fetchTest() {
            const response = await testApi.find(this.$route.params.id)
            this.test = response.data.data
        },
    },
    mounted() {
        this.fetchTest()
    },
}
</script>
