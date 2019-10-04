export default function validate(values) {
  let errors = {};

  if (!values.name || !/^[a-z ,.'-]+$/i.test(values.name)) {
    errors.name = "First and last name are required.";
  } 

  if (!values.email || !/\S+@\S+\.\S+/.test(values.email)) {
    errors.email = "Email addres is invalid.";
  }

  if (!values.number || !/^\d+$/.test(values.number)) {
    errors.number = "Number is required.";
  }

  if (!values.country || !/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/.test(values.country)) {
    errors.country = "Country is reqired.";
  }

  if (!values.city || !/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/.test(values.city)) {
    errors.city = "City is required";
  }

  if (!values.address || /^\d+\s[A-z]+\s[A-z]+/.test(values.address)) {
    errors.address = "Address is required.";
  }

  if (!values.postal || /[A-Za-z][1-9][A-Za-z]\s[1-9][A-Za-z][1-9]/.test(values.postal)) {
    errors.postal = "Postal code is required.";
  }

  return errors;
};
