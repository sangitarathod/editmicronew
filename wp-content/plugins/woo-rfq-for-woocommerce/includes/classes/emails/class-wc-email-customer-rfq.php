<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists('WC_Email_Customer_RFQ') ) :

/**
 * Customer Processing RFQ Email
 *
 * An email sent to the customer when a new RFQ is received.
 * @extends     WC_Email
 */
class WC_Email_Customer_RFQ extends WC_Email {

	/**
	 * Constructor
	 */
	function __construct() {

		$this->id               = 'customer_rfq';
		$this->title            = __( 'RFQ-ToolKit New Request for Quote', 'woo-rfq-for-woocommerce' );
		$this->description      = __( 'This is an quote request notification sent to customers containing their order details after quote request.', 'woo-rfq-for-woocommerce' );

		$this->heading          = __( 'Thank you for your quote request', 'woo-rfq-for-woocommerce' );
		$this->subject          = __( 'Your {site_title} quote request confirmation from {order_date}', 'woo-rfq-for-woocommerce' );

		$this->template_html    = 'emails/customer-rfq.php';
		$this->template_plain   = 'emails/plain/customer-rfq.php';
		$this->_templates = array($this->template_html,$this->template_plain);

		// Triggers for this email

        $this->customer_email = true;
		add_filter('woocommerce_template_directory',array( $this, 'gpls_rfq_woocommerce_locate_template_dir' ), 10, 2);
		add_action( 'woocommerce_order_status_gplsquote-req_notification', array( $this, 'trigger' ) );



		// Call parent constructor
		parent::__construct();


	}



	public function gpls_rfq_woocommerce_locate_template_dir($dir,$template)
	{

			return $dir;

	}

	/**
	 * Trigger.
	 */
	function trigger( $order_id ) {

		if ( $order_id ) {
			$this->object       = wc_get_order( $order_id );
			$this->recipient    = $this->object->get_billing_email();

			$this->find['order-date']      = '{order_date}';
			$this->find['order-number']    = '{order_number}';

			$this->replace['order-date']   = date_i18n( wc_date_format(), strtotime( $this->object->get_date_created() ) );
			$this->replace['order-number'] = $this->object->get_order_number();
		}
//gplsquote-req
		if ( ! $this->is_enabled() || ! $this->get_recipient()  ) {
			return;
		}

		$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
	}


	/**
	 * get_content_html function.
	 *
	 * @access public
	 * @return string
	 */
	function get_content_html() {

		ob_start();
		wc_get_template( $this->template_html, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => false,
            'email'			=> $this,
		) );
		return ob_get_clean();
	}

	/**
	 * get_content_plain function.
	 *
	 * @access public
	 * @return string
	 */
	function get_content_plain() {
		ob_start();
		wc_get_template( $this->template_plain, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => true,
            'email'			=> $this,

		) );
		return ob_get_clean();
	}


}

endif;

return new WC_Email_Customer_RFQ();
