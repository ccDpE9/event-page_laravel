export default function validate(values) {
  let errors = {};

  if (!values.name) {
    errors.name = "Name is required.";
  } else if () {
  }

  if (!values.email) {
    errors.email = "Email address is required"
  } else if (!/\S+@\S+\.\S+/.test(values.email)) {
    errors.email = "Email addres is invalid.";
  }

  if (!values.number) {
    errors.number = "Number is required.";
  }

  if (!values.country) {
    errors.country = "Country is reqired.";
  }

  if (!values.city) {
    errors.city = "City is required";
  }

  if (!values.address) {
    errors.address = "Address is required.";
  }

  if (!values.postal) {
    errors.postal = "Postal code is required.";
  }

  return errors;
};
