<?php
 session_start();
/**
 * cashBaba Express Class
 */
class WC_cashBabaExpress {

   // const base_url = 'https://www.cashbaba.co:6081/api/Payment/SPExprSale';
    private $table = 'wc_cashbaba_express';

    function __construct() {
        add_action( 'wp_ajax_wc-cashBaba-express-confirm-trx', array($this, 'process_form') );

        add_action( 'woocommerce_order_details_after_order_table', array($this, 'transaction_form_order_view') );
    }

    function transaction_form_order_view( $order ) {
		
        if ( $order->has_status( 'on-hold' ) && $order->payment_method == 'cashBabaExpress' && ( is_view_order_page() || is_order_received_page())) {
			 
			  $option = get_option( 'woocommerce_cashBabaExpress_settings', array() );
			 ?>
			 
			 <div class="wc-cashBabaExpress-form-wrap" style="background: #eee;padding: 15px;border: 1px solid #ddd; margin: 15px 0;">
				<div id="wc-cashBabaExpress-result"></div>
				<form action="" method="post" id="wc-cashBabaExpress-confirm" class="wc-cashBabaExpress-form">
					<p class="form-row validate-required">
						<label><?php _e( 'Virtual Cash Number', 'wc-cashbaba_express' ) ?>: <span class="required">*</span></label>

						<input class="input-text" type="text" name="cashBabaExpress_trxid" placeholder="Virtual Cash Number" required />
						<span class="description"><?php echo isset( $option['trans_help'] ) ? $option['trans_help'] : ''; ?></span>
					</p>

					<p class="form-row">
						<?php wp_nonce_field( 'wc-cashBabaExpress-confirm-trx' ); ?>
						<input type="hidden" name="action" value="wc-cashBabaExpress-confirm-trx">
						<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

						<?php $pay_order_button_text = apply_filters( 'wc_cashBabaExpress_pay_order_button_text', __( 'Confirm Payment', 'wc-cashBabaExpress' ) ); ?>
						<input type="submit" class="button alt" id="wc-cashBabaExpress-submit" value="<?php echo esc_attr( $pay_order_button_text ); ?>" />
					</p>
				</form>
			</div>
			 
			 
			 
			 <?php
			if( $_POST['cashBabaExpress_trxid'] != NULL){
				 $items =  $order->get_items();
				 $quantities = "";
				 foreach($items as $value){
					 $quantities += $value['qty'];
					}
	
				$option = get_option( 'woocommerce_cashBabaExpress_settings', array() );
				
				 $merchantId     = isset( $option['merchant_Id']) ? $option['merchant_Id'] : '' ;
				 $merchantKey    = isset( $option['merchant_Key']) ? $option['merchant_Key'] : '' ;
				 $returnUrl      = isset( $option['return_Url']) ? $option['return_Url'] : '' ;
				 $order_id       = isset( $_POST['order_id'] ) ? intval( $_POST['order_id'] ) : 0;
				 $transaction_id = sanitize_key( $_POST['cashBabaExpress_trxid'] );
				 
				 $orders         = wc_get_order( $order );
				 $OrderToralPay  = $orders->get_total();
				 
				 $OrderId  		 =  $orders ->id;
				 $totalPay  	 = $OrderToralPay;
				 $quantities;
				
				$today	  = date("m-d-Y");
				//$orderNo  = time(); 
				
				$data = array(
					"MerchantId" 			 => $merchantId,
					"MerchantSecurityKey" 	 => $merchantKey,
					"VirtualAccountNumber"   => $transaction_id,
					"NoOfItems" 			 => $quantities,
					"OrderId" 				 => $OrderId,
					"OrderAmount" 			 => $totalPay,
					"ExpectedSettlementDate" => $today,
					"ReturnUrl" 			 => $returnUrl
				 );
				
				/*echo "<pre>";
					print_r($data);
				echo "</pre>";
				exit;*/
				
				//$url = 'https://www.cashbaba.co:6081/api/Payment/SPExprSale'; 

			//$url = 'https://sanapi.cashbaba.com.bd/api/Payment/SPExprSale';
               $url = 'https://api.cashbaba.com.bd/api/Payment/SPExprSale';
				$jdata = json_encode($data);
			
				//print_r($jdata);
			
			
				//open connection
				$ch = curl_init();

				//set the url, number of POST vars, POST data
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch,CURLOPT_POST, count($data));
				curl_setopt($ch,CURLOPT_POSTFIELDS, $jdata);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
					'Content-Type: application/json')                                                                       
				);       

				//execute post
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				 $result = curl_exec($ch);
				 $receivedData = json_decode($result,true);
				 
				 
				/*echo "<pre>";
					print_r($receivedData);
				echo "</pre>";
				echo "<br/>";
				exit;*/
				
