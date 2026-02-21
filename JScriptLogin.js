const signUpButton=document.getElementById('CrearOpcion');
const signInButton=document.getElementById('IniciarOpcion');
const signInForm=document.getElementById('IniSes');
const signUpForm=document.getElementById('Creausu');

signUpButton.addEventListener('click',function(){
    signInForm.style.display="none";
    signUpForm.style.display="block";
})
signInButton.addEventListener('click', function(){
    signInForm.style.display="block";
    signUpForm.style.display="none";
})