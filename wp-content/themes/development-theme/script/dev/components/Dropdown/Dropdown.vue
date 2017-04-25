<template>
	<div ref="dropdownscope"
			 class="dropdown-scope"
			 @click.prevent="invokeDropdown"
			 :class="{collapsed:mutableCollapsed}"
	>
		<slot></slot>
	</div>
</template>

<script>
	export default {

		props: {
			scope    : [String],
			slotname : [String],
			accordion: [Boolean],
			collapsed: [Boolean]
		},

		data() {
			return {
				speed           : 250,
				elem            : null,
				elemContent     : null,
				originHeight    : null,
				mutableCollapsed: this.collapsed
			}
		},


		computed: {},

		// Constructor
		created(){

			eventHub.$on('accordionProcess', (dropinfo) => {
				if (dropinfo.scope === this.scope && dropinfo.slot != this.slotname) {
					this.mutableCollapsed = true
					$(this.elemContent).animate({height: 0}, this.speed)
				}

			})

		},

		// Rendered
		mounted() {
			this.elem = this.$el
			this.elemContent = (this.$el).querySelector('.dropdown-content')
			this.originHeight = this.elemContent.offsetHeight

			if (this.collapsed) {
				(this.elemContent).style.height = 0
			}

		},

		methods: {

			invokeDropdown(event) {
				if ($(event.target).hasClass('dropdown-heading')) {

					if (this.accordion) {
						eventHub.$emit('accordionProcess', {
							scope: this.scope,
							slot : this.slotname
						})
					}

					this.mutableCollapsed = !this.mutableCollapsed

					if (this.mutableCollapsed) {
						$(this.elemContent).animate({height: 0}, this.speed)
					} else {
						$(this.elemContent).animate({height: this.originHeight}, this.speed, 'linear', () => {
							$(this.elemContent).height('auto')
							this.originHeight = this.elemContent.offsetHeight

							// Ajust Position
							// let bodyRect = document.body.getBoundingClientRect(),
							// elem = this.$refs['dropdownscope'].getBoundingClientRect(),
							// offset = (elem.top - bodyRect.top)

							// Animated Scroll
							// TweenMax.to(window, .5, { scrollTo: { y : offset, offsetY: 125 } })
							// Native scroll
							// window.scrollTo(0, ( offset - 150) )

						})
					}

				}

			}

		}
	}
</script>