export const REQUEST_CONCERTS = "REQUEST_CONCERTS";
export const RECEIVE_CONCERTS = "RECEIVE_CONCERTS";

export const requestConcerts = () => ({
  type: REQUEST_CONCERTS,
});

export const receiveConcerts = json => ({
  type: RECEIVE_CONCERTS,
  concerts: json.data,
  receivedAt: Date.now()
});

const fetchConcerts = concert => dispatch => {
  dispatch(requestConcerts());
  return fetch("/api/concerts/index")
    .then(response => response.json())
    .then(json => dispatch(receiveConcerts(json)));
}

const shouldFetchConcerts = state => {
  const concerts = state.concerts;

  if(!concerts) {
    return true;
  }

  if(concerts.isFetching) {
    return false;
  }

  return concerts.didInvalidate;
}

export const fetchConcertsIfNeeded = () => (dispatch, getState) => {
  if (shouldFetchConcerts(getState())) {
    return dispatch(fetchConcerts());
  }
}
