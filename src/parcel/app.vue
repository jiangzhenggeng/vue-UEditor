<template>
  <div @click="change">
    {{ msg }}
  </div>
</template>
<script>
	export default {
		data() {
			return {
				msg: 'app'
			}
		},
		methods: {
			change() {
				this.msg = Math.random()
			}
		}
	}
</script>
<style>

</style>