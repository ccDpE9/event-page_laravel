import React, { Component } from "react";

export default class Concert extends Component {
  onClick() {
    retun (
      // StripeForm
    )
  }

  renderSoldOutConcert() {
  }

  render() {
    /*
    if (this.props.data.ticketsLeft === 0) {
      { renderSoldOutConcert() }
    }
    */

    return (
      <div className="concert-list__concert">
        <div className="concert-list__concert-date">{ this.props.data.date }</div>
        <div className="concert-list__concert-location">
          <div className="concert-list__concert-city">{ this.props.data.city }</div>
          <div className="concert-list__concert-avenue">{ this.props.data.avenue }</div>
        </div>
        <button
          onClick={this.onClick}
        >
          Order
        </button>
      </div>
    );
  }
}
