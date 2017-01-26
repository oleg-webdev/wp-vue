<template>
	<div ref="popovercontentscope"
			 class="Popovercontent-scope"
			 v-bind:class="['position-'+position, {show:opened}]"
	>
		<transition
				v-bind:enter-active-class="resolveEnterPosition"
				v-bind:leave-active-class="resolveOutPosition"
		>
			<div v-show="opened">
				<span class="popover-pointer"></span>
				<slot></slot>
			</div>

		</transition>
	</div>
</template>

<script>


	export default {

		props: {
			position: [String] // top right bottom left
		},

		data() {
			return {
				opened: false
			}
		},

		computed: {

			resolveEnterPosition() {
				let animated = 'animated';
				switch (this.position) {
					case 'top':
						return `${animated} fadeInDown`
						;break;
					case 'bottom':
						return `${animated} fadeInUp`
						;break;
					case 'left':
						return `${animated} fadeInLeft`
						;break;
					case 'right':
						return `${animated} fadeInRight`
						;break;
					default:
						return `${animated} fadeIn`;
				}
			},

			resolveOutPosition() {
				let animated = 'animated';
				switch (this.position) {
					case 'top':
						return `${animated} fadeOutUp`
							;break;
					case 'bottom':
						return `${animated} fadeOutDown`
							;break;
					case 'left':
						return `${animated} fadeOutLeft`
							;break;
					case 'right':
						return `${animated} fadeOutRight`
							;break;
					default:
						return `${animated} fadeOut`
				}
			},

		},

		// Constructor
		created(){

		},

		// Rendered
		mounted() {
			let vm = this;

			eventHub.$on('popupRequest', (evt) => {
				if (evt.invoker.parentElement === vm.$el.parentElement) {
					this.opened = !this.opened
				}
			})

		},

		methods: {}
	}
</script>