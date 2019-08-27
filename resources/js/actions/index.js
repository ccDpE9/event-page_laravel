export const REQUEST_CONCERTS = "REQUEST_CONCERTS";
export const REQUEST_CONCERTS_ERROR = "REQUEST_CONCERTS_ERROR";
export const RECEIVE_CONCERTS = "RECEIVE_CONCERTS";

export const requestConcerts = () => ({
  type: REQUEST_CONCERTS,
});

export const requestConcertsError = () => ({
  type: REQUEST_CONCERTS_ERROR
});

export const receiveConcerts = json => ({
  type: RECEIVE_CONCERTS,
  concerts: json.data,
  receivedAt: Date.now()
});
