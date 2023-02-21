/* eslint-disable */
jQuery(document).ready(function(){
  let faqItems = document.querySelectorAll(".faq-box");
  for (let i = 0; i < faqItems.length; i++) {
    let itemClicked = faqItems[i];
    faqItems[i].addEventListener("click", function(evt) {
      showFaq(i);
    });
  }
  function showFaq(varOne) {
    // box that people can click 
    let allFaq = document.querySelectorAll(".faq-box");
    // all answers that can be displayed
    let allAnswers = document.querySelectorAll(".faq-answer");
    // Signifies faq is opened or not 
    let openSig = document.querySelectorAll(".faq-box svg");
    // specific box that is clicked
    let selectedFaq = allFaq[varOne];
    // corresponding answet to clicked box
    let corresAnswer = allAnswers[varOne];
    // corresponding x to selected faq
    let corresX = openSig[varOne];
    if( selectedFaq.classList.contains("plus-sign-click")){
      selectedFaq.classList.remove("plus-sign-click");
      corresX.setAttribute("style", "transform:rotate(45deg)");
      jQuery(corresAnswer).slideDown();
    }
    else{
      selectedFaq.classList.add("plus-sign-click");
      corresX.removeAttribute("style", "transform:rotate(45deg)");
      jQuery(corresAnswer).slideUp();
    }
  }

})

