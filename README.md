# mycode
This is a simple wordpress plugin supporting Woocommerce / Members customization for my wordpress sites.

This plugin will:

1. redirect the user to the main page after login
2. hook the process order for premium content purchases
3. validate subscription expiry upon site access by logged in user

The order customization for a premium content purchase shall:

1. enable the "premium_subscriber" role for the user purchasing a premium subscription
2. set a subscription expiry date for the user

The subscription validation shall:

1. remove the role "premium_subscriber" for a user whose subscription has expired
