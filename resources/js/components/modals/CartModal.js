import React, { Component, Fragment, useState } from "react";

import {
  IoMdCart as CartIcon,
} from "react-icons/io";

import CartModalContent from "./CartModalContent";
import CheckoutModalContent from "./CheckoutModalContent";

const CartModal = () => {
  const [ cartIsOpen, setCartIsOpen ] = useState(false);
  const [ checkoutIsOpen, setCheckoutIsOpen ] = useState(false);

  const onCartOpen = () => {
    setCartIsOpen(true);
  }

  const onCartClose = () => {
    setCartIsOpen(false);
  }

  const onCheckoutOpen = () => {
    setCartIsOpen(false);
    setCheckoutIsOpen(true);
  }

  const onCheckoutClose = () => {
    setCartIsOpen(false);
    setCheckoutIsOpen(false);
  }

  const onCheckout = (data) => {
    console.log(data);
  }

  return (
    <Fragment>
      <CartIcon onClick={onCartOpen} />
      {cartIsOpen &&
        <CartModalContent
          onCartClose={onCartClose}
          onCheckoutOpen={onCheckoutOpen}
        />
      }
      {checkoutIsOpen &&
        <CheckoutModalContent
          onCheckoutClose={onCheckoutClose}
          onCheckout={onCheckout}
        />
      }
    </Fragment>
  );
}

export default CartModal;
