<?php

// ============= Paypal_donations_form =============
if ( ! function_exists( 'paypal_donations_form' ) ) {
	function paypal_donations_form()
	{
		ob_start();
		// global $aa_payment;
		// $aa_payment->get_images_dir_url()
		?>
		<form action="" method="POST" autocomplete="off">
			<input type="hidden" name="paypal_checkout_20164820054847" value="checkout"/>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" name="donation-name" type="text" id="donation-name">
				<label class="mdl-textfield__label" for="donation-name">Donation Name</label>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" name="donation-price" type="text" id="price-name">
				<label class="mdl-textfield__label" for="price-name">Price</label>
			</div>
			<hr>

			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
				Button
			</button>
		</form>
		<?php
		return ob_get_clean();
	}
}

// ============= Paypal_pro_donation_form =============
if ( ! function_exists( 'paypal_pro_donation_form' ) ) {
	function paypal_pro_donation_form()
	{
		ob_start();
		// global $aa_payment;
		// $aa_payment->get_images_dir_url()
		?>
		<form action="" method="POST" autocomplete="off" class="aa-payment">
			<input type="hidden" name="paypal_pro_checkout_20165122015139" value="checkout"/>

			<div class="row">
				<div class="col-md-6">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" name="firstname" type="text" id="firstname" pattern="[A-Z,a-z]*">
						<label class="mdl-textfield__label" for="firstname">First Name</label>
						<span class="mdl-textfield__error">Please type letters without spaces</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" name="lastname" type="text" id="lastname" pattern="[A-Z,a-z]*">
						<label class="mdl-textfield__label" for="lastname">Last Name</label>
						<span class="mdl-textfield__error">Please type letters without spaces</span>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" name="description" type="text" id="description">
						<label class="mdl-textfield__label" for="description">Donation Name</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" name="card_number" type="text" id="card_number">
						<label class="mdl-textfield__label" for="card_number">Card Number</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" name="total_amount" type="text" id="total-amount">
						<label class="mdl-textfield__label" for="total-amount">Name your Price</label>
					</div>
				</div>
			</div>


			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
				Button
			</button>
		</form>
		<?php

		return ob_get_clean();
	}
}

/**
 * ==================== Shortcodes definition ======================
 * 21.07.2016
 */
add_action( 'wp_loaded', 'aa_func_20163321033351' );
function aa_func_20163321033351()
{
	add_shortcode( 'paypal_donations_form', 'paypal_donations_form' );
	add_shortcode( 'paypal_pro_donation_form', 'paypal_pro_donation_form' );
}