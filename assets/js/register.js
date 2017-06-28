 myReady(function() { //on document ready function

     var signupLink = document.querySelector("#signupLink");
     var loginLink = document.querySelector("#loginLink");
     var signupContainer = document.querySelector(".signup-container");
     var loginContainer = document.querySelector(".login-container");
     var errorMessage = document.querySelectorAll(".error-msg-container");
     var submitBtns = document.querySelectorAll(".submit");






     //Hide login container
     signupLink.onclick = function() {


         signupContainer.classList.remove("hide");
         loginContainer.classList.add("hide");
         errorMessage[1].innerHTML = "";
         document.title = 'Register';


     };

     //Hide Signup container
     loginLink.onclick = function() {

         loginContainer.classList.remove("hide");
         signupContainer.classList.add("hide");
         errorMessage[0].innerHTML = "";
         document.title = 'Login';
     };


     clearErrorMsg();

     function clearErrorMsg() {
         for (let i = 0; i < errorMessage.length; i++) {
             if (!errorMessage[i].innerHTML == "") {

                 setTimeout(() => {
                     errorMessage[i].innerHTML = "";

                 }, 2500);

             }

         }

     }

 });

 /*****************************************************
                     DOC.READY FUNCTION
 ******************************************************/
 function myReady(f) {
     (/in/).test(document.readyState) ? setTimeout("myReady(" + f + ")", 9) : f();
 }