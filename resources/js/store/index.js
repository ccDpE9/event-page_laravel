import { 
  createStore,
  applyMiddleware
} from "redux";
import thunk from "redux-thunk";
// import { routerMiddleware } from "connected-react-router";

const middlewares = [ thunk ];

const store = createStore(
  reducer,
  applyMiddleware(...middlewares)
);

export default store;
