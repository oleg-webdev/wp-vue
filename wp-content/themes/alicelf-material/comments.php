
<?php
echo "<ol>";
wp_list_comments();
echo "</ol>";
$req         = get_option( 'require_name_email' );
$aria_req    = ( $req ? " aria-required='true'" : '' );
$commenter   = wp_get_current_commenter();
$name_label  = "Name " . ( $req ? "*" : "" );
$email_label = "Email" . ( $req ? "*" : "" );
$arguments   = [
	'id_form'           => 'am-commentform',
	'id_submit'         => 'am-submit',
	'class_submit'      => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect',
	'title_reply'       => 'Leave a Reply',
	'title_reply_to'    => 'Leave a Reply to %s',
	'cancel_reply_link' => 'Cancel Reply',
	'label_submit'      => 'Add Review',
	'submit_button'     => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',

	'comment_field' => '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><textarea  id="comment" name="comment" rows="5" class="mdl-textfield__input"></textarea><label for="comment" class="mdl-textfield__label">Comment</label></div>',

	'fields' => apply_filters( 'comment_form_default_fields', [

		'author' => '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" class="mdl-textfield__input" name="author" type="text" id="author"><label class="mdl-textfield__label" for="author">' . $name_label . '</label></div>',

		'email' => '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" class="mdl-textfield__input" name="email" type="email" id="author"><label class="mdl-textfield__label" for="author">' . $email_label . '</label></div>',

	] )

];
echo "<div class='mdl-grid'>";
comment_form( $arguments );
echo "</div>";