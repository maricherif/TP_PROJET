let erreur_email= document.getElementById("erreur_email")
let erreur_email2= document.getElementById("erreur_email2")
let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
let submit = document.getElementById("submit")
let erreur_passwords = document.getElementById("erreur_passwords")
let erreur_passwords2 = document.getElementById("erreur_passwords2")
let erreur_prenom = document.getElementById("erreur_prenom")
let erreur_roles = document.getElementById("erreur_roles")
let erreur_nom = document.getElementById("erreur_nom")
let passwords = document.getElementById("passwords")
let passwords2 = document.getElementById("passwords2")
let nom = document.getElementById("nom")
let prenom = document.getElementById("prenom")
let email = document.getElementById("email")
let roles = document.getElementById("roles")
let confpasswords = document.getElementById("confpasswords") 


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

  const resetPasswords2 = () =>{
    erreur_passwords2.classList.remove("d-flex")
    erreur_passwords2.classList.remove("d-none")
    confpasswords.classList.remove("d-flex")
    confpasswords.classList.remove("d-none")
    passwords2.style.border= "1px solid black"
    
  }

  const checkpasswords2 = () =>{
    resetPasswords2()
    if(passwords2.value === ""){
        erreur_passwords2.classList.remove("d-none")
        erreur_passwords2.classList.add("d-flex")
        passwords2.style.border= "1px solid red"
        return false;
    }
    if(passwords.value !== passwords2.value){
      confpasswords.classList.remove("d-none")
      confpasswords.classList.add("d-flex")
      passwords.style.border= "1px solid red"
      passwords2.style.border= "1px solid red"
      return false;
}
    
    resetPasswords2()
    return true;
  }

  

  const resetnom = () =>{
    erreur_nom.classList.remove("d-flex")
    erreur_nom.classList.remove("d-none")
    nom.style.border= "1px solid black"
    
  }

  const checknom = () =>{
    resetnom()
    if(nom.value.trim() === ""){
        erreur_nom.classList.remove("d-none")
        erreur_nom.classList.add("d-flex")
        nom.style.border= "1px solid red"
        return false;
    }
    resetnom()
    return true;
  }

  const resetroles = () =>{
    erreur_roles.classList.remove("d-flex")
    erreur_roles.classList.remove("d-none")
    roles.style.border= "1px solid black"
    
  }

  const checkroles = () =>{
    resetroles()
    if(roles.value === ""){
        erreur_roles.classList.remove("d-none")
        erreur_roles.classList.add("d-flex")
        roles.style.border= "1px solid red"
        return false;
    }
    resetroles()
    return true;
  }

  const resetprenom = () =>{
    erreur_prenom.classList.remove("d-flex")
    erreur_prenom.classList.remove("d-none")
    prenom.style.border= "1px solid black"    
  }

  const checkprenom = () =>{
    resetprenom()
    if(prenom.value.trim() === ""){
        erreur_prenom.classList.remove("d-none")
        erreur_prenom.classList.add("d-flex")
        prenom.style.border= "1px solid red"
        return false;
    }
    resetprenom()
    return true;
  }

  submit.addEventListener("click",(e) => {
    console.log("clicked");
  if((!checkemail() && !checkpasswords() && !checkpasswords2() && !checknom() && !checkprenom() && !checkroles() ) || !checkemail() || !checkpasswords() || !checkpasswords2() || !checknom() || !checkprenom() || !checkroles()){
    e.preventDefault()
  }

  })