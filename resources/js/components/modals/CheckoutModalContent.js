import React from "react";
import ReactDOM from "react-dom";

import {
  StripeProvider,
  Elements
} from "react-stripe-elements";
import CheckoutForm from "../CheckoutForm";

const CheckoutModalContent = ({ onCheckoutClose, onCheckout }) => {
  return ReactDOM.createPortal(
    <aside className="modal-cover">
      <div className="modal">
        <div className="modal__body">
          <StripeProvider apiKey="pk_test_TYooMQauvdEDq54NiTphI7jx">
            <Elements>
              <CheckoutForm />
            </Elements>
          </StripeProvider>
        </div>
        <button 
          className="modal__btn--close"
          onClick={onCheckoutClose}
        >
          Close
        </button>
        <button 
          className="modal__btn-checkout"
          onClick={onCheckout}
        >
          Checkout
        </button>
      </div>
    </aside>,
    document.body
  );
}

export default CheckoutModalContent;
