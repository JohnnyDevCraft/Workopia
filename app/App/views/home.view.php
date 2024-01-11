<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('showcase-search'); ?>
<?php loadPartial('top-banner'); ?>

<!-- Job Listings -->
<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Recent Jobs</div>
        <?php loadPartial('flash-message') ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <?php if (isset($listings)) {
                foreach ($listings as $listing) : ?>
                    <?php loadPartial('listings/job-card', [
                            'listing' => $listing
                    ]) ?>
                <?php endforeach;
            } ?>
        </div>
        <a href="listings" class="block text-xl text-center">
            <i class="fa fa-arrow-alt-circle-right"></i>
            Show All Jobs
        </a>
</section>



<?php loadPartial('bottom-banner'); ?>
<?php loadPartial('footer'); ?>
