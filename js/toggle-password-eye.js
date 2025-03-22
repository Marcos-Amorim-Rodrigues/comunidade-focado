function togglePasswordEye() {
  let eyeButton = document.querySelector('.password-eye');
  let eyeButton2 = document.querySelector('.password-eye2');
  let passwordInput = document.querySelector('#senha');
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    eyeButton.classList.toggle('eye-hide');
    eyeButton2.classList.toggle('eye-hide');
  } else {
    passwordInput.type = 'password';
    eyeButton.classList.toggle('eye-hide');
    eyeButton2.classList.toggle('eye-hide');
  }
}
