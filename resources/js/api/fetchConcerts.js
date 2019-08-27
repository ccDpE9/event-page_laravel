import axios from "axios";
import {
  requestConcerts,
  requestConcertsError,
  receiveConcerts
} from "../actions/index";

const fetchConcerts = concert => dispatch => {
  dispatch(requestConcerts());
  return axios.get("/api/concerts/index")
    .then(res => res.data)
    .then(concerts => dispatch(receiveConcerts(concerts)))
    .catch(err => dispatch(requestConcertsError()));
}

const shouldFetchConcerts = state => {
  const concerts = state.concerts;

  if(!concerts) {
    return true;
  }

  if(concerts.isFetching) {
    return false;
  }

  return concerts.didInvalidate;
}

export const fetchConcertsIfNeeded = () => (dispatch, getState) => {
  if (shouldFetchConcerts(getState())) {
    return dispatch(fetchConcerts());
  }
}
