<?php //var_dump($tabs); ?>
<div>
  <div class="tw-max-w-7xl tw-mx-auto tw-flex tw-justify-center tw-text-4xl tw-font-extrabold tw-text-gray-900 tw-tracking-tight sm:tw-text-3xl tw-my-6 tw-mt-24"> <?php echo $heading; ?> </div>
  <div class="tw-hidden sm:tw-block">
    <div class="tw-border-b tw-border-gray-200">
      <div id="tabsTable" class="tw-max-w-7xl tw-mx-auto tw--mb-px tw-grid md:tw-grid-cols-3 tw-gap-x-8 tw-px-4" aria-label="Tabs">
        <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-geon-body hover:text-gray-700 hover:border-gray-300" -->
        <?php foreach($tabs as $key=>$tab) { ?>
            <div id="<?php echo $key; ?>" class="tw-block tw-w-full tw-text-sm tw-font-semibold tw-uppercase tw-tracking-wide tw-text-geon-body sm:tw-text-base lg:tw-text-sm xl:tw-text-base tw-cursor-pointer tw-border-transparent tw-text-geon-body hover:tw-text-gray-700 tw-py-4 tw-px-1 tw-text-center tw-border-b-2 tw-font-medium tw-text-sm <?php if($key == 0) { echo 'active-tab'; }?>"> <?php echo $tab['heading']; ?> </div>
        <?php } ?>
        <span class="target tw-hidden"></span>
      </div>
    </div>
  </div>
  <div class="tab-content">
      <?php foreach($tabs as $key=>$tab) { ?>
        <div data-key="<?php echo $key; ?>" class="tw-grid md:tw-grid-cols-3 tw-max-w-7xl tw-mx-auto <?php if($key > 0) { echo 'tw-hidden'; } ?>">
            <?php
              $combined = array($tab['product_a']['product'], $tab['product_b']['product'], $tab['product_c']['product']);
              $titles = array($tab['product_a']['heading'], $tab['product_b']['heading'], $tab['product_c']['heading']);
              $pictureOverrides = array($tab['product_a']['image_override'], $tab['product_b']['image_override'], $tab['product_c']['image_override']);
              $prods = getProdsByID($combined);
              foreach($prods as $key=>$product) :
            ?>
              <div class="tw-mt-10 tw-flex tw-justify-center tw-flex-col tw-bg-white tw-drop-shadow-2xl tw-mx-4">
                <div class="tw-relative tw-group">
                  <div class="tw-relative tw-w-full tw-overflow-hidden">
                    <img style="height: 394px;" src="<?php echo strlen($pictureOverrides[$key]) > 0 ? $pictureOverrides[$key] : $product['image_url']; ?>" alt="" class="group-hover:tw-scale-105 tw-duration-300 tw-w-full tw-h-full tw-object-center tw-object-cover">
                  </div>
                  <div class="tw-opacity-0 group-hover:tw-opacity-100 tw-duration-300 tw-ease-in-out tw-absolute tw-top-0 tw-inset-x-0 tw-h-full tw-p-4 tw-flex tw-items-end tw-justify-end tw-overflow-hidden">
                    <div aria-hidden="true" class="tw-absolute tw-inset-x-0 tw-bottom-0 tw-h-full tw-bg-black tw-opacity-30"></div>
                  </div>
                  <a href="<?php echo $product['url']; ?>" class="tw-duration-300 tw-opacity-0 group-hover:tw-opacity-100 tw-font-semibold tw-uppercase tw-tracking-wide tw-text-base tw-h-12 tw-inset-0 tw-mx-auto tw-my-auto tw-w-32 tw-absolute tw-flex tw-py-2 tw-px-8 tw-items-center tw-justify-center tw-font-medium tw-bg-black tw-text-white tw-select-none hover:tw-bg-white hover:tw-text-black">Shop <span class="tw-sr-only">, <?php echo $product['title']; ?></span></a>
                </div>
                <div class="tw-mt-4 tw-px-4 ">
                  <div class="tw-relative tw-mb-4">
                    <h3 class="tw-text-2xl tw-font-extrabold tw-text-gray-900 tw-tracking-tight sm:tw-text-3xl tw-border-b tw-border-gray-200 tw-mb-4 tw-pb-4"><?php echo $product['title']; ?></h3>
                    <p class="tw-mt-1 tw-text-geon-body tw-flex th-svg-sml tw-items-center tw-text-base"><?php echo $titles[$key]; ?></p>
                  </div>
                  
                </div>
              </div>
            <?php endforeach; ?>
        </div>
  <?php } ?>
  </div>
</div>
<script>
  const tabsContent = document.querySelectorAll('.tab-content > *')

  document.querySelectorAll('#tabsTable > *').forEach((tab) => {
    tab.addEventListener('click', ()=> {
      tabsContent.forEach((content) => {
        if (content.dataset.key === tab.id) {
          content.classList.remove('tw-hidden')
        } else {
          content.classList.add('tw-hidden')
        }
      })
    })
  });

  const target = document.querySelector(".target");
  const links = document.querySelectorAll("#tabsTable > *");
  const colors = ["#F3B01A", "#EF5822", "#5BA5B6", "#20AB9A", "magenta", "#F38B81", "darkblue"];

  links.forEach((itm) => {
    itm.addEventListener("click", mouseenterFunc);
    if(itm.classList.contains('active-tab')) {     
      const width = itm.getBoundingClientRect().width;
      const height = itm.getBoundingClientRect().height;
      const left = itm.getBoundingClientRect().left;
      const color = colors[Math.floor(Math.random() * colors.length)];
      const screenWidth = screen.width - 10
      const adjustmentWidth = screenWidth - 1280
    
      target.style.width = `${width}px`;
      target.style.height = `${height}px`;
      target.style.left = `${adjustmentWidth > 0 ? (left - adjustmentWidth/2): left}px`;
      target.style.borderColor = color;
      target.style.transform = "none";
    } else {
      itm.style.opacity = "0.25";
    }
  })

  function mouseenterFunc() {
    if (!this.classList.contains("active-tab")) {
      for (let i = 0; i < links.length; i++) {
        if (links[i].classList.contains("active-tab")) {
          links[i].classList.remove("active-tab");
        }
        links[i].style.opacity = "0.25";
      }
      
      this.classList.add("active-tab");
      this.style.opacity = "1";
      
      const width = this.getBoundingClientRect().width;
      const height = this.getBoundingClientRect().height;
      const left = this.getBoundingClientRect().left;
      const color = colors[Math.floor(Math.random() * colors.length)];
      const screenWidth = screen.width - 10
      const adjustmentWidth = screenWidth - 1280
    
      target.style.width = `${width}px`;
      target.style.height = `${height}px`;
      target.style.left = `${adjustmentWidth > 0 ? (left - adjustmentWidth/2): left}px`;
      target.style.borderColor = color;
      target.style.transform = "none";
    }
  }
</script>
