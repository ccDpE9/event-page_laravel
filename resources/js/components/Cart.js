import Recat, { Component } from "react";
import { connect } from "react-redux";
import PropTypes from "prop-types";

import { checkout } from "../actions";

const Cart = ({ products, total, onCheckoutClicked }) => {
  const hasProducts = products.length > 0;

  const nodes = hasProducts ? (
    products.map(product => {(
      <Product
        title={product.title}
        price={product.price}
        quantity={product.quantity}
        key={product.id}
      />
    )});
  ) : (
    <span>You cart is currently empty.</span>
  );

  return (
    <div className="cart">
      <h3>Your cart</h3>
      <div>{ nodes }</div>
      <p>Total: &#36;{ total }</p>
      <div className="cart-actions">
        <button
          onClick={closeModal}
        >
          Close Cart
        </button>
        <button 
          onClick={onCheckoutCilked}
          disabled={hasProducts ? "" : "disabled" }
        >
          Checkout
        </button>
      </div>
    </div>
  )
};

Cart.propTypes = {
  products: PropTypes.arrayOf(PropTypes.shape({
    id: PropTypes.number.isRequired,
    title: PropTypes.number.isRequired,
    price: PropTypes.number.isRequired,
    quantity: PropTypes.number.isRequired,
  })).isRequired,
  total: PropTypes.string,
  checkout: PropTypes.funch.isRequired,
}

const mapStateToProps = (state) => ({
  products: getCartProducts(state),
  total: getTotal(state),
});

export default connect(
  mapStateToProps,
  { checkout }
)(Cart);
