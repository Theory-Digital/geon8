import { slideCart, addToCart, blurCart, unblurCart, rebuildCart, addToCartMaybeGrout } from '../../../../mu-plugins/theory-woocommerce-ajax/modules/cart.js';
import { calcGroutQty } from '../modules/grout.js';
import { refreshNotices } from '../../../../mu-plugins/theory-woocommerce-ajax/modules/notices.js';
// import { bindToolTips } from '../modules/tooltip.js';

/* eslint-disable */
function bindToolTips() {
  var a = document.querySelectorAll('[tooltip]'),
        tip, text,
        base = document.createElement('tooltip'); //Defining all objects
        base.close = () => {base.remove()}
  for (var x=0;x < a.length;x++) {
    const waiver = a[x].getAttribute('waiver')
    const item = a[x]
    const event = new MouseEvent('confirmed', {bubbles: true})
    const eventOpen = new MouseEvent('open', {bubbles: true})
    //global listener for checked waiver since it is dynamically generated
    document.addEventListener('click',function(e){
      if(e.target.classList.contains('waiver')){
        if(e.target.checked) {
          //proc event on [tooltip] object to allow for external handling
          e.target.closest('[tooltip]').dispatchEvent(event)
        }
      }
    });
    item.addEventListener('click', function (e) {
      var ar = Array.from(item.children)
      if(e.target === item || ar.includes(e.target) ) {
        text = this.getAttribute('tooltip');
        if (text != null) {// Checking if tooltip is empty or not.
          if(waiver == "true") {
            base.innerHTML = 
            `<div class="tw-bg-yellow-50 tw-border-l-4 tw-border-yellow-400 tw-p-4 tw-w-full md:tw-w-60 tw-top-0 tw-cursor-auto tw-shadow-lg">
              <div class="tw-flex">
                <div class="tw-flex-shrink-0">
                  <svg class="tw-h-5 tw-w-5 tw-text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div class="tw-ml-3">
                  <p class="tw-text-sm tw-text-yellow-700">
                    ${text}
                  </p>
                  <div class="tw-flex tw-items-center tw-mt-4">
                    <span class="tw-text-sm tw-text-yellow-700 tw-mr-2">Confirm choice</span> <input type="checkbox" class="waiver tw-cursor-pointer" name="waiver">
                  </div>
                </div>
              </div>
            </div>
          `;
          } else {
            base.innerHTML = 
            `<div class="tw-bg-yellow-50 tw-border-l-4 tw-border-yellow-400 tw-p-4 md:tw-w-60 tw-top-0 tw-top-0 tw-shadow-lg">
              <div class="tw-flex">
                <div class="tw-flex-shrink-0">
                  <svg class="tw-h-5 tw-w-5 tw-text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div class="tw-ml-3">
                  <p class="tw-text-sm tw-text-yellow-700">
                    ${text}
                  </p>
                </div>
              </div>
            </div>
          `;
          }
          // decide position
          // note: tw-w-60 is 280px
          if((screen.width <= 768) || (window.matchMedia && window.matchMedia('only screen and (max-width: 768px)').matches))
          {
            // Do the mobile thing
            base.style.position = 'fixed';
            base.style.left = `0`;
            base.style.bottom = '75px';
            base.style.left = '0';
            base.style.padding = '1rem';
          } else {
            base.style.position = 'absolute';

            // Have to check if tooltip would go off screen if right
            // get current elements furthest right
            let elementBoundingBox = this.getBoundingClientRect()
            let width = screen.width;
            
            console.log(elementBoundingBox.right + 285);
            console.log(width)
            if(elementBoundingBox.right + 285 > width) {
              base.style.right = `calc(100% + 5px)`;
              base.style.left = 'unset';
            } else {
              base.style.left = `calc(100% + 5px)`;
              base.style.right = 'unset';
            }
          }

          item.appendChild(base);
          
          //proc event for external handling
          item.closest('[tooltip]').dispatchEvent(eventOpen)

          //handle auto close
          if(waiver != "true"){
            setTimeout(() => { 
              if(e.target.querySelector('tooltip')) {
                e.target.querySelector('tooltip').remove()
              }
            }, 7000)
          }
          //handle manual close
          if(waiver != "true"){
            //close last tooltip
            item.onmouseout = function () {
              if(document.querySelector('tooltip')) {
                document.querySelector('tooltip').remove();// Remove last tooltip
              }
            };
          } else {
            //base.close()
            //handled on event trigger :. pdp.js
          }
        }
      }
    });
  }
}

