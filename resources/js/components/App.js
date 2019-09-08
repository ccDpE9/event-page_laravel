import React, { Component } from "react";
/*
import {
  BrowserRouter,
  Route,
  Switch
} from "react-router-dom";
*/

import Navbar from "./Navbar";
import Concerts from "./Concerts";


class App extends Component {
  render() {
    return (
      <div className="container">
        <Navbar />
        <Concerts />
      </div>
    );
  }
}

export default App;
