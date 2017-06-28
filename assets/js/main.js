myReady(function() { //on document ready function



    // if (this == 1) {
    //     document.write('<script type="text/javascript" src="./assets/js/register.js"><\/script>"');
    // }


    document.write('<scr' + 'ipt type="text/javascript" src="./assets/js/register.js"></scr' + 'ipt>');
    //--></script>
});
/*****************************************************
                    DOC.READY FUNCTION
******************************************************/
function myReady(f) {
    /in/.test(document.readyState) ? setTimeout('myReady(' + f + ')', 9) : f();
}