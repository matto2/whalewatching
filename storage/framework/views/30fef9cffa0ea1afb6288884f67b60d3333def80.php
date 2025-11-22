

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle('Administration')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
	<div id="breadcrumbs" class="row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Administration
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Administration</h1>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="row">
		<?php if( auth()->user()->hasPermission( 'admin.user.*' ) ): ?>
	<div class="columns p0">
				<div class="secondary callout">
						<h2>Accounts &amp; Users</h2>

						<div class="small-12 medium-4 columns">
							<ul class="vertical menu">
<?php if( auth()->user()->hasPermission( 'admin.user.add' ) ): ?> <li><a href="<?php echo e(route( 'admin.user.add' )); ?>">Add New User</a></li> <?php endif; ?>
	</ul>
						</div>
						<div class="small-12 medium-4 columns">
							<ul class="vertical menu">
								<li><a href="<?php echo e(route( 'admin.user' )); ?>">View Users</a></li>
							</ul>
						</div>
						<div class="small-12 medium-4 columns">
							<ul class="vertical menu">
								<?php if( auth()->user()->hasPermission( 'admin.user.settings.*' ) ): ?>
									<li><a href="<?php echo e(route( 'admin.user.settings' )); ?>">Settings</a></li>
								<?php endif; ?>
							</ul>
						</div>
					<p class="holder">&nbsp;</p>
				</div>
			</div>

		<?php endif; ?>

		<?php if( auth()->user()->hasPermission( 'admin.blog.*' ) ): ?>
			<div class="small-12 columns p0">
				<div class="secondary callout">
					<div class="row">
						<div class="columns p0">
							<div class="small-12 medium-6 columns">
								<h2>5 Recent Posts</h2>
							</div>
							<div class="small-12 medium-6 columns">
								<a class="primary button mb0" href="<?php echo e(route( 'admin.blog' )); ?>" title="Manage Posts">Go to Sightings Posts</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="columns p0">
			<?php if( count( $entries = \App\Models\Blog\BlogEntry::orderBy( 'created_at', 'desc' )->take( 5 )->get() ) > 0 ): ?>
				<ul class="posts">
					<?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li><a href="<?php echo e(route( 'admin.blog.entry.view', [ $entry->blog_id, $entry->id ] )); ?>" title="Edit this entry"><?php echo e($entry->name); ?></a></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			<?php else: ?>
								<div class="callout">
									There are no Sighting entries.
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>