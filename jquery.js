$(document).ready(function () {
  $('#login').click(function () {
    $('.modal-title').html('Login');
    $('.modal-form').html(`<h1 class="text-center">Login</h1>
        <ul class="p-0">
            <li class="mb-4">
                <label for="email">Email :</label>
                <br>
                <input class="w-100 mt-2 px-2 py-2" type="email" id="email" name="email">
            </li>
            <li>
                <label for="password">Password :</label>
                <br>
                <input class="w-100 mt-2 px-2 py-2" type="password" id="password " name="password">
            </li>
            <li class="my-3 d-flex justify-content-center w-100">
              <button class="w-50 btn btn-primary" type="submit" name="login">Login</button>
            </li>
        </ul>`);
  });
  $('#register').click(function () {
    $('.modal-title').html('Register');
    $('.modal-form').html(`<h1 class="text-center">Register</h1>
    <ul class="p-0">
        <li class="mb-4">
            <label for="username">Username :</label>
            <br>
            <input class="w-100 mt-2 px-2 py-2" type="username" id="username" name="username">
        </li>
        <li class="mb-4">
            <label for="email">Email :</label>
            <br>
            <input class="w-100 mt-2 px-2 py-2" type="email" id="email" name="email">
        </li>
        <li>
            <label for="password">Password :</label>
            <br>
            <input class="w-100 mt-2 px-2 py-2" type="password" id="password" name="password">
        </li>
        <li class="d-flex justify-content-center w-100"><button class="btn btn-primary mt-3 w-50 rounded-1" type="submit" name="register">Register</button></li>
    </ul>
`);
  });
});
