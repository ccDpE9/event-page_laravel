import React, { Component } from "react";
import Concert from "./Concert";
import { connect } from "react-redux";
import { fetchConcerts } from "../api/fetchConcerts";

class Concerts extends Component {

  componentDidMount() {
    this.props.fetchConcerts();
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

const mapStateToProps = state => ({
  concerts: state.concerts.items,
  loading: state.concerts.loading,
  error: state.concerts.error
});

export default connect(mapStateToProps, {
  fetchConcerts
})(Concerts);
