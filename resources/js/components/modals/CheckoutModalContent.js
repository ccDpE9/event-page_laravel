import React from "react";
import ReactDOM from "react-dom";
import {
  StripeProvider,
  Elements,
  CardElement
} from "react-stripe-elements";

import useForm from "./useForm";
import validate from "./CheckoutFormValidationRules";
// @TODO: import order from "../../api/order";

const CheckoutModalContent = ({ onCheckoutClose, onCheckout }) => {
  const {
    values,
    errors,
    handleChange,
    handleSubmit
  } = useForm(order, validate);

  function order() {
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
                  {errors.name && (
                    <p>{errors.name}</p>
                  )}
                  <input type="text" name="email" className="checkout-form__input checkout-form__input-email" placeholder="Email" required
                    value={values.email}
                    onChange={handleChange}
                  />
                  {errors.email && (
                    <p>{errors.email}</p>
                  )}
                  <input type="text" name="number" className="checkout-form__input checkout-form__input-number" placeholder="Phone number" required
                    value={values.number}
                    onChange={handleChange}
                  />
                  {errors.number && (
                    <p>{errors.number}</p>
                  )}
                  <input type="text" name="country" className="checkout-form__input checkout-form__input-country" placeholder="Country" required
                    value={values.country}
                    onChange={handleChange}
                  />
                  {errors.country && (
                    <p>{errors.country}</p>
                  )}
                  <input type="text" name="city" className="checkout-form__input checkout-form__input-city" placeholder="City" required
                    value={values.city}
                    onChange={handleChange}
                  />
                  {errors.city && (
                    <p>{errors.city}</p>
                  )}
                  <input type="text" name="address"className="checkout-form__input checkout-form__input-address" placeholder="Street address" required
                    value={values.address}
                    onChange={handleChange}
                  />
                  {errors.address && (
                    <p>{errors.address}</p>
                  )}
                  <input type="text" name="postal" className="checkout-form__input checkout-form__input-postal" placeholder="Postal code" required
                    value={values.postal}
                    onChange={handleChange}
                  />
                  {errors.postal && (
                    <p>{errors.postal}</p>
                  )}
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
