import { combineReducers } from "redux";
import concertsReducer from "./concerts";

const rootReducer = combineReducers({
  concertsReducer,
});

export default rootReducer;
