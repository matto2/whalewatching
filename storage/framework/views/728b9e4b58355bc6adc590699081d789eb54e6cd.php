

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle('Sighting Entries')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>

	<div id="breadcrumbs" class="expanded row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="<?php echo e(route( 'admin' )); ?>">Administration</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Sighting Entries
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>Sighting Entries</h1>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<?php if( $blog ): ?>

		<div class="expanded row columns">
			<div class="field"><input class="tableSearchBar" type="text" placeholder="Search..." data-search="#blogEntryListTable" /></div>
		</div>

		<div class="expanded row">
			<div class="small-12 columns">
				<?php if( $entries && count( $entries ) > 0 ): ?>
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
							<?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
						<strong>There are no Sighting entries.</strong> <?php if( auth()->user()->hasPermission( 'admin.blog.entry.add' ) ): ?> <a href="<?php echo e(route( 'admin.blog.entry.add', $blog->id )); ?>" title="Add a new blog entry">Add one?</a> <?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if( auth()->user()->hasPermission( 'admin.blog.entry.add' ) ): ?>
					<a class="button primary" href="<?php echo e(route( 'admin.blog.entry.add', $blog->id )); ?>" title="Add a new blog entry">Add a Sighting</a>
				<?php endif; ?>
			</div>
		</div>

	<?php else: ?>
		<div class="expanded row columns">
			<div class="alert callout">
				<strong>The Sighting you specified was not found.</strong>
			</div>
			<a class="primary button" href="<?php echo e(route( 'admin.blog' )); ?>" title="Return to the list of blogs">Return to Sightings</a>
		</div>
	<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>