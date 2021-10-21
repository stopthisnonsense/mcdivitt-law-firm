<?php
/**
 * Protect the Water Cases Page
 * Enables the functionality for
 * the CSV upload and the email based 
 * password, among other related items.
 * 
 */

//
define( 'WC_PROTECTED_PAGE_ID', 16163 );
define( 'WC_PROTECTED_EMAILS_META_KEY', '_wc_emails' );
define( 'WC_PROTECTED_EMAILS_COOKIE_NAME', 'wp-postpass_wcemails' );
define( 'WC_PROTECTED_EMAILS_TABLE', 'wc_emails' );

//was our login form submitted
if( isset($_POST['wcaction']) && $_POST['wcaction'] == 'login' ) {
	McD_WC_Protected::login();
}


//go
add_action( 'init', 'McD_WC_Protected::init' );

//filter passwords
add_filter( 'post_password_required', 'McD_WC_Protected::filter_pwd', 1, 2 );
//add_filter( 'the_password_form', 'McD_WC_Protected::show_pwd_form_errors', 999 );

//
class McD_WC_Protected {

	/**
	 * init
	 * Register hooks and filters
	 * 
	 */
	public static function init() {

		//add menu item for CSV upload
		add_action( 'admin_menu', 'McD_WC_Protected::add_menu_item' );

		//change expiration of password cookie
		//add_filter( 'post_password_expires', 'McD_WC_Protected::filter_password_expires' );

		//custom password form
		add_filter( 'the_password_form', 'McD_WC_Protected::show_password_form' );

	}

	/**
	 * login
	 * Attempt to auth the user for WC
	 * 
	 */
	public static function login() {

		//
		$email = filter_var( $_POST['wc_password'], FILTER_VALIDATE_EMAIL );

		if( ! $email )
			$email = 0;

		//set this as a cookie
		//setcookie( WC_PROTECTED_EMAILS_COOKIE_NAME, md5($email), time()+3600, "/" );
		//setcookie( WC_PROTECTED_EMAILS_COOKIE_NAME, $email, (time()+3600), "/", $_SERVER['HTTP_HOST'], 1, 1 );
		//setcookie('NO_CACHE', '1', time()+0, "/water-cases-information-page");
		setcookie( WC_PROTECTED_EMAILS_COOKIE_NAME, $email, (time()+3600), "/" );

		wp_redirect( get_permalink(WC_PROTECTED_PAGE_ID) );
		exit;
	}

	/**
	 * filter_password_expires
	 * change default expiration of password cookie for security
	 *
	 * @see https://developer.wordpress.org/reference/hooks/post_password_expires/
	 * 
	 */
	public static function filter_password_expires( $expires ) {
		return 0;
	}

