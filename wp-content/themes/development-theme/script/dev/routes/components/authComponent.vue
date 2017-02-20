<style lang="scss" rel="stylesheet/scss">
	.spinner-container {
		height : 55px;
		.md-spinner {
			float : right;
		}
	}
</style>
<template>
	<div ref="authscope" id="Auth-scope">
		<div class="container">
			<div id="login-register-form"
					 v-bind:class="[formClass]"
					 class="animated">
				<div class="spinner-container">
					<md-spinner :md-size="30" v-if="spinnerActive" md-indeterminate class="md-accent"></md-spinner>
				</div>

				<md-card id="login-register-wrapper">

					<md-button @click="toggleRegistration" title="Registration" class="md-fab"
										 v-if="registrationInfo.registration_info == 'yes'"
										 v-bind:class="{'icon-centered':currentForm != 'login'}"
										 id="register-trigger">
						<md-icon>border_color</md-icon>
						<md-tooltip md-direction="top">Registration</md-tooltip>
					</md-button>

					<md-button @click="toggleResetPassword" title="Reset Password" class="md-fab md-primary"
										 v-bind:class="{'icon-centered':currentForm != 'login'}"
										 id="reset-trigger">
						<md-icon>send</md-icon>
						<md-tooltip md-direction="top">Reset Password</md-tooltip>
					</md-button>


					<md-card-content id="forms-handler"
													 v-bind:class="{'increase-z':currentForm != 'login'}">

						<!--
							Login Form
						-->
						<div id="am-loginform-wrapper">
							<md-card-header>
								<div class="md-title">Login</div>
								<div class="md-subhead">Enter Your login and password</div>
							</md-card-header>

							<md-card-content id="am-loginform">
								<form @submit.prevent="loginUser" action="" method="post" role="form">

									<div
										v-bind:class="[{'is-invalid':errors.login}, {'is-focused':errors.login}]"
										class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input v-model="loginUserModel.login" class="mdl-textfield__input" type="text" id="am-username">
										<label class="mdl-textfield__label" for="am-username">Username</label>
										<span class="mdl-textfield__error">{{errors.login.message}}</span>
									</div>

									<div
										v-bind:class="[{'is-invalid':errors.pass}, {'is-focused':errors.pass}]"
										class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input v-model="loginUserModel.pass" class="mdl-textfield__input" type="password" id="am-password">
										<label class="mdl-textfield__label" for="am-password">Password</label>
										<span class="mdl-textfield__error">{{errors.pass.message}}</span>
									</div>

									<md-card-actions>
										<md-button class="md-raised md-accent" type="submit">Login</md-button>
									</md-card-actions>
								</form>
							</md-card-content>
						</div>
						<!--Login Form END-->


						<!--
							Reset Password Form
						-->
						<md-card-content id="am-resetpass-form"
														 v-bind:class="{'open-form-opened':currentForm == 'resetpassword'}"
						>
							<div class="register-inner-wrap">
								<md-card-header>
									<md-button class="md-fab animated close-frm-btn md-primary"
														 v-bind:class="{'fadeInRightBig':currentForm == 'resetpassword'}"
														 @click="toggleResetPassword" title="Close">
										<md-icon>close</md-icon>
									</md-button>

									<div class="md-title">Reset Password</div>
									<div class="md-subhead">Subheading title</div>
								</md-card-header>
								<form @submit.prevent="resetPasswordForm" action="" method="post" role="form">

									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input v-model="resetUserModel.email"
													 class="mdl-textfield__input" type="email" id="reset-email">
										<label class="mdl-textfield__label" for="reset-email">Email</label>
										<span class="mdl-textfield__error">{{errors.resetEmail.message}}</span>
									</div>

									<md-card-actions>
										<md-button class="md-raised md-primary animated"
															 v-bind:class="{'fadeInUpBig':currentForm == 'resetpassword'}"
															 type="submit">Send Reset pass
										</md-button>
									</md-card-actions>

								</form>
							</div>
						</md-card-content>
						<!--Reset Password END-->


						<!--
							Register Form
						-->
						<md-card-content id="am-register-form" v-if="registrationInfo.registration_info == 'yes'"
														 v-bind:class="{'open-form-opened':currentForm == 'registration'}"
						>
							<div class="register-inner-wrap">
								<md-card-header>

									<md-button class="md-fab animated close-frm-btn"
														 v-bind:class="{'fadeInRightBig':currentForm == 'registration'}"
														 @click="toggleRegistration" title="Close">
										<md-icon>close</md-icon>
									</md-button>

									<div class="md-title">Registration</div>
									<div class="md-subhead">Subheading title</div>
								</md-card-header>
								<form @submit.prevent="registerUser" action="" method="post" role="form">

									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input v-model="registerUserModel.login"
													 class="mdl-textfield__input" type="email" id="reg-email">
										<label class="mdl-textfield__label" for="reg-email">Email</label>
										<span class="mdl-textfield__error">{{errors.regLogin.message}}</span>
									</div>

									<div
										v-if="registrationInfo.registration_strategy != 'confirm_before'"
										class="flex-container">

										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label flex-col-50">
											<input v-model="registerUserModel.pass"
														 class="mdl-textfield__input" type="password" id="reg-password">
											<label class="mdl-textfield__label" for="reg-password">Password</label>
											<span class="mdl-textfield__error">{{errors.regPass.message}}</span>
										</div>

										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label flex-col-50">
											<input v-model="registerUserModel.confirm"
														 class="mdl-textfield__input" type="password" id="reg-password-confirm">
											<label class="mdl-textfield__label" for="reg-password-confirm">Password Confirm</label>
											<span class="mdl-textfield__error">{{errors.confirm.message}}</span>
										</div>

									</div>

									<md-card-actions>
										<md-button class="md-raised md-accent animated"
															 v-bind:class="{'fadeInUpBig':currentForm == 'registration'}"
															 type="submit">Register
										</md-button>
									</md-card-actions>
								</form>
							</div>
						</md-card-content>
						<!--Register Form End-->

					</md-card-content>

				</md-card>

			</div>
		</div>
	</div>
