<?php

// ============= Paypal_donations_form =============
if ( ! function_exists( 'paypal_donations_form' ) ) {
	add_shortcode( 'paypal_donations_form', 'paypal_donations_form' );
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
	add_shortcode( 'paypal_pro_donation_form', 'paypal_pro_donation_form' );
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

if ( ! function_exists( 'subscription_form_shortcode' ) ) {
	add_shortcode( 'subscription_form_shortcode', 'subscription_form_shortcode' );
	function subscription_form_shortcode( $atts )
	{
		ob_start();
		$startDate   = gmdate( "Y-m-d\TH:i:s\Z", time() );
		$description = json_encode( [
			'plan' => 5,
			'user' => get_current_user_id()
		] );
		?>
		<hr>

		<form action="" method="POST" autocomplete="off">
			<input type="hidden" name="paypal_checkout_20170007120041" value="checkout"/>
			<input type="hidden" name="_payment_purpose" value="CreateRecurringPaymentsProfile"/>
			<input type="hidden" name="startdate" value="<?php echo $startDate ?>"/>
			<input type="hidden" name="currency_code" value="USD"/>
			<input type="hidden" name="period" value="Month"/>
			<input type="hidden" name="frequency" value="1"/>
			<input type="hidden" name="description" value='<?php echo $description ?>'/>

			<div class="clearfix">
				<div class="row">
					<div class="col-md-6">
						<p>
							<span>Card type</span>
							<input type="text" class="form-control" name="card_type" value="Visa"/>
						</p>
					</div>
					<div class="col-md-6">
						<p>
							<span>Card number</span>
							<input type="text" class="form-control" name="card_number" value="4032039953243609"/>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p>
							<span>Exp date</span>
							<input type="text" class="form-control" name="exp_date" value="102020"/>
						</p>
					</div>
					<div class="col-md-6">
						<p>
							<span>CVV2</span>
							<input type="text" class="form-control" name="cvv2" value="123"/>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p>
							<span>First Name</span>
							<input type="text" class="form-control" name="first_name" value="alice"/>
						</p>
					</div>
					<div class="col-md-6">
						<p>
							<span>Last Name</span>
							<input type="text" class="form-control" name="last_name" value="alice"/>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p>
							<span>Street</span>
							<input type="text" class="form-control" name="street" value="707 W. Bay Drive"/>
						</p>
					</div>
					<div class="col-md-6">
						<p>
							<span>City</span>
							<input type="text" class="form-control" name="city" value="Largo"/>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p>
							<span>State</span>
							<input type="text" class="form-control" name="state_code" value="FL"/>
						</p>
					</div>
					<div class="col-md-6">
						<p>
							<span>Country</span>
							<input type="text" class="form-control" name="coutry_code" value="US"/>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p>
							<span>Zip</span>
							<input type="text" class="form-control" name="zip_code" value="33770"/>
						</p>
					</div>
					<div class="col-md-6">
						<p>
							<span>Price</span>
							<input type="text" class="form-control" name="total_amount" value="2.54"/>
						</p>
					</div>
				</div>
			</div>

			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
				Button
			</button>
		</form>
		<hr>
		<?php
		return ob_get_clean();
	}
}