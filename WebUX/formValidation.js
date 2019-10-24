
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {

        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
var checkPasswords = function() {
	pass1 = document.getElementById("newPassword");
	pass2 = document.getElementById("newPassword2");
	if(pass1.value != pass2.value){
		pass1.setCustomValidity("Passwords must match");
		pass2.setCustomValidity("Passwords must match");
		}
	else{
    if(pass1 == ""){
      pass1.setCustomValidity("Enter a Password");
  		pass2.setCustomValidity("Enter a Password");
    }
    else{
		pass1.setCustomValidity("");
		pass2.setCustomValidity("");
    }
	}

}
function extractFilename(path) {
  if (path.substr(0, 12) == "C:\\fakepath\\")
    return path.substr(12); // modern browser
  var x;
  x = path.lastIndexOf('/');
  if (x >= 0) // Unix-based path
    return path.substr(x+1);
  x = path.lastIndexOf('\\');
  if (x >= 0) // Windows-based path
    return path.substr(x+1);
  return path; // just the filename
}

function changeLabel( input) {
	var label = input.nextSibling.nextSibling;
	if(label.tagName != "LABEL"){
		label = label.nextSibling;
	}
	label.innerHTML = extractFilename(input.value);
}
