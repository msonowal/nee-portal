
function showError (message) {

	Materialize.toast(message, 10000, 'error');
}

/*
$.validator.setDefaults({
	ignore: [],
    errorClass: 'invalid',
    validClass: "valid",
    errorPlacement: function (error, element) {
    	$(element)
            .closest("form")
            .find("label[for='" + element.attr("id") + "']")
            .attr('data-error', error.text());
    },
    submitHandler: function (form) {
        console.log('form ok');
    }
 });
*/

$.validator.setDefaults({
  onkeyup: false,
  errorClass: 'invalid',
  validClass: 'valid',
  submitHandler: function(form) {
    $(form).find("input[type='submit']").prop('disabled', true);
    $(form).find("button[type='submit']").addClass("disabled");
    $(form).find("button[type='submit']").prop('disabled', true);
    form.submit();
  },
  errorPlacement: function(error, element) {
    error.insertAfter($(element).siblings('label'));
  }
});

$("form[class~='validate']").each(function(){
	$(this).validate();
});