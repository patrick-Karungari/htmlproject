<form>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <button type="button" onClick="makePayment()">Pay Now</button>
</form>

<script>
function makePayment() {
    FlutterwaveCheckout({
        public_key: "FLWPUBK-d88d5ef8d67ddffb22cddb47600e4b3a-X",
        tx_ref: "RX1",
        amount: 10,
        currency: "RWF",
        country: "RW",
        payment_options: " ",
        customer: {
            email: "cornelius@gmail.com",
            phone_number: "08102909304",
            name: "Flutterwave Developers",
        },
        callback: function(data) { // specified callback function
            console.log(data);
        },
        customizations: {
            title: "Ken Coin",
            description: "Payment for items in cart",
            logo: "https://assets.piedpiper.com/logo.png",
        },
    });
}
</script>
