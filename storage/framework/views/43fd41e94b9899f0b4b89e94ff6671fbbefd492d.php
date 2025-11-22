

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle( 'User Accounts' )); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>

	<div id="breadcrumbs" class="expanded row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="<?php echo e(route( 'admin' )); ?>">Administration</a></li>
					<li>
						<span class="show-for-sr">Current: </span> User Accounts
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>User Accounts</h1>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="expanded row columns">
		<div class="field"><input class="tableSearchBar" type="text" placeholder="Search..." data-search="#userListTable" /></div>
	</div>

	<div class="expanded row">
		<div class="small-12 columns">
			<table id="userListTable" width="100%">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th class="hide-for-small-only">Created</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr data-click="<?php echo e(route('admin.user.view', $user->id )); ?>" data-search-element>
							<td data-search-content><?php echo e($user->first_name); ?></td>
							<td data-search-content><?php echo e($user->last_name); ?></td>
							<td data-search-content><?php echo e($user->email); ?></td>
							<td class="hide-for-small-only"><?php echo e($user->created_at->toDateString()); ?></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="expanded row">
		<div class="small-12 columns">
			<?php if( auth()->user()->hasPermission( 'admin.user.add' ) ): ?> <a class="primary button" href="<?php echo e(route( 'admin.user.add' )); ?>" title="Add a User">Add a User<i class="add icon"></i></a> <?php endif; ?>
			<?php if( auth()->user()->hasPermission( 'admin.user.settings.*' ) ): ?> <a class="secondary button" href="<?php echo e(route( 'admin.user.settings' )); ?>" title="Adjust user account settings">Settings</a> <?php endif; ?>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>