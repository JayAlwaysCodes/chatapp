const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input_field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) =>{
    e.preventDefault(); //preventing form from submitting
}

sendBtn.onclick = ()=>{
    // Ajax code
   let xhr = new XMLHttpRequest();
   xhr.open("POST", "php/insert-chat.php", true)
   xhr.onload = ()=>{
    if(xhr.readyState===XMLHttpRequest.DONE){
        if(xhr.status===200){
           inputField.value = ""; //input field becomes blank once message is message is submitted
           scrollToBottom();
        }
    }

   }
   //send the form data through ajax to php
   let formData = new FormData(form); //creating new formData Object
   xhr.send(formData); //sending the form data to php
}
chatBox.onmouseenter =()=>{
    chatBox.classList.add("active")
}
chatBox.onmouseleave =()=>{
    chatBox.classList.remove("active")
}

setInterval(()=>{
    // Ajax code
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true)
    xhr.onload = ()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){
                    scrollToBottom()
                }
            }
        }
    }
    //send the form data through ajax to php
    let formData = new FormData(form); //creating new formData Object
    xhr.send(formData); //sending the form data to php
}, 500); //this function will run frequently after 500ms

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight
}