import React from "react";
import { connect } from "react-redux";

import {
  addProductToCart,
} from "../actions/cart";

const Concert = ( props ) => (
  <div className="concert-list__concert">
    <div className="concert-list__concert-date">{ props.data.date }</div>
    <div className="concert-list__concert-location">
      <div className="concert-list__concert-city">{ props.data.city }</div>
      <div className="concert-list__concert-avenue">{ props.data.avenue }</div>
    </div>
      <button
      className="concert-list__concert-btn"
      onClick={() => props.addToCart(props.data)}
    >
      Order
    </button>
  </div>
);

const mapDispatchToProps = (dispatch) => ({
  addToCart: (ticket) => dispatch(addProductToCart(ticket)),
});

export default connect(
  null,
  mapDispatchToProps
)(Concert);
