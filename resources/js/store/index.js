import { 
  createStore,
  applyMiddleware
} from "redux";
import reducer from "../reducers/index";
import thunk from "redux-thunk";
// import { routerMiddleware } from "connected-react-router";

const middlewares = [ thunk ];

const store = state => createStore(
  reducer,
  applyMiddleware(...middlewares)
);

export default store;
