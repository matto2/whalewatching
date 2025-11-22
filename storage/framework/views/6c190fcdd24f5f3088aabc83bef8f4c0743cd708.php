

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle( @$entry->name ?: config( 'blog.title' ) )); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1><?php echo e(@$entry ? $entry->name : config( 'blog.title' )); ?></h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

	<?php if( isset( $entry ) ): ?>

		<div class="row">
	
			<div class="small-12 columns">
	
				<?php echo $entry->content; ?>


				<div class="blogFooter">
					<?php echo e($entry->poster->displayName()); ?> | <?php echo e($entry->created_at->toDayDateTimeString()); ?> <?php echo $entry->categoryLink( "| " ); ?> <?php if( auth()->check() && auth()->user()->administrator ): ?> | <a href="<?php echo e(route( 'admin.blog.view', $entry->id )); ?>">Edit</a> <?php endif; ?>
				</div>
	
			</div>
	
		</div>

		<?php if( $entry->comments->count() ): ?>

			<div class="row columns">

				<h2>Comments</h2>

				<?php $__currentLoopData = $entry->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					<div class="blogCommentBody">
						<?php echo e($comment->comment); ?>

					</div>

					<div class="blogCommentFooter">
						Posted <?php echo e(\Carbon\Carbon::parse( $comment->created_at )->toDayDateTimeString()); ?> by <?php echo e($comment->poster ? $comment->poster->displayName(): 'Anonymous'); ?>

					</div>

					<?php if( !$loop->last ): ?>
						<hr>
					<?php endif; ?>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			</div>

		<?php endif; ?>


		<?php if( $entry->allow_comments && ( setting( 'blogCommentLoginRequired' ) && auth()->check() ) ): ?>
			<div class="row columns">
				<h2>Add a Comment</h2>
				<form method="post" action="<?php echo e(route( 'blog.comment.add', $entry->id )); ?>" data-form-ajax data-form-ajax-reload data-abide>
					<textarea name="comment" required></textarea>
					<button class="primary button" type="submit">Add Comment</button>
				</form>
			</div>
		<?php endif; ?>

	<?php else: ?>

		<div class="row">
			<div class="small-12 columns">
				<div class="alert callout">
					<strong>The <?php echo e(config( 'blog.title' )); ?> entry you're looking for was not found.</strong>
				</div>
			</div>
		</div>

	<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>