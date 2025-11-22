

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle( $blog ? 'View Sightings' : 'Sightings Not Found' )); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>

	<div id="breadcrumbs" class="row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="<?php echo e(route( 'admin' )); ?>">Administration</a></li>
					<li><a href="<?php echo e(route( 'admin.blog' )); ?>">Posts</a></li>
					<li>
						<span class="show-for-sr">Current: </span> View Sightings
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1><?php echo e(@$blog ? $blog->name : 'Sightings Not Found'); ?></h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<?php if( @$blog ): ?>

		<div class="row">
			<div class="small-12 columns">
				<?php if( $blog->entries->count() ): ?>
					<table id="blogEntryListTable" class="table-bordered table-striped table-hovered" width="100%">
						<thead>
							<tr>
								<th>Entry Name</th>
								<th class="hide-for-small-only">Slug</th>
								<th class="hide-for-small-only">Active</th>
								<th class="hide-for-small-only">Hidden</th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $blog->entries()->orderBy( 'created_at', 'desc' )->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr data-click="<?php echo e(route( 'admin.blog.entry.view', [ $blog->id, $entry->id ] )); ?>" data-search-element>
									<td data-search-content><?php echo e($entry->name); ?></td>
									<td data-search-content class="hide-for-small-only"><?php echo e($entry->slug); ?></td>
									<td class="hide-for-small-only"><?php echo e($entry->active ? 'Active' : 'Inactive'); ?></td>
									<td class="hide-for-small-only"><?php echo e($entry->hidden ? 'Hidden' : 'Visible'); ?></td>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				<?php else: ?>
					<div class="alert callout">
						<strong>There are no entries for this blog.</strong> <?php if( auth()->user()->hasPermission( 'admin.blog.entry.add' ) ): ?> <a href="<?php echo e(route('admin.blog.entry.add', $blog->id )); ?>" title="Add a new sighting entry">Add one?</a> <?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if( auth()->user()->hasPermission( 'admin.blog.entry.add' ) ): ?> <a class="primary button" href="<?php echo e(route( 'admin.blog.entry.add', $blog->id )); ?>" title="Add a new sighting">Add a Post</a> <?php endif; ?>
				<?php if( auth()->user()->hasPermission( 'admin.blog.settings.edit' ) ): ?> <a class="secondary button hide" href="<?php echo e(route( 'admin.blog.edit', $blog->id )); ?>" title="Edit this sighting">Edit Sighting</a> <?php endif; ?>
				<?php if( auth()->user()->hasPermission( 'admin.blog.settings.edit' ) ): ?> <a class="secondary button hide" href="<?php echo e(route( 'admin.blog.category', $blog->id )); ?>" title="Edit categories this post">Edit Categories</a> <?php endif; ?>
				<p>Click on an entry in order to modify it</p>

			</div>
		</div>

	<?php else: ?>

		<div class="row">
			<div class="small-12 columns">
				<div class="alert callout">
					<strong>The sighting you are looking for was not found.</strong>
				</div>
			</div>
		</div>

	<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>