<?php

add_action( 'wp_ajax_hs_form_submit', 'McDivitt_Form_Handler::handle_submit' );
add_action( 'wp_ajax_nopriv_hs_form_submit', 'McDivitt_Form_Handler::handle_submit' );
add_action( 'wp_footer', 'McDivitt_Form_Handler::add_js' );

add_shortcode( 'hsform', 'McDivitt_Form_Handler::output_form' );

//
class McDivitt_Form_Handler {

	/**
     *	Submit to Hubspot
     *
     */
	public static function submit_to_hubspot( $data ) {

		$portal_id = '1790085';

        // See: http://developers.hubspot.com/docs/methods/forms/submit_form
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $phone = empty($data['phone']) ? 'n/a' : $data['phone'];
        $case_details = empty($data['case_details']) ? 'n/a' : $data['case_details'];
        $email = $data['email'];

        $hubspotutk      = ( isset($_COOKIE['hubspotutk']) ) ? $_COOKIE['hubspotutk'] : [];
        $hs_context      = array(
            'hutk' => $hubspotutk,
            'ipAddress' => $_SERVER['REMOTE_ADDR'],
            'pageUrl' => $data['page_url'],
            'pageName' => $data['page_title']
        );

        // Need to populate these varilables with values from the form.
        $str_post = "firstname=" . urlencode($firstname)
                  . "&lastname=" . urlencode($lastname)
                  . "&email=" . urlencode($email)
                  . "&phone=" . urlencode($phone)
                  . "&case_details=" . urlencode($case_details)
                  //. "&unique_id_for_captorra_match=" . urlencode($data['unique_id'])
                  . "&hs_context=" . urlencode( json_encode($hs_context) );

        // Replace the values in this URL with your portal ID and your form GUID
        $endpoint = sprintf('https://forms.hubspot.com/uploads/form/v2/%s/%s', $portal_id, $data['form_id']);

        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
        @curl_setopt($ch, CURLOPT_URL, $endpoint);
        @curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded'
        ));
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response    = @curl_exec($ch); //Log the response from HubSpot as needed.
        $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
        @curl_close($ch);

        //log the captorra response
        error_log( 'HubSpot Response:' );
        error_log( json_encode($response) );

        return ($status_code == '404' || $status_code == '500') ? false : true;
    }

    /**
     *	Submit to Captorra
     *
     */
    public static function submit_to_captorra( $data ) {
        $url = 'http://capweb01.captorra.com:89/LidogeneratorService.svc/rest/create';

        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $phone = empty($data['phone']) ? 'n/a' : $data['phone'];
        $case_details = empty($data['case_details']) ? 'n/a' : $data['case_details'];
        $email = $data['email'];

        //$page_url = $_POST['page_url'];
        //$page_title = $_POST['page_title'];

        $fields = array(
            'LidogeneratorId' => urlencode('329194'),
            'Referrer' => urlencode('6abadb6d-411f-e411-8f33-00155d5d2601'),
            'First Name' => urlencode($firstname),
            'Last Name' => urlencode($lastname),
            'Telephone Number' => urlencode($phone),
            'Alt Telephone Number' => urlencode('n/a'),
            'Email Address' => urlencode($email),
            'Address' => urlencode('n/a'),
            'City' => urlencode('n/a'),
            'State' => urlencode('n/a'),
            'Zip Code' => urlencode('n/a'),
            'Case Details' => urlencode($case_details),
            'Type of Case' => urlencode('n/a'),
            'Contact Source' => urlencode('n/a'),
            'HubspotID' => urlencode($data['unique_id'])
        );

        // url-ify the data for the POST
        $fields_string = '';
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        $fields_string = rtrim($fields_string, '&');

        $data_string = json_encode( $fields );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute post
        $response = curl_exec($ch);
        curl_close($ch);

        //log the captorra response
        error_log( 'Captorra Response:' );
        error_log( json_encode($response) );

        return ( ! $response ) ? false : true;
    }

    /**
     * submit_to_salesforce
     * Submit data to Force.com, Salesforce API
     * 
     */
    public static function submit_to_salesforce( $data ) {

        $url = 'https://mcdivitt-intakes.secure.force.com/api/services/apexrest/litify_pm/api/v1/intake/create';

        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $phone = empty($data['phone']) ? 'n/a' : $data['phone'];
        $case_details = empty($data['case_details']) ? 'n/a' : $data['case_details'];
        $email = $data['email'];

        //
        $fields = array(
            'firstName' => $firstname,
            'lastName' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'Contact_Method' => 'Web/Lead',
            'intakeStatus' => 'Pending',
            'caseType' => 'New Lead',
            'desctription' => $case_details
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // Execute post
        $response = curl_exec($ch);
        curl_close($ch);

        //log the salesforce response
        error_log( 'SalesForce Response:' );
        error_log( json_encode($response) );

        //
        return true;
        //return ( ! $response ) ? false : true;
    }
	
	
	/**
     * submit_to_pin_capture_forms
     * Submit data to the PIN Portal
     * 
     */
	
	public static function submit_to_pin_capture_forms( $data ) {
		$url = 'https://app.pinbusinessnetwork.com/SaveContact/791bd2c4-851b-4827-bfa8-a42f27c969b1';

        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $phone = empty($data['phone']) ? 'n/a' : $data['phone'];
        $case_details = empty($data['case_details']) ? 'n/a' : $data['case_details'];
        $email = $data['email'];
        $pagetitle = $data['page_title'];
        $pageurl = $data['page_url'];
        $pit_pagehit = $data['pit_pagehit'];
        $ip_address = $data['ip_address'];
        $pit_ipaddress = $data['pit_ipaddress'];
        $formid = $data['form_id'];
      
		 $fields = array(
            'first_name' => $firstname,
            'last_name' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'page_title' => $pagetitle,
            'page_url' => $pageurl,
            'pit_pagehit' => $pit_pagehit,
            'ip_address' => $ip_address,
            'pit_ipaddress' => $pit_ipaddress, 
            'form_id' => $formid,
            'contact_method' => 'Web/Lead',
            'intake_status' => 'Pending',
            'case_type' => 'New Lead',
            'desctription' => $case_details
        );
		
		$postFields = http_build_query($fields);
		
		 // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute post
        $response = curl_exec($ch);
        curl_close($ch);

        //log the salesforce response
        error_log( 'Pin Capture Form Response:' );
        error_log( json_encode($response) );

        //
        return true;
        //return ( ! $response ) ? false : true;
		
		
	}
	
    /**
     *	Handle Submit via AJAX
     *
     */
    public static function handle_submit() {

    	$ers = array();

    	//sanitize
    	$data = array(
    		'firstname' => filter_var( $_POST['firstname'], FILTER_SANITIZE_STRING ),
    		'lastname' => filter_var( $_POST['lastname'], FILTER_SANITIZE_STRING ),
    		'email' => filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ),
    		'phone' => filter_var( $_POST['phone'], FILTER_SANITIZE_STRING ),
    		'case_details' => filter_var( $_POST['case_details'], FILTER_SANITIZE_STRING ),
    		'form_id' => filter_var( $_POST['form_id'], FILTER_SANITIZE_STRING ),
    		'page_url' => filter_var( $_POST['page_url'], FILTER_SANITIZE_URL ),
            'page_title' => filter_var( $_POST['page_title'], FILTER_SANITIZE_STRING ),
            'pit_pagehit' => filter_var( $_POST['pit_pagehit'], FILTER_SANITIZE_STRING ),
            'pit_ipaddress' => filter_var( $_POST['pit_ipaddress'], FILTER_SANITIZE_STRING ),
            'ip_address' => filter_var( $_POST['ip_address'], FILTER_SANITIZE_STRING ),
    		'unique_id' => ( uniqid( time() ) )
    	);

        //
        error_log( json_encode($_POST) );

        //
        if( ! empty($_POST['email_alt2']) ) {
            error_log("Captcha!");
            self::ajax_response(500, "Network error. Please try again.");
        }

        //verify first name and last name
        if( empty($data['firstname']) || empty($data['lastname']) ) {
            self::ajax_response(500, 'First and last name required.');
        }

        //get redirect link
        $redirect = get_option('siteurl') . '/free-case-evaluation/thank-you';    //default
        
        if( isset( $_POST['redirect'] ) ) {
            $redirect = get_option('siteurl') . filter_var( $_POST['redirect'], FILTER_SANITIZE_URL );
        }

        
        //submit to Force.com (Salesforce)
        if( ! self::submit_to_salesforce( $data ) ) {
            $ers[] = 'Unable to submit lead to SalesForce ';
        }
		
		 //submit to Pin Capture Forms
        if( ! self::submit_to_pin_capture_forms( $data ) ) {
            $ers[] = 'Unable to submit lead to Pin Capture Forms ';
        }
        
        

//     	//submit to hubspot
//         if( empty($ers) ) {
//         	if( ! self::submit_to_hubspot( $data ) ) {
//         		$ers[] = 'Unable to submit lead to Hubspot ';
//         	}
//         }

    	//submit to captora
    	/*if( ! self::submit_to_captorra( $data ) ) {
    		$ers[] = 'Unable to submit lead to Captorra due to network error.';
    	}*/
       
        if( ! empty($ers) ) {
            error_log("Form Submission Error");
            error_log(json_encode($ers));
            error_log(json_encode($data));

            self::ajax_response( 500, 'Something went wrong. Please try again. If problems persist, please call us.' );
        }

        //all done
        self::ajax_response( 200, 'Thank you for your submission.', array( 'redirect' => $redirect ) );
    }

    /**
     *	Ajax Response
     *
     */
    public static function ajax_response( $status, $message = '', $data = array() ) {

    	header("Content-Type: application/json");
    	die(json_encode(array(
    		'status' => $status,
    		'message' => $message,
    		'data' => $data
    	)));

    	exit;
    }

    /**
     *	Add JS
     */
    public static function add_js() {
    	?>

    	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
    	<script type="text/javascript">
    	jQuery(document).ready(function($) {

            //
            var isSubmitting = false;

    		//
    		var hsSubmit = function( form ) {

                //prevent duplicates
                if( isSubmitting ) return;
                isSubmitting = true;

                //
    			var form = $(form),
    				wrap = form.closest('.hbspt-form');

    			//send
    			$.ajax({
    				url: '<?php echo admin_url('admin-ajax.php'); ?>',
    				type: 'POST',
    				data: form.serialize(),
    				success: function( response ) {

    					//if success, show message
    					if( response.status == 200 && response.data.redirect ) {
                            window.location.href = response.data.redirect;
    					}else {

                            //allow submissions again
                            isSubmitting = false;

                            //
                            if( response.message ) {
                                alert( response.message );
                            }

                        }

    				}
    			});

    			return false;

    		};

    		//validate
            $('form.hs-form').each(function() {

                $(this).validate({
                    submitHandler: function( form ) {
                        hsSubmit( form );
                    }
                });

            });

    		

    	});
    	</script>

    	<?php
    }

    /**
     *	Sidebar Form
     *	Handled via a Shortcode
     *
     */
    public static function output_form( $atts ) {
    	global $post;

        $atts = array_merge( array(
            'id' => '3c8a36f5-9d5f-49ba-9536-1bab9d60ff05',
            'redirect' => '/free-case-evaluation/thank-you',
            'spanish' => 'no'
        ), $atts );

    	/*
		  Original HubSpot embed code

    	  <!--[if lte IE 8]>
	      <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
	      <![endif]-->
	      <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
	      <script>
	        hbspt.forms.create({ 
	          css: '',
	          portalId: '1790085',
	          formId: '3c8a36f5-9d5f-49ba-9536-1bab9d60ff05'
	        });
	      </script>
    	*/

        //Language settings
        $lang_firstname = 'First Name';
        $lang_lastname = 'Last Name';
        $lang_email = 'Email';
        $lang_phone = 'Phone Number';
        $lang_ta = 'How can we help you?';
        $lang_submit = 'Get Help Now';
        $lang_required = 'This field is required.';

        //check for spanish form
        if( $atts['spanish'] === 'yes' ) {
            $lang_firstname = 'Nombre';
            $lang_lastname = 'Apellido';
            $lang_email = 'Correo Electrónico';
            $lang_phone = 'Teléfono';
            $lang_ta = 'Como podemos ayudarte?';
            $lang_submit = 'Consigue Ayuda';
            $lang_required = 'Por favor, rellene este campo obligatorio.';
        }

        //if a button name was supplied, use that instead
        if( isset( $atts['button'] ) )
            $lang_submit = $atts['button'];

		ob_start();

	    ?>

	    <div class="hbspt-form" id="test">
		    <form novalidate="" accept-charset="UTF-8" action="#" enctype="multipart/form-data" id="hsForm_3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" method="POST" class="hs-form stacked hs-form-private hs-form-3c8a36f5-9d5f-49ba-9536-1bab9d60ff05_cd211e76-e73c-4d45-b334-5d2d7d37bc85" data-form-id="3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" data-portal-id="1790085" data-reactid=".hbspt-forms-0">
		        <div class="hs_firstname field hs-form-field" data-reactid=".hbspt-forms-0.0:$0">
		            <label class="" placeholder="Enter your First Name" for="firstname-3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" data-reactid=".hbspt-forms-0.0:$0.0"><span data-reactid=".hbspt-forms-0.0:$0.0.0"><?php echo $lang_firstname; ?></span><span class="hs-form-required" data-reactid=".hbspt-forms-0.0:$0.0.1">*</span></label>
		            <legend class="hs-field-desc" style="display:none;" data-reactid=".hbspt-forms-0.0:$0.1"></legend>
		            <div class="input" data-reactid=".hbspt-forms-0.0:$0.$firstname">
		                <input id="firstname-3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" class="hs-input invalid error" type="text" name="firstname" required="" value="" placeholder="<?php echo $lang_firstname; ?>" data-reactid=".hbspt-forms-0.0:$0.$firstname.0" data-msg="<?php echo $lang_required; ?>">
		            </div>
		        </div>
		        <div class="hs_lastname field hs-form-field" data-reactid=".hbspt-forms-0.0:$1">
		            <label class="" placeholder="Enter your Last Name" for="lastname-3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" data-reactid=".hbspt-forms-0.0:$1.0"><span data-reactid=".hbspt-forms-0.0:$1.0.0"><?php echo $lang_lastname; ?></span><span class="hs-form-required" data-reactid=".hbspt-forms-0.0:$1.0.1">*</span></label>
		            <legend class="hs-field-desc" style="display:none;" data-reactid=".hbspt-forms-0.0:$1.1"></legend>
		            <div class="input" data-reactid=".hbspt-forms-0.0:$1.$lastname">
		                <input id="lastname-3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" class="hs-input" type="text" name="lastname" required="" value="" placeholder="<?php echo $lang_lastname; ?>" data-reactid=".hbspt-forms-0.0:$1.$lastname.0" data-msg="<?php echo $lang_required; ?>">
		            </div>
		        </div>
		        <div class="hs_email field hs-form-field" data-reactid=".hbspt-forms-0.0:$2">
		            <label class="" placeholder="Enter your Email" for="email-3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" data-reactid=".hbspt-forms-0.0:$2.0"><span data-reactid=".hbspt-forms-0.0:$2.0.0"><?php echo $lang_email; ?></span><span class="hs-form-required" data-reactid=".hbspt-forms-0.0:$2.0.1">*</span></label>
		            <legend class="hs-field-desc" style="display:none;" data-reactid=".hbspt-forms-0.0:$2.1"></legend>
		            <div class="input" data-reactid=".hbspt-forms-0.0:$2.$email">
		                <input id="email-3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" class="hs-input" type="email" name="email" required="" placeholder="<?php echo $lang_email; ?>" value="" data-reactid=".hbspt-forms-0.0:$2.$email.0" data-msg="<?php echo $lang_required; ?>">
		            </div>
		        </div>
		        <div class="hs_phone field hs-form-field" data-reactid=".hbspt-forms-0.0:$3">
		            <label class="" placeholder="Enter your Phone Number" for="phone-3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" data-reactid=".hbspt-forms-0.0:$3.0"><span data-reactid=".hbspt-forms-0.0:$3.0.0"><?php echo $lang_phone; ?></span></label>
		            <legend class="hs-field-desc" style="display:none;" data-reactid=".hbspt-forms-0.0:$3.1"></legend>
		            <div class="input" data-reactid=".hbspt-forms-0.0:$3.$phone">
		                <input id="phone-3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" class="hs-input" type="tel" name="phone" value="" placeholder="<?php echo $lang_phone; ?>" data-reactid=".hbspt-forms-0.0:$3.$phone.0">
		            </div>
		        </div>
		        <div class="hs_case_details field hs-form-field" data-reactid=".hbspt-forms-0.0:$4">
		            <label class="" placeholder="Enter your How can we help you?" for="case_details-3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" data-reactid=".hbspt-forms-0.0:$4.0"><span data-reactid=".hbspt-forms-0.0:$4.0.0"><?php echo $lang_ta; ?></span></label>
		            <legend class="hs-field-desc" style="display:none;" data-reactid=".hbspt-forms-0.0:$4.1"></legend>
		            <div class="input" data-reactid=".hbspt-forms-0.0:$4.$case_details">
		                <textarea id="case_details-3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" class="hs-input" name="case_details" placeholder="" data-reactid=".hbspt-forms-0.0:$4.$case_details.0"></textarea>
		            </div>
		        </div>
		        <div class="hs_unique_id_for_captorra_match field hs-form-field" style="display:none;" data-reactid=".hbspt-forms-0.0:$5">
		            <label class="" placeholder="Enter your Unique ID for Captorra Match" for="unique_id_for_captorra_match-3c8a36f5-9d5f-49ba-9536-1bab9d60ff05" data-reactid=".hbspt-forms-0.0:$5.0"><span data-reactid=".hbspt-forms-0.0:$5.0.0">Unique ID for Captorra Match</span></label>
		            <legend class="hs-field-desc" style="display:none;" data-reactid=".hbspt-forms-0.0:$5.1"></legend>
		            <div class="input" data-reactid=".hbspt-forms-0.0:$5.$unique_id_for_captorra_match">
		                <input name="unique_id_for_captorra_match" class="hs-input" type="hidden" value="" data-reactid=".hbspt-forms-0.0:$5.$unique_id_for_captorra_match.0">
		            </div>
		        </div>
                
		        <div class="hs_submit" data-reactid=".hbspt-forms-0.3">
		            <div class="hs-field-desc" style="display:none;" data-reactid=".hbspt-forms-0.3.0"></div>
		            <div class="actions" data-reactid=".hbspt-forms-0.3.1">
		                <input type="submit" value="<?php echo $lang_submit; ?>" class="hs-button primary large" data-reactid=".hbspt-forms-0.3.1.0">
		            </div>
		        </div>
		        
                <input type="hidden" name="pit_pagehit" value="" /> 
                <input type="hidden" name="pit_ipaddress" value="" /> 
                <input type="hidden" name="ip_address" value="<?php  echo $_SERVER['REMOTE_ADDR'] ?>" />
		        <input type="hidden" name="page_title" value="<?php the_title(); ?>">
		        <input type="hidden" name="page_url" value="<?php the_permalink(); ?>">
		        <input type="hidden" name="form_id" value="<?php echo $atts['id']; ?>">
                <input type="hidden" name="redirect" value="<?php echo $atts['redirect']; ?>">
		        <input type="hidden" name="action" value="hs_form_submit">

                <?php //wp_nonce_field( 'hsform_nonce'.$atts['id'] ); ?>

                <input type="hidden" name="email_alt2" value="">
		    </form>
		</div>

		<?php

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
    }

    /**
     *  Debug helper
     *
     */
    public static function __debug( $data ) {

        echo '<pre>';
            print_r( $data );
        echo '</pre>';
        exit;

    }

}