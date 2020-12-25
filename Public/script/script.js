const submit = document.querySelector('#submit');
const email = document.querySelector('#email');
let checkbox = document.querySelector('#checkbox');
let text = document.querySelector('#errorMessage');
let errorText = document.querySelector('.error');
let hasEmail = false;

email.addEventListener(
  'keyup',
  function validation() {
    const emailValue = email.value.trim();
    const regex = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/gi;
    const regColombia = /(^[^ ]+@[^ ]+\.co)/gi;

    if (emailValue.length === 0) {
      text.innerHTML = 'Email address is required';
      hasEmail = false;
    } else if (!emailValue.match(regex)) {
      text.innerHTML = 'Please provide a valid e-mail address';
      hasEmail = false;
    } else if (emailValue.match(regColombia) && emailValue.slice(-3) == '.co') {
      text.innerHTML =
        'We are not accepting subscriptions from Colombia emails';
      hasEmail = false;
    } else {
      hasEmail = true;
      text.innerHTML = '';
    }
  });

checkbox.addEventListener('change', function () {
  if (hasEmail) {
    if (checkbox.checked) {
      submit.disabled = false;
      errorText.innerHTML = '';
    } else {
      submit.disabled = true;
      errorText.innerHTML = 'You must accept the terms and conditions”';
    }
  } else {
    text.innerHTML = 'Email address is required';
    text.style.color = '#ff0000';
  }
});

const success = function () {
  if (checkbox.disabled) {
    text.innerHTML = 'Success';
    text.style.color = '#00ff00';
  }
};