document.addEventListener( 'DOMContentLoaded', function() {
  //bind featured-item cta special behavior on pdp
  const featured = document.querySelector('.th-fp-link')
  if(featured) {
    featured.addEventListener('click', (e) => {
      e.preventDefault()
      const item = jQuery(e.target).parents('.th-fp-link');
      const pid = item.data('pid')
      const vid = item.data('vid')
      const miniCart = jQuery('.th-mini-cart')
      addToCart(pid, 1, vid ? vid: null, beforeSendCallback(item, miniCart),null).then((data) => {
        onCompleteCallback(item, miniCart, data)
      })
      .catch((error) => {
        console.log(error)
      })
    })
  }
 
  //initMagnifier('thumb')
  initLightbox(document.querySelector('.th-gallery'))

  //tooltips
  bindToolTips(true)
  //if this product has been marked as a tile
  if(true) {
    //onload -- check if page is variation or not
    if(document.querySelector('.variation_id')) {
      var selectedVar = document.querySelector('.variation_id').value;
      //begin variation listener
      jQuery('.variations_form').on('woocommerce_variation_has_changed', function () {
          //Only handle idiosyncratic Tile logic here that use hidden inputs as the data source
          const varID = getVariationID();
          //force change to trigger woocommerce 
          const dataSource = document.querySelector(`#variantMeta${varID}`);
          if(varID) {
            //set grout
            jQuery('#grout').val(dataSource.dataset.grout);
            jQuery('#grout').val(dataSource.dataset.grout);
            jQuery('#grout-label').html(` Add ${dataSource.dataset.groutName}`);
            //change title
            jQuery('#variant-title').html(`Color: ${dataSource.dataset.title}`)
            //change byline
            jQuery('.th-byline').html(`${dataSource.dataset.byline}`)
            //change pictures
            renderGallery(dataSource.dataset.gallery, varID)
            //change price + per sq ft
            const p = dataSource.dataset.price * 1;
            const newPrice = dataSource.dataset.currency + p.toFixed(2);
            if(newPrice) {
              jQuery('.wrap-price').empty();
              jQuery('.wrap-price').html(`${newPrice} ${dataSource.dataset.unit ? '/ '+dataSource.dataset.unit: '' }`);
            }
            //update base price and btn
            document.querySelector('#basePrice').value = `${p}`
            updateBtn(dataSource.dataset.currency, p)
            //update badge
            if(dataSource.dataset.badge) {
              jQuery('.badge').html(dataSource.dataset.badge)
              jQuery('.badge').show()
            } else {
              jQuery('.badge').hide()
              jQuery('.badge').html('')
            }
            //description
            const newDescription = jQuery('.woocommerce-variation-description').html();
            if(jQuery(newDescription).text()) {
              jQuery('#content-area').html(newDescription)
            }
            //calc squarefootage price and change square footage amount
            var newSqFt = dataSource.dataset.squareFootage
            var sqFtPrice = 0;
            if (newSqFt) {
              sqFtPrice = Math.round((dataSource.dataset.price/dataSource.dataset.squareFootage + Number.EPSILON) * 100) / 100
            }
            jQuery('#price-per-sf').html(`${dataSource.dataset.currency + sqFtPrice.toFixed(2)} / sq.ft`)
            jQuery('.square-footage-per-box-span').html(newSqFt)

          }
          
      });
    }

    //custom button functions  when using selection of size attributes
    const selSize = jQuery('#pa_size')
    const sizeSelectors = document.querySelectorAll('.size-selector')

    sizeSelectors.forEach( element => element.addEventListener('mouseenter', (e) => {
      document.querySelector('.size-selected').classList.remove('tw-bg-gray-200')
      document.querySelector('.size-selected').classList.add('tw-opacity-30')
      e.target.classList.add('tw-bg-gray-200')
      e.target.classList.remove('tw-opacity-30')
    }))

    sizeSelectors.forEach( element => element.addEventListener('mouseleave', (e) => {
      e.target.classList.remove('tw-bg-gray-200')
      e.target.classList.add('tw-opacity-30')
    }))

    document.querySelectorAll('.shape-array').forEach( element => element.addEventListener('mouseleave', (e) => {
      document.querySelector('.size-selected').classList.add('tw-bg-gray-200')
      document.querySelector('.size-selected').classList.remove('tw-opacity-30')
    }))

    sizeSelectors.forEach( (element, index) => element.addEventListener('click', (e) => {
      e.target.classList.remove('tw-opacity-30')
      sizeSelectors.forEach((ele, ind) => {
        if(ele != e.target) {
          ele.classList.add('tw-opacity-30');
        }
      })
      document.querySelector('.shape-array .size-selected').classList.remove('size-selected')
      e.target.classList.add('size-selected', 'tw-bg-gray-200')
      selSize.val( e.target.dataset.size ).change()
    }))

    //custom button functions when using selection of color attributes
    const sel = jQuery( '#pa_color' )
    const varSelectors = document.querySelectorAll( '.variation-select' )
    //add select functionality to the variant thumbnails
    varSelectors.forEach( ( element ) => element.addEventListener( 'click', ( e ) => {
      varSelectors.forEach( el => {
          el.closest('.color-select').style.outline = '';
      })
      e.target.closest('.color-select').style.outline = '#8C8F88 solid 1px';
      jQuery('.variation-title').addClass('tw-hidden')
      //trigger woocommerce change
      sel.val( e.target.dataset.color ).change()
    }));

    //fix labels of custom inputs
    document.querySelectorAll('.quantity-input input').forEach((item)=> {
      item.addEventListener('focus', (e) => {
        e.target.closest('.quantity-input').querySelector('label').classList.add('th-shift')
      })
      item.addEventListener('blur', (e) => {
        if(e.target.value == false) {
          e.target.value = ''
          e.target.closest('.quantity-input').querySelector('label').classList.remove('th-shift')
        }
      });
      
      item.addEventListener('input', (e) => {
        setQty(item.value);
        equalize(e.target)
        updateBtn(getCurrency(), getBasePrice())
      })
    })

    if(document.querySelector('#overage'))
    {
      document.querySelectorAll('.overage-box').forEach( ( element ) => element.addEventListener( 'confirmed', ( e ) => {
        //find tooltip to init close
        const tooltip = e.target.querySelector('tooltip');
        tooltip.close();
      }))
      document.querySelectorAll('.overage-box').forEach( ( element ) => element.addEventListener( 'click', ( e ) => {
        if(e.target === element) {
          document.querySelector('#overage').value = element.dataset.value;
          jQuery('.overage-select').removeClass('overage-select');
          element.classList.add('overage-select')
          equalize(e.target)
          updateBtn(getCurrency(), getBasePrice())
        }
      }))
    }

    //set add sample button
    jQuery('.add-sample-btn').on('click', function(e){ 
      e.preventDefault();
      console.log('@update')
      const $thisbutton = jQuery(this),
      miniCart = jQuery('.th-mini-cart'),
      color = jQuery('#pa_color').val(),
      finish = jQuery('#pa_finish').val(),
      product_qty = 1,
      product_id = jQuery('#sample_product_id').val(),
      variation_id = color ? jQuery('.add-sample-btn').data(color) : jQuery('.add-sample-btn').data(finish);

      addToCart(product_id, product_qty, variation_id, beforeSendCallback($thisbutton, miniCart),null).then((data) => {
        onCompleteCallback($thisbutton, miniCart, data)
      })
      .catch((error) => {
        console.log(error)
      })
    }); 
  }

  //add to cart
  jQuery('.main-add-to-cart').on('click', function(e){
      e.preventDefault();
      const $thisbutton = jQuery(this),
      $form = $thisbutton.closest('form.cart'),
      id = $thisbutton.val(),
      miniCart = jQuery('.th-mini-cart'),
      product_id = $form.find('input[name=product_id]').val() || id,
      variation_id = $form.find('input[name=variation_id]').val() || 0;

      var grout = null;
      var groutParent = null;
      var groutPerBox = null;
      var groutQty = 1;
      var product_qty = $form.find('input[name=quantity]').val() || 1

      if(isTile()) {
        if(jQuery('#grout')) {
          if(jQuery('#grout').prop('checked')) {
            grout = jQuery('#grout').val();
            groutParent = getGroutParent();
            groutPerBox = getGroutPerBox();
            groutQty = calcGroutQty(groutPerBox, product_qty);
          }
        }
        product_qty = calculate()
      }

      addToCartMaybeGrout(product_id, product_qty, variation_id, beforeSendCallback($thisbutton, miniCart),null, grout, groutParent, groutQty).then((data) => {
        onCompleteCallback($thisbutton, miniCart, data)
      })
      .catch((error) => {
        console.log(error)
      })
  });

  //add to cart on simple products
  // jQuery('.single_add_to_cart_button').on('click',function(e) {
  //   e.preventDefault();
  //   const $thisbutton = jQuery(this),
  //   $form = $thisbutton.closest('form.cart'),
  //   id = $thisbutton.val(),
  //   miniCart = jQuery('.th-mini-cart'),
  //   product_qty = $form.find('input[name=quantity]').val() || 1,
  //   product_id = $form.find('input[name=product_id]').val() || id,
  //   variation_id = $form.find('input[name=variation_id]').val() || 0;

  //   addToCart(product_id, product_qty, variation_id, beforeSendCallback($thisbutton, miniCart),null).then((data) => {
  //     onCompleteCallback($thisbutton, miniCart, data)
  //   })
  //   .catch((error) => {
  //     console.log(error)
  //   })
  // })

  //init details
  let details = document.querySelectorAll(".details");
  for (let i = 0; i < details.length; i++) {
    let itemClicked = details[i];
    details[i].addEventListener("click", function(evt) {
      showDetails(i);
    });
  }
});

