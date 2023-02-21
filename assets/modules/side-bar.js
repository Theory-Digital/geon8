/* eslint-disable */

function bindFilterSidebar() {
  (function($) {
    $(document).on('facetwp-loaded', function() {
      //dynamically insert cancel filter btns
      var base = '';
      $.each(FWP.facets, function(name, vals) {
        vals.forEach(item => {
          base = base + `<button class="th-filter-deselect tw-mt-2 tw-inline tw-border-gray-700 hover:tw-bg-gray-700 hover:tw-text-white tw-border tw-border-solid tw-rounded-full tw-px-2 tw-mr-2 tw-text-gray-700" onclick="FWP.reset({ '${name}': '${item}' })">${item}<svg style="display: inline; width: 15px; margin-left: 8px; margin-bottom: 2px;" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button>`
        })
        document.querySelector('#resetFilters').innerHTML = base;
      });
    });
  })(jQuery);
}

function slideBar() {
  document.querySelector('body').classList.toggle('overflow-hidden')
  document.querySelector(".th-side-bar").classList.toggle("tw-translate-x-full");
  document.querySelector(".th-grayout-filters").classList.toggle("tw-hidden");
  document.querySelector("body").classList.toggle("tw-fixed")
}

export {bindFilterSidebar, slideBar};