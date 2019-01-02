<?php

/**

 * Author: GPLSAVER
 * Date: 1/10/2016
 * Time: 2:57 PM
 */
class WC_Email_RFQ
{
    /**
     * Constructor
     */
    public function __construct()
    {

        add_action( 'plugins_loaded', array($this,'gpls_rfq_register_email') ,1000);
      //  add_action( 'init', array($this,'gpls_rfq_register_email') ,1000);

    }

    public function gpls_rfq_register_email(){

        add_filter('woocommerce_locate_template', array($this,'gpls_woo_rfq_pay_woocommerce_locate_template'), 1000, 3);
        add_filter( 'woocommerce_locate_core_template',array( $this, 'gpls_woo_rfq_pay_woocommerce_locate_template' ), 1000, 3 );

        add_filter('woocommerce_email_classes', array($this,'gpls_rfq_setup_new_requests_emails'));
        add_filter( 'woocommerce_email_actions', array($this,'gpls_qbb_quote_request_filter_actions') );

        add_action( 'woocommerce_order_status_gplsquote-req', array( $this, 'send_transactional_email' ), 10, 2 );

        add_action( 'gpls_woo_rfq_order_item_product_show_price', array( $this, 'filter_gpls_woo_rfq_order_item_product_show_price' ), 1, 2 );

// add the filter
        add_filter( 'woocommerce_resend_order_emails_available', array( $this,'filter_woocommerce_resend_order_emails_available'), 100, 1 );


        add_filter( 'woocommerce_email_order_meta_fields', array( $this,'woocommerce_email_order_meta_fields_notes'), 100, 3 );





    }







public function woocommerce_email_order_meta_fields_notes($array, $sent_to_admin, $order){
    $fields = $array;

    if ( $order->get_customer_note() && !class_exists("GPLS_WOO_RFQ_PLUS")) {
        $fields['customer_note'] = array(
            'label' => __( 'Note', 'woocommerce' ),
            'value' => wptexturize( $order->get_customer_note() ),
        );
    }
    return $fields;
}


public function filter_woocommerce_resend_order_emails_available( $array ) {
        // make filter magic happen here...
        array_push($array,'new_rfq','customer_rfq');
        return $array;
    }

    public function send_transactional_email( $args = array(), $message = '' ) {
        global $woocommerce;

        $woocommerce->mailer();

        do_action( current_filter() . '_notification', $args, $message );
    }

    /**
     * Register "woocommerce_order_status_pending_to_quote" as an email trigger
     */

    public function gpls_qbb_quote_request_filter_actions( $actions ){
       // $actions[] = "woocommerce_new_quote_created";
        return $actions;
    }

    public function gpls_rfq_setup_new_requests_emails($emails)
    {
        $emails['WC_Email_Customer_RFQ'] = include(gpls_woo_rfq_DIR . 'includes/classes/emails/class-wc-email-customer-rfq.php');
        $emails['WC_Email_New_RFQ'] = include(gpls_woo_rfq_DIR . 'includes/classes/emails/class-wc-email-new-rfq.php');

        return $emails;
    }
    public function gpls_woo_rfq_pay_woocommerce_locate_template($template, $template_name, $template_path)
    {

        // global $woocommerce;

        $_template = $template;
        if ( ! $template_path )
            $template_path = WC()->template_url;

        $plugin_path  = gpls_woo_rfq_DIR  . 'woocommerce/';

        // Look within passed path within the theme - this is priority
        $template = locate_template(
            array(
                $template_path . $template_name,
                $template_name
            )
        );


        if( ! $template && file_exists( $plugin_path . $template_name ) )
            $template = $plugin_path . $template_name;

        if ( ! $template )
            $template = $_template;
        // d($template);
        return $template;
        // Return what we found

    }

}

?>