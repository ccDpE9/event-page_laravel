import store from "../store";

export const reduxify = (
  Component, 
  props = {},
  state = {}
) => {
  return function reduxWrap() {
    return (
      <Provider store={store}>
        <Component { ...props } />
      </Provider>
    )
  }
};
