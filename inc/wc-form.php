<?php

define('WC_FORM_PAGE_ID', 15822);
define('WC_FORM_REFERRAL_KEY', 'referral-number');

add_action('wp_ajax_wcform', 'McD_WC_Form::listen');
add_action('wp_ajax_nopriv_wcform', 'McD_WC_Form::listen');

//
class McD_WC_Form {

	private $conn = false;

	/**
	 * listen()
	 *
	 * Listen for requests
	 */
	public static function listen() {

		$data = $_POST;

		//dump action
		unset( $data['action'] );

		//build sql statements
		$statements = [];

		//process data
		for( $i = 0; $i < count($data['kc']); $i++ ) {

			//sanitize data
			$case = filter_var( $data['rnumber'][$i] );

			$kc = filter_var( $data['kc'][$i] );
			$kc_date = filter_var( $data['kc_date'][$i] );
			if( empty($kc_date) ) $kc_date = NULL;

			$tc = filter_var( $data['tc'][$i] );
			$tc_date = filter_var( $data['tc_date'][$i] );
			if( empty($tc_date) ) $tc_date = NULL;

			$uc = filter_var( $data['uc'][$i] );
			$uc_date = filter_var( $data['uc_date'][$i] );
			if( empty($uc_date) ) $uc_date = NULL;

			$td = filter_var( $data['td'][$i] );
			$td_date = filter_var( $data['td_date'][$i] );
			if( empty($td_date) ) $td_date = NULL;

			$pg = filter_var( $data['pg'][$i] );
			$pg_date = filter_var( $data['pg_date'][$i] );
			if( empty($pg_date) ) $pg_date = NULL;

			$hc = filter_var( $data['hc'][$i] );
			$hc_date = filter_var( $data['hc_date'][$i] );
			if( empty($hc_date) ) $hc_date = NULL;

			$other = filter_var( $data['otherd'][$i] );
			$dr = filter_var( $data['dr'][$i] );

			//validate data
			$errs = [];

			//ensure yes or no answers
			if( 
				! in_array($kc, ['no', 'yes']) 
				|| ! in_array($tc, ['no', 'yes']) 
				|| ! in_array($uc, ['no', 'yes']) 
				|| ! in_array($td, ['no', 'yes']) 
				|| ! in_array($pg, ['no', 'yes'])
				|| ! in_array($hc, ['no', 'yes']) 
			) {
				$errs[] = 'Please select yes or no for all questions.';
			}

			//require a date for the selection?

			//any errors?
			if( ! empty($errs) ) {
				header('Content-Type: application/json');
				die( json_encode([
					'code' => 400,
					'errors' => $errs
				]) );
			}

			//build statement
			$has_kc = ( $kc == 'no' ) ? 0 : 1;
			$has_tc = ( $tc == 'no' ) ? 0 : 1;
			$has_uc = ( $uc == 'no' ) ? 0 : 1;
			$has_td = ( $td == 'no' ) ? 0 : 1;
			$has_pg = ( $pg == 'no' ) ? 0 : 1;
			$has_hc = ( $hc == 'no' ) ? 0 : 1;
			$has_other = ( empty($other) ) ? 0 : 1;

			//$today = new DateTime();
			//$todayf = $today->format('m/d/Y');

			//$statements = "PutHubSpotMailOut {$case},{$has_kc},'{$kc_date}',{$has_tc},'{$tc_date}',{$has_uc},'{$uc_date}',{$has_td},'{$td_date}',{$has_pg},'{$pg_date}',{$has_hc},'{$hc_date}',{$has_other},'{$other}','{$dr}'";

			$statement = "PutHubSpotMailOut {$case},{$has_kc},";
			$statement .= ( $kc_date ) ? "'{$kc_date}'," : 'NULL,';
			$statement .= "{$has_tc},";
			$statement .= ( $tc_date ) ? "'{$tc_date}'," : 'NULL,';
			$statement .= "{$has_uc},";
			$statement .= ( $uc_date ) ? "'{$uc_date}'," : 'NULL,';
			$statement .= "{$has_td},";
			$statement .= ( $td_date ) ? "'{$td_date}'," : 'NULL,';
			$statement .= "{$has_pg},";
			$statement .= ( $pg_date ) ? "'{$pg_date}'," : 'NULL,';
			$statement .= "{$has_hc},";
			$statement .= ( $hc_date ) ? "'{$hc_date}'," : 'NULL,';
			$statement .= "{$has_other},'{$other}','{$dr}'";

			$statements[] = $statement;
		}

		//send request to DB
		$wc = new McD_WC_Form();
		$conn = $wc->connect();

		//process each statement
		$results = [];

		foreach( $statements as $statement ) {
			$result = sqlsrv_query( $conn, $statement );

			if( ! $result ) {
				$results[] = [$statement, sqlsrv_errors()];
				continue;
			}

			$results[] = [$statement, $result];
		}

		//all good
		header('Content-Type: application/json');
		die( json_encode([
			'code' => 200,
			'redirect' => '/water-confirmation'
		]) );

	}

	/**
	 * connect()
	 *
	 * Attempt to connect to the WC SQL Server
	 * @return resource
	 */
	private function connect() {

		//use existing connection
		if( $conn )
			return $conn;

		//connect
		/*
		$conn = sqlsrv_connect('45.62.182.71,6654', [
			'Authentication' => 'SqlPassword',
			'Database' => 'MLFDEV01\SGREEN',
			'PWD' => '\|/473rwater3verYwher3~',
			'UID' => 'Hubspot',
			'TrustServerCertificate' => true,
			'Encrypt' => true
		]);
		*/

		$conn = sqlsrv_connect('45.62.182.71,6654', [
			'Authentication' => 'SqlPassword',
			'Database' => 'REFERRAL',
			'PWD' => 'W@t3rW0r1d',
			'UID' => 'Hubspot',
			'TrustServerCertificate' => true,
			'Encrypt' => true
		]);

		if( ! $conn ) {
			__debug([ 'Can not connect to the database server', sqlsrv_errors() ]);
		}

		$this->$conn = $conn;
		return $conn;
	}

	/**
	 * lookup()
	 *
	 * Attempt to lookup a case number
	 *
	 * @param  $number the case number
	 * @return array of cases
	 */
	public function lookup( $number ) {

		$conn = $this->connect();

		$result = sqlsrv_query( $conn, "GetHubSpotMailOut {$number}" );

		if( ! $result ) {
			__debug(['Query Error', $result]);
		}

		//move results to an array
		$cases = [];

		while( $item = sqlsrv_fetch_array($result) ) {
			$cases[] = $item;
		}

		return $cases;
	}

}
