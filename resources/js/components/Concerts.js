import React, { Component } from "react";
import Concert from "./Concert";
import { connect } from "react-redux";
import { fetchConcertsIfNeeded } from "../api/fetchConcerts";

const concertListStyle = {
  maxWidth: "1700px",
  marginLeft: "auto",
  marginRight: "auto",
  fontSize: "16px",
  letterSpacing: "2px",
  lineHeight: "1px",
  textTransform: "uppercase",
  color: "rgb(193, 191, 190)"
};

export class Concerts extends Component {

  componentDidMount() {
    const { dispatch } = this.props;

    dispatch(fetchConcertsIfNeeded());
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

    if (this.props.concerts) {
      return (
        <section className="concerts">
          <div className="concert-list">
            { 
              this.props.concerts.map(concert => (
                <Concert data={concert} />
              ))
            }
          </div>
        </section>
      );
    }

    return (
      <div>There was an error while loading concerts.</div>
    );
  }
};

const mapStateToProps = state => {
  console.log(state);
  return {
    concerts: state.concertsReducer.items,
    loading: state.concertsReducer.loading,
    error: state.concertsReducer.error,
  };
};

export default connect(mapStateToProps)(Concerts);
