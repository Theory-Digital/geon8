<div 
  style='<?php echo sprintf(
      'background-color: %1$s; color: %2$s;',
      $barColor,
      $textColor
    )
  ?>'
  class="tw-overflow-hidden tw-duration-200 tw-transition-all th-global-announcement tw-z-21 tw-relative tw-bg-primary-yellow tw-text-white tw-flex tw-justify-center tw-text-md tw-px-4"
>
    <div class="tw-py-2">
        <div class="tw-hidden md:tw-flex tw-text-center tw-items-center"><?php echo $content?></div>
      <div class="tw-flex md:tw-hidden tw-text-center"><?php echo $mobile ?></div>
      <!-- <svg xmlns="http://www.w3.org/2000/svg" class="tw-top-0 tw-absolute th-close-announcement tw-right-0 tw-h-6 tw-w-6 tw-my-2 tw-mx-2 tw-cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg> -->
    </div>
</div>

<!-- <script>
    const announcementClose = document.querySelector('.th-close-announcement');
    announcementClose.addEventListener('click', (e) => {
        document.querySelector('.th-global-announcement').style.maxHeight = '0px'
        document.cookie = "cookieName=announcementClosed; max-age=60; path=/;";
    })
</script> -->