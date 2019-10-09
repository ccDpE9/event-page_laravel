import React from "react";
import { injectStripe, CardElement } from "react-stripe-elements";

import useForm from "./useForm";
import validate from "./CheckoutFormValidationRules";
// @TODO: import order from "../../api/order";

const CheckoutForm = () => {
  const {
    values,
    errors,
    handleChange,
    handleSubmit
  } = useForm(order, validate);

  function order() {
    console.log(values);
  };

  return (
    <div className="checkout-form">
      <input text="text" name="name" placeholder="First and last name"
        className={errors.name ? "checkout-form__input checkout-form__input-name checkout-form__input--error" : "checkout-form__input checkout-form__input-name" }
        value={values.name}
        onChange={handleChange}
      />
      <input type="text" name="email" placeholder="Email" 
        className={errors.email ? "checkout-form__input checkout-form__input-email checkout-form__input--error" : "checkout-form__input checkout-form__input-email"}
        value={values.email}
        onChange={handleChange}
      />
      <input type="text" name="number" placeholder="Phone number"
        className={errors.number ? "checkout-form__input checkout-form__input-number checkout-form__input--error" : "checkout-form__input checkout-form__input-number"}
        value={values.number}
        onChange={handleChange}
      />
      <input type="text" name="country" placeholder="Country"
        className={errors.country ? "checkout-form__input checkout-form__input-country checkout-form__input--error" : "checkout-form__input checkout-form__input-country"}
        value={values.country}
        onChange={handleChange}
      />
      <input type="text" name="city" placeholder="City"
        className={errors.city ? "checkout-form__input checkout-form__input-city checkout-form__input--error" : "checkout-form__input checkout-form__input-city"}
        value={values.city}
        onChange={handleChange}
      />
      <input type="text" name="address" placeholder="Street address"
        className={errors.address ? "checkout-form__input checkout-form__input-address checkout-form__input--error" : "checkout-form__input checkout-form__input-address"}
        value={values.address}
        onChange={handleChange}
      />
      <input type="text" name="postal" placeholder="Postal code"
        className={errors.postal ? "checkout-form__input checkout-form__input-postal checkout-form__input--error" : "checkout-form__input checkout-form__input-postal"}
        value={values.postal}
        onChange={handleChange}
      />
      <CardElement />
    </div>
  )
};

export default injectStripe(CheckoutForm);
