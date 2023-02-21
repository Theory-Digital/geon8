/* eslint-disable */
document.addEventListener( 'DOMContentLoaded', function() {
  //header
  const menuOpenBtns = document.querySelectorAll('.th-open-menu')
  const subMenuOpenBtns = document.querySelectorAll('.th-open-sub')
  const menuMobileOpen = document.querySelector('.th-open-mobile')
  const menu = document.querySelector('#mobileMenu')

  menuMobileOpen.addEventListener('click', function() {
    menu.classList.toggle('tw-max-h-0')
    menu.classList.toggle('tw-max-w-0')
    menu.classList.toggle('th-nav-menu-full')
    menu.classList.toggle('th-menu-active')
    if( menu.classList.contains('th-menu-active')) {
      menu.style.opacity = 100
      menu.style.top = '100%'
      disableScroll();
    } else {
      enableScroll();
      menu.style.opacity = 0
      menu.style.top = 'calc(100% - 50px)'
    }
    
    //document.querySelector('body').classList.toggle('tw-overflow-hidden')
  })

  menuOpenBtns.forEach(btn => {
      btn.addEventListener('click', function(e) {
        //close other open menus
        menuOpenBtns.forEach(btnn => {
          const menu =  btnn.parentElement.closest('.th-nav-item').querySelector('.th-mega-menu');
          //if not current menu
          if(menu != e.target.closest('.th-nav-item').querySelector('.th-mega-menu')) {
            if(menu) {
              menu.classList.remove('th-menu-active')
              menu.classList.remove('th-full-h')
              menu.classList.add('tw-max-h-0')
              menu.style.opacity = 0;
            }
          }
        })
        
        e.target.closest('.th-nav-item').querySelector('.th-mega-menu').classList.toggle('th-menu-active')
        e.target.closest('.th-nav-item').querySelector('.th-mega-menu').classList.toggle('tw-max-h-0')
        e.target.closest('.th-nav-item').querySelector('.th-mega-menu').classList.toggle('th-full-h')
        if( e.target.closest('.th-nav-item').querySelector('.th-mega-menu').classList.contains('th-menu-active')) {
          e.target.closest('.th-nav-item').querySelector('.th-mega-menu').style.opacity = 100
          e.target.closest('.th-nav-item').querySelector('.th-mega-menu').style.top = '100%'
        } else {
          e.target.closest('.th-nav-item').querySelector('.th-mega-menu').style.opacity = 0
          e.target.closest('.th-nav-item').querySelector('.th-mega-menu').style.top = 'calc(100% - 50px)'
        }
        
        //e.target.closest('.th-nav-item').querySelector('.th-mega-menu').classList.toggle('th-open-menu')
        //overlay
        const carot = e.target.closest('.th-nav-item').querySelector('svg')
        if(carot &&  e.target.closest('.th-nav-item').querySelector('.th-mega-menu').classList.contains('th-menu-active')) {
          const prev = document.querySelector('.carotSwitch')
          if(prev) {
            prev.removeAttribute("style", "transform:rotate(180deg)")
          }

          carot.setAttribute("style", "transform:rotate(180deg)")
          carot.classList.add("carotSwitch")
        } else if(carot && !e.target.closest('.th-nav-item').querySelector('.th-mega-menu').classList.contains('th-menu-active')) {
          carot.removeAttribute("style", "transform:rotate(180deg)");
          carot.classList.remove("carotSwitch")
        }
          
        //check if any menu is open
        var screenWidth = window.innerWidth
        || document.documentElement.clientWidth
        || document.body.clientWidth;
          if(document.querySelector('.th-menu-active')) {
            //apply overlay on non mobile -- causes a weird black screen flash
            if(screenWidth > 768) {
              document.querySelector('#headerOverlay').classList.remove('tw-hidden');
              document.querySelector('#headerOverlay').style.opacity = '45%'
            }
            //document.querySelector('body').classList.add('tw-fixed')
          } else {
            if(screenWidth > 768) {
              document.querySelector('#headerOverlay').classList.add('tw-hidden')
              document.querySelector('#headerOverlay').style.opacity = '0%'
            }
            //document.querySelector('body').classList.remove('tw-fixed')
          }
      })
  })

  subMenuOpenBtns.forEach(btn => {
    btn.addEventListener('click', function(e) {     
      e.target.closest('.th-sub-item').querySelector('.th-sub-menu').classList.toggle('sub-active')
      e.target.closest('.th-sub-item').querySelector('.th-sub-menu').classList.toggle('tw-max-h-0')
      e.target.closest('.th-sub-item').querySelector('.th-sub-menu').classList.toggle('th-full-h')
      if( e.target.closest('.th-sub-item').querySelector('.th-sub-menu').classList.contains('sub-active')) {
        e.target.closest('.th-sub-item').querySelector('.th-sub-menu').style.opacity = 100
        e.target.closest('.th-sub-item').querySelector('.th-sub-menu').style.top = '100%'
        e.target.closest('.th-sub-item').querySelector('.th-sub-menu').style.overflow = 'visible'
        e.target.closest('.th-open-sub').style.backgroundColor  = '#f9fafb'
      } else {
        e.target.closest('.th-sub-item').querySelector('.th-sub-menu').style.opacity = 0
        e.target.closest('.th-sub-item').querySelector('.th-sub-menu').style.top = 'calc(100% - 50px)'
        e.target.closest('.th-sub-item').querySelector('.th-sub-menu').style.overflow = 'hidden'
        e.target.closest('.th-open-sub').style.backgroundColor  = 'white'
      }
      
      // const carot = e.target.closest('.th-nav-item').querySelector('svg')
      // if(carot &&  e.target.closest('.th-nav-item').querySelector('.th-mega-menu').classList.contains('active')) {
      //   const prev = document.querySelector('.carotSwitch')
      //   if(prev) {
      //     prev.removeAttribute("style", "transform:rotate(180deg)")
      //   }

      //   carot.setAttribute("style", "transform:rotate(180deg)")
      //   carot.classList.add("carotSwitch")
      // } else if(carot && !e.target.closest('.th-nav-item').querySelector('.th-mega-menu').classList.contains('active')) {
      //   carot.removeAttribute("style", "transform:rotate(180deg)");
      //   carot.classList.remove("carotSwitch")
      // }
    })
  })

  //header
  const header = document.querySelector('header');
  var lastScrollTop = 0;

  window.addEventListener("scroll", () => {
    var st = window.pageYOffset || document.documentElement.scrollTop; // Credits: "https://github.com/qeremy/so/blob/master/so.dom.js#L426"
    //only if menu is not open
    if(!menu.classList.contains('th-menu-active')) {
      if (st > lastScrollTop){
        header.style.top = '-88px';
     } else {
       header.style.top = '0px';
     }
     lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
    }
  });
  
  //overlay
  document.querySelector('#headerOverlay').addEventListener('click', function() {
    const menus = document.querySelectorAll('.th-menu-active')
    menus.forEach(menu => {
      menu.classList.remove('th-menu-active')
      menu.classList.remove('th-full-h')
      menu.classList.add('tw-max-h-0')
      menu.style.opacity="0"
      menu.style.top = "calc(100% - 50px)"
      document.querySelector('#headerOverlay').classList.add('tw-hidden')
      document.querySelector('body').classList.remove('tw-fixed')
    })
  })

  //slider height fix
  const sliders = document.querySelectorAll('.th-general-slider .flickity-slider')
  if(sliders) {
    sliders.forEach((slider) => {
      const slides = slider.querySelectorAll('.carousel-cell');
      let height = 0;
      slides.forEach((slide)=> {
        if(slide.firstElementChild.offsetHeight > height) {
          height = slide.offsetHeight
        }
      })
      //get body height
      slides.forEach((slide)=> {
        slide.firstElementChild.setAttribute("style",`height:${height}px;`)
        slide.firstElementChild.style.height = height;
      })
  
      //set height of parent container
      slider.closest('.main-carousel').setAttribute('style', `height:${height + 75}px`)
    })
  }
})

function disableScroll() {
  // Get the current page scroll position
  var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

      // if any scroll is attempted, set this to the previous value
      window.onscroll = function() {
          window.scrollTo(scrollLeft, scrollTop);
      };
}

function enableScroll() {
  window.onscroll = function() {};
}
