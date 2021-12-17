<form>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <button type="button" onClick="makePayment()">Pay Now</button>
</form>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="EBAWKYYPGWHWE">
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit"
        alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


<script>
function makePayment() {
    FlutterwaveCheckout({
        public_key: "FLWPUBK-d88d5ef8d67ddffb22cddb47600e4b3a-X",
        tx_ref: "RX1",
        amount: 10,
        currency: "USD",
        country: "US",
        payment_options: "",
        redirect_url: // specified redirect URL
            "https://callbacks.piedpiper.com/flutterwave.aspx?ismobile=34",
        meta: {
            consumer_id: 23,
            consumer_mac: "92a3-912ba-1192a",
        },
        customer: {
            email: "cornelius@gmail.com",
            phone_number: "08102909304",
            name: "Flutterwave Developers",
        },
        callback: function(data) {
            console.log(data);
        },
        onclose: function() {
            // close modal
        },
        customizations: {
            title: "Ken Coin",
            description: "Payment for items in cart",
            logo: "https: //alpha-capital-investments.com/assets/img/logo.png",
        },
    });
}
</script>
