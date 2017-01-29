<template>
	<div ref="popovercontentscope"
			 class="Popovercontent-scope"
			 :class="['position-'+position, {show:opened}]"
	>
		<transition
				:enter-active-class="resolveEnterPosition"
				:leave-active-class="resolveOutPosition"
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
			let vm = this,
				parentEl = vm.$el.parentElement;

			eventHub.$on('popupRequest', (evt) => {
				let invoker = evt.invoker;
				if (invoker.parentElement === parentEl) {
					this.opened = !this.opened



					setTimeout(()=>{
						let invokerHeight = invoker.offsetHeight,
								invokerWidth  = invoker.offsetWidth,
								popoverHeight = (vm.$el).offsetHeight,
								popoverWidth  = (vm.$el).offsetWidth;

						switch (this.position) {
							case 'top':
								(vm.$el).style.marginLeft = `-${popoverWidth / 2}px`;
								break;
							case 'bottom':
								(vm.$el).style.marginLeft = `-${popoverWidth / 2}px`;
								break;
							case 'left':
								(vm.$el).style.marginTop = `-${popoverHeight / 2}px`;
								break;
							case 'right':
								(vm.$el).style.marginTop = `-${popoverHeight / 2}px`;
								break;
							default:
								return false;
						}

					}, 50)

				}
			})

		},

		methods: {}
	}
</script>