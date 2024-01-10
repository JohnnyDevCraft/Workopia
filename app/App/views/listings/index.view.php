<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<!-- Job Listings -->
<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">All Jobs</div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <?php if (isset($listings)) : ?>
                <?php foreach ($listings as $listing) : ?>
                    <?php loadPartial('listings/job-card', [
                        'listing' => $listing
                    ]) ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
</section>


<?php loadPartial('bottom-banner'); ?>
<?php loadPartial('footer'); ?>