import {
  REQUEST_CONCERTS,
  REQUEST_CONCERTS_ERROR,
  RECEIVE_CONCERTS
} from "../actions";

const initialState = {
  items: [],
  loading: false,
  error: null
};

const concertsReducer = (
  state = initialState,
  action
) => {
  switch (action.type) {
    case REQUEST_CONCERTS:
      return {
        ...state,
        loading: true,
        error: false,
      };
    case REQUEST_CONCERTS_ERROR:
      return {
        ...state,
        loading: false,
        error: true 
      };
    case RECEIVE_CONCERTS:
      return {
        ...state,
        items: action.concerts,
        loading: false,
        error: false,
      }
    default:
      return state;
  }
};

export default concertsReducer;
