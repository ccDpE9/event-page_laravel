import Dashboard from "./Dashboard";

export const AdminRoute = () => {
  <Route render={(props) => (
    isAuth === true
    ? <Dashboard />
    : <Redirect to="/404" />
  )} />
};
