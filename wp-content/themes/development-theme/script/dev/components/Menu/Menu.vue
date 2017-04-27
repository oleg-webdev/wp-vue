<template>
	<div ref="menuscope" class="Menu-scope">

		<transition
			enter-active-class="animated bounceInUp"
			leave-active-class="animated bounceOut"
		>
			<div class="inner-menu-elms" :style="menuStyle" v-if="currentMenuState">
				<!--SubItems-->
				<div class="subitems-menu-tickets">
					<a v-for="subitem in allSubmenuItems"
						 :class="subitem.classes"
						 :href="subitem.url"
					>{{subitem.title}}</a>
				</div>

				<ul>
					<li v-for="item in allMenuItems"
							:class="{
					menuItemHasChilds : itemHasChildren(item),
					openedSubitem : !item.collapsed && itemHasChildren(item)}"
					>
						<a :href="item.url">{{item.title}}</a>
						<!--Subitems-->

						<div v-if="itemHasChildren(item)" class="childs-wrap">
							<i class="fa fa-plus" @click="toggleSubItem(item)"></i>
							<transition
								enter-active-class="animated bounceInRight"
								leave-active-class="animated bounceOut"
							>
								<ul class="children-items-mobile-menu" v-if="!item.collapsed">
									<li v-for="children in item.wpse_children">
										<a :href="children.url">{{children.title}}</a>
									</li>
								</ul>
							</transition>
						</div>

					</li>
				</ul>

				<div class="flex-container-nowrap mobile-menu-footer text-center">
					<a :href="socialsItems.insta"><i class="fa fa-instagram"></i></a>
					<a :href="socialsItems.fb"><i class="fa fa-facebook"></i></a>
				</div>

			</div>
		</transition>

	</div>
</template>

<script>
	// app-menu
	import MenuState from '../../vuex/Menu'
	export default {

		props: {
			menuitems   : [String],
			menusubitems: [String],
			socials     : [String]
		},

		data() {
			return {
				allMenuItems   : [],
				allSubmenuItems: [],
				socialsItems   : [],
				menuStyle      : {
					height: 0
				}
			}
		},

		computed: {
			currentMenuState() {
				return MenuState.state.opened
			}
		},

		methods: {

			itemHasChildren(item) {
				return item.wpse_children.length > 0
			},

			toggleSubItem(item) {
				item.collapsed = !item.collapsed
			}

		},

		// Constructor
		created(){
			if (this.socials) {
				this.socialsItems = JSON.parse(this.socials)
			}

			if (this.menuitems) {
				let parsedItems = JSON.parse(this.menuitems)

				for (let obj in parsedItems) {
					parsedItems[obj]['collapsed'] = true
					this.allMenuItems.push(parsedItems[obj])
				}
			}

			if (this.menusubitems) {
				let tempItems = JSON.parse(this.menusubitems)
				for (let _item in tempItems) {
					this.allSubmenuItems.push(tempItems[_item])
				}
			}
		},

		// Rendered
		mounted() {
			let vm             = this,
					container      = vm.$refs.menuscope, // vm.$el
					topContainer   = document.getElementById('mobile-navigation-aside'),
					rect           = topContainer.getBoundingClientRect(),
					topBarOffset   = rect.top + topContainer.offsetHeight,
					currentWindowH = window.innerHeight,
					menuH          = currentWindowH - topBarOffset;

			this.menuStyle.height = `${menuH}px`


			window.addEventListener('resize', (e) => {
				let rect           = topContainer.getBoundingClientRect(),
						topBarOffset   = rect.top + topContainer.offsetHeight,
						currentWindowH = window.innerHeight,
						menuH          = currentWindowH - topBarOffset;

				vm.menuStyle.height = `${menuH}px`

			});

		}
	}
</script>