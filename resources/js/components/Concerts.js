import React, { useEffect } from "react";
import Concert from "./Concert";
import { connect } from "react-redux";
import { fetchConcerts } from "../api/fetchConcerts";

const Concerts = (props) => {
  useEffect(async () => {
    await props.fetchConcerts();
  }, []);

  if (props.loading) return <div className="concets-loading">Loading...</div>

  if (props.error) return <div className="concert-loading-error">Failed to load upcoming concerts...</div>

  return (
    <section className="concerts">
      <div className="concert-list">
        { 
          props.concerts.map(concert => (
            <Concert data={concert} />
          ))
        }
      </div>
    </section>
  )
};

const mapStateToProps = state => ({
  concerts: state.concerts.items,
  loading: state.concerts.loading,
  error: state.concerts.error
});

export default connect(mapStateToProps, {
  fetchConcerts
})(Concerts);
