require("dotenv").config();
import React, { Component } from "react";
import { StripeProvider, Elements } from "react-stripe-elements";

import CheckoutForm from "./components/CheckoutForm";

const App = () => (
  <StripeProvider apiKey={process.env.STRIPE_KEY}>
    <Elements>
      <CheckoutForm />
    </Elements>
  </StripeProvider>
);

export default App;