				// Check for errors and display the error message
				if($errno = curl_errno($ch)) {
					$error_message = curl_strerror($errno);
					echo "cURL error ({$errno}):\n {$error_message}";
				}

				//close connection
				curl_close($ch);   
			
				//$url = $ProvideUrl;
				$msg = $receivedData['Message'];
			 
			
			 
				//exit;
				if($msg == 'Ok'){
				
					$_SESSION['TransactionId']    	    =  $receivedData['TransactionId'];
					$_SESSION['OrderId'] 					=  $receivedData['OrderId'];
					$_SESSION['OrderAmount']      		=  $receivedData['OrderAmount'];
					$_SESSION['CustomerName']     		=  $receivedData['CustomerName'];
					$_SESSION['TransactionDate']  		=  $receivedData['TransactionDate'];
					$_SESSION['IsOTPRequired']    		=  $receivedData['IsOTPRequired'];
					$_SESSION['TransactionCurrencyCode']  =  $receivedData['TransactionCurrencyCode'];
					$_SESSION['IsOperationSuccessful'] 	   =  $receivedData['IsOperationSuccessful'];
					
					header('Location:'.$returnUrl);
					exit;
				
				}else{
				
					/*echo "<pre>";
						print_r($receivedData);
					echo "</pre>";
					echo "<br/>";*/
					
					echo $msg;
				}
			
			}
			
           // self::tranasaction_form( $order->id );
			
        }
    }

    /**
     * Show the payment field in checkout
     *
     * @return void
     */
    public static function tranasaction_form( $order_id ) {
       // $option = get_option( 'woocommerce_cashBabaExpress_settings', array() );
        ?>

        <div class="wc-cashBabaExpress-form-wrap" style="background: #eee;padding: 15px;border: 1px solid #ddd; margin: 15px 0;">
            <div id="wc-cashBabaExpress-result"></div>
            <form action="" method="post" id="wc-cashBabaExpress-confirm" class="wc-cashBabaExpress-form">
                <p class="form-row validate-required">
                    <label><?php _e( 'Virtual Cash Number', 'wc-cashbaba_express' ) ?>: <span class="required">*</span></label>

                    <input class="input-text" type="text" name="cashBabaExpress_trxid" placeholder="Virtual Cash Number" required />
                    <span class="description"><?php echo isset( $option['trans_help'] ) ? $option['trans_help'] : ''; ?></span>
                </p>

                <p class="form-row">
                    <?php wp_nonce_field( 'wc-cashBabaExpress-confirm-trx' ); ?>
                    <input type="hidden" name="action" value="wc-cashBabaExpress-confirm-trx">
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

                    <?php $pay_order_button_text = apply_filters( 'wc_cashBabaExpress_pay_order_button_text', __( 'Confirm Payment', 'wc-cashBabaExpress' ) ); ?>
                    <input type="submit" class="button alt" id="wc-cashBabaExpress-submit" value="<?php echo esc_attr( $pay_order_button_text ); ?>" />
                </p>
            </form>
        </div>

        <script type="text/javascript">
            /*jQuery(function($) {
                $('form#wc-cashBabaExpress-confirm').on('submit', function(event) {
                    event.preventDefault();

                    var submit = $(this).find('input[type=submit]');
                    submit.attr('disabled', 'disabled');

                    $.post('<?php echo admin_url( 'admin-ajax.php'); ?>', $(this).serialize(), function(data, textStatus, xhr) {
                        submit.removeAttr('disabled');

                        if ( data.success ) {
                            window.location.href = data.data;
                        } else {
                            $('#wc-cashBabaExpress-result').html('<ul class="woocommerce-error"><li>' + data.data + '</li></ul>');
                        }
                    });
                });
            }); */
        </script>
        <?php
    }

    public function process_form() {
		
		echo "hello";
		exit;
        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'wc-cashBabaExpress-confirm-trx' ) ) {
            wp_send_json_error( __( 'Are you cheating?', 'wc-cashBabaExpress' ) );
        }

        $order_id       = isset( $_POST['order_id'] ) ? intval( $_POST['order_id'] ) : 0;
        echo $transaction_id = sanitize_key( $_POST['cashBabaExpress_trxid'] );
	exit;
        $order          = wc_get_order( $order_id );
        $response       = $this->do_request( $transaction_id );

        if ( ! $response ) {
            wp_send_json_error( __( 'Something went wrong submitting the request', 'wc-cashBabaExpress' ) );
            return;
        }

        if ( $this->transaction_exists( $response->trxId ) ) {
            wp_send_json_error( __('This transaction has already been used!', 'wc-cashBabaExpress' ) );
            return;
        }

        /*switch ($response->trxStatus) {

            case '0010':
            case '0011':
                wp_send_json_error( __( 'Transaction is pending, please try again later', 'wc-cashBabaExpress' ) );
                return;

            case '0100':
                wp_send_json_error( __( 'Transaction ID is valid but transaction has been reversed. ', 'wc-cashBabaExpress' ) );
                return;

            case '0111':
                wp_send_json_error( __( 'Transaction is failed.', 'wc-cashBabaExpress' ) );
                return;

            case '1001':
                wp_send_json_error( __( 'Invalid MSISDN input. Try with correct mobile no.', 'wc-cashBabaExpress' ) );
                break;

            case '1002':
                wp_send_json_error( __( 'Invalid transaction ID', 'wc-cashBabaExpress' ) );
                return;

            case '1003':
                wp_send_json_error( __( 'Authorization Error, please contact site admin.', 'wc-cashBabaExpress' ) );
                return;

            case '1004':
                wp_send_json_error( __( 'Transaction ID not found.', 'wc-cashBabaExpress' ) );
                return;

            case '9999':
                wp_send_json_error( __( 'System error, could not process request. Please contact site admin.', 'wc-cashBabaExpress' ) );
                return;

            case '0000':
                $price = (float) $order->get_total();

                // check for BDT if exists
                $bdt_price = get_post_meta( $order->id, '_bdt', true );
                if ( $bdt_price != '' ) {
                    $price = $bdt_price;
                }

                if ( $price > (float) $response->amount ) {
                    wp_send_json_error( __( 'Transaction amount didn\'t match, are you cheating?', 'wc-cashBabaExpress' ) );
                    return;
                }

                $this->insert_transaction( $response );

                $order->add_order_note( sprintf( __( 'CashBaba Express payment completed with TrxID#%s! CashBaba Express amount: %s', 'wc-cashBabaExpress' ), $response->trxId, $response->amount ) );
                $order->payment_complete();

                wp_send_json_success( $order->get_view_order_url() );

                break;
        } */

        wp_send_json_error();
    }

    /**
     * Do the remote request
     *
     * For some reason, WP_HTTP doesn't work here. May be
     * some implementation related problem in their side.
     *
     * @param  string  $transaction_id
     *
     * @return object
     */
    function do_request( $transaction_id ) {

	
	     $items =  $order->get_items();
		 $quantities = "";
		 foreach($items as $value){
			 $quantities += $value['qty'];
		 }
	
        $option = get_option( 'woocommerce_cashBabaExpress_settings', array() );
		
		 $merchantId   = isset( $option['merchant_Id']) ? $option['merchant_Id'] : '' ;
		 $merchantKey  = isset( $option['merchant_Key']) ? $option['merchant_Key'] : '' ;
		 $returnUrl    = isset( $option['return_Url']) ? $option['return_Url'] : '' ;
		 
		 $orders         = wc_get_order( $order );
		 $OrderToralPay  = $orders->get_total();
		 
		 $OrderId  		 =  $orders ->id;
		 $totalPay  	 = $OrderToralPay;
		 $quantities;
		
		$today	  = date("m-d-Y");
		$orderNo  = time(); 
		
		$data = array(
		    "MerchantId" 			 => $merchantId,
			"MerchantSecurityKey" 	 => $merchantKey,
			"VirtualAccountNumber"   => $transaction_id,
			"NoOfItems" 			 => $quantities,
			"OrderId" 				 => $OrderId,
			"OrderAmount" 			 => $totalPay,
			"ExpectedSettlementDate" => $today,
			"ReturnUrl" 			 => $returnUrl
		 );
		
		echo "<pre>";
			print_r($data);
		echo "</pre>";
		exit;
		 
        $url      = self::base_url . '?' . http_build_query( $data, '', '&' );
        $response = file_get_contents( $url );

        if ( false !== $response ) {
            $response = json_decode( $response );

            return $response->transaction;
        }

        return false;
    }

    /**
     * Insert transaction info in the db table
     *
     * @param  object  $response
     *
     * @return void
     */
    function insert_transaction( $response ) {
        global $wpdb;

        $wpdb->insert( $wpdb->prefix . $this->table, array(
            'trxId'  => $response->trxId,
            'sender' => $response->sender,
            'ref'    => $response->reference,
            'amount' => $response->amount
        ), array(
            '%d',
            '%s',
            '%s',
            '%s'
        ) );
    }

    /**
     * Check if a transaction exists
     *
     * @param  string  $transaction_id
     *
     * @return bool
     */
    function transaction_exists( $transaction_id ) {
        global $wpdb;

        $query  = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}{$this->table} WHERE trxId = %d", $transaction_id );
        $result = $wpdb->get_row( $query );

        if ( $result ) {
            return true;
        }

        return false;
    }
}

new WC_cashBabaExpress();
