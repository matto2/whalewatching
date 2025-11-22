

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle('Edit Post')); ?></title>
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
						<span class="show-for-sr">Current: </span> Edit Post
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Edit Post</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php if( @$entry ): ?>
		<form id="editBlogEntryForm" method="post" action="<?php echo e(route( 'admin.blog.entry.view', [ $blog->id, $entry->id ] )); ?>" data-form-ajax autocomplete="off" data-form-wait-title="Adding blog entry...">
			<div class="row">
				<div class="small-12 columns">
					<ul id="entryTabs" class="tabs" data-tabs>
						<li class="tabs-title is-active"><a href="#entryTab">Entry</a>
						<li class="tabs-title"><a href="#commentsTab">Comments</a>
					</ul>

					<div class="tabs-content" data-tabs-content="entryTabs">
						<div id="entryTab"class="tabs-panel is-active">
							<div class="secondary callout">
								<h2>Entry Details</h2>

								<div class="small-12">
									<label>Blog:<input type="text" value="<?php echo e($entry->blog->name); ?>" disabled="disabled"></label>
								</div>

								<div class="small-12">
									<label>Name:<input class="first-focus" name="name" type="text" placeholder="Name" data-url-slug="input[name=slug]" data-form-initial-value="<?php echo e($entry->name); ?>"></label>
								</div>

								<div class="small-12">
									<label>
										URL:
										<div class="input-group">
											<span class="input-group-label">/<?php echo e($entry->blog->slug); ?>/</span>
											<input class="input-group-field" name="slug" type="text" placeholder="URL" data-form-initial-value="<?php echo e($entry->slug); ?>">
										</div>
										<label id="addRedirect" class="hide"><input type="checkbox" name="add_redirect"> Add a redirect</label>
									</label>
								</div>

								<div class="small-12">
									<label>Content:<textarea class="fontFixedWidth" name="content" rows="20" data-form-initial-value="<?php echo e($entry->content); ?>"></textarea></label>
								</div>
							</div>

							<div class="small-12 hide">
								<div class="secondary callout">
									<h2>Post Options</h2>

									<label><input name="active" type="checkbox" data-form-initial-value="<?php echo e($entry->active); ?>">This post is active</label>
									<label><input name="hidden" type="checkbox" data-form-initial-value="<?php echo e($entry->hidden); ?>">This post is hidden (can only be accessed if the visitor knows the URL)</label>
									<label><input name="restricted" type="checkbox" data-form-initial-value="<?php echo e($entry->restricted); ?>">Users must be logged in to see this entry</label>
									<label><input name="comments" type="checkbox" data-form-initial-value="<?php echo e($entry->allow_comments); ?>">Allow comments</label>
								</div>
							</div>

							<?php if( $blog->categories->count() ): ?>
								<div class="secondary callout" data-select-all>
									<h2>Categories</h2>
									<label class="small-12 columns"><input class="selectAll" type="checkbox" data-select-all-toggle="categories"> Select All</label>

									<div class="expanded row">
										<?php $__currentLoopData = $blog->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<label class="small-4 columns end"><input class="input" type="checkbox" name="categories[]" value="<?php echo e($category->id); ?>" data-select-all="categories" data-form-initial-value="<?php echo e($entry->categories->contains( 'blog_category_id', $category->id )); ?>"> <?php echo e($category->name); ?></label>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
								</div>
							<?php endif; ?>

							<div class="small-12">
								<button class="button primary" type="submit" data-form-submit="editBlogEntryForm">Save Post</button>
								<button type="button" class="button alert" data-open="deleteBlogEntryModal">Delete Post</button>
								<?php if( session()->has( 'blogViewEntryReferer' ) ): ?> <a class="button secondary" href="<?php echo e(session()->get( 'blogViewEntryReferer' )); ?>" title="Return to the entry">Return to Post</a> <?php endif; ?>
								<a class="button secondary" href="<?php echo e(route('admin.blog.view', $entry->blog->id )); ?>" title="Cancel">Cancel</a>
							</div>
						</div>

						<div id="commentsTab"class="tabs-panel is-active">
							<?php if( $entry->comments->count() ): ?>
								<?php $__currentLoopData = $entry->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="secondary callout">
										<div class="blogCommentBody">
											<?php echo e($comment->comment); ?>

										</div>
										<div class="blogCommentFooter">
											Posted <?php echo e(\Carbon\Carbon::parse( $comment->created_at )->toDayDateTimeString()); ?> by <?php echo e($comment->poster ? $comment->poster->displayName(): 'Anonymous'); ?>

										</div>
										<a href="#" class="alert link" title="Delete this comment">Delete Comment</a>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								<div class="primary callout">
									<strong>This entry does not have any comments</strong>
								</div>
							<?php endif; ?>
						</div>

					</div>
				</div>
			</div>
		</form>

		<div id="deleteBlogEntryModal" class="reveal" data-reveal>
			<form id="deleteBlogEntryForm" method="post" action="<?php echo e(route( 'admin.blog.entry.delete', [ $blog->id, $entry->id ] )); ?>" data-form-ajax data-form-wait-title="Deleting post...">
				<h2>Delete Post?</h2>
				<p><strong>Are you sure you want to delete the post "<?php echo e($entry->name); ?>"?</strong> This action cannot be undone.</p>
				<button type="submit" class="button alert">Delete Post</button>
				<button type="button" class="button secondary" data-close>Cancel</button>
				<button class="close-button" data-close aria-label="Close reveal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
			</form>
		</div>

	<?php else: ?>

		<div class="expanded row">
			<div class="small-12 columns">
				<div class="alert callout">
					<strong>The post you are looking for was not found.</strong>
				</div>
			</div>
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

			$("*[data-url-slug]").on( "keyup", function(e) {
				var slug = $(this).val();
				slug = slug.toLowerCase();
				slug = slug.replace(/\s+/g, '_')           // Replace spaces with underscores
				slug = slug.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
				slug = slug.replace(/\-\-+/g, '-')         // Replace multiple - with single -
				slug = slug.replace(/^-+/, '')             // Trim - from start of text
				slug = slug.replace(/-+$/, '');            // Trim - from end of text
				$( $(this).attr("data-url-slug") ).val( slug );
			});

			$( "input[name=slug]" ).on( "keyup", function( e ) {
				if ( $( this ).val() != $( this ).attr( "data-form-initial-value" ) ) {
					$( "input[name=add_redirect]" ).prop( "checked", true );
					$( "#addRedirect" ).removeClass( "hide" );
				}
				else {
					$( "input[name=add_redirect]" ).prop( "checked", false );
					$( "#addRedirect" ).addClass( "hide" );
				}
			});

		});

	</script>

<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>