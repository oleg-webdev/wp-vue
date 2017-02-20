<style lang="scss" rel="stylesheet/scss">
	#Restore-pass-scope {
		.am-wrap {
			max-width : 900px;
		}
		.md-card {
			padding : 20px;
		}
	}
</style>
<template>
	<div ref="restorepassscope" id="Restore-pass-scope">
		<div class="am-wrap">
			<div class="spinner-container">
				<md-spinner :md-size="30" v-if="spinnerActive" md-indeterminate class="md-accent"></md-spinner>
			</div>
		</div>
		<md-card class="am-wrap am-wrap-sm">
			<md-card-header>
				<div class="md-title">Enter new password</div>
				<div class="md-subhead">Make sure your password is strengh enough</div>
			</md-card-header>

			<md-card-content>
				<form @submit.prevent="changePassword" action="" method="post" role="form">

					<div
						class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input v-model="pass" class="mdl-textfield__input" type="password" id="am-pass">
						<label class="mdl-textfield__label" for="am-pass">Password</label>
					</div>
					<div
						class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input v-model="confirm" class="mdl-textfield__input" type="password" id="am-confirm">
						<label class="mdl-textfield__label" for="am-confirm">Password</label>
					</div>

					<md-card-actions>
						<md-button class="md-raised md-accent" type="submit">Reset</md-button>
					</md-card-actions>

				</form>
			</md-card-content>

		</md-card>
	</div>
</template>

<script>
	import CurrentUser from '../../vuex/User'
	export default {
		data() {
			return {
				spinnerActive: false,
				pass         : null,
				confirm      : null,
				errors       : {
					pass   : '',
					confirm: ''
				}
			}
		},

		computed: {},

		// Constructor
		created(){

		},

		// Rendered
		mounted() {
			var vm = this;
			eventHub.$emit('profileViewHeight', vm.$refs.restorepassscope.clientHeight)
		},

		methods: {

			trunkErrors() {
				for (var obj in this.errors) {
					this.errors[obj] = ''
				}
			},

			changePassword() {
				this.spinnerActive = true
				this.trunkErrors()

				if (this.pass.length < 8) {
					this.$root.openDialog('alertFailDialog', {
						alert: 'alertfail',
						data : {
							type       : 'fail',
							contentHtml: 'Password should be more than 8 symbols',
							text       : 'Got It'
						}
					})
				} else {
					if (this.pass != this.confirm) {
						this.$root.openDialog('alertFailDialog', {
							alert: 'alertfail',
							data : {
								type       : 'fail',
								contentHtml: 'Password and Confirm should match',
								text       : 'Understood'
							}
						})
					} else {

						let token = this.$route.query.pass_token;
						if (token) {
							const loginData = dataToPost('ajx20175216035231', {
								pass   : this.pass,
								confirm: this.confirm,
								token  : token
							});

							this.$http.post(AMdefaults.ajaxurl, loginData).then(function(response) {
								let data = response.data

								if (data.status === 'invalid_token') {
									this.$root.openDialog('alertFailDialog', {
										alert: 'alertfail',
										data : {
											type       : 'fail',
											contentHtml: 'No record for this user',
											text       : 'Ok'
										}
									})
								} else {
									if (data.status === 'success') {
										CurrentUser.commit('setUserdata', data.user)
										this.$router.push({name: 'userentrypoint'})
									}

								}
							})
						}
					}
				}
				this.spinnerActive = false
			}

		}
	}
</script>