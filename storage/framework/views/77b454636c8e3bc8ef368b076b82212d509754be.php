

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle( $blog->name )); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div id="pageTitle" class="row collapse">
		<div class="small-12 columns">
			<h1><?php echo e($blog->name); ?></h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

	<?php if( $entries && count( $entries ) ): ?>

		<div class="row collapse">	
			<div class="small-12 columns">

				<?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="secondary callout">
						<h2><a href="<?php echo e($entry->route()); ?>"><?php echo e($entry->name); ?></a></h2>
						<?php echo $entry->content; ?>

						<div class="cr">
							<?php echo e($entry->poster->displayName() ?? ''); ?> | <?php echo e($entry->created_at->toDayDateTimeString()); ?> <?php echo $entry->categoryLink( "| " ); ?> <?php if( auth()->check() && auth()->user()->administrator ): ?> | <a href="<?php echo e($entry->route( true )); ?>">Edit</a> <?php endif; ?>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	
			</div>	
		</div>

	<?php else: ?>

		<div class="row collapse">
			<div class="small-12 columns">
				<div class="alert callout">
					<strong>There are no <?php echo e($blog->name); ?> entries.</strong>
				</div>
				<?php if( auth()->check() && auth()->user()->hasPermission( 'admin.blog.entry.add' ) ): ?>
					<a class="primary button" href="<?php echo e(route( 'admin.blog.entry.add', $blog->id )); ?>" title="Add a <?php echo e($blog->name); ?> entry">Add a <?php echo e($blog->name); ?> entry</a>
				<?php endif; ?>
			</div>
		</div>

	<?php endif; ?>

					<?php echo $__env->make('includes.springtime-otters-breaching-humpbacks-migrating-gray-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.gray-whales-near-santa-cruz', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.good-day-with-gray-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.gray-humpback-whales-springtime-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.gray-whales-dolphins-sea-birds', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.winter-wildlife-migration-festival', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.gray-whales-humpbacks-otters-birds', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.northern-right-whale-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- *************************************** 2016 *************************************** -->

					<h1 id="2016">2016 Sightings</h1>

					<?php echo $__env->make('includes.2016.winter-solstice-brings-friendly-humpback-whales-lively-dolphins-and-ocean-birds', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.orca-sighting-on-sunday', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.lunge-feeding-whales-sea-lions', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.fall-winter-sightings', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.happy-thanksgiving', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.dolphins-and-humpback-whales-this-week', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.november-humpbacks-near-santa-cruz', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.look-for-spouts-west-cliff-and-seabright', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.october-humpbacks-feeding-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.beautiful-day-up-close-with-humpback-whales-video', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.welcome-to-autumn-in-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- End recent-sightings/page/2 -->

					<?php echo $__env->make('includes.2016.friday-orcas', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.feeding-humpbacks-dolphins-sea-lions-birds', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.rissos-dolphins-baby-bottlenose-humpback-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.orcas-again-today', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.dolphins-blues-humpback-whales-video', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.every-blue-whale-is-here-right-now', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.humpback-blue-fin-whales-in-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.monterey-bay-has-it-all', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.so-many-whales-blues-and-humpbacks', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- End recent-sightings/page/3 -->

					<?php echo $__env->make('includes.2016.orca-dolphins-humpback-whales-sharks-this-week', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.july-sightings', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.fin-whales-humpbacks-blues-and-rissos-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.amazing-encounters-with-orca-and-humpback-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.orcas-again-this-weekend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.special-sighting-fin-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.20-blue-whales-today', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.blue-whales-are-the-stars-this-week', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.chance-to-see-up-to-3-whale-species', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- End recent-sightings/page/4 -->

					<?php echo $__env->make('includes.2016.blue-whale-near-santa-cruz-dolphins-sharks', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.april-20-gray-whales-and-calves', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.gorgeous-blue-whale-humpback-whales-playful-common-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.killer-whales-humpbacks-on-wednesday', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.today-gray-whale-breach', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.new-boat-legacy-joins-our-fleet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.3010', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.santa-cruz-harbor-is-open', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.spring-is-here', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.grays-humpbacks-common-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- End recent-sightings/page/5 -->

					<?php echo $__env->make('includes.2016.gray-whales-1000-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2016.gray-whale-migration', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- *************************************** 2015 *************************************** -->

					<h1 id="2015">2015 Sightings</h1>
					<?php echo $__env->make('includes.2015.lunge-feeding-whales-leaping-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.this-friday-optoutside-with-whale-watching', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.november-whale-watching-monterey', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.video-captures-monterey-bay-wild-orcas-visit-with-whale-watching-boat', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.orcas-active-in-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.humpbacks-near-santa-cruz-baby-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.monterey-bay-amazing-wildlife', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.humpback-whales-bottlenose-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- End recent-sightings/page/6 -->

					<?php echo $__env->make('includes.2015.this-week-orcas-whales-and-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.monterey-whale-watching-continues', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.september-highlights-orcas-whales-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.humpbacks-and-orca-thrill-on-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.the-whales-of-august-monterey-style', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.entertaining-humpback-whales-over-monterey-canyon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.santa-cruz-has-whales-dolphins-and-sharks', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.its-shark-week-in-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.whales-orca-sea-turtles-sharks', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.monterey-bay-humpbacks-here-for-summer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- End recent-sightings/page/7 -->

					<?php echo $__env->make('includes.2015.world-oceans-day-with-humpback-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.a-day-with-orcas-in-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.memorial-day-on-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.friendly-humpback-whales-this-weekend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.yes-we-have-been-seeing-whales-whale-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.blue-whales-again-over-the-weekend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.orcas-and-blue-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.whales-dolphins-beautiful-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.first-blue-whale-of-the-season', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.whales-and-dolphins-on-monday', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- End recent-sightings/page/8 -->

					<?php echo $__env->make('includes.2015.whales-and-dolphins-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.migrating-gray-whales-put-on-a-show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.amazing-breaching-humpback-and-gray-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.great-whale-watching-week', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.humpback-whales-near-santa-cruz', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.tuesday-baywatch-report', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.gray-humpback-whales-feed-together', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.humpbacks-wintering-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.humpback-gray-whales-common-dolphins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- End recent-sightings/page/9 -->

					<?php echo $__env->make('includes.2015.monterey-whale-sightings-week', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.humpback-gray-whales-just-2-miles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.gray-whale-migration-alaska-baja-mexico', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2015.new-year-new-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- *************************************** 2014 *************************************** -->
					<h1 id="2014">2014 Sightings</h1>

					<?php echo $__env->make('includes.2014.happy-new-year-humpback-whales-remain-active-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.winter-humpbacks-dolphins-gray-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.holiday-adventure-santa-cruz-whale-watching', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.december-humpback-whales-across-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.humpbacks-dolphins-sunday', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.santa-cruz-whale-watching-sightings-november-8-11', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- End recent-sightings/page/10 -->

					<?php echo $__env->make('includes.2014.great-whale-dolphin-show-beautiful-ocean-conditions', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.whales-still-thick-santa-cruz-monterey', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.humpback-whales-cool-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.humpback-whales-near-shore-santa-cruz', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.sharing-wonders-monterey-bay-marine-life', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.humpback-whales-dolphins-orcas-active-monterey-bay-2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.2192', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.dozen-humpbacks-near-boardwalk-santa-cruz', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.humpback-whales-dolphins-orcas-active-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.whale-watching-monterey-bay-good-gets-right-now', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.lunge-feeding-humpbacks-fill-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.tuesday-blue-whales-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.lots-humpbacks-middle-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.friendly-humpback-whales-near-santa-cruz-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.whale-watching-humpbacks-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2014.orcas-humpback-whales-monterey-canyon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<!-- root dir - not in resent sightings -->
					<?php echo $__env->make('includes.2014.rare-finds-monterey-bay-2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

					<!-- *************************************** 2013 *************************************** -->
					<h1 id="2013">2013 Sightings</h1>
					<!-- root dir - not in resent sightings -->
					<?php echo $__env->make('includes.2013.a-variety-of-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.2013.thursday-january-17-2013', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>