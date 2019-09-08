import {
  ADD_TICKET_TO_CART,
  REMOVE_TICKET_FROM_CART,
} from "../actions/cart";

const initialState = {
  products: {
    tickets: [],
    albums: [],
    merch: [],
  },
  totalPrice: 0
};

const cart = (
  state = initialState,
  action
) => {
  switch (action.type) {
    case ADD_TICKET_TO_CART:
      var ticket = action.ticket;

      if (state.products.tickets.includes(ticket)) {
        let newTicket = state.products.tickets.find(item => item.slug === action.ticket.slug);
        newTicket.quantity += 1;

        return {
          ...state,
          products: {
            ...state.products,
            tickets: {
              ...state,
              newTicket
            }
          }
        };
      } else {
        ticket.quantity = 1;

        return Object.assign(
          {},
          state,
          state.products.tickets.push(ticket)
        );
      }
    case REMOVE_TICKET_FROM_CART:
      /*
      if (item.quantity && item.quantity > 1) {
      } 
      else if (item.quantity && item.quantity == 1) {
      }
      else {
        console.log("Item is not in cart.");
      }
      /*
    case ADD_ALBUM_TO_CART:
    case REMOVE_ALBUM_FROM_CART:
    case ADD_MERCH_TO_CART:
    case REMOVE_MERCH_FROM_CART:
    */
    default:
      return state;
  }
};

export default cart;
