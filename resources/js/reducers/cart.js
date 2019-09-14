import {
  ADD_PRODUCT_TO_CART,
  REMOVE_PRODUCT_FROM_CART,
  INCREMENT_PRODUCT_QUANTITY,
  DECREMENT_PRODUCT_QUANTITY
} from "../actions/cart";

const initialState = {
  products: [],
  totalPrice: 0
};

const cart = (
  state = initialState,
  action
) => {
  switch (action.type) {
    case ADD_PRODUCT_TO_CART:
      if (!state.products.includes(action.product)) {
        action.product.quantity = 1;
        action.product.totalPrice = action.product.price;

        return {
          ...state,
          products: [
            ...state.products,
            action.product
          ],
          totalPrice: state.totalPrice += action.product.price
        };
      } else {
        alert("Item is already in the cart.");

        return {
          ...state
        }
      }
    case REMOVE_PRODUCT_FROM_CART:
      return {
        ...state,
        products: [
          ...state.products,
          state.products.filter(item => {
            if (item.slug === action.product.slug) {
              return false;
            }

            return true;
          })
        ],
        totalPrice: state.totalPrice - action.product.totalPrice
      };
    case INCREMENT_PRODUCT_QUANTITY:
      return {
        ...state,
        products: state.products.map(item => {
          if (item.slug === action.product.slug) {
            return {
              ...item,
              quantity: item.quantity + 1
            };
          }

          return item;
        }),
        totalPrice: state.totalPrice + action.product.price
      };
    case DECREMENT_PRODUCT_QUANTITY:
      return {
        ...state,
        products: state.products.map(item => {
          if (item.slug === action.product.slug) {
            return {
              ...item,
              quantity: item.quantity - 1
            }
          }

          return item;
        }),
        totalPrice: state.totalPrice -= action.product.price
      };
    default:
      return state;
  }
};

export default cart;
