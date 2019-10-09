import React from "react";
import ReactDOM from "react-dom";
import { connect } from "react-redux";
import {
  StripeProvider,
  Elements,
  CardElement
} from "react-stripe-elements";

const CheckoutModalContent = ({ onCheckoutClose, onCheckout }) => {
  return ReactDOM.createPortal(
    <aside className="modal-cover">
      <div className="modal">
        <div className="modal__body">
          <div className="checkout">
            <div className="checkout__cart-meta">
              <span>Quantity</span>
              <span>Subtotal:</span>
              <span>00</span>
            </div>
            <StripeProvider apiKey="pk_test_TYooMQauvdEDq54NiTphI7jx">
              <Elements>
                <CheckoutForm 
                  values={values}
                  handleChange={handleChange}
                />
              </Elements>
            </StripeProvider>
            <div className="modal__btns">
              <a className="modal__btn--close" onClick={onCheckoutClose}>Close</a>
              <a className="modal__btn--checkout" onClick={handleSubmit}>Order ticket</a>
            </div>
          </div>
        </div>
      </div>
    </aside>,
    document.body
  );
}

const mapStateToProps = state => ({
  itemsQuantity: state.cart.products.reduce((acc, val) => acc.quantity + val)
});

export default connect(
  mapStateToProps,
  null,
)(CheckoutModalContent);
