/* eslint-disable */
import { colorMe, uncolorMe } from '../modules/style.js';
import { slideCart, init } from '../../../../mu-plugins/theory-woocommerce-ajax/modules/cart.js';
import { bindCart } from '../../../../mu-plugins/theory-woocommerce-ajax/modules/cart.js';

/* eslint-disable */
document.addEventListener( 'DOMContentLoaded', function() {
  init();
  //miniCart Styles and slide
  const miniCartIcon = document.querySelector("#mini-cart-icon")  
  //Add hover effects to header icon
  miniCartIcon.addEventListener("mouseenter", () => {
    colorMe(miniCartIcon)
  })
  miniCartIcon.addEventListener("mouseleave", () => {
    uncolorMe(miniCartIcon)
  })

  //Add slide function to cart icons click
  miniCartIcon.addEventListener("click", slideCart);

  //add initial increment and decrement fxs
  const miniCart = jQuery('.th-mini-cart')
  bindCart('.increment-cart-item', '.decrement-cart-item', '.remove-cart-item', miniCart, '#cartQuant');
})

