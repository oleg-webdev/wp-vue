<style lang="scss" rel="stylesheet/scss" src="./flash.scss"></style>

<template xmlns:v-bind="http://www.w3.org/1999/xhtml">
	<div ref="Flashscope" class="Flash--scope">

		<transition-group
			enter-active-class="animated flipInX"
			leave-active-class="animated flipOutX"
			tag="div">
			<div v-for="flash in flashes"
					 v-bind:key="flash"
					 v-bind:class="[flash.flashclass, {dissmisable:flash.dismissable}]"
					 class="am-flash-notice"
			>
				<div class="flash-wrapper">
					{{flash.message}}
					<div v-if="flash.dismissable" class="flash-icon-container" @click="removeNotice(flash)">
						<md-button class="md-icon-button md-raised">
							<md-icon>clear</md-icon>
						</md-button>
					</div>
				</div>
			</div>
		</transition-group>

	</div>
</template>

<script>
	//				let dt = new Date()
	//				eventHub.$emit('flashadded', {
	//					flashclass : 'success',
	//					dismissable: true,
	//					message    : `${dt}`,
	//					scope      : 'front', // front, system
	//					timeout    : 5000     // optional
	//				})

	import user from '../../vuex/User'
	export default {

		props: ['incomingflashes'],

		data() {
			return {
				flashes: []
			}
		},

		computed: {},

		// Constructor
		created(){
			let systemFlashes = JSON.parse(this.incomingflashes),
					vm            = this;



			// add ${systemFlashes} to flashes
			eventHub.$on('flashadded', (flash)=> {
				this.flashes.unshift(flash)

				if ('timeout' in flash) {
					let t = Number.isInteger(flash.timeout) ?
						flash.timeout > 0 ? flash.timeout: 1000
						: 1000;
					setTimeout(() => vm.removeNotice(flash), t)
				}

			})

			eventHub.$on('flashremoved', (flash)=> {
				console.log(flash);
			})

			if (systemFlashes) {
				for (var flsh in systemFlashes) {
					eventHub.$emit('flashadded', systemFlashes[flsh])
				}
			}

		},

		// Rendered
		mounted() {
			var vm        = this,
					container = vm.$refs.Flashscope;
		},

		methods: {

			removeNotice(flash){

				if (flash.scope == 'system') {
					// ajax call then
				}

				return this.flashes.splice(this.flashes.indexOf(flash), 1)
			},


		}
	}
</script>