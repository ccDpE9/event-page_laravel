import { combineReducers } from "redux";
import concerts from "./concerts";
import cart from "./cart";

const rootReducer = combineReducers({
  concerts,
  cart
});

export default rootReducer;
