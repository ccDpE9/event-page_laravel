import {
  REQUEST_CONCERTS,
  RECEIVE_CONCERTS
} from "../actions";

const initialState = {
  items: [],
  isFetching: false,
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
        isFetching: true,
        didInvalidate: false
      };
    case RECEIVE_CONCERTS:
      return {
        ...state,
        isFetching: false,
        didInvalidate: false,
        items: action.concerts,
        lastUpdated: action.receivedAt
      }
    default:
      return state;
  }
};

export default concertsReducer;
