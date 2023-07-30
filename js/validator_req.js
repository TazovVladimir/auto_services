const EMAIL_REGEXP = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
const input_email = document.getElementById('email');
const post_form_btn = document.getElementById('post_form_btn');
function isEmailValid(value) {
 	return EMAIL_REGEXP.test(value);
}

function onInput() {
	if (isEmailValid(input_email.value)) {
		input_email.style.borderColor = 'green';
        post_form_btn.disabled = false
	} else {
		input_email.style.borderColor = 'red';
        post_form_btn.disabled = true
	}
}

input_email.addEventListener('input', onInput);