function equalize(target) {
  var qty = getQuant()
  if(isTile()) {
    if(target == document.querySelector('#squareFootageQuantity')) {
      qty = adjustBoxQuantity()
    } else if(target == document.querySelector('#boxQuantity')) {
      qty = adjustSquareFootageQuantity()
    }
  }
  //set qty -- pre overage
  document.querySelector('.quantity input').value = qty;
}

function adjustBoxQuantity() {
  const varID = getVariationID();
  const dataSource = document.querySelector(`#variantMeta${varID}`);
  const requestedSquareFootage = document.querySelector('#squareFootageQuantity').value;
  const sfPerBox = dataSource.dataset.squareFootage;
  if(requestedSquareFootage > 0) {
    document.querySelector('#boxQuantity').closest('.quantity-input').querySelector('label').classList.add('th-shift')
    const boxes = Math.ceil(requestedSquareFootage / sfPerBox)
    document.querySelector('#boxQuantity').value = boxes;
    return boxes
  } else {
    document.querySelector('#boxQuantity').value = '';
    document.querySelector('#boxQuantity').closest('.quantity-input').querySelector('label').classList.remove('th-shift')
    return 0
  }
}

function adjustSquareFootageQuantity() {
  const varID = getVariationID();
  const dataSource = document.querySelector(`#variantMeta${varID}`);
  const sfPerBox = dataSource.dataset.squareFootage;
  const requestedBoxes = document.querySelector('#boxQuantity').value
  const sqFtg = Math.ceil(sfPerBox * requestedBoxes)

  if(requestedBoxes > 0) {
    document.querySelector('#squareFootageQuantity').value = sqFtg;
    document.querySelector('#squareFootageQuantity').closest('.quantity-input').querySelector('label').classList.add('th-shift')
    return requestedBoxes
  } else {
    document.querySelector('#squareFootageQuantity').value = '';
    document.querySelector('#squareFootageQuantity').closest('.quantity-input').querySelector('label').classList.remove('th-shift')
    return 0
  }
}

