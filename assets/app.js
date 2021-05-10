/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
// start the Stimulus application
import './bootstrap';

window.addEventListener("load",() =>{

    // let counters = document.querySelectorAll(".counter");
    let speed = 200;
    const menu = document.querySelector("#menu");
    const dropDown = document.querySelector("#dropdown");
    const depotbtn = document.querySelector("#depotadd");
    const modal = document.querySelector("#modal");
    const closeModal = document.querySelector("#closemodal")

    function removeModal(e) {
        e.preventDefault()
        if(modal.classList.contains("block")){
            modal.classList.remove("block")
            modal.classList.add("hidden")
        }
    }
    function toggleMenu() {
        dropDown.classList.toggle("md:block")

    }
    function addModal(e){
        e.preventDefault()
        if(modal.classList.contains("hidden")){
            modal.classList.remove("hidden")
            modal.classList.add("block")
        }
    }
    menu.addEventListener("click",toggleMenu);
    depotbtn.addEventListener("click",addModal);
    closeModal.addEventListener("click",removeModal)
})