</template>

<script>
	import CurrentUser from '../../vuex/User'
	export default {

		data() {
			return {
				spinnerActive: false,
				registrationInfo: AMdefaults.themeSettings.auth_info,
				formClass       : 'rubberBand',
				currentForm     : 'login',

				loginUserModel: {
					login: '',
					pass : ''
				},

				resetUserModel: {
					email: '',
				},

				registerUserModel: {
					login  : '',
					pass   : '',
					confirm: ''
				},

				errors: {
					login     : '',
					pass      : '',
					regLogin  : '',
					regPass   : '',
					confirm   : '',
					resetEmail: ''
				}

			}
		},

		computed: {},

		methods: {

			toggleRegistration(){
				this.currentForm = this.currentForm === 'registration' ? 'login': 'registration';
			},

			toggleResetPassword(){
				this.currentForm = this.currentForm === 'resetpassword' ? 'login': 'resetpassword';
			},

			trunkErrors() {
				for (var obj in this.errors) {
					this.errors[obj] = ''
				}
			},

			loginUser() {
				this.spinnerActive = true
				this.formClass = ''
				this.trunkErrors()

				const loginData = dataToPost('ajx20174507084516', this.loginUserModel);
				this.$http.post(AMdefaults.ajaxurl, loginData).then(function(response) {
					let data = response.data
					if (data.status.type === 'success') {
						CurrentUser.commit('setUserdata', data.user)
						this.$router.push({name: 'userentrypoint'})
					} else {
						this.errors[data.status.field] = data.status
						this.formClass = 'shake'
					}

					this.spinnerActive = false
				});
			},

			// @TODO: Reset password
			resetPasswordForm(){
				this.spinnerActive = true
				this.formClass = ''
				this.trunkErrors()

				const loginData = dataToPost('ajx20173909123946', this.resetUserModel);
				this.$http.post(AMdefaults.ajaxurl, loginData).then(function(response) {
					let data = response.data

					if(data.status === 'notfound') {
						console.log(this);
						this.$root.openDialog('alertFailDialog',{
							alert : 'alertfail',
							data : {
								type: 'fail',
								contentHtml: 'This user is not exists',
								text: 'Ok'
							}
						})
						this.resetUserModel = {
							email: '',
						}
					}
					if(data.status === 'success') {
						this.$root.openDialog('alertOkDialog',{
							alert : 'alertok',
							data : {
								type: 'success',
								contentHtml: 'Check your email',
								text: 'Ok'
							}
						})
						this.resetUserModel = {
							email: '',
						}
					}
					console.log(data);

					this.spinnerActive = false
				});
			},

			// @TODO: Do register
			registerUser() {

				console.log(this.registerUserModel)

			}

		},

		created(){

		},

		// Rendered
		mounted() {
			var vm = this;
			eventHub.$emit('profileViewHeight', vm.$refs.authscope.clientHeight)
		},

	}
</script>