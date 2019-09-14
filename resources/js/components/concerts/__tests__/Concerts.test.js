import "babel-polyfill";

import React from "react";
import Concerts from "../../Concerts";
import {
  Enzyme,
  configure,
  mount
} from "enzyme";
import Adapter from "enzyme-adapter-react-16";
import { Provider } from "react-redux";
import store from "../../../store/index";
import axios from "axios";

configure({
  adapter: new Adapter()
});

jest.mock("axios");

const concerts = { data: [
  { 
    title: "Concert number one",
  },
  {
    title: "Concert number two",
  }
]};

const flushAllPromises = () => new Promise(resolve => setTimeout(resolve, 0));

const render = () => mount(
  <Provider store={ store() } >
    <Concerts />
  </Provider>
);

describe("Concerts", () => {

  it("Should render loading state, followed by concerts.", async () => {
    axios.get.mockReturnValue(
      new Promise(resolve => resolve(concerts))
    );
    const component = render();

    //expect(component.find("concerts-loading").exists()).toBe(true);
    //expect(component.find("concerts-loading").text()).toBe("Loading...");
    expect(component.find("concerts-loading-error").exists()).toBe(false);
    //expect(component.find("concert-list").exists()).toBe(true);
    //expect(component.find("concerts-list").length()).toEqual(0);

    await flushAllPromises();
    component.update();

    expect(component.find("concerts-loading").exists()).toBe(false);
    expect(component.find("concerts-loading-error").exists()).toBe(false);
    //expect(component.find("concerts-list").length()).toEqual(2);
    //expect(component.find("concerts.title").text()).toMatch("Concert number one");
  });

  it("Render error message if concerts fail to load.", async () => {
    /*
    concerts.items = [];
    concerts.error = true;

    expect(component.find("concerts-loading").exists()).toBe(true);
    expect(component.find("concerts-loading").text()).toBe("Loading...");
    expect(component.find("concerts-loading-error").exists()).toBe(false);
    expect(component.find("concerts-list").exists()).toBe(true);
    expect(component.find("concerts-list").length()).toEqual(0);

    await flushAllPromises();
    component.update();

    expect(component.find("concerts-loading").exists()).toBe(false);
    expect(component.find("concerts-loading-error").exists()).toBe(true);
    expect(component.find("concerts-loading-error").text()).toMatch("Failed to load upcoming concerts...");
    expect(component.find("concerts-list").length()).toEqual(0);
    */
  });

  it("Should render self and subcomponents.", () => {
  });

  it("Should call requestConcerts.", () => {
    /*
    const { wrapper, props } = setup();

    expect(props.requestConcerts.mock.calls.length).toBe(1);
    */
  });

  it("Should render all of concerts.", () => {
    //expect(wrapper.find("div").length).toEqual(10);
  });

  it("Should render all of the concert's fields.", () => {
    // Loop through concert object keys
    // Assert "concert-list__concert--${key}" exists
  });

  it("Should render a button next to all concerts with tickets left.", () => {
    //expect(wrapper.find("div").length).toEqual(10);
  });

  it("Should indicate that there are no tickets left, and not render a button.", () => {
  });

  it("Clicking on a button returns a stripe checkout modal.", () => {
  });

});
