import buildEditor from './editor.js';

(function init() {
  $.ajax({
    url: 'App/index.php',
    method: 'GET',
    data: { action: 'start' },
    success: function (response) {
      const isAuthenticated = Boolean(response);
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
      $("[data-link='register']").on('click', loadRegisterForm);
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
      $("[data-link='login']").on('click', loadLoginForm);
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
      buildEditor();
    },
  });
}
