let colors_array = [];

 $(function () {

     let cb_array = [];
     const colorApi = 'https://www.colorfyit.com/api/swatches/list.json?url=';
     const discoverApi = 'http://www.colorfyit.com/api/discover/list.json?url=';

    let loader = 0;
    function showloader(cnt){
        loader = loader + cnt;
        if(loader < 1 ){
            $('#loading').hide();
        } else{
            $('#loading').show();
        }
    }
 

     function getColors() {
         let website = $('#url_text').val();
         console.log(website);
         showloader(1);
         $.getJSON('https://json2jsonp.com/?url=' + encodeURIComponent('https://www.colorfyit.com/api/swatches/list.json?url=' + website + '&discover=true') + '&callback=?',
             function (data, status) {
                 console.log(data);
                 data.colors.sort( (a, b) => b.Count - a.Count); // sort count descending order
                 console.log(status);
                 if (data.colors.length == 0) {
                     $('#swatches').append('<p>Couldn\'t retrieve color Hex codes.</p>');
                 } else {
                     $.each(data.colors, function (i, field) {
                         var hex = field.Hex;
                         var count = field.Count;

                         var hxcolors = //html for color swatches
                             '<div class="col-lg-3">' +
                             '<div class="text-center colored_div" title="' + hex + ' "style="background-color:' + hex + '"' + '>' +
                             '<p>' + hex + '</p>' +
                             '</div>' +
                             '<div class="color_info text-center">' +
                             '<button type="button" name="color_button" class="add" value="' + hex + '" aria-hidden="true"><i class="ion-plus-round"></i></button>' +
                             '<p>Found: ' + count + ' times.</p>' +
                             '<input type="hidden" value="' + hex + '">'
                         '</div>' +
                         '</div>';

                         $('#swatches').append(hxcolors);

                         if (i == 15) return false; //limit to 16 results 
                     }); //end each loop
                 } //end if array empty
             }).done( ()=> showloader(-1) ); //end getJSON
     } //end getColors() function


     /*=================Screenshot Api===============*/
     $(document).ajaxStart(function () {
         $('#thumbnail').hide();
         $('#loading1').show();
     });
    
     var urlInput;

     /*function screenshot() {
         urlInput = 'http://' + $('#url_text').val();
         console.log(urlInput);
         $.get('http://api.screenshotlayer.com/api/capture?access_key=d25d40f9853f09059b70e9e7fa3bfb82&url=' + urlInput + '&viewport=1440x900&width=600&height=400&format=jpg', function (data) {
             var source = 'http://api.screenshotlayer.com/api/capture?access_key=d25d40f9853f09059b70e9e7fa3bfb82&url=' + urlInput + '&viewport=1440x900&width=600&height=400&format=jpg';
             $('#thumbnail').attr("src", source);
             console.log(source);
         });*/
    // }
     /*===================Button to pull results==================*/
     $('#url_search').on('click', function (e) {
         e.preventDefault();
         $('#swatches').children().remove();
        // screenshot();
         getColors();
         $('#thumbnail').hide();
         $('#thumbnail').show();
     });
     /*====================Start adding colors to palette======================*/
     $(document).on('click', '.add', function () {
      /*  if (colors_array.length > 5) {
            colors_array.splice(-1,1);
        }*/
         const color = $(this).val();
         const each_palette = 
                '<div class="palette" title="Double click to remove" style="background-color:' + color + '; height:217px; width:97px; float:left; border:1px solid #ccc; "' + '>' +
                    '<input type="text" name="hex_code" style="width:100%; padding:0 !important;" value="' + color + '">' +
                '</div>';

         // $('#make_palette').append('<input type="text" name="hex_code" value="'+ color +'">');
         colors_array.push(color);

         if(colors_array.length < 6){
             $('.e_palette').append(each_palette); //limit to max for 5 colors
         };
         if(colors_array.length > 5){ //remove last added color if array exceeds 5 values
             colors_array.pop();
         };
         
         $('.palette_count #count').text(colors_array.length);
         $('#name_palette').show(); // show input for naming palette after search 
         $('#make_palette_button').show(); // show create palette button after search
         $('.palette_count').show();
         $('#view_palette h3').show();
        
     });

       
     /*==============Remove colors from palette==================*/
     $(document).on('dblclick', '.palette', function () { // remove colored div on click
         let x = $(this);
         let y = x.find('input').val();
         console.log(y);
         x.remove();      // remove the dom element 

         let index = colors_array.indexOf(y);
         if (index > -1) {
             colors_array.splice(index, 1);
             console.log(colors_array);                 //remove the value from the array
         }
         $('.palette_count #count').text(colors_array.length);
         //console.log(x);
     });

     if(colors_array.length < 1){
         $('#make_palette_button').attr('disabled');
     };
     /*================== Ajax================*/
     let make_palette = $('#make_palette_button');
     make_palette.click(function (e) { // button to create palette
         e.preventDefault();

         let name_palette = $('#name_palette').val();
         let ea_palette = colors_array.toString();
         let web_name = $('#url_text').val();
         $.ajax({
             type: 'POST',
             data: {
                 'palette_name': name_palette,
                 'palette': ea_palette,
                 'website': web_name
             },
             global:false,
             url: "insert_palettes.php",
             success: function (results) {
                 console.log(results);
                 $('#name_palette').val('');
                 $.post("show_palettes.php", function (data) {
                     $('#list_palettes').children().remove();
                     $('#list_palettes').html(data);
                 }); // end $.post

             } // end success

         }) // end of ajax function
     }); // end click function


     $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      let hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
   $(document).ajaxComplete(function () {
         $('#loading1').hide();
         $('#thumbnail').show();
     });

 }); // end jQuery document ready