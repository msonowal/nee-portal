function showError (message) {
	Materialize.toast(message, 10000, 'error');
}

function readURL(input, preview_element_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#'+preview_element_id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
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
    if($(element).is('select') || $(element).is('textarea')){
    	error.insertAfter($(element));
    }else
    	error.insertAfter($(element).siblings('label'));
  }
});
/*
$("form[class~='validate']").each(function(){
	$(this).validate();
});
*/