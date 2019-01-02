<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if (!class_exists('WC_Gateway_GPLS_Request_Quote')) {
    /**
     * Cheque Payment Gateway
     *
     * Provides a Cheque Payment Gateway, mainly for testing purposes.
     *
     * @class        WC_Gateway_Cheque
     * @extends        WC_Payment_Gateway
     * @version        2.1.0
     * @package        WooCommerce/Classes/Payment
     * @author        WooThemes
     */
    class WC_Gateway_GPLS_Request_Quote extends WC_Payment_Gateway
    {

        /**
         * Constructor for the gateway.
         */
        public function __construct()
        {
            $this->id = 'gpls-rfq';
            $this->icon = apply_filters('gpls_rfq_icon', '');
            $this->has_fields = false;
            $this->method_title = __('Quote Request', 'woo-rfq-for-woocommerce');
            $this->method_description = __('Allows RFQ to go through.', 'woo-rfq-for-woocommerce');

            // Load the settings.
            $this->init_form_fields();
            $this->init_settings();

            // Define user set variables
            $this->title = $this->get_option('title',$this->title);
            $this->description = $this->get_option('description');
            $this->instructions = $this->get_option('instructions');

            // Actions
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
            add_action('woocommerce_thankyou_wc-gplsquote-req', array($this, 'thankyou_page'));

            // Customer Emails
            add_action('woocommerce_email_before_order_table', array($this, 'email_instructions'), 10, 3);
        }

        /**
         * Initialise Gateway Settings Form Fields
         */
        public function init_form_fields()
        {

            $this->form_fields = array(
                'enabled' => array(
                    'title' => __('Enable/Disable', 'woo-rfq-for-woocommerce'),
                    'type' => 'checkbox',
                    'label' => __('Skip Payment For Quote Requests', 'woo-rfq-for-woocommerce'),
                    'default' => 'yes'
                ),
                'title' => array(
                    'title' => __('Title', 'woo-rfq-for-woocommerce'),
                    'type' => 'text',
                    'description' => __('This controls the title which the user sees during checkout.', 'woo-rfq-for-woocommerce'),
                    'default' => __('Request For Quote', 'woo-rfq-for-woocommerce'),
                    'desc_tip' => true,
                ),
                'description' => array(
                    'title' => __('Description', 'woo-rfq-for-woocommerce'),
                    'type' => 'textarea',
                    'description' => __('Payment method description that the customer will see on your checkout.', 'woo-rfq-for-woocommerce'),
                    'default' => '',
                    'desc_tip' => true,
                ),
                'instructions' => array(
                    'title' => __('Instructions', 'woo-rfq-for-woocommerce'),
                    'type' => 'textarea',
                    'description' => __('Instructions that will be added to the thank you page and emails.', 'woo-rfq-for-woocommerce'),
                    'default' => '','woo-rfq-for-woocommerce',
                    'desc_tip' => true,
                ),
            );
        }

        /**
         * Output for the order received page.
         */
        public function thankyou_page()
        {
            if ($this->instructions)
                echo wpautop(wptexturize($this->instructions));
        }

        /**
         * Add content to the WC emails.
         *
         * @access public
         * @param WC_Order $order
         * @param bool $sent_to_admin
         * @param bool $plain_text
         */
        public function email_instructions($order, $sent_to_admin, $plain_text = false)
        {
            if ($this->instructions && !$sent_to_admin && 'gpls-rfq' === $order->payment_method && $order->has_status('wc-gplsquote-req')) {
                echo wpautop(wptexturize($this->instructions)) . PHP_EOL;
            }
        }

        /**
         * Process the payment and return the result
         *
         * @param int $order_id
         * @return array
         */
        public function process_payment($order_id)
        {

            $order = wc_get_order($order_id);

            // Mark as on-hold (we're awaiting the respponse by customer)
            $order->update_status('wc-gplsquote-req', __('RFQ', 'woo-rfq-for-woocommerce'));

            // Reduce stock levels
            //$order->reduce_order_stock();

            // Remove cart
            WC()->cart->empty_cart();


            // Return thankyou redirect
            return array(
                'result' => 'success',
                'redirect' => $this->get_return_url($order)
            );


        }


    }
}
