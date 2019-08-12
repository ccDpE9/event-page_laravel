import React, { Component } from "react";
import Concert from "./Concert";
import { connect } from "react-redux";
import { fetchConcertsIfNeeded } from "../api/fetchConcerts";

class Concerts extends Component {

  componentDidMount() {
    const { dispatch } = this.props;

    dispatch(fetchConcertsIfNeeded());
  }

  render() {
    if (this.props.isFetching) {
      return <div>Loading...</div>
    }

    if (this.props.concerts) {
      return (
        <div className="concerts">
          <ul className="concert-list">
            { 
              this.props.concerts.map(concert => (
                <li className="concert-list__concert">
                  <Concert data={concert} />
                </li>
              ))
            }
          </ul>
        </div>
      );
    }

    return (
      <div>There was an error while loading concerts.</div>
    );
  }
};

const mapStateToProps = state => {
  return {
    concerts: state.concertsReducer.items,
    isFetching: state.concertsReducer.isFetching
  };
};

export default connect(mapStateToProps)(Concerts);
