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
  var verifyInputButton = $('#otp-verify');
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

  var verify = $("#otp-screen");
  if (verify.length) {
    verify.each(function () {
      
     
      
      var $this = $(this);
      $this.validate({
        rules: {
          code1: {
            required: true
          },
          code2: {
            required: true
          },
          code3: {
            required: true,
            email: true
          },
          code4: {
            required: true
          },
          code5: {
            required: true
          },
          code6: {
            required: true
          }
          
        }
      });
      $this.on('submit', function (e) {
        var code1 = document.getElementById('code1').value;
        var code2 = document.getElementById('code2').value;
        var code3 = document.getElementById('code3').value;
        var code4 = document.getElementById('code4').value;
        var code5 = document.getElementById('code5').value;
        var code6 = document.getElementById('code6').value;

        var code = code1.concat(code2, code3, code4, code5, code6);
        console.log(code);
        $("#verify-btn").className += " d-none";
         $("#verify-spinner").className -= " d-none";
        e.preventDefault();
        $.ajax({
        url: "settings/verifycode/" + phoneInput.getNumber(intlTelInputUtils.numberFormat.E164)+"/"+code,
        type: 'GET',
        success: function (resp) {
            console.log(resp);
            
          if (resp.includes('approved')) {
                console.log("it is true");
            
            
           
            $("#otp-modal").modal('hide').on("hidden.bs.modal", function(){
                $("#otp-screen input").each(function(){
                  var input = $(this);
                  console.log(input);
                  input.val(''); 
                  if (phoneInputButton.hasClass('btn-primary')) {
                    phoneInputButton.removeClass('btn-primary');
                  }
                  if (!phoneInputButton.hasClass('btn-outline-success')) {
                    phoneInputButton.addClass('btn-outline-success');
                  }
                  $('#alert-box').addClass('d-none');
                  phoneInputButton.html('Verified');
                });
            });
            }
            
        },
        error: function (x) {
          
        }
        });
      });
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
    
    //e.preventDefault();
    if (validator.element("#phone")) {  
       
      $.ajax({
        url: "settings/sendcode/" + phoneInput.getNumber(intlTelInputUtils.numberFormat.E164),
        type: 'GET',
        success: function (resp) {
            console.log(resp);
           
          if (resp.includes('pending')) {
            console.log("it is true");
            $("#otp-modal").modal('show').on('shown.bs.modal', function (e) {
              $("#code1").focus(); 
            });
          }

           
        },
        error: function (x) {
         
        }
      });
     
    } 
     
  });

  
});
