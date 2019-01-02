=== RFQ-ToolKit for WooCommerce ===
Contributors: Neah Plugins
Donate link: https://www.neahplugins.com/
Tags: request for quote for woocommerce,quote request for woocommerce,rfq,request,quote,ecommerce,e-commerce,commerce,
Requires at least: 4.1
Tested up to: 4.9 and WooCommerce 3.3
Stable tag: 1.8.94
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
RFQ-ToolKit: Request For Quote For WooCommerce.

== Description ==

RFQ-ToolKit is an easy to configure quote request plugin that turns your WooCommerce shopping cart into a lead generation system .It can be easily adjusted it to suit your quoting needs.

**You can configure RFQ-ToolKit basic version in two ways:**

**1- Allow quote request on selected products.Simple and varaiable product types**

[youtube https://youtu.be/haFv3kifRo8?rel=0]

**2- All product types. Customers can submit their cart as a quote request at checkout:**
* Customers submit their cart as a quote request.
* Customers submit their cart as a quote request or purchase based on minimum purchase.
* Customers submit their cart as a quote request or purchase based on items in the cart.

[youtube https://youtu.be/b9H9VVToNYs?rel=0]

[Documentation](https://wordpress.org/plugins/woo-rfq-for-woocommerce/#installation)


Version 1.7.9997 is compatible with WooCommerce 2.x.
Version 1.7.9998 and higher is compatible with WooCommerce 3.x


* Hides or shows prices with your choice of Normal Checkout mode or RFQ mode.
* Creates orders from an RFQ.
* Sends confirmation emails to customer and shop manager.
* RFQ list shown in the RFQ page.
* Manage price visibility.
* Support for variable product in normal checkout..


**[RFQ-ToolKit-Plus Premium Extension](https://www.neahplugins.com/)**


* Customize the quote request page for normal checkout.
* In the pro version, shop manager can write a proposal the customer in the quote request, choose to include a link to "pay".
  and save the status as "Quote Sent".
  This triggers an email, notifying the customer of the quote, which is payable by following the link.
* Allow customers to submit a bid while requesting a quote.
* Customer can also choose to respond to the proposal and add a response(note) by clicking in the "respond" link in the email.
* Add custom HTML content to the top and bottom of the quote request page.
* Designate additional fields as required for visitors such as phone,zip,state etc.
* Choose to allow create an account or disable.
* RFQ Enable or disable all products in bulk. Useful if you use the "normal checkout" and have a lot of products.
* RFQ Enable or disable all products in a category. Useful if you use the "normal checkout" and have a lot of products.
* Plugin can operate in 2 modes: Request for quote checkout and normal checkout.
* In "RFQ Checkout" , you can optionally allow customer to pay now or submit a quote request at Checkout. Allows either â€œCheckout or Request quoteâ€ for the entire cart.
* With "Checkout or Request quote" you can limit by minimum purchase ( quote request available above a minimum).
* With "Checkout or Request quote" you can limit by allowing either quote request or purchasing depending on the products in the cart.
* Send custom content with the confirmation and proposal email. Customize the content even further based on each product.
* Accept customer bids while submitting quotes.
* Quote cart widget in the normal check.
* Change the "reply to" in emails to admin to be the customer's email.
* Customize color, background color and mouse effects of the quote button.
* Add to quote shortcode.
* Add custom fields to your checkout page using a Ninja Form.
* Add custom HTML content to the top and bottom of the quote request page.*
* Designate additional fields as required such as phone,zip,state etc.
* Choose to allow create an account or disable for new customers on quote request page.
* In RFQ mode, allow customer to pay now or submit a quote request at Checkout. Allows either "Checkout or Request quote" for the entire cart.
* RFQ Enable or disable all products in bulk.
* Send custom content with the confirmation and proposal email. Customize the content even further based on each product.
* Choose a redirect page after add to quote.
* More control over showing prices and showing add to cart button in normal checkout.
* More control over showing prices in customer emails.
* Better support for third party plugins order meta data.
* Set defaults for new products to be quote request products.
* Set automatic expiration / cancellation for quotes based on number of days.
* Resend Quote Confirmation and Quote Sent emails using order actions in the order screen.
* And more features..

= RFQ-ToolKit-Plus Premium Only Features =
[youtube https://youtu.be/b1Q93LPjEp4?rel=0]

[Email, Content Marketing & Dashboard Video](https://youtu.be/sq6Dt0kRnzw?rel=0)

[Custom fields Video](https://youtu.be/uqGzFyPnyWY?rel=0)


== Installation ==

= Minimum Requirements =

* Version 1.7.9997 is compatible with WooCommerce 2.x.
* Version 1.7.9998 and higher is compatible with WooCommerce 3.x



= Documention =

= General Options =

RFQ-ToolKit enables you to operate in your choice of 2 different modes: Normal Checkout mode or RFQ mode.

= Normal Checkout Mode =
Normal Checkout mode shows prices by default except on products that are RFQ enabled in the product setup page(Advanced Tab) in admin.  You can choose specific products in the product setup that you want customers to request a quote. The prices for these products will be hidden by default unless you choose the option "Show Prices With Normal Checkout"; then all prices will show regardless of RFQ status.  So you could select some products to be available for the customer to purchase through the regular checkout proceedure, OR allow the customer to request a quote on that product. All quote requests are added to the RFQ cart and when submitted, and saved as an order with an RFQ status. All other product purchases can check out normally.

The Normal Checkout mode gives you the most flexibility in offering your products for sale. For example, a customer loves the sweatshirts you sell and decides to buy one at your special sale price of $32 (regularly $38). But then, the customer realizes these are just what his team (25 people) has been looking for--along with the matching sweatpants. Using the Normal Checkout mode, this customer can purchase his sale sweatshirt, and also request a quote for pricing for the 25 sweatshirts and 25 sweatpants for his team.


= Product setup =
Applicable to Normal Checkout only. In the product setup advanced tab you can enable requesting quotes for the product by checking "Enable RFQ for this product".

= RFQ Checkout Mode =
RFQ Checkout mode allows the customer to only be able to check out using a request for quote. This mode hides all prices for the customer by default, however you have the option to allow prices to be shown. The items in the cart are saved after the checkout as an order with RFQ status. You can then adjust the prices and turn the order to a pending status to allow payment by the customer.


= Email setup =
When a customer requests a quote, an order is created with "quote_request" status and emails are sent out to the customer and the store manager.
Emails are added to the WooCommerce email settings section and can be enabled/disabled. Email templates can be overridden as you would with other emails by copying the "woocommerce/emails" to your theme.


= Work Flow =

**In Normal Checkout mode**

* Customer shops and can check out normally to purchase items at set price (for items with a visible price).
* Customer can request quotes for products that have been RFQ enabled in product setup (whether or not price is visible).
* Customer adds items for quote request to the RFQ List.
* Customer can submit their request in the quote request page (instead of paying, customer submits a request for quote).
* The request creates an order that can be viewed in the Order section.
* Shop manager recieves an email that a quote is requested.
* The request is viewed and the price adjusted as desired.
* Manager sends an invoice when price is agreed upon.
* Manager adjusts the status of the request to order-pending.
* Customer can pay the invoice online from the "my account" menu, after the status is set to pending payment.
* Customer can see the price and your normal payment gateways when paying for orders with pending payment status.

**In RFQ mode**

* ALL products are checked out through the RFQ process above, regardless of whether or not the price shows.
* At checkout, instead of paying, customer submits a request for quote.
* The request creates an order that can be viewed in the Order section.
* Shop manager recieves an email that a quote is requested.
* The request is viewed and the price adjusted as desired.
* Manager sends an invoice when price is agreed upon.
* Manager adjusts the status of the request to order-pending.
* Customer can pay the invoice online from the "my account" menu, after the status is set to pending payment.

= Templates =

RFQ-ToolKit templates located in the "woo-rfq-for-commerce/woocommerce".
You can override the templates by copying them to "your_theme_directory/woocommerce".


= Automatic installation =

Automatic installation through your WordPress dashboard.

= Manual installation =

Download RFQ-ToolKit plugin and upload it to your webserver via FTP. The WordPress codex contains [instructions on how to do this here](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

= Updating =

Automatic / manual the same way as installing

== Frequently Asked Questions ==

= Where are the settings? =

Settings are all in the WooCommerce settings page. under email and payment gateway sections

= Will it change the styling of my theme? =

No.

= Where can I request new features =

You can vote on and request new features.




== Screenshots ==
0. getquote.png
1. checkout.png
2. thankyou.png
3. email setup.png
4. email setup.png
5. gateway.png
6. orders.png
7. orders2.png
8. orders3.png
9. myaccount.png
10. pay.png
11. setting.png
12. emailresend.png
13. productninja.png
14. woorfqsetting.png
15. cart.png
16. single-product.png


= 1.8.94 - 9/28/2018 =
*anon issues

= 1.8.93 - 9/20/2018 =
*duplicate email items

= 1.8.92 - 9/20/2018 =
*customer note, no variation label warning

= 1.8.91 - 9/18/2018 =
*fix bug in add to cart. Friday update broke ajax add

= 1.8.90 - 9/18/2018 =
*rfq enable function

= 1.8.89 - 9/15/2018 =
*rfq enable function, order of label changing, rfq cart warnings

= 1.8.88 - 9/8/2018 =
* locate template adj
* put back missing Customer notes

= 1.8.87 - 9/3/2018 =
 * Ajax add to quote

= 1.8.85 - 8/12/2018 =
* languages

= 1.8.84 - 8/12/2018 =
* fix redirect problem

= 1.8.83 - 7/31/2018 =
* Add respond to in the customer note

= 1.8.82 - 7/11/2018 =
* Fix CSS for single page


= 1.8.79 - 6/22/2018 =
* Fix Add To Cart for bundled

= 1.8.78 - 6/22/2018 =
* Fix Add To Cart for bundled

= 1.8.77 - 6/11/2018 =
* Fix Add To Cart

= 1.8.76 - 6/7/2018 =
* Fix Bug with sessions

= 1.8.75 - 6/7/2018 =
* Fix Bug with sessions


= 1.8.74 - 6/7/2018 =
* Fix Email missing hook

= 1.8.73 - 5/22/2018 =
* Fixed Add to quote from single

= 1.8.70 - 5/22/2018 =
* Fixed Add to quote from single

= 1.8.68 - 5/22/2018 =
* MOVE FILE UPLOAD IN RFQ CART

= 1.8.67 - 5/1/2018 =
* garbage collection job

= 1.8.66 - 5/1/2018 =
* garbage collection job

= 1.8.65 - 4/26/2018 =
* remove empty

= 1.8.64 - 4/19/2018 =
* fix the order of loading the plugin

= 1.8.63 - 4/18/2018 =
* fix "add to cart" button focus

= 1.8.62 - 4/10/2018 =
* add to cart link filter

= 1.8.61 - 3/31/2018 =
* unclosed div

= 1.8.60 - 3/23/2018 =
* gateway problems


= 1.8.59 - 3/19/2018 =
* style problem

= 1.8.58 - 3/7/2018 =
* undefined variable $readmore

= 1.8.57 - 3/5/2018 =
* increase cookie time

= 1.8.56 - 3/2/2018 =
* session cookie

= 1.8.54 - 2/15/2018 =
* order time & Date

= 1.8.53 - 2/14/2018 =
* fix undefined constant gpls_woo_rfq_INQUIRE_TEXT

= 1.8.52 - 2/14/2018 =
* Translation for options

= 1.8.51 - 2/14/2018 =
* Fix blank customer notes

= 1.8.50 - 2/13/2018 =
* Translation for options


= 1.8.49 - 2/13/2018 =
* Quantity problem on quote cart-js error

= 1.8.48 - 2/9/2018 =
* Quantity problem on quote cart

= 1.8.47 - 1/25/2018 =
* suppress the non-numeric warning

= 1.8.46 - 1/25/2018 =
* fix problem with current_user function


= 1.8.45 - 1/25/2018 =
* fix problem with current_user function

= 1.8.44 - 1/24/2018 =
* fix price not showing on thankyou

= 1.8.43 - 1/22/2018 =
* fix order metadata


= 1.8.42 - 1/9/2018 =
* fix error in extra code

= 1.8.41 - 1/8/2018 =
* fix order meta

= 1.8.40 - 12/12/2017 =
* fix php 7.1 errors, add to quote option

= 1.8.39 - 12/12/2017 =
* fix order metadata

= 1.8.38 - 12/12/2017 =
* fix order metadata

= 1.8.37 - 12/8/2017 =
* fixe confirmation message

= 1.8.36 - 11/8/2017 =
* fixe confirmation message

= 1.8.35 - 11/3/2017 =
* fixes css in admin

= 1.8.34 - 10/25/2017 =
* fixes css in admin

= 1.8.33 - 10/25/2017 =
* fixes css in admin

= 1.8.32 - 10/25/2017 =
* fixes for labels

= 1.8.31 - 10/25/2017 =
* fixes for labels

= 1.8.30 - 10/24/2017 =
* remove short code from admin or if woocommerce not loaded

= 1.8.29 - 10/24/2017 =
* remove short code from admin

= 1.8.28 - 10/10/2017 =
* Label for variable product add to cart/quote

= 1.8.27 - 10/3/2017 =
* Hook for order meta data

= 1.8.26 - 9/28/2017 =
* Remove garbage text from button

= 1.8.25 - 9/23/2017 =
* Fix adding non purchasable items through url visit

= 1.8.24 - 8/30/2017 =
* fix label for variable products

= 1.8.22 - 8/20/2017 =
* exclude external

= 1.8.19 - 8/18/2017 =
* exclude external

= 1.8.18 - 8/17/2017 =
* change request page to text. Remove buffering to avoid conflicts

= 1.8.17 - 8/8/2017 =
* fix problem with redirect

= 1.8.15 - 8/8/2017 =
* fix problem with woocommerce_loop add_to_cart_link

= 1.8.14 - 8/8/2017 =
* fix double * for required

= 1.8.13 - 8/7/2017 =
* fix the redirect

= 1.8.12 - 8/3/2017 =
* fix rfq cart required labeling conflict


= 1.8.11 - 7/14/2017 =
* fix empty issue


= 1.8.10 - 7/14/2017 =
* fix bug for anon checkou

= 1.8.9 - 7/13/2017 =
* Remove empty to make it compatible for php less than 5.6 when variable is null

= 1.8.8 - 7/11/2017 =
* Fix settings page


= 1.8.7 - 7/10/2017 =
* Fix undefined variable in email


= 1.8.6 - 7/8/2017 =
* Fixed extra customer note email.
* Remove woocommerce css.
* Fix username generation when creating new account

= 1.8.5 - 6/30/2017 =
* Single add to product for blank vs zero

= 1.8.4 - 6/30/2017 =
* remove jquery validation

= 1.8.3 - 6/28/2017 =
* javascript errors on dashboard. Undefined function

= 1.8.1 - 6/26/2017 =
* fix Add to cart button flash in single page


= 1.7.99999.24 - 6/25/2017 =
* language files

= 1.7.99999.23 - 6/19/2017 =
* fixed prices not showing in orders. Hide prices in email to customers for added notes

= 1.7.99999.22 - 6/18/2017 =
* fixed Customer phone not adding to order. Link to cart in rfq was wrong


= 1.7.99999.22 - 6/18/2017 =
* fixed Customer phone not adding to order. Link to cart in rfq was wrong

= 1.7.99999.21 - 6/18/2017 =
* Fix quote request not firing. Bundled product for wc 3.0

= 1.7.99999.20 - 6/18/2017 =
* Fix jquery validation & css. add to cart on single


= 1.7.99999.19 - 6/14/2017 =
* Product number in single add to cart. label for cart. fix jquery validation loading.

= 1.7.99999.18 - 6/14/2017 =
* Fix Prices not showing in RFQ mode

= 1.7.99999.17 - 6/14/2017 =
* Fix labels for proceed to checkout

= 1.7.99999.16 - 6/14/2017 =
* Fix language. RFQ page. Formattting

= 1.7.99999.16 - 6/14/2017 =
* Fix language. RFQ page. Formattting

= 1.7.99999.15 - 6/9/2017 =
* Fix mini cart prices. Translation update

= 1.7.99999.14 - 6/5/2017 =
* RFQ Wording added to cart messages


= 1.7.99999.13 - 6/5/2017 =
* Fix RFQ with blank prices not getting added to cart

= 1.7.99999.12 - 6/1/2017 =
* Fix RFQ with blank prices not getting added to cart


= 1.7.99999.11 - 6/1/2017 =
* Fix RFQ with prices showing

= 1.7.99999.10 - 5/31/2017 =
* Fix no prices

= 1.7.99999.9 - 5/30/2017 =
* Fix single page adding to cart with 0 prices


= 1.7.99999.8 - 5/29/2017 =
* Fix adding to cart with 0 prices


= 1.7.99999.7 - 5/29/2017 =
* Fix session issues for PHP 5.2.
Fix email double for WC 3.0.
Fix prices not showing for admin email


= 1.7.99999.6 - 5/29/2017 =
* Fix Prices after add to cart


= 1.7.99999.5 - 5/29/2017 =
* Fix Prices not showing in normal checkout

= 1.7.99999.4 - 5/29/2017 =
* Fix Prices not showing in normal checkout

= 1.7.99999.3 - 5/17/2017 =
* WC 3.0 upgrade email break fixes

= 1.7.99999.2 - 5/16/2017 =
* Order and email metadata

= 1.7.99999.1 - 5/15/2017 =
* Remove warning for price from prefix


= 1.7.99999 - 5/5/2017 =
* order creation WC 3.0 fixes


= 1.7.99998 - 5/4/2017 =
* missing customer detail from admin email


= 1.7.99997 - 5/4/2017 =
* missing add to cart links for anon visitors


= 1.7.99996 - 5/2/2017 =
* missing page check


= 1.7.99995 - 5/2/2017 =
* upgrade session manager fix

= 1.7.99994 - 5/1/2017 =
* upgrade session manager

= 1.7.99993 - 4/24/2017 =
* Move product setup to Advanced Tab from general

= 1.7.99992 - 4/24/2017 =
* fix emails after WC 3.0 updates

= 1.7.99991 - 4/18/2017 =
* fix empty for 5.4


= 1.7.9999 - 4/17/2017 =
* normal checkout single page

= 1.7.9998 - 4/17/2017 =
* WC 3.0 changes

= 1.7.9997 - 3/30/2017 =
* wrong constant name for session

= 1.7.9996 - 3/28/2017 =
* fixed zero price and stock management

= 1.7.9995 - 2/20/2017 =
* fixed zero price needing payment not triggering.

= 1.7.9994 - 2/20/2017 =
* fix add cart showing in rfq items


= 1.7.9993 - 2/20/2017 =
* fix fatal error

= 1.7.9992 - 2/19/2017 =
* prices in payment page


= 1.7.9991 - 2/18/2017 =
* prices in payment page

= 1.7.999 - 2/18/2017 =
* prices in payment page

= 1.7.998 - 2/11/2017 =
* prices in paid emails not showing

= 1.7.997 - 2/10/2017 =
* Cumulative fixes for admin email price and zero price

= 1.7.996 - 2/9/2017 =
* Variable product avialability

= 1.7.995 - 2/7/2017 =
* Checkout problem when prices were showing

= 1.7.994 - 2/6/2017 =
* no javascript problem

= 1.7.993 - 1/29/2017 =
* fix css for menu cart


= 1.7.992 - 1/28/2017 =
* price format in rfq mode
* variation price on some themes

= 1.7.991 - 1/22/2017 =
* fix wp_session conflicts

= 1.7.990 - 1/16/2017 =
* Switchto wp_session from woocommerce session

= 1.7.989 - 1/9/2017 =
* Customer notes problem fixed

= 1.7.988 - 1/8/2017 =
* RFQ Page name first and last required problem

= 1.7.987 - 1/5/2017 =
* Settings Page

= 1.7.986 - 1/2/2017 =
* Zipcode issue

= 1.7.985 - 12/31/2016 =
* Out of Stock  issues


= 1.7.984 - 12/26/2016 =
* Fix for missing label for country


= 1.7.984 - 12/2/2016 =
* More labels, mobile friendly version of Request for Quote Page


= 1.7.983 - 12/2/2016 =
* More labels, mobile friendly version of Request for Quote Page

= 1.7.982 - 11/24/2016 =
* no shipping problem

= 1.7.981 - 11/23/2016 =
* no shipping problem

= 1.7.980 - 11/23/2016 =
* Empty cart fix


= 1.7.979 - 11/18/2016 =
* Custeomer email notification

= 1.7.978 - 11/18/2016 =
* order recieved message

= 1.7.977 - 11/18/2016 =
* order recieved message

= 1.7.976 - 11/15/2016 =
* language po files

= 1.7.975 - 11/15/2016 =
* shop page add to cart

= 1.7.974 - 11/15/2016 =
* empty cart update cart


= 1.7.972 - 11/15/2016 =
* empty cart

= 1.7.971 - 11/15/2016 =
* add to cart & link on single page


= 1.7.970 - 11/9/2016 =
* fix view cart adding to cart

= 1.7.969 - 11/8/2016 =
* menu and page creatiion errors

= 1.7.968 - 11/7/2016 =
* parse_url error


= 1.7.967 - 11/6/2016 =
* menu creation error


= 1.7.966 - 11/5/2016 =
* css rfq cart


= 1.7.965 - 11/4/2016 =
* page creation problem


= 1.7.964 - 11/4/2016 =
* blank page option

= 1.7.963 - 11/4/2016 =
* style the request to quote button

= 1.7.962 - 11/3/2016 =
* fixes for orders meta data, remove warnings bundled items

= 1.7.961 - 11/3/2016 =
* fixes for orders meta data, remove warnings for tax totals

= 1.7.96 - 11/2/2016 =
* fix add to cart hook lower priority

= 1.7.95 - 10/31/2016 =
* bug fixes including create page, menu

= 1.7.9.2 - 10/23/2016 =
* fix the missing free notice

= 1.7.9.1 - 10/23/2016 =
* fixed shipping zones issue

= 1.7.9 - 10/19/2016 =
* fixed tax warning

= 1.7.89 - 10/19/2016 =
* fixed add to cart button in shop. rfq cart formating and orders with rfq status label changed to "Quote Request"

= 1.7.88 - 10/19/2016 =
* cumulative bug fixes

= 1.7.87 - 10/18/2016 =
* add to cart button and view rfq cart position to increase theme compatibility

= 1.7.86 - 10/15/2016 =
* bug fixes blank page on installation page and menu. bundled items quantity update

= 1.7.85 - 10/15/2016 =
* bug fixes shipping calc,blank checkout option, double div on updates

= 1.7.84 - 10/13/2016 =
* bug fixes link to rfq cart

= 1.7.83 - 10/13/2016 =
* bug fixes for quote request menu and bundled price single page

= 1.7.82 - 10/13/2016 =
* bug fixes for account creation and order data

= 1.7.81 - 10/13/2016 =
* bug fixes for rfq cart not showing and shipping calcualtor


= 1.7.8 - 10/8/2016 =
* fix option defaults for new installs
* fix cart totals

= 1.7.7 - 10/8/2016 =
* support for bundled items in rfq cart and orders
* new admin settings section
* fix sales flash for bundled items on sale and rfq enabled

= 1.7.6 - 10/6/2016 =
* fix order totals

= 1.7.5 - 10/5/2016 =
* fix available and cart totals

= 1.7.4 - 10/3/2016 =
* fix error with cart and zero showing in single product page


= 1.7.3 - 9/30/2016 =
* fix proceed to checkout button

= 1.7.2 - 9/27/2016 =
* rfq page exit

= 1.7.1 - 9/26/2016 =
* hide tax rate

= 1.7 - 9/21/2016 =
* Removed most templates

= 1.6.9 - 8/26/2016 =
* Fix visitor rfq name and email
= 1.6.8 - 8/23/2016 =
* Add coupon enabled check on cart, metaorder doaction in rfq submit, bug fixes

= 1.6.7 - 6/7/2016 =
* Fix problems with variable products in normal checkout and javascript errors. Add default rfq list page to menu automatically

= 1.6.7 - 6/6/2016 =
* Add default page for RFQ page for the normal checkout page

= 1.6.6 - 5/8/2016 =
* Removed Ninja Form

= 1.6.5 - 4/29/2016 =
* Fix bug with RFQ page for logged in users

= 1.6.4 - 4/29/2016 =
* Update settings page, allow link to rfq page vs modal popup
= 1.6.3 - 4/8/2016 =
* bug fix with debug function

= 1.6.2 - 4/8/2016 =
* bug fix with debug function


= 1.6.1 - 4/8/2016 =
* fixed problems wordings for variable rfq

= 1.6 - 4/6/2016 =
* problems with anon orders


= 1.5.9 - 4/1/2016 =
* problems with anon orders

= 1.5.8 - 4/1/2016 =
* problems with bundled products orders
= 1.5.7 - 4/1/2016 =
* problems with bundled products orders

= 1.5.5 - 4/1/2016 =
* improve problems with bundled products

= 1.5.4 - 4/1/2016 =
* Fix problems with my account or order detail

= 1.5.3 - 4/1/2016 =
* Support for variable products, short code for rfq cart, change wordings in settings

= 1.4.9 - 3/19/2016 =
* Bug fix css / js

= 1.4.8 - 3/18/2016 =
* Bug fix css / js

= 1.4.7 - 3/18/2016 =
* Bug fix css

= 1.4.6 - 3/18/2016 =
* Bug fix normal checkout show prices

= 1.4.5 - 3/14/2016 =
* Bug fix variation price

= 1.4.4 - 3/14/2016 =
* CSS Bug fix for RFQ cart


= 1.4.3 - 3/14/2016 =
* CSS Bug fix for RFQ cart

= 1.4.2 - 3/14/2016 =
* Bug fix for RFQ cart

= 1.4.1 - 3/14/2016 =
* Bug fix for RFQ cart

= 1.4 - 3/14/2016 =
* Major Upgrade for normal checkout as well as bugfixes

= 1.3.2 - 2/23/2016 =
* Bug fixes for order status
= 1.3.1 - 2/23/2016 =
* Add filter for proceed to checkout and submit order
= 1.3 - 2/19/2016 =
* Fix bug add to cart not showing when Ninja Forms not installed
= 1.2.9 - 2/8/2016 =
* Fix bug when ninja forms deleted
= 1.2.8 - 2/8/2016 =
* Fix bug with prices showing during normal checkout when it was added to RFQ
= 1.2.7 - 2/10/2016 =
* Fixed bug in defaults
= 1.2.6 - 2/10/2016 =
* Fixed bug to uncheck add to RFQ in product editing
= 1.2.5 - 2/8/2016 =
* Hide prices for visitor only
= 1.2.4 - 2/04/2016 =
* Ninja Form Integration
= 1.2.3 - 1/30/2016 =
* Fix email templates for price/no price
* Add email resend actions in the admin section
= 1.2.2 - 1/29/2016 =
* bug fix
= 1.2.1 - 1/29/2016 =
* bug fix
= 1.2 - 1/27/2016 =
* bug fix
= 1.1.9 - 1/27/2016 =
* bug fix
= 1.1.8 - 1/27/2016 =
* Ability to show/hide prices.
* Make RFQ status editable
* Show coupons applied when submitting a RFQ
* Allow redeeming coupons when submitting a RFQ
= 1.1.8 - 1/26/2016 =
* Fixed checkout page to show shipping and remove payment method "quote_request"
= 1.1.7 - 1/16/2016 =
* Fixed readme
= 1.1.6 - 1/16/2016 =
* Fixed parameter missing warning
= 1.1.5 - 1/15/2016 =
* Fixed readme. Fixed warning
= 1.1.4 - 1/15/2016 =
* Fixed thank you message after paying for order
= 1.1.3 - 1/14/2016 =
* Fixed warning
= 1.1.2 - 1/13/2016 =
* Fixed typo in js directory name
* Fixed missing argument in cart filter
= 1.1.1 - 1/13/2016 =
* Fixed undefined property in register activation.
= 1.1 - 1/10/2016 =

== Upgrade Notice ==

= 1.8.94 - 9/28/2018 =
*anon issues

