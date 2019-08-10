import React, { Component } from "react";
import Concert from "./Concert";

export default class Concerts extends Component {
  constructor() {
    super();

    this.state = {
      concerts: [
        {
          title: "Just a concert."
        }
      ]
    }
  };

  render() {
    const { concerts } = this.state;

    return (
      <div className="concerts">
        <ul className="concert-list">
          { 
            this.state.concerts.map(concert => (
              <Concert data={concert} />
            ))
          }
        </ul>
      </div>
    );
  };
};
