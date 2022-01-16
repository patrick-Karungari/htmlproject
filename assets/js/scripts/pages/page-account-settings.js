/*=========================================================================================
	File Name: page-account-setting.js
	Description: Account setting.
	----------------------------------------------------------------------------------------
	Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: PIXINVENT
	Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  // variables
  var form = $('.validate-form'),
    flat_picker = $('.flatpickr'),
    accountUploadImg = $('#account-upload-img'),
    accountUploadBtn = $('#account-upload');
var phoneInputButton = $('#verify');
  // Update user photo on click of button
  if (accountUploadBtn) {
    accountUploadBtn.on('change', function (e) {
      var reader = new FileReader(),
        files = e.target.files;
      reader.onload = function () {
        if (accountUploadImg) {
          accountUploadImg.attr('src', reader.result);
        }
      };
      reader.readAsDataURL(files[0]);
    });
  }

  // OTP Form (Focusing on next input)
$("#otp-screen .form-control").keyup(function() {  
if (this.value.length == 0) {
   $(this).blur().parent().prev().children('.form-control').focus();
   $(this).blur().prev('.form-control').focus();
}
else if (this.value.length == this.maxLength) {
   $(this).blur().parent().next().children('.form-control').focus();
   $(this).blur().next('.form-control').focus();
}
});

  
  // flatpickr init
  if (flat_picker.length) {
    flat_picker.flatpickr({
      onReady: function (selectedDates, dateStr, instance) {
        if (instance.isMobile) {
          $(instance.mobileInput).attr('step', null);
        }
      }
    });
  }

  // jQuery Validation
  // --------------------------------------------------------------------
  if (form.length) {
    form.each(function () {
      var $this = $(this);

      $this.validate({
        rules: {
          username: {
            required: true
          },
          name: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          password: {
            required: true
          },
          company: {
            required: true
          },
          'new-password': {
            required: true,
            minlength: 6
          },
          'confirm-new-password': {
            required: true,
            minlength: 6,
            equalTo: '#account-new-password'
          },
          dob: {
            required: true
          },
          phone: {
            required: true
          },
          website: {
            required: true
          },
          'select-country': {
            required: true
          }
        }
      });
      $this.on('submit', function (e) {
        e.preventDefault();
      });
    });
  }
 // console.log(phoneInputButton);
  var validator = $( "#details" ).validate();

  phoneInputButton.validate({
      rules: {
          phone: {
              required: true
          }
      }
  });
  phoneInputButton.click( function(e) {
    console.log('ive been clicked');
    if (validator.element("#phone")) {      
      
      $.ajax({
        url: "settings/sendcode/" + phoneInput.getNumber(intlTelInputUtils.numberFormat.E164),
        type: 'GET',
        success: function (resp) {
            console.log(resp);
           
            if (resp === 'pending') {
                //e.preventDefault();
                return true;
          }
          e.preventDefault();
          return false;
        },
        error: function(e) {
           e.preventDefault();
            return false;
        }
      });
      //return true;
    }
      e.preventDefault();
      return false;
  });
});
