import React, { Component } from "react";
/*
import {
  BrowserRouter,
  Route,
  Switch
} from "react-router-dom";
*/

import Concerts from "./Concerts";


class App extends Component {
  render() {
    return (
      <div className="container">
        <Concerts />
      </div>
    );
  }
}

export default App;
