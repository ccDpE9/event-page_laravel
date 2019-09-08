import axios from "axios";
import {
  requestConcerts,
  requestConcertsError,
  receiveConcerts
} from "../actions/index";

export const fetchConcerts = () => dispatch => {
  dispatch(requestConcerts());
  return axios.get("/api/concerts/index")
    .then(res => res.data)
    .then(concerts => dispatch(receiveConcerts(concerts)))
    .catch(err => dispatch(requestConcertsError()));
}

export const order = products => (dispatch, getState) => {
  const { cart } = getState();

  dispatch({
    type: types.CHECKOUT_REQUEST
  });

  axios.post("/api/order/store");

};
