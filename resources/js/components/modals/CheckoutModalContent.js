import React from "react";
import ReactDOM from "react-dom";

import useForm from "./useForm";
import {
  StripeProvider,
  Elements
} from "react-stripe-elements";

const CheckoutModalContent = ({ onCheckoutClose, onCheckout }) => {
  const { values, handleChange, handleSubmit } = useForm(charge);

  function charge() {
    console.log(values);
  };

  return ReactDOM.createPortal(
    <aside className="modal-cover">
      <div className="modal">
        <div className="modal__body">
          <StripeProvider apiKey="pk_test_TYooMQauvdEDq54NiTphI7jx">
            <Elements>
              <div className="checkout">
                <div className="checkout__cart-meta">
                  <span>Quantity</span>
                  <span>Subtotal:</span>
                  <span>00</span>
                </div>
                <div className="checkout-form">
                  <input text="text" name="name" className="checkout-form__input checkout-form__input-name" placeholder="First and last name" required
                    value={values.name}
                    onChange={handleChange}
                  />
                  <input type="text" name="email" className="checkout-form__input checkout-form__input-email" placeholder="Email" required
                    value={values.email}
                    onChange={handleChange}
                  />
                  <input type="text" name="number" className="checkout-form__input checkout-form__input-number" placeholder="Phone number" required
                    value={values.number}
                    onChange={handleChange}
                  />
                  <input type="text" name="country" className="checkout-form__input checkout-form__input-country" placeholder="Country" required
                    value={values.country}
                    onChange={handleChange}
                  />
                  <input type="text" name="city" className="checkout-form__input checkout-form__input-city" placeholder="City" required
                    value={values.city}
                    onChange={handleChange}
                  />
                  <input type="text" name="address"className="checkout-form__input checkout-form__input-address" placeholder="Street address" required
                    value={values.address}
                    onChange={handleChange}
                  />
                  <input type="text" name="postal" className="checkout-form__input checkout-form__input-postal" placeholder="Postal code" required
                    value={values.postal}
                    onChange={handleChange}
                  />
                  <CardElement />
                </div>
              </div>
            </Elements>
          </StripeProvider>
        </div>
        <button className="modal__btn--close" onClick={onCheckoutClose}>Close</button>
        <button className="modal__btn--checkout" onClick={handleSubmit}>Order ticket</button>
      </div>
    </aside>,
    document.body
  );
}

export default CheckoutModalContent;
