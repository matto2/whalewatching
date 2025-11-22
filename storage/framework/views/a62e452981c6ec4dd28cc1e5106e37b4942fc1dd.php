

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle('Add a New Post')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>

	<div id="breadcrumbs" class="row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="<?php echo e(route( 'admin' )); ?>">Administration</a></li>
					<li><a href="<?php echo e(route( 'admin.blog' )); ?>">Post</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Add a Post
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Add a Post</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<?php if( $blog ): ?>

		<div class="row">
			<div class="small-12 columns">
				<form id="addBlogEntryForm" method="post" action="<?php echo e(route( 'admin.blog.entry.add', $blog->id )); ?>" data-form-ajax autocomplete="off" data-form-ajax-clear data-form-wait-title="Adding Sighting...">
					<div class="secondary callout">
						<h2>Entry Details</h2>

						<div class="small-12">
							<label>Sighting: <input type="text" disabled="disabled" value="<?php echo e($blog->name); ?>"></label>
						</div>

						<div class="small-12">
							<label>Name: <input class="first-focus" name="name" type="text" placeholder="Name" data-url-slug="input[name=slug]"></label>
						</div>

						<div class="small-12">
							<label>
								URL Slug:
								<div class="input-group">
									<span class="input-group-label">/<?php echo e($blog->slug); ?>/</span>
									<input class="input-group-field" name="slug" type="text" placeholder="URL Slug">
								</div>
							</label>
						</div>

						<div class="small-12">
							<label>Content: (Youtube video: click icon 2nd from right, click embed, paste embed code)<textarea class="fontFixedWidth" name="content" rows="20"></textarea></label>
						</div>
					</div>

					<div class="small-12 hide">
						<div class="secondary callout">
							<h2>Entry Options</h2>
							<label><input name="active" type="checkbox" data-form-initial-value="<?php echo e(setting( 'blogEntryActiveDefault' )); ?>">This Sighting entry is active</label>
							<label><input name="hidden" type="checkbox" data-form-initial-value="<?php echo e(setting( 'blogEntryHiddenDefault' )); ?>">This Sighting entry is hidden (can only be accessed if the visitor knows the URL)</label>
							<label><input name="restricted" type="checkbox" data-form-initial-value="<?php echo e(setting( 'blogEntryRestrictedDefault' )); ?>">Users must be logged in to see this entry</label>
							<label><input name="comments" type="checkbox" data-form-initial-value="<?php echo e(setting( 'blogEntryAllowCommentsDefault' )); ?>">Allow comments</label>
						</div>
					</div>

					<?php if( $blog->categories->count() ): ?>
						<div class="secondary callout" data-select-all>
							<h2>Categories</h2>
							<label class="small-12 columns"><input class="selectAll" type="checkbox" data-select-all-toggle="categories"> Select All</label>

							<div class="expanded row">
							<?php $__currentLoopData = $blog->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<label class="small-4 columns end"><input class="input" type="checkbox" name="categories[]" value="<?php echo e($category->id); ?>" data-select-all="categories"> <?php echo e($category->name); ?></label>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="small-12">
						<button class="button primary" type="submit" data-form-submit="addBlogEntryForm">Add Sighting</button>
						<a class="button secondary" href="<?php echo e(route( 'admin.blog.view', $blog->id )); ?>" title="Cancel">Cancel</a>
					</div>
				</form>
			</div>
		</div>

	<?php else: ?>
		<div class="expanded row columns">
			<div class="alert callout">
				<strong>The post you specified was not found.</strong>
			</div>
			<a class="primary button" href="<?php echo e(route( 'admin.blog' )); ?>" title="Return to the list of blogs">Return to Sightings</a>
		</div>
	<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

	<script src="/js/tinymce/tinymce.min.js"></script>
	<script src="/js/tinymce/jquery.tinymce.min.js"></script>

	<script type="text/javascript">
		$(document).ready( function() {
			$("textarea").tinymce({
				menubar: false,
				plugins: [
					'advlist autolink lists link image charmap print preview anchor',
					'searchreplace visualblocks code fullscreen',
					'insertdatetime media table contextmenu paste code responsivefilemanager'
				],
				toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | image media responsivefilemanager',
				content_css: '//www.tinymce.com/css/codepen.min.css',
				external_filemanager_path:"/js/filemanager/",
				filemanager_title:"Insert File" ,
				external_plugins: { "filemanager" : "/js/filemanager/plugin.min.js" },
				media_live_embeds: true
			});

		});
	</script>
<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>