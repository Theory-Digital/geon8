<?php
/* Template Name: Wholesale-Login
*/
get_header();
?>
    <div class="th-accounts">
        <div class="tw-relative tw-bg-white tw-overflow-hidden">
            <div class="tw-hidden lg:tw-block lg:tw-absolute lg:tw-inset-y-0 lg:tw-h-full lg:tw-w-full">
                <div class="tw-relative tw-h-full tw-text-lg tw-max-w-prose tw-mx-auto" aria-hidden="true">
                    <svg class="tw-absolute tw-top-12 tw-left-full tw-transform tw-translate-x-32" width="404" height="384" fill="none" viewBox="0 0 404 384">
                        <defs>
                        <pattern id="74b3fd99-0a6f-4271-bef2-e80eeafdf357" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="tw-text-gray-200" fill="currentColor"></rect>
                        </pattern>
                        </defs>
                        <rect width="404" height="384" fill="url(#74b3fd99-0a6f-4271-bef2-e80eeafdf357)"></rect>
                    </svg>
                    <svg class="tw-absolute tw-top-1/2 tw-right-full tw-transform tw--translate-y-1/2 tw--translate-x-32" width="404" height="384" fill="none" viewBox="0 0 404 384">
                        <defs>
                        <pattern id="f210dbf6-a58d-4871-961e-36d5016a0f49" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="tw-text-gray-200" fill="currentColor"></rect>
                        </pattern>
                        </defs>
                        <rect width="404" height="384" fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)"></rect>
                    </svg>
                    <svg class="th-hide-on-short tw-absolute tw-bottom-12 tw-left-full tw-transform tw-translate-x-32" width="404" height="384" fill="none" viewBox="0 0 404 384">
                        <defs>
                        <pattern id="d3eb07ae-5182-43e6-857d-35c643af9034" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="tw-text-gray-200" fill="currentColor"></rect>
                        </pattern>
                        </defs>
                        <rect width="404" height="384" fill="url(#d3eb07ae-5182-43e6-857d-35c643af9034)"></rect>
                    </svg>
                </div>
            </div>
            <div class="tw-relative tw-px-4 sm:tw-px-6 lg:tw-px-8 tw-max-w-7xl tw-mx-auto tw-bg-white">
                <div class="tw-mx-auto">
                    <div class="wholesale-page commit-container tw-bg-red tw-grid md:tw-grid-cols-2 md:tw-gap-24 lg:tw-gap-x-52">
                        <div class="tw-pt-16 tw-mb-16">
                            <div> <?php echo do_shortcode('[gravityform action="login" description="false" registration_link_display="false" logged_in_avatar="false" login_redirect="/shop/"  /]');?></div>
                        </div>
                        <?php 
                        if ( is_user_logged_in() ) { ?>

                        <?php }else{ ?>
                        <div class="apply-wholesale tw-my-16 ">
                            <div><?php echo do_shortcode("[gravityform id=2 title=true description=false ajax=true tabindex=49]"); ?></div>
                        </div>
                        <?php    } ?>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    </main>

        <?php get_footer(); ?>