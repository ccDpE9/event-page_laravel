import React, { Component } from "react";
import ReactDOM from "react-dom";
import {
  BrowserRouter,
  Route,
  Switch
} from "react-router-dom";
import Concerts from "./Concerts";


class App extends Component {
  render() {
    return (
      /*
      <BrowserRouter>
        <div>
          <Switch>
            <Route exact path="/" component={Concerts} />
          </Switch>
        </div>
      </BrowserRouter>
      */
      <Concerts />
    );
  }
}

ReactDOM.render(
  <App />,
  document.querySelector(".container")
);
