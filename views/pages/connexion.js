let erreur_email= document.getElementById("erreur_email")
let erreur_email2= document.getElementById("erreur_email2")
let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
let submit = document.getElementById("submit")
let erreur_passwords = document.getElementById("erreur_passwords")
let passwords = document.getElementById("passwords")
let email = document.getElementById("email")


const checkemail = () =>{
    resetemail ()
    if(email.value.trim() === ""){
        erreur_email.classList.remove("d-none")
        erreur_email.classList.add("d-flex")
        email.style.border= "1px solid red"
        return false;
    }
    if(!regex.test(email.value.trim())){
        erreur_email2.classList.remove("d-none")
        erreur_email2.classList.add("d-flex")
        email.style.border= "1px solid red"
        
return false;
    }
   
    resetemail()
    return true;
  
  }
  const resetemail = () =>{
    erreur_email.classList.remove("d-flex")
    erreur_email.classList.remove("d-none")
    erreur_email2.classList.remove("d-flex")
    erreur_email2.classList.remove("d-none")
    email.style.border= "1px solid black"
  }
  const resetPasswords = () =>{
    erreur_passwords.classList.remove("d-flex")
    erreur_passwords.classList.remove("d-none")
    passwords.style.border= "1px solid black"
    
  }

  const checkpasswords = () =>{
    resetPasswords()
    if(passwords.value === ""){
        erreur_passwords.classList.remove("d-none")
        erreur_passwords.classList.add("d-flex")
        passwords.style.border= "1px solid red"
        return false;
    }
    resetPasswords()
    return true;
  } 

  submit.addEventListener("click",(e) => {
    console.log("clicked");
  if((!checkemail() && !checkpasswords()) || !checkemail() || !checkpasswords() ){
    e.preventDefault()
  }

  })