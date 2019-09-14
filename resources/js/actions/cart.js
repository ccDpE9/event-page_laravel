export const ADD_PRODUCT_TO_CART = "ADD_PRODUCT_TO_CART";
export const INCREMENT_PRODUCT_QUANTITY = "INCREMENT_PRODUCT_QUANTITY";
export const REMOVE_PRODUCT_FROM_CART = "REMOVE_PRODUCT_FROM_CART";
export const DECREMENT_PRODUCT_QUANTITY = "DECREMENT_PRODUCT_QUANTITY";

export const addProductToCart = (product) => ({
    type: ADD_PRODUCT_TO_CART,
    product
});

export const incrementProductQuantity = (product) => ({
    type: INCREMENT_PRODUCT_QUANTITY,
    product
});

export const removeProductFromCart = (product) => ({
    type: REMOVE_PRODUCT_FROM_CART,
    product
});

export const decrementProductQuantity = (product) => ({
  type: DECREMENT_PRODUCT_QUANTITY,
  product
});

// @TODO:
// - Resource returns:
// -- ticket.price
// -- album.price
// -- merch.price
// - Action are structured:
// -- addProductToCart
// - Reducers stay the same for all products
