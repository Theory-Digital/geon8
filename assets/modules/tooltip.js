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
            `<div class="tw-bg-yellow-50 tw-border-l-4 tw-border-yellow-400 tw-p-4 tw-w-60 tw-top-0 tw-cursor-auto tw-shadow-lg">
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
            `<div class="tw-bg-yellow-50 tw-border-l-4 tw-border-yellow-400 tw-p-4 tw-w-60 tw-top-0 tw-shadow-lg">
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
  
          //half of height
          base.style.left = `calc(100% + 5px)`;
          base.style.position = 'absolute';
          //why does x increment
          // console.log({x})
          // console.log(a[x-1])
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

export {bindToolTips};