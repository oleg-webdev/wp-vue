<template>
	<div ref="popovertriggerscope"
			 class="Popovertrigger-scope"
			 @click.prevent="invokePopup($event)">
		<slot></slot>
	</div>
</template>

<script>
	export default {
		methods: {

			invokePopup($event) {
				eventHub.$emit('popupRequest', {

					invoker : this.$el,
					pageX  : $event.pageX,
					pageY  : $event.pageY,
					offsetX: $event.offsetX,
					offsetY: $event.offsetY

				})
			}

		}
	}
</script>