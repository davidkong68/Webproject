
//Get data

const nameInput = document.querySelector("#name");
const email = document.querySelector("#email");
const message = document.querySelector("#message");
const success = document.querySelector("#success");
const errorNodes = document.querySelectorAll(".error");  // errorNodes




//Validate data

function validateForm(){

    clearMessages();
   
    

    if(nameInput.value.length < 1){
        errorNodes[0].innerText = "Name cannot be blank";  
        nameInput.classList.add("error-border");
        
    }
    if(!emailisvalid(email.value)){
        errorNodes[1].innerText = "Invalid email address";  
        email.classList.add("error-border");
       

    }

    if(message.value.length < 1){
        errorNodes[2].innerText = "Please enter message ";  
        message.classList.add("error-border");
      

    }

    if(emailisvalid(email.value)){
        alert("Message send");
    }
    
   
   
}

//clear error and show success messages      
function clearMessages(){           
    for(let i = 0; i < errorNodes.length; i++){
        errorNodes[i].innerText = "";

   
    }
    nameInput.classList.remove("error-border");
    email.classList.remove("error-border");
    message.classList.remove("error-border");
    
}

     //To check email is valid
    function emailisvalid(email){
        let pattern = /\S+@\S+\.\S+/;
        return pattern.test(email);
 
    }
  