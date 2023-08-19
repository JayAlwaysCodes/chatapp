const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-txt");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
   // Ajax code
   let xhr = new XMLHttpRequest();
   xhr.open("POST", "php/signup.php", true)
   xhr.onload = ()=>{
    if(xhr.readyState===XMLHttpRequest.DONE){
        if(xhr.status===200){
            let data = xhr.response;
            if(data == "success"){
                location.href = "user.php"

            }else{
                errorText.textContent = data; 
                errorText.style.display = "block"
            }
        }
    }

   }
   //send the form data through ajax to php
   let formData = new FormData(form); //creating new formData Object
   xhr.send(formData); //sending the form data to php

}