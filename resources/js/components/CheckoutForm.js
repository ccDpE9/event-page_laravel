import React, { Component } from "react";
import { CardElement, injectStripe } from "react-stripe-elements";

class CheckoutForm extends Component {
  constructor(props) {
    super(props);

    this.state = {
      ticketQuantity: null
    };
    
    this.handleSubmit = this.handleSubmit.bind(this);
  };

  async handleSubmit(e) {
    e.preventDefault();

    try {
      /*
       * createToken():: converts bank account information into a single-use token
       * returns a Promise which resolves with a result object
       * object has either result.token or result.error properties
       */
      let { token } = await this.props.stripe.createToken({ name: "Name" });

      // --- Send token return from createToken() to a server
      await fetch("localhost:8000/charge", {
        method: "POST",
        headers: { "Content-type": "application/json" },
        // @TODO pass ticketQuantity to server
        body: JSON.stringify({ token })
      })
        .then(res => {
          // --- 1. Clear input
          // --- 2. Thank you alert
          // --- 3. Redirect
        })
        .catch(err => {
        });
    } catch (e) {
      throw e;
    };

  };

  render() {
    return (
      <form className="checkout-form" action="/order" method="POST" onSubmit={this.handleSubmit}>
        <CardElement className="checkout-form__card-number" />
        <input
          type="text"
          className="checkout-form__input--quantity checkout-form__input"
          value={this.state.name}
          onChange={this.handleTicketQuantityChange}
        />
        <button 
          className="btn--order" 
          type="submit"
        >Order ticket
        </button>
      </form>
    );
  };
};

export default injectStripe(CheckoutForm);
