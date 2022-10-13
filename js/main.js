let menu = document.querySelector("#menu-btn");
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
    menu.classList.toggle('fa-times')
    navbar.classList.toggle('active')
};

document.getElementById('order').onsubmit = function(){
    let emai = document.getElementById('email').value; 
    let tel =/(\d{3})[- ](\d{3})[- ](\d{3})/; 

    if(document.querySelector("#name").value=="")
    {
        alert("please fill the name ..!!")
    }
    if(/^[A-Za-z]*\s{1}[A-Za-z]*$/.test(document.querySelector("#name").value) === false 
    && /^[\u0600-\u06FF\u0750-\u077F]*\s{1}[\u0600-\u06FF\u0750-\u077F]*$/.test(document.querySelector("#name").value) === false){
        alert("allowed Arabic and english Character ..!")
        return false;
    }
    if(tel.test(document.getElementById("tel_id").value) === false){
        alert("Allowed Number btween 0-9 like: 000-000-000..!")
        return false;
    }
    if(emai == ""){
        alert("Please enter your email ..!")
        return false;
    }
    if(/(com|net|org|info)/g.test(emai) === false){
    alert("You must include in end of email one of these: \"com, net, org, info\"");
    return false;
    }
    if(document.querySelector("#address").value=== ""){
        alert("Enter your address")
        return false;
    }
}
