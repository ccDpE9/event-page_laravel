import React from "react";
import ReactDOM from "react-dom";
import { connect } from "react-redux";

import {
  removeProductFromCart,
  incrementProductQuantity,
  decrementProductQuantity
} from "../../actions/cart";

import {
  IoIosAddCircle as Add,
  IoIosRemoveCircle as Minus,
  IoIosRemoveCircleOutline as MinusGhost
} from "react-icons/io";

const CartModalContent = (props) => {
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
                    <span className="cart__order-remove">
                      <a href="#" onClick={(e) => props.removeProduct(product)}>Remove</a>
                    </span>
                    <div className="cart__order-quantity">
                      <span className="cart__order-quantity--down">
                        { product.quantity <= 1 ? ( <MinusGhost /> ) : ( <Minus onClick={() => props.decrementQuantity(product)}/> )}
                      </span>
                      <span>{ product.quantity }</span>
                      <span className="cart__order-quantity--up">
                        <Add onClick={() => props.incrementQuantity(product)} />
                      </span>
                      <span className="cart__order-price">&euro;{ product.totalPrice }</span>
                    </div>
                  </div>
                  <hr />
                </div>
              ))}
              <div className="cart__order-total">
                <span>Subtotal (EUR)</span>
                <span>&euro;{ props.cart.totalPrice }</span>
              </div>
            </div>
          ) : (
            <div className="cart__empty">
              <p>Your cart is currently empty...</p>
            </div>
          )}
        </div>
        <div className="modal__btns">
          <a className="modal__btn--close" onClick={props.onCartClose}>Close</a>
          <a className="modal__btn--checkout" onClick={props.onCheckoutOpen}>Checkout</a>
        </div>
      </div>
    </aside>,
    document.body
  );
}

const mapStateToProps = state => ({
  cart: state.cart,
});

const mapDispatchToProps = dispatch => ({
  removeProduct: (product) => dispatch(removeProductFromCart(product)),
  incrementQuantity: (product) => dispatch(incrementProductQuantity(product)),
  decrementQuantity: (product) => dispatch(decrementProductQuantity(product)),
});

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(CartModalContent);
