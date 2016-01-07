
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
  //onkeyup: false,
  ignore: [],
  errorClass: 'invalid',
  validClass: 'valid',
  errorElement: 'span',
  //errorClass: 'help-block',
  submitHandler: function(form) {
     $(form).find("input[type='submit']").prop('disabled', true);
     $(form).find("button[type='submit']").addClass("disabled");
     $(form).find("button[type='submit']").prop('disabled', true);
     form.submit();
  },
  errorPlacement: function(error, element) {

    if($(element).is('select')){
    	error.insertAfter($(element));
    }else
    	error.insertAfter($(element).siblings('label'));
    //console.log(element);
  }
});

/*
$("form[class~='validate']").each(function(){
	$(this).validate();
});
*/
