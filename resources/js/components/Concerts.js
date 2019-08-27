import React, { Component } from "react";
import Concert from "./Concert";
import { connect } from "react-redux";
import { fetchConcerts } from "../api/fetchConcerts";

export class Concerts extends Component {

  componentDidMount() {
    const { dispatch } = this.props;

    dispatch(fetchConcerts());
  }

  render() {
    const {
      concerts,
      loading,
      error
    } = this.props;

    if (loading) {
      return <div className="concerts-loading">Loading...</div>
    }

    if (error) {
      return <div className="concerts-loading-error">Failed to load upcoming concerts...</div>
    }

    return (
      <section className="concerts">
        <div className="concert-list">
          { 
            concerts.map(concert => (
              <Concert data={concert} />
            ))
          }
        </div>
      </section>
    );
  }
};

const mapStateToProps = state => {
  return {
    concerts: state.concerts.items,
    loading: state.concerts.loading,
    error: state.concerts.error
  };
};

export default connect(mapStateToProps)(Concerts);
