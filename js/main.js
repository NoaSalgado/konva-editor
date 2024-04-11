import buildEditor from './editor.js';

(function init() {
  $.ajax({
    url: 'App/index.php',
    method: 'GET',
    data: { action: 'start' },
    success: function (response) {
      const isAuthenticated = JSON.parse(response) === 'auth';
      isAuthenticated ? loadHome() : loadLoginForm();
    },
  });
})();

function loadLoginForm() {
  $.ajax({
    url: 'App/index.php',
    method: 'GET',
    data: { action: 'loadLogin' },
    success: function (response) {
      $('#content').html(response);
      $("[data-link='logout']").hide();
      $("[data-link='register']").on('click', loadRegisterForm);
      $("[data-form='login']").on('submit', function (e) {
        e.preventDefault();
        const formData = $("[data-form='login']").serializeArray();
        login(formData);
      });
    },
  });
}

function loadRegisterForm() {
  $.ajax({
    url: 'App/index.php',
    method: 'GET',
    data: { action: 'loadRegister' },
    success: function (response) {
      $('#content').html(response);
      $("[data-link='logout']").hide();
      $("[data-link='login']").on('click', loadLoginForm);
      $("[data-form='register']").on('submit', function (e) {
        e.preventDefault();
        const formData = $("[data-form='register']").serializeArray();
        register(formData);
      });
    },
  });
}

function loadHome() {
  $.ajax({
    url: 'App/index.php',
    method: 'GET',
    data: { action: 'loadHome' },
    success: function (response) {
      $('#content').html(response);
      $('[data-link="login"], [data-link="register"]').hide();
      $("[data-link='logout']").show();
      $("[data-link='logout']").on('click', logout);
      buildEditor();
    },
  });
}

function register(formData) {
  const user = {};

  formData.forEach((input) => {
    user[input.name] = input.value;
  });

  if (
    !areAllFieldsFilled(user) ||
    !isValidMail(user['email']) ||
    !passwordsAreEqual(user['password'], user['confirm-password'])
  ) {
    return;
  }

  $.ajax({
    url: 'App/index.php',
    method: 'POST',
    data: { action: 'register', user: user },
    success: function (response) {
      loadHome();
    },
    statusCode: {
      400: (response) => {
        const errorMessage = JSON.parse(response.responseText);
        $('[data-error="email"]').text(errorMessage);
      },
    },
  });
}

function login(formData) {
  const user = {};

  formData.forEach((input) => {
    user[input.name] = input.value;
  });

  if (!areAllFieldsFilled(user) || !isValidMail(user['email'])) {
    return;
  }

  $.ajax({
    url: 'App/index.php',
    method: 'POST',
    data: { action: 'login', user: user },
    success: function (response) {
      loadHome();
    },
    statusCode: {
      400: (response) => {
        const errorMessage = JSON.parse(response.responseText);
        $('[data-error="password"]').text(errorMessage);
      },
      404: (response) => {
        const errorMessage = JSON.parse(response.responseText);
        $('[data-error="password"]').text(errorMessage);
      },
    },
  });
}

function logout() {
  $.ajax({
    url: 'App/index.php',
    method: 'POST',
    data: { action: 'logout' },
    success: function (response) {
      $('[data-link="login"], [data-link="register"]').show();
      $("[data-link='logout']").hide();
      loadLoginForm();
    },
  });
}

// Form validation functions
function areAllFieldsFilled(user) {
  let allFieldsFilled = true;

  Object.entries(user).forEach(([field, value]) => {
    const errorElement = document.querySelector(`[data-error='${field}']`);
    if (value.trim().length === 0) {
      errorElement.textContent = 'El campo no puede estar vacío';
      allFieldsFilled = false;
    } else {
      errorElement.textContent = '';
    }
  });

  return allFieldsFilled;
}

function isValidMail(mail) {
  const regex = /^[a-zA-Z0–9._-]+@[a-zA-Z0–9.-]+.[a-zA-Z]{2,4}$/;
  const errorElement = document.querySelector(`[data-error='email']`);

  if (!regex.test(mail)) {
    errorElement.textContent = 'El email introducido no es válido';
    return false;
  } else {
    errorElement.textContent = '';
    return true;
  }
}

function passwordsAreEqual(password, confirmPassword) {
  const errorElement = document.querySelector(
    `[data-error='confirm-password']`
  );
  if (!(password === confirmPassword)) {
    errorElement.textContent = 'Los passwords introducidos no coindiden';
    return false;
  } else {
    errorElement.textContent = '';
    return true;
  }
}
