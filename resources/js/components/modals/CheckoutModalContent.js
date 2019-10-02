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
                  <input text="text" name="name" placeholder="First and last name"
                    className={
                      errors.name
                        ? "checkout-form__input checkout-form__input-name checkout-form__input--error"
                        : "checkout-form__input checkout-form__input-name"
                    }
                    value={values.name}
                    onChange={handleChange}
                  />
                  <input type="text" name="email" placeholder="Email" 
                    className={
                      errors.email 
                        ? "checkout-form__input checkout-form__input-email checkout-form__input--error" 
                        : "checkout-form__input checkout-form__input-email"
                    }
                    value={values.email}
                    onChange={handleChange}
                  />
                  <input type="text" name="number" placeholder="Phone number"
                    className={
                      errors.number
                        ? "checkout-form__input checkout-form__input-number checkout-form__input--error" 
                        : "checkout-form__input checkout-form__input-number"
                    }
                    value={values.number}
                    onChange={handleChange}
                  />
                  <input type="text" name="country" placeholder="Country"
                    className={
                      errors.country 
                        ? "checkout-form__input checkout-form__input-country checkout-form__input--error" 
                        : "checkout-form__input checkout-form__input-country"
                    }
                    value={values.country}
                    onChange={handleChange}
                  />
                  <input type="text" name="city" placeholder="City"
                    className={
                      errors.city
                        ? "checkout-form__input checkout-form__input-city checkout-form__input--error" 
                        : "checkout-form__input checkout-form__input-city"
                    }
                    value={values.city}
                    onChange={handleChange}
                  />
                  <input type="text" name="address" placeholder="Street address"
                    className={
                      errors.address 
                        ? "checkout-form__input checkout-form__input-address checkout-form__input--error" 
                        : "checkout-form__input checkout-form__input-address"
                    }
                    value={values.address}
                    onChange={handleChange}
                  />
                  <input type="text" name="postal" placeholder="Postal code"
                    className={
                      errors.postal 
                        ? "checkout-form__input checkout-form__input-postal checkout-form__input--error" 
                        : "checkout-form__input checkout-form__input-postal"
                    }
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
