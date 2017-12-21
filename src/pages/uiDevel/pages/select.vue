<template>
  <div class="example-select">
    <ui-select>
      <ui-option
        v-for="item in list"
        :key="item.value"
        :label="item.title"
        :value="item.value"
      >
        {{item.title}}
      </ui-option>
    </ui-select>
  </div>
</template>

<script>
	export default {
		data() {
			return {
				list: [
					{
						title: '第一项',
						value: 1
					},
					{
						title: '第二项',
						value: 2
					},
					{
						title: '第三项',
						value: 3
					}
				]
			}
		}
	}
</script>

<style>

</style>