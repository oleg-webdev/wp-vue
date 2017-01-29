<style lang="scss" rel="stylesheet/scss" src="./dropdown.scss"></style>
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
				speed           : 60,
				elem            : null,
				elemContent     : null,
				mutableCollapsed: this.collapsed,
				originHeight    : null,
			}
		},

		computed: {},

		// Constructor
		created(){

			eventHub.$on('accordionProcess', (dropinfo) => {
				if (dropinfo.scope === this.scope && dropinfo.slot != this.slotname) {
					this.mutableCollapsed = true
					$(this.elemContent).animate({height: `0px`}, this.speed, 'linear')
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
						$(this.elemContent).animate({height: `0px`}, this.speed, 'linear')
					} else {
						$(this.elemContent).animate({height: `${this.originHeight}px`}, this.speed, 'linear')
					}
				}

			}

		}
	}
</script>