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
