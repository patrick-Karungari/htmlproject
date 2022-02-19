/*=========================================================================================
	File Name: blog-edit.js
	Description: Blog edit field select2 and quill editor JS
	----------------------------------------------------------------------------------------
	Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: PIXINVENT
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function (window, document, $) {
  'use strict';

  var select = $('.select2');
  var editor = '#blog-editor-container .editor';
  var blogFeatureImage = $('#blog-feature-image');
  var blogImageText = document.getElementById('blog-image-text');
  var blogImageInput = document.querySelector('input[name=avatar]');
  var text = document.querySelector('input[name=description]');
  var form = document.querySelector('form');
 // document.getElementById('submit').addEventListener('click', clickeable);
 //alert(form.innerHTML);
  // Basic Select2 select
  select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      // the following code is used to disable x-scrollbar when click in select input and
      // take 100% width in responsive also
      dropdownAutoWidth: true,
      width: '100%',
      dropdownParent: $this.parent()
    });
  });

  // Snow Editor

  var Font = Quill.import('formats/font');
  Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
  Quill.register(Font, true);



  var blogEditor = new Quill(editor, {
    bounds: editor,
    modules: {
      formula: true,
      syntax: true,
      toolbar: [
        [
          {
            font: []
          },
          {
            size: []
          }
        ],
        ['bold', 'italic', 'underline', 'strike'],
        [
          {
            color: []
          },
          {
            background: []
          }
        ],
        [
          {
            script: 'super'
          },
          {
            script: 'sub'
          }
        ],
        [
          {
            header: '1'
          },
          {
            header: '2'
          },
          'blockquote',
          'code-block'
        ],
        [
          {
            list: 'ordered'
          },
          {
            list: 'bullet'
          },
          {
            indent: '-1'
          },
          {
            indent: '+1'
          }
        ],
        [
          'direction',
          {
            align: []
          }
        ],
        ['link', 'image', 'video', 'formula'],
        ['clean']
      ]
    },
    theme: 'snow'
  });
  blogEditor.on('text-change', function() {
    text.value = blogEditor.root.innerHTML;/*JSON.stringify(blogEditor.getContents());*/
    console.log("ON TEXT CHANGE POST VALUE:", $('input[name=description]').val());

  });

  form.onsubmit = function () {
    text.value = blogEditor.root.innerHTML;/*JSON.stringify(blogEditor.getContents());*/
    console.log("ON SUBMIT POST VALUE:", $('input[name=description]').val());
  return true;
  }


/*

  //onsubmit form append form data


  var Delta = Quill.import('delta');

// Store accumulated changes
  var change = new Delta();
  blogEditor.on('text-change', function (delta) {
    change = change.compose(delta);
  });

// Save periodically
  setInterval(function () {
    if (change.length() > 0) {
      console.log('Saving changes', change);
      /!*
      Send partial changes
      $.post('/your-endpoint', {
        partial: JSON.stringify(change)
      });

      Send entire document
      $.post('/your-endpoint', {
        doc: JSON.stringify(quill.getContents())
      });
      *!/
      change = new Delta();
    }
  }, 5 * 1000);

// Check for unsaved data
  window.onbeforeunload = function () {
    if (change.length() > 0) {
      return 'There are unsaved changes. Are you sure you want to leave?';
    }
  }



  function clickeable (){
    var text = document.querySelector('input[name=text]');
    text.value = blogEditor.root.innerHTML;
    console.log(text.value);
    alert(text.value);
    return true;
  }*/



  // Change featured image
  if (blogImageInput.length) {
    $(blogImageInput).on('change', function (e) {
      var reader = new FileReader(),
        files = e.target.files;
      reader.onload = function () {
        if (blogFeatureImage.length) {
          blogFeatureImage.attr('src', reader.result);
        }
      };
      reader.readAsDataURL(files[0]);
      blogImageText.innerHTML = blogImageInput.val();
      blogImageInput.value = blogImageInput.val();
      ///console.log(blogImageInput.value);
    });
  }



})(window, document, jQuery);