	/**
	 * show_password_form
	 * Custom password form
	 * 
	 */
	public static function show_password_form( $output ) {
		global $post;

		//
		if( $post->ID !== WC_PROTECTED_PAGE_ID )
			return $output;

		ob_start();
		?>

			<form action="<?php echo get_permalink(WC_PROTECTED_PAGE_ID); ?>" class="post-password-form" method="post">
				<?php if( ! is_null($_COOKIE[WC_PROTECTED_EMAILS_COOKIE_NAME]) ) : ?>
					<p style="color: red;">The password you entered was invalid</p>
				<?php endif; ?>
				<p>This content is password protected. To view it please enter your password below:</p>
				<p>
					<label for="pwbox-16163">Password: <input name="wc_password" type="password"></label> <input type="submit" value="Enter">
				</p>
				<input type="hidden" name="wcaction" value="login">
			</form>

			<style type="text/css">
			.post-password-errors { display: none !important; }
			</style>

		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	/**
	 * filter_pwd
	 * Check our CSV for valid emails
	 *
	 */
	public static function filter_pwd( $required, $post ) {
		global $wpdb;

		//ensure this is the wc protected page
		if( ! $post->ID || $post->ID !== WC_PROTECTED_PAGE_ID )
			return $required;

		//if a pwd hasn't been entered yet...
		//checking our custom cookie now
		if( ! isset( $_COOKIE[WC_PROTECTED_EMAILS_COOKIE_NAME] ) )
			return $required;

		//lets assume invalid for the time being...
		$required = true;

		//get valid emails from the post meta
		//$emails = get_post_meta( WC_PROTECTED_PAGE_ID, WC_PROTECTED_EMAILS_META_KEY, true );

		//get the pwd entered and check against email list
		$hash = wp_unslash( $_COOKIE[WC_PROTECTED_EMAILS_COOKIE_NAME] );
		$hash = filter_var( $hash, FILTER_SANITIZE_STRING );
		//$hasher = new PasswordHash( 8, true );
		
		//
		$query = $wpdb->prepare("SELECT email FROM " . WC_PROTECTED_EMAILS_TABLE . " WHERE email = %s", $hash);

		//
		$result = $wpdb->get_row($query);

		//if not found, pwd required
		if( ! $result ) {
			return $required;
			//return wp_redirect( get_permalink(WC_PROTECTED_PAGE_ID) . "?wcinvalidpwd=1" );
		}

		//pwd found! return not pwd not required
		return false;
	}

	/**
	 * show_pwd_form_errors
	 * Show errors when an incorrect password
	 * is entered
	 * 
	 */
	public static function show_pwd_form_errors( $output ) {

		//if the password is set and we are showing this, it must be invalid...
		if( isset( $_COOKIE[WC_PROTECTED_EMAILS_COOKIE_NAME] ) ) {
			$errors = '<div class="post-password-errors">';
			 $errors .= 'Incorrect password entered. Please try again.';
			$errors .= '</div>';

			$output = $errors . $output;
		}

		return $output;
	}

	/**
	 * add_menu_item
	 * Add the CSV upload page under the Tools menu
	 * 
	 */
	public static function add_menu_item() {
		add_management_page('WC Emails', 'Upload WC Emails', 'manage_options', 'Upload WC Emails', 'McD_WC_Protected::build_menu_page');
	}

	/**
	 * build_menu_page
	 * UI for the WC Emails upload CSV
	 * 
	 */
	public static function build_menu_page() {

		//Was the form submitted?
		if( isset( $_FILES['wc-emails'] ) ) {

			ini_set('auto_detect_line_endings', true);

			//parse the CSV
			$data = array_map('str_getcsv', file( $_FILES["wc-emails"]["tmp_name"] , FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
			$emails = [];
			$failures = [];
			
			//ensure each is an email and then save to the post as meta
			foreach( $data as $row ) {

				//ensure we have something in the row
				if( ! isset($row[0]) || empty($row[0]) )
					continue;

				//sanitize the email
				$email = filter_var( $row[0], FILTER_SANITIZE_EMAIL );

				//validate
				if( ! filter_var($email, FILTER_VALIDATE_EMAIL) ) {
					$failures[] = $email;
					continue;
				}

				//$emails[] = md5( filter_var( $email, FILTER_SANITIZE_EMAIL ) );
				$emails[] = filter_var( $email, FILTER_SANITIZE_EMAIL );
			}
			
			//save
			//$wc_emails_saved = update_post_meta( WC_PROTECTED_PAGE_ID, WC_PROTECTED_EMAILS_META_KEY, $emails );
			$wc_emails_saved = self::save_emails($emails);
		}
		

		//output ui
		?>

		<div class="wc-emails-upload">

			<?php //if processed, output results ?>
			<?php if( isset($wc_emails_saved) && $wc_emails_saved ) : ?>
				<div class="wc-upload-results">
					<h2>File successfully processed</h2>
					<p>
						<span style="color: green;"><?php echo count($emails); ?> successfully added.</span><br>
						<span style="color: red;"><?php echo count($failures); ?> failures.</span>
						<?php if( ! empty($failures) ) : ?>
							<ul>
								<?php foreach( $failures as $failure ) : ?>
									<li style="color: red;"><?php echo $failure; ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</p>

					<br><hr><br>
				</div>
			<?php endif; ?>

			<h1>Upload Emails</h1>
			<p>Upload a CSV of email addresses. Email adresses should be the first and only column in the sheet.</p>

			<form action="" method="POST" enctype="multipart/form-data">
				<input type="file" name="wc-emails" accept=".csv"><br><br>
				<input type="submit" value="Upload" class="button-primary">
			</form>

		</div>

		<?php
	}

	/**
	 * save_emails
	 *
	 * @param (array) emails
	 */
	public static function save_emails( $emails ) {
		global $wpdb;

		//start by deleting all current emails
		$wpdb->query( "DELETE FROM " . WC_PROTECTED_EMAILS_TABLE );

		//now add each row
		$query = "INSERT INTO " . WC_PROTECTED_EMAILS_TABLE . " (email) VALUES ";
		$inserts = [];

		//
		foreach( $emails as $email ) {
			$inserts[] = "(\"" . trim(strtolower($email)) . "\")";
		}

		//
		$query .= implode(", ", $inserts);
		unset($inserts);

		//insert
		$insert = $wpdb->query( $query );

		return ($insert) ? true : false;
	}

}