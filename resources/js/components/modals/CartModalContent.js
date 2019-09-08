import React from "react";
import ReactDOM from "react-dom";
import { connect } from "react-redux";

const CartModalContent = (props) => {
  return ReactDOM.createPortal(
    <aside className="modal-cover">
      <div className="modal">
        <div className="modal__body">
          {props.cart.products.tickets ? (
            props.cart.products.tickets.map(ticket => (
              <div className="products__ticket">
                <p>Ticket</p>
              </div>
            ))
          ) : (
            <p>No tickets in the cart.</p>
          )}

          {props.cart.products.albums > 0 ? (
            props.cart.products.albums.map(album => (
              <div className="products__album">
                <p>Album</p>
              </div>
            ))
          ) : (
            <p>No albums in the cart.</p>
          )}

          {props.cart.products.merch > 0 ? (
            props.cart.products.merch.map(merch => (
              <div className="products__merch">
                <p>Merch</p>
              </div>
            ))
          ) : (
            <p>No merch in the cart.</p>
          )}

          {props.cart.totalPrice > 0 ? (
            <div className="products__total-price">
              <p>props.cart.totalPrice</p>
            </div>
          ) : (
            ""
          )}
        </div>
        <button 
          className="modal__btn--close"
          onClick={props.onCartClose}
        >
          Close
        </button>
        <button 
          className="modal__btn--checkout"
          onClick={props.onCheckoutOpen}
        >
          Checkout
        </button>
      </div>
    </aside>,
    document.body
  );
}

const mapStateToProps = state => ({
  cart: state.cart,
});

const mapDistpachToProps = dispatch => ({
  addTicket: (slug) => dispatch(addTicketToCart(slug)),
  removeTicket: (slug) => dispatch(removeTicketFromCart(slug)),
});

export default connect(
  mapStateToProps,
  //mapDispatchToProps
  null
)(CartModalContent);
