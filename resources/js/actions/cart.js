export const ADD_TICKET_TO_CART = "ADD_TICKET_TO_CART";
export const REMOVE_TICKET_FROM_CART = "REMOVE_TICKET_FROM_CART";

export const addTicketToCart = (ticket) => {
  return {
    type: ADD_TICKET_TO_CART,
    ticket,
  }
};

export const removeTicketToCart = ticket => {
  return {
    type: REMOVE_TICKET_FROM_CART,
    ticket
  }
};
