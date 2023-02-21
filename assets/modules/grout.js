/* eslint-disable */
//onload
document.addEventListener( 'DOMContentLoaded', function() {
  jQuery('.variations_form').on('woocommerce_variation_has_changed', function () {
    //console.log('changed')
  });
})

function calcGroutQty(groutPerBox, boxQty) { 
  const total = groutPerBox * boxQty;
  return Math.ceil(total);
}

export { calcGroutQty };