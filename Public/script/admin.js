const filterDropdown = document.getElementById('subscribers-filter');

filterDropdown.addEventListener('change', function (event) {

  window.location.href = "/admin?filter=" + this.value;
});
