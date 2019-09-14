import React from "react";
import ReactDOM from "react-dom";
import { connect } from "react-redux";

import {
  incrementProductQuantity,
  decrementProductQuantity
} from "../../actions/cart";

import {
  IoMdAdd as Add,
  IoMdRemove as Minus
} from "react-icons/io";

const CartModalContent = (props) => {
  /*
  cart
    cart__tickets
      cart__ticket
    cart__albums
    cart__merch
    cart__order
      cart__order-quantity--up
      cart__order
      cart__order-price
      */
  return ReactDOM.createPortal(
    <aside className="modal-cover">
      <div className="modal">
        <div className="modal__body">
          {props.cart.products ? (
            <div className="cart">
              { props.cart.products.map(product => (
                <div className="cart__product">
                  <span>{ product.title }</span>
                  <div className="cart__order clearfix">
                    <span className="cart__order-remove">Remove</span>
                    <div className="cart__order-quantity">
                      <span className="cart__order-down">
                        { product.quantity <= 1 ? (
                          <Minus />
                        ) : (
                          <Minus 
                            onClick={() => props.decrementQuantity(product)}
                          />
                        )}
                      </span>
                      <span>{ product.quantity }</span>
                      <span className="cart__order-up">
                        <Add 
                          onClick={() => props.incrementQuantity(product)}
                        />
                      </span>
                      <span className="cart__order-price">{ product.totalPrice }</span>
                    </div>
                  </div>
                  <hr />
                </div>
              ))}
              <div>
                <span>Subtotal (EUR)</span>
                <span>{ props.cart.totalPrice }</span>
              </div>
            </div>
          ) : (
            <p>Your cart is currently empty...</p>
          )}
        </div>
        <button 
          className="modal__btn--close"
          onClick={props.onCartClose}
        >
          Close
        </button>
        <button 
          className="modal__btn--checkout"
          onClick={props.onCheckoutOpen}
        >
          Checkout
        </button>
      </div>
    </aside>,
    document.body
  );
}

const mapStateToProps = state => ({
  cart: state.cart,
});

const mapDispatchToProps = dispatch => ({
  incrementQuantity: (product) => dispatch(incrementProductQuantity(product)),
  decrementQuantity: (product) => dispatch(decrementProductQuantity(product)),
});

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(CartModalContent);
