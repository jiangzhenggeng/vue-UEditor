<template>
  <div>
    {{$slots.default}}
  </div>
</template>

<script>
	export default {
		name: "Option",
		props: {
			label: {
				type: String,
				default: ''
			}
		},
    mounted(){
			console.log(this.$slots.default)
    }
	}
</script>

<style>

</style>