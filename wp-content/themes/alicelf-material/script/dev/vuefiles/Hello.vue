<style>
	.red {
		color: blue;
	}
</style>

<template>
	<h1 class="red">{{msg}}</h1>
</template>

<script>
	export default {
		data () {
			return {
				msg: 'Hello world!'
			}
		}
	}
</script>