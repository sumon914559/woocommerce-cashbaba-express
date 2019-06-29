<?php

/**
 * CashBaba Express Payment gateway
 *
 * @author RCIS
 */
class WC_Gateway_cashBabaExpress extends WC_Payment_Gateway {

    /**
     * Initialize the gateway
     */
    public function __construct() {
        $this->id                 = 'cashBabaExpress';
        $this->icon               = false;
        $this->has_fields         = true;
        $this->method_title       = __( 'cashBabaExpress', 'wc-cashBabaExpress' );
        $this->method_description = __( 'Pay via cashBabaExpress payment', 'wc-cashBabaExpress' );
        $this->icon               = apply_filters( 'woo_cashbaba_express_logo', plugins_url( 'images/cashbaba-express-logo.png', dirname( __FILE__ ) ) );

        $title                    = $this->get_option( 'title' );
	$this->title              = empty( $title ) ? __( 'cashBabaExpress', 'wc-cashBabaExpress' ) : $title;
        $this->description        = $this->get_option( 'description' );
        $this->instructions       = $this->get_option( 'instructions', $this->description );

        $this->init_form_fields();
        $this->init_settings();

        add_action( 'woocommerce_email_before_order_table', array( $this, 'email_instructions' ), 10, 3 );
        add_action( 'woocommerce_thankyou_cashBabaExpress', array( $this, 'thankyou_page' ) );
        add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options') );
    }

    /**
     * Admin configuration parameters
     *
     * @return void
     */
     public function init_form_fields() {
		
		$this->form_fields = array(
            'enabled' => array(
                'title'   => __( 'Enable/Disable', 'wc-cashBabaExpress' ),
                'type'    => 'checkbox',
                'label'   => __( 'Enable cashBabaExpress', 'wc-cashBabaExpress' ),
                'default' => 'yes'
            ),
            'title' => array(
                'title'   => __( 'Title', 'wc-cashBabaExpress' ),
                'type'    => 'text',
                'default' => __( 'cashBabaExpress Payment', 'wc-cashBabaExpress' ),
            ),
            
            'merchant_Id' => array(
                'title' => __( 'Merchant ID', 'wc-cashBabaExpress' ),
                'type'  => 'text',
            ),
            'merchant_Key' => array(
                'title' => __( 'Merchant Key', 'wc-cashBabaExpress' ),
                'type'  => 'text',
            ),
			
            'return_Url' => array(
                'title'       => __( 'Return Url.', 'wc-cashBabaExpress' ),
                'type'        => 'text',
                'description' => __( 'Return Url.', 'wc-cashBabaExpress' ),
            ),
			
        ); 
		
    }

    /**
     * Output for the order received page.
     *
     * @return void
     */
    public function thankyou_page( $order_id ) {

        /*if ( $this->instructions ) {
            echo wpautop( wptexturize( wp_kses_post( $this->instructions ) ) );
        }

        $order = wc_get_order( $order_id );

        if ( $order->has_status( 'on-hold' ) ) {
          WC_bKash::tranasaction_form( $order_id );
        } */
    }

    /**
     * Add content to the WC emails.
     *
     * @access public
     * @param WC_Order $order
     * @param bool $sent_to_admin
     * @param bool $plain_text
     *
     * @return void
     */
    public function email_instructions( $order, $sent_to_admin, $plain_text = false ) {

        if ( ! $sent_to_admin && 'cashBabaExpress' === $order->payment_method && $order->has_status( 'on-hold' ) ) {
            if ( $this->instructions ) {
                echo wpautop( wptexturize( $this->instructions ) ) . PHP_EOL;
            }
        }

    }

    /**
     * Process the gateway integration
     *
     * @param  int  $order_id
     *
     * @return void
     */
    public function process_payment( $order_id ) {

        $order = wc_get_order( $order_id );

        // Mark as on-hold (we're awaiting the payment)
        $order->update_status( 'on-hold', __( 'Awaiting cashBabaExpress payment', 'wc-cashBabaExpress' ) );

        // Remove cart
        WC()->cart->empty_cart();

        // Return thankyou redirect
        return array(
            'result'    => 'success',
            'redirect'  => $this->get_return_url( $order )
        );
    }

    /**
     * Validate place order submission
     *
     * @return bool
     */
    public function validate_fieldss() {
        global $woocommerce;

        if ( empty( $_POST['cashBabaExpress_trxid'] ) ) {
            wc_add_notice( __( 'Please type the transaction ID.', 'wc-cashBabaExpress' ), 'error' );
            return;
        }

        return true;
    }

}