/* eslint-disable */
import { slideBar, bindFilterSidebar } from '../modules/side-bar.js';

document.addEventListener( 'DOMContentLoaded', function() {
  bindFilterSidebar()
  document.querySelectorAll('.th-filter-toggle').forEach(itm => {
    itm.addEventListener('click', () => {
      slideBar();
    })
  })
  document.querySelector('.th-grayout-filters').addEventListener('click', () => {
    slideBar();
  })
})

jQuery(document).on("facetwp-loaded", function () {
  //get and parse query arguments
  const urlParams = new URLSearchParams(window.location.search);
  var colors = urlParams.get('_tile_color')
  var color = '';
  if (colors) {
    colors = colors.split(',')
    //color = colors[colors.length - 1]
  }
  if (FWP.loaded) {
    jQuery(".facetwp-template").prepend('<div class="loading"></div>');
  }

  //----refresh
  if (!window.fwp_is_paging) {
    window.fwp_page = 1;
    FWP.extras.per_page = "default";
    bindPage()
    if(colors) {
      setTilesToColor(colors);
    }
  }
  window.fwp_is_paging = false;
  //----refresh
});


//bind
function bindPage() {
  const varSelectors = document.querySelectorAll( '.variation-select' );
  //add select functionality to the variant thumbnails
  varSelectors.forEach( ( element ) => element.addEventListener( 'click', ( e ) => {
    //const pid = e.target.dataset.pid;
    //replace title, if product has title class :. any product with a product excerpt will not have this class and not be changed on class
    var titleLocation = e.target.closest('.tw-var-wrapper').querySelector('.th-prod-title')
    if(titleLocation) {
      titleLocation.innerHTML = e.target.dataset.title
    }
    //replace picture
    var image = e.target.closest('.product').querySelector('.attachment-woocommerce_thumbnail')
    var srcSet =  e.target.srcset.split(",");
    const searchTerm = ' 600w'
    const result = (srcSet.find(e => e.includes(searchTerm)) || "");
    //replace price
    e.target.closest('.th-prod-itm').querySelector('.th-variation-price').innerHTML = e.target.dataset.price
    //replace url
    e.target.closest('.th-prod-itm').querySelector('.p-url').href = e.target.dataset.url
    //replace byline
    e.target.closest('.th-prod-itm').querySelector('.th-variation-byline').innerHTML = e.target.dataset.byline
    //
    image.srcset = e.target.srcset;
    image.src = result;
  }));
}

function setTilesToColor(colors) {
  const prods = document.querySelectorAll('.variation-select img')
  const checker = (arr, target) => {
    //check if target is in array
    let lowercaseArr = arr.map(e => e.toLowerCase());
    return target.every(v => {
      return lowercaseArr.includes(v.toLowerCase())
    })
  };

  //get each variant
  prods.forEach((item) => {
    //get an array of each repsective variant's colors
    let itemColors = item.dataset.color.split(",")
    //if colors are identical (order independent and case insensitive)
    if(checker(itemColors, colors)) {
      var image = item.closest('.product').querySelector('.attachment-woocommerce_thumbnail')
      image.srcset = '';
      image.src = item.src;
      image.closest('.th-prod-itm').querySelector('.p-url').href = item.dataset.url
      return false
    }
  })
}