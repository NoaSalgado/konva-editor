export default function register(formData) {
  const user = formData.map((input) => ({
    [input.name]: input.value,
  }));
  console.log(user);
}
