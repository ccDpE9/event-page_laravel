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
