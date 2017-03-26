<template>
	<div ref="sliderscope" class="Slider-scope" @mousedown="movePinThere">
		<div class="range-handler" :style="{width:pos+'%'}"></div>
		<span class="dragger" :style="{left:pos+'%'}"
					:class="{touched:mooving}"
					@mousedown="invokeMove"
		>
			<transition
				enter-active-class="animated rubberBand"
				leave-active-class="animated flipOutY"
			>
				<span v-if="showbulb && mooving" class="bulb-handler">
				<i class="bulb-percentage">{{Math.ceil(pos)}}%</i>
			</span>
			</transition>

		</span>

	</div>
</template>

<script>
	export default {

		props: {
			type    : [String],
			disabled: [Boolean],
			position: [Number],
			vertical: [Boolean],
			showbulb: [Boolean]
		},

		data() {
			return {
				mooving: false,
				pos    : 0
			}
		},

		computed: {},

		methods: {

			invokeMove(e) {
				this.mooving = true

				let parent = findAncestor(e.target, "Slider-scope")

				if ( parent ) {
					let vm = this,
							parentPosition = parent.getBoundingClientRect()

					window.addEventListener('mousemove', function(e) {
						if (vm.mooving) {
							let measure   = e.pageX - parentPosition.left,
									fullWidth = parentPosition.width
							if (measure >= 0 && measure <= fullWidth) {
								vm.pos = ((measure - 5) / fullWidth) * 100
							}
						}
					});
				}

			},

			movePinThere(e) {
				let target     = e.target,
						originElem = null,
						vm         = this

				if (target.classList.contains('Slider-scope')) {
					originElem = target
				}

				if (target.classList.contains('range-handler')) {
					originElem = findAncestor(target, "Slider-scope")
				}

				if (!target.classList.contains('dragger') && !findAncestor(target, "dragger")) {
					let pos       = originElem.getBoundingClientRect(),
							measure   = e.pageX - pos.left,
							fullWidth = pos.width

					if (measure >= 0 && measure <= fullWidth) {
						vm.pos = ((measure - 5) / fullWidth) * 100
					}
				}

			},

		},

		// Constructor
		created(){
			this.pos = this.position

			let vm = this
			window.addEventListener('mouseup', function(e) {
				vm.mooving = false
			});
		},

		// Rendered
		mounted() {
			let vm        = this,
					container = vm.$refs.popovercontentscope; // vm.$el

		}
	}
</script>