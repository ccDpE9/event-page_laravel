import configureMockStore from "redux-mock-store";
import thunk from "redux-thunk";
import {
  fetchConcertsIfNeeded
} from "../../api/fetchConcerts";
import {
  REQUEST_CONCERTS,
  RECEIVE_CONCERTS,
  requestConcerts,
  receiveConcerts
} from "../index";
import fetchMock from "fetch-mock";

const middlewares = [ thunk ];
const mockStore = configureMockStore(middlewares);

describe("Concert action creators.", () => {

  beforeEach(() => {
    fetchMock.mock("/api/concerts/index", {
      data: {
        "title": "Just a concert.",
      }
    });
  });

  afterEach(() => {
    fetchMock.restore();
  });

  it("fetchConcertsIfNeeded dispatches two actions.", () => {
    const expectedActions = [
      {
        type: REQUEST_CONCERTS
      },
      {
        type: RECEIVE_CONCERTS,
        concerts: {
          "title": "Just a concert."
        },
        receivedAt: Date.now()
      }
    ];

    const initialState = {
      items: [],
      isFetching: false,
      error: null
    };

    const store = mockStore(initialState);

    return store.dispatch(fetchConcertsIfNeeded()).then((data) => {
      expectedActions[1].receivedAt = data.receivedAt;
      expect(store.getActions()).toEqual(expectedActions);
    });
  });

});
