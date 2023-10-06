jQuery(document).ready(function () {
"use strict";




        

    
    


    new WOW().init();
});


function format(input)
{
    var nStr = input.value + '';
    nStr = nStr.replace( /\,/g, "");
    var x = nStr.split( '.' );
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while ( rgx.test(x1) ) {
        x1 = x1.replace( rgx, '$1' + ',' + '$2' );
    }
    input.value = x1 + x2;
}

let inputPrice = document.getElementById("digitPrice");
inputPrice.addEventListener("keypress" , () => format(inputPrice));

