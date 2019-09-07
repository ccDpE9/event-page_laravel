import React, { Component } from "react";
import { connect } from "react-redux";

import {
  addTicketToCart,
} from "../actions/cart";

class Concert extends Component {
  constructor(props) {
    super(props);

    this.handleAddToCart = this.handleAddToCart.bind(this);
  }

  handleAddToCart() {
    let ticket = this.props.data;
    delete ticket["tickets_left"];

    this.props.addToCart(ticket);
    console.log(this.props);
  }

  renderSoldOutConcert() {
  }

  render() {
    return (
      <div className="concert-list__concert">
        <div className="concert-list__concert-date">{ this.props.data.date }</div>
        <div className="concert-list__concert-location">
          <div className="concert-list__concert-city">{ this.props.data.city }</div>
          <div className="concert-list__concert-avenue">{ this.props.data.avenue }</div>
        </div>
        <button
          className="concert-list__concert-btn"
          onClick={this.handleAddToCart.bind()}
        >
          Order
        </button>
      </div>
    );
  }
}

const mapDispatchToProps = (dispatch) => ({
  addToCart: (ticket) => dispatch(addTicketToCart(ticket)),
});

export default connect(
  null,
  mapDispatchToProps
)(Concert);
