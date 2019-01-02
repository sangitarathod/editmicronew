<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email_New_RFQ' ) ) :

/**
 * New RFQ Email
 *
 * An email sent to the admin when a new RFQ is received.
 *
 * @class       WC_Email_New_Order
 * @extends     WC_Email
 */
class WC_Email_New_RFQ extends WC_Email {

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->id               = 'new_rfq';
		$this->title            = __( 'RFQ-ToolKit New RFQ Admin', 'woo-rfq-for-woocommerce' );
		$this->description      = __( 'New quote request emails are sent to the recipient list when an order is received.', 'woo-rfq-for-woocommerce' );

		$this->heading          = __( 'New customer quote request', 'woo-rfq-for-woocommerce' );
		$this->subject          = __( '[{site_title}] New customer quote request ({order_number}) - {order_date}', 'woo-rfq-for-woocommerce' );

		$this->template_html    = 'emails/admin-new-rfq.php';
		$this->template_plain   = 'emails/plain/admin-new-rfq.php';

		$this->_templates = array($this->template_html,$this->template_plain);

		// Triggers for this email


		add_filter('woocommerce_template_directory',array( $this, 'gpls_rfq_woocommerce_locate_template_dir' ), 10, 2);
		add_action( 'woocommerce_order_status_gplsquote-req_notification', array( $this, 'trigger' ) );




		// Call parent constructor
		parent::__construct();

		// Other settings
		$this->recipient = $this->get_option( 'recipient' );

		if ( ! $this->recipient )
			$this->recipient = get_option( 'admin_email' );
	}


	public function gpls_rfq_woocommerce_locate_template_dir($dir,$template)
	{

			return $dir;

	}

	/**
	 * Trigger.
	 */
	public function trigger( $order_id ) {

		if ( $order_id ) {
			$this->object       = wc_get_order( $order_id );

			$this->find['order-date']      = '{order_date}';
			$this->find['order-number']    = '{order_number}';

			$this->replace['order-date']   = date_i18n( wc_date_format(), strtotime( $this->object->get_date_created() ) );
			$this->replace['order-number'] = $this->object->get_order_number();
		}

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
	public function get_content_html() {

		ob_start();
		wc_get_template( $this->template_html, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => true,
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
	public function get_content_plain() {
		ob_start();
		wc_get_template( $this->template_plain, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => true,
			'plain_text'    => true,
            'email'			=> $this,

		) );
		return ob_get_clean();
	}



	/**
	 * Initialise settings form fields
	 */
	public function init_form_fields() {
		$this->form_fields = array(
			'enabled' => array(
				'title'         => __( 'Enable/Disable', 'woo-rfq-for-woocommerce' ),
				'type'          => 'checkbox',
				'label'         => __( 'Enable this email notification', 'woo-rfq-for-woocommerce' ),
				'default'       => 'yes'
			),
			'recipient' => array(
				'title'         => __( 'Recipient(s)', 'woo-rfq-for-woocommerce' ),
				'type'          => 'text',
				'description'   => sprintf( __( 'Enter recipients (comma separated) for this email. Defaults to <code>%s</code>.', 'woo-rfq-for-woocommerce' ), esc_attr( get_option('admin_email') ) ),
				'placeholder'   => '',
				'default'       => ''
			),
			'subject' => array(
				'title'         => __( 'Subject', 'woo-rfq-for-woocommerce' ),
				'type'          => 'text',
				'description'   => sprintf( __( 'This controls the email subject line. Leave blank to use the default subject: <code>%s</code>.', 'woo-rfq-for-woocommerce' ), $this->subject ),
				'placeholder'   => '',
				'default'       => ''
			),
			'heading' => array(
				'title'         => __( 'Email Heading', 'woo-rfq-for-woocommerce' ),
				'type'          => 'text',
				'description'   => sprintf( __( 'This controls the main heading contained within the email notification. Leave blank to use the default heading: <code>%s</code>.', 'woo-rfq-for-woocommerce' ), $this->heading ),
				'placeholder'   => '',
				'default'       => ''
			),
			'email_type' => array(
				'title'         => __( 'Email type', 'woo-rfq-for-woocommerce' ),
				'type'          => 'select',
				'description'   => __( 'Choose which format of email to send.', 'woo-rfq-for-woocommerce' ),
				'default'       => 'html',
				'class'         => 'email_type wc-enhanced-select',
				'options'       => $this->get_email_type_options()
			)
		);
	}
}

endif;

return new WC_Email_New_RFQ();
