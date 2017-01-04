<style lang="scss">
</style>
<template>
	<div ref="authscope" id="Auth-scope">
		<div class="container">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-md-6">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium deserunt ducimus iure officia perspiciatis praesentium quis quos veniam voluptate voluptates. Aspernatur earum et impedit libero molestiae obcaecati, officia optio sequi.
					</div>
					<div class="col-md-6">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis esse et excepturi impedit molestiae necessitatibus nesciunt, odio perferendis praesentium sapiente sequi sunt voluptatibus voluptatum. Architecto deserunt harum nesciunt nobis voluptatibus?
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {


		data() {
			return {

			}
		},

		computed: {

		},

		// Constructor
		created(){

		},

		// Rendered
		mounted() {
			var vm = this;
			eventHub.$emit('profileViewHeight', vm.$refs.authscope.clientHeight)

		},

		methods: {

		}
	}
</script>