function calculate() {
  var overage = 1;
  if(document.querySelector('#overage')) {
    overage = getOverrage()
  }
  //document.querySelector('#boxQuantity').value = '';
  const varID = getVariationID();
  const dataSource = document.querySelector(`#variantMeta${varID}`);
  const requestedBoxes = document.querySelector('#boxQuantity').value
  const requestedSquareFootage = document.querySelector('#squareFootageQuantity').value;
  const sfPerBox = dataSource.dataset.squareFootage;
  const boxes = Math.ceil(overage * (requestedSquareFootage / sfPerBox))

  if(overage > 1) {
    if(boxes > 0) {
      document.querySelector('.quantity input').value = boxes
      return boxes;
    } else {
      document.querySelector('.quantity input').value = 0
      return 0;
    }
  } else {
    return requestedBoxes
  }

}

function calculateSquareFootagePerBox() {
  var overage = 1;
  if(document.querySelector('#overage')) {
    overage = getOverrage()
  }
  //document.querySelector('#boxQuantity').value = '';
  const varID = getVariationID();
  const dataSource = document.querySelector(`#variantMeta${varID}`);
  const requestedSquareFootage = document.querySelector('#squareFootageQuantity').value;
  const sfPerBox = dataSource.dataset.squareFootage;
  const boxes = Math.ceil(overage * (requestedSquareFootage / sfPerBox))

  if(boxes > 0) {
    document.querySelector('.quantity input').value = boxes
    return boxes;
  } else {
    document.querySelector('.quantity input').value = 0
    return 0;
  }
}

function calculateBoxQuantity() {
  var overage = 1;
  const varID = getVariationID();
  const dataSource = document.querySelector(`#variantMeta${varID}`);
  const sfPerBox = dataSource.dataset.squareFootage;
  const requestedBoxes = document.querySelector('#boxQuantity').value
  if(document.querySelector('#overage')) {
    overage = getOverrage()
  }

  if(requestedBoxes > 0) {
    document.querySelector('.quantity input').value = Math.ceil(requestedBoxes * overage)
  } else {
    document.querySelector('#squareFootageQuantity').value = '';
  }
}

function beforeSendCallback(button, minicart) {
  blurCart(minicart);
  button.removeClass('added').addClass('loading');
}

function onCompleteCallback(button, miniCart, html) {
  const incrementSelector = '.increment-cart-item'
  const decrementSelector = '.decrement-cart-item'
  const removeSelector = '.remove-cart-item'
  const counterSelector = '#cartQuant'

  rebuildCart(miniCart, html, incrementSelector, decrementSelector, removeSelector, counterSelector)
  slideCart()
  unblurCart(miniCart)
  button.addClass('added').removeClass('loading')
  //updateCartCounter('#cartQuant')
  // refreshNotices().then(() => {
  //   button.addClass('added').removeClass('loading');
  // })
}

//takes in a string json and renders the gallery for a single variation
function renderGallery(gallery, varID) {
  if(gallery) {
    const galleryJSON = JSON.parse(gallery);
    //only tiles atm use the gallery -- even if it is just 1 item
    document.querySelector('.th-gallery').innerHTML = '';
    const slider = document.querySelector('.tw-slider')
    if(slider) {
      slider.innerHTML = '';
    }


    //slider
    var carousel =  document.createElement('div')
    carousel.classList.add('main-carousel','tw-max-w-7xl', 'tw-mx-auto','tw-overflow-visible', 'tw-mt-6')
    carousel.id = `carousel${varID}`

    jQuery.each(galleryJSON, function(index) {
      var img = document.createElement('img');
        img.id = 'thumb'
        img.src = galleryJSON[index];
        img.style.width = '100%';
        img.setAttribute('data-magnify', galleryJSON[index])
      var carouselCell = document.createElement('div')
        carouselCell.classList.add('carousel-cell','tw-mr-6', 'tw-w-80', 'tw-group', 'tw-overflow-hidden', 'tw-drop-shadow-2xl', 'tw-bg-white')
      var carouselCellChild = document.createElement('div')
      var carouselCellImageWrapper = document.createElement('div')
        carouselCellImageWrapper.classList.add('tw-h-80', 'tw-w-80', 'tw-overflow-hidden')
      var carouselCellImage = document.createElement('img')
        carouselCellImage.classList.add('tw-h-80','tw-w-80', 'tw-object-cover', 'group-hover:tw-scale-105', 'tw-duration-300')
        carouselCellImage.src = galleryJSON[index];
      var magnifierWrapper =  document.createElement('div')
        magnifierWrapper.setAttribute('data-src', galleryJSON[index])
        magnifierWrapper.classList.add('th-gallery-itm', 'md:tw-flex', 'tw-hidden')
      var hoverCircle =  document.createElement('div')
        hoverCircle.classList.add('th-circle-plus')

      if( Object.keys(galleryJSON).length > 1) {
        //document.querySelector('.tw-slider').classList.remove('tw-hidden')
        magnifierWrapper.classList.add('tw-hidden')
        document.querySelector('.th-gallery').classList.add('th-gallery-multi')
      } else {
        //document.querySelector('.tw-slider').classList.add('tw-hidden')
        magnifierWrapper.classList.add('th-single-product')
        document.querySelector('.th-gallery').classList.remove('th-gallery-multi')
      }

      //grid appends
      magnifierWrapper.appendChild(img);
      magnifierWrapper.appendChild(hoverCircle);

      //slider appends
      carouselCellImageWrapper.appendChild(carouselCellImage)
      carouselCellChild.appendChild(carouselCellImageWrapper)
      carouselCell.appendChild(carouselCellChild)
      carousel.appendChild(carouselCell)

      //document appends
      document.querySelector('.th-gallery').appendChild(magnifierWrapper)
      document.querySelector('.tw-slider').appendChild(carousel)
      
      //initMagnifier(img.id)
    });

    //run slider and lightbox functions
    initLightbox(document.querySelector('.th-gallery'));
    if(document.querySelector(`#carousel${varID}`)) {
      var flkty = new Flickity( `#carousel${varID}`, {
        selectedAttraction: 0.2,
        friction: 0.8,
        dragThreshold: 25,
        pageDots: false,
        prevNextButtons: false,
      });
    }

    if (Object.keys(galleryJSON).length === 1) {
      document.querySelector('.th-gallery').classList.add('th-single');
    } else {
      document.querySelector('.th-gallery').classList.remove('th-single'); 
    }
  }
}

