import React from "react";
import ReactDOM from "react-dom";

const CheckoutModalContent = ({ onCheckoutClose, onCheckout }) => {
  return ReactDOM.createPortal(
    <aside className="modal-cover">
      <div className="modal">
        <div className="modal__body">
          CHECKOUT CONTENT
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
