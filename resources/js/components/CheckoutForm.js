import React, { Component } from "react";
import { CardElement, injectStripe } from "react-stripe-elements";
import { connect } from "react-redux";

class CheckoutForm extends Component {
  constructor(props) {
    super(props);

    this.state = {
      form: {
        name: "",
        email: "",
        city: ""
      },
      complete: false 
    };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  };

  handleChange(e) {
    this.setState({ form: { 
      ...this.state.form,
      [event.target.id]: event.target.value
    }});
  }

  async handleSubmit(e) {
    e.preventDefault();
    console.log(this.state);

    /*
    let { token } = await this.props.stripe.createToken({ name: "Name" });
    let { products } = this.props.cart;
    let information = this.state.form;

    let response = await fetch("/api/order/charge", {
      method: "POST",
      headers: {
        "Accept": "application/json",
        "Content-Type": "text/plain"
      },
      body: JSON.stringify({
        token: token.id,
        information,
        products
      })
    });

    console.log(response);

    if (response.ok) this.setState({ complete: true });
    */
  };

  render() {
    if (this.state.complete) return <h1>Purchase Complete</h1>;

    return (
      <form className="checkout-form" method="POST" onSubmit={this.handleSubmit}>
        <input
          text="text"
          id="name"
          className="checkout-form__input checkout-form__input-name"
          value={this.state.name}
          onChange={this.handleChange}
          placeholder="First and last name"
        />
        <input
          type="text"
          id="email"
          className="checkout-form__input checkout-form__input-email"
          value={this.state.email}
          onChange={this.handleChange}
          placeholder="Email"
        />
        <input
          text="text"
          id="city"
          className="checkout-form__input checkout-form__input-city"
          value={this.state.city}
          onChange={this.handleChange}
          placeholder="City"
        />
        <CardElement className="checkout-form__card-number" />
        <button 
          className="btn--order" 
          type="submit"
        >Order ticket
        </button>
      </form>
    );
  };
};

const mapStateToProps = (state) => ({
  cart: state.cart,
});

export default connect(mapStateToProps)(injectStripe(CheckoutForm));