function getVariationID() {
  return document.querySelector('input[name=variation_id]').value || 0;
}

function getGroutPerBox() {
  const varID = getVariationID();
  const dataSource = document.querySelector(`#variantMeta${varID}`);
  //set grout
  return dataSource.dataset.groutQty;
}

function getGroutParent() {
  const varID = getVariationID();
  const dataSource = document.querySelector(`#variantMeta${varID}`);
  //set grout
  return dataSource.dataset.groutParent;
}

function initMagnifier(imageID) {
  var evt = new Event(),
  m = new Magnifier(evt);
  const fullImage = document.querySelector(`#${imageID}`).dataset.magnify

  m.attach({
      thumb: `#${imageID}`,
      large: `${fullImage}`,
      mode: 'inside',
      zoom: 3,
      zoomable: true
  });
}

//
// @params: Takes in a HTML object
//
function initLightbox(gallery) {
  lightGallery(gallery)
}

function showDetails(varOne) {
  // box that people can click 
  let allDetails = document.querySelectorAll(".details");
  // all answers that can be displayed
  let allAnswers = document.querySelectorAll(".details-content");
  // Signifies faq is opened or not 
  let openSig = document.querySelectorAll(".details svg");
  // specific box that is clicked
  let selectedDetail = allDetails[varOne];
  // corresponding answet to clicked box
  let corresAnswer = allAnswers[varOne];
  // corresponding x to selected faq
  let corresX = openSig[varOne];
  if( selectedDetail.classList.contains("close")){
    selectedDetail.classList.remove("close");
    corresX.setAttribute("style", "transform:rotate(180deg)");
    jQuery(corresAnswer).slideDown();
  }
  else{
    selectedDetail.classList.add("close");
    corresX.removeAttribute("style", "transform:rotate(180deg)");
    jQuery(corresAnswer).slideUp();
  }
}

function getQuant() {
  return document.querySelector('.quantity input').value
}

function getOverrage(){
  if(document.querySelector('#overage')) {
    return document.querySelector('#overage').value
  }
  return 1;
}

function getQuantwOverrage() {
  return Math.ceil(getOverrage() * document.querySelector('.quantity input').value)
}

function getBasePrice() {
  return document.querySelector('#basePrice').value
}
function getCurrency() {
  return '$';
}

function updateBtn(currency, basePrice) {
  jQuery('.main-add-to-cart').html(`Add To Cart ${currency}${(basePrice*getQuantwOverrage()).toFixed(2)}`)
}

function isTile() {
  return jQuery('#isTile').val() == 'true';
}

function setQty(val) {
  document.querySelector('.quantity input').value = val;
}