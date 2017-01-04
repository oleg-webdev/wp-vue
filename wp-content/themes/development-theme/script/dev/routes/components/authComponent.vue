<style lang="scss">
	#login-register-wrapper {
		position : relative;
		overflow : visible;
	}

	#forms-handler {
		position      : relative;
		overflow      : hidden;
		z-index       : 1;
		border-radius : 3px;

		&.increase-z {
			 z-index : 4;
		}
	}

	#am-loginform-wrapper {
		width        : 100%;
		max-width    : 670px;
		margin-left  : auto;
		margin-right : auto;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		* {
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
	}

	#am-register-form {
		-webkit-transition : all .2s;
		-moz-transition    : all .2s;
		transition         : all .2s;
		position           : absolute;
		background-color   : #1E88E5;
		left               : 50%;
		top                : 50%;
		padding            : 0;
		width              : 0;
		height             : 0;
		overflow           : hidden;
		display            : flex;
		justify-content    : center;
		align-items        : center;
		border-radius      : 50%;

		&.open-form-opened {
			 width : 1000px;
			 height : 1000px;
			 margin-left : -500px;
			 margin-top : -500px;
			 -webkit-transition : all .8s;
			 -moz-transition    : all .8s;
			 transition         : all .8s;
		}
	}

	#register-trigger {
		position           : absolute;
		right              : -30px;
		top                : 10px;
		z-index            : 3;
		-webkit-transition : all .3s;
		-moz-transition    : all .3s;
		transition         : all .3s;

		&.icon-centered {
			right        : 50%;
			top          : 50%;
			margin-top   : -20px;
			margin-right : -20px;
		}

	}

	#register-inner-wrap {
		position : relative;
		width : 100%;
		max-width : 650px;
		-moz-box-sizing: border-box;
		box-sizing: border-box;

		* {
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}

		.md-card-header {
			padding-left : 0;
			padding-right : 0;
		}

		.md-card-actions {
			padding-right : 0;
		}

		.md-card-header {
			color : #fff;
		}

		.mdl-textfield--floating-label {
			color :#fff;

			.mdl-textfield__label {
				color : rgba(255, 255, 255, 0.81);
				&:after {
					background-color: rgba(255, 255, 255, 0.81);
				}
			}

			&.is-invalid {
				.mdl-textfield__label {
					color : red;
					&:after {
						background-color: red;
					}
				}
			}
		}

	}

	#close-register {
		position : absolute;
		right : 0;
		top : 0;
		/*Desktop*/
		@media (min-width : 952px) {
			right: -20px;
		}
	}

</style>
<template>
	<div ref="authscope" id="Auth-scope">
		<div class="container">
			<div id="login-register-form" class="col-md-8 col-md-offset-2">
				<br>

				<md-card id="login-register-wrapper">

					<md-button @click="toggleRegistration" title="Registration" class="md-fab"
										 v-bind:class="{'icon-centered':currentForm == 'registration'}"
										 id="register-trigger">
						<md-icon>border_color</md-icon>
					</md-button>

					<div id="forms-handler" v-bind:class="{'increase-z':currentForm == 'registration'}">
						<div id="am-loginform-wrapper">
							<md-card-header>
								<div class="md-title">Login</div>
								<div class="md-subhead">Enter Your login and password</div>
							</md-card-header>
							<!--Login-->
							<md-card-content id="am-loginform">
								<form action="" method="post" role="form">

									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="am-username">
										<label class="mdl-textfield__label" for="am-username">Username</label>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="password" id="am-password">
										<label class="mdl-textfield__label" for="am-password">Password</label>
									</div>

									<md-card-actions>
										<md-button class="md-raised md-accent" type="submit">Login</md-button>
									</md-card-actions>
								</form>
						</div>

						</md-card-content>

						<!--Register-->
						<md-card-content id="am-register-form"
														 v-bind:class="{'open-form-opened':currentForm == 'registration'}"
						>
							<div id="register-inner-wrap">
								<md-card-header>
									<md-button id="close-register" @click="toggleRegistration" title="Close" class="md-fab">
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
										<md-button class="md-raised" type="submit">Register</md-button>
									</md-card-actions>
								</form>
							</div>


						</md-card-content>
					</div>

				</md-card>

			</div>
		</div>
	</div>
</template>

<script>
	export default {


		data() {
			return {

				currentForm: 'login'

			}
		},

		computed: {},

		methods: {

			toggleRegistration(){
				this.currentForm = this.currentForm === 'registration' ? 'login': 'registration';
			}

		},


		// Constructor
		created(){

		},

		// Rendered
		mounted() {
			var vm = this;
			eventHub.$emit('profileViewHeight', vm.$refs.authscope.clientHeight)
		},


	}
</script>