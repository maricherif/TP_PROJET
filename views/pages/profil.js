let erreur_email= document.getElementById("erreur_email")
let erreur_email2= document.getElementById("erreur_email2")
let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
let submit = document.getElementById("submit")
let erreur_prenom = document.getElementById("erreur_prenom")
let erreur_nom = document.getElementById("erreur_nom")
let nom = document.getElementById("nom")
let prenom = document.getElementById("prenom")
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
  if((!checkemail() && !checknom() && !checkprenom() ) || !checkemail() || !checknom() || !checkprenom() ){
    e.preventDefault()
  }

  })