

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle('Posts')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>

	<div id="breadcrumbs" class="expanded row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="<?php echo e(route( 'admin' )); ?>">Administration</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Posts
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>Posts</h1>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="expanded row columns">
		<div class="field"><input class="tableSearchBar" type="text" placeholder="Search..." data-search="#blogEntryListTable" /></div>
	</div>

	<div class="expanded row">
		<div class="small-12 columns">
			<?php if( $blogs && count( $blogs ) > 0 ): ?>

				<table id="blogEntryListTable" class="table-bordered table-striped table-hovered" width="100%">	
					<thead>
						<tr>
							<th>Post Category</th>
							<th class="hide-for-small-only">URL (page)</th>
							<th class="hide-for-small-only">Posts</th>
						</tr>
					</thead>	
					<tbody>
						<?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr data-click="<?php echo e(route('admin.blog.view', $blog->id )); ?>" data-search-element>
								<td data-search-content><?php echo e($blog->name); ?></td>
								<td data-search-content class="hide-for-small-only">/<?php echo e($blog->slug); ?></td>
								<td class="hide-for-small-only"><?php echo e($blog->entries->count()); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>	
				</table>

			<?php else: ?>
				<div class="alert callout">
					<strong>There are no Posts.</strong> <?php if( auth()->user()->hasPermission( 'admin.blog.entry.add' ) ): ?> <a href="<?php echo e(route('admin.blog.add' )); ?>" title="Add a new post?">Add one?</a> <?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if( auth()->user()->hasPermission( 'admin.blog.entry.add' ) ): ?>
				<a class="button primary hide" href="<?php echo e(route('admin.blog.add' )); ?>" title="Add a new post">Add a New Posting Category</a>
			<?php endif; ?>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>