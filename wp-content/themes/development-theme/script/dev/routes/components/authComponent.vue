<template>
	<div ref="authscope" id="Auth-scope">
		<div class="container">
			<div id="login-register-form"
					 class="col-md-8 col-md-offset-2 animated rubberBand">
				<br>
				<md-card id="login-register-wrapper">

					<md-button @click="toggleRegistration" title="Registration" class="md-fab"
										 v-bind:class="{'icon-centered':currentForm == 'registration'}"
										 id="register-trigger">
						<md-icon>border_color</md-icon>
					</md-button>

					<md-card-content id="forms-handler"
													 v-bind:class="{'increase-z':currentForm == 'registration'}">
						<!--Login-->
						<div id="am-loginform-wrapper">
							<md-card-header>
								<div class="md-title">Login</div>
								<div class="md-subhead">Enter Your login and password</div>
							</md-card-header>
							<!--Login-->
							<md-card-content id="am-loginform">
								<form @submit.prevent="loginUser" action="" method="post" role="form">

									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input v-model="loginUserModel.login" class="mdl-textfield__input" type="text" id="am-username">
										<label class="mdl-textfield__label" for="am-username">Username</label>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input v-model="loginUserModel.pass" class="mdl-textfield__input" type="password" id="am-password">
										<label class="mdl-textfield__label" for="am-password">Password</label>
									</div>

									<md-card-actions>
										<md-button class="md-raised md-accent" type="submit">Login</md-button>
									</md-card-actions>
								</form>
							</md-card-content>
						</div>
						<!--END Login Partial-->

						<!--Register-->
						<md-card-content id="am-register-form"
														 v-bind:class="{'open-form-opened':currentForm == 'registration'}"
						>
							<div id="register-inner-wrap">
								<md-card-header>
									<md-button id="close-register" class="md-fab animated"
														 v-bind:class="{'fadeInRightBig':currentForm == 'registration'}"
														 @click="toggleRegistration" title="Close">
										<md-icon>close</md-icon>
									</md-button>
									<div class="md-title">Registration</div>
									<div class="md-subhead">Subheading title</div>
								</md-card-header>
								<form action="">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="email" id="reg-email">
										<label class="mdl-textfield__label" for="reg-email">Email</label>
									</div>
									<div class="flex-container">
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label flex-col-50">
											<input class="mdl-textfield__input" type="password" id="reg-password">
											<label class="mdl-textfield__label" for="reg-password">Password</label>
										</div>
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label flex-col-50">
											<input class="mdl-textfield__input" type="password" id="reg-password-confirm">
											<label class="mdl-textfield__label" for="reg-password-confirm">Password Confirm</label>
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
						<!--END Register partial-->

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

				currentForm   : 'login',
				loginUserModel: {
					login: '',
					pass : ''
				},

				errors: []
			}
		},

		computed: {

		},

		methods: {

			toggleRegistration(){
				this.currentForm = this.currentForm === 'registration' ? 'login': 'registration';
			},

			loginUser() {
				this.errors = []
				const loginData = dataToPost('ajx20174507084516', this.loginUserModel);
				this.$http.post(AMdefaults.ajaxurl, loginData).then(function(response) {
					let data = JSON.parse(response.data);

					if (data.status === 'success') {
						CurrentUser.commit('setUserdata', data.user)
						console.log(CurrentUser.state.userdata);
						this.$router.push({name: 'userentrypoint'})
					} else {
						this.errors.push(data.status)
					}
				});
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