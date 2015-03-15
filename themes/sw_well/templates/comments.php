<?php

function roots_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
  	<div id="comment-<?php comment_ID(); ?>" <?php comment_class('media'); ?>>
  		<div class="author">
			<div class="pull-left user-avatar"><?php echo get_avatar($comment, $size = '32'); ?></div>
			<div class="media">
            	<h5 class="title">
					<?php echo comment_author_link(get_comment_ID())?>
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                </h5> 
                <div class="meta">
					<time class="hblog-time" datetime="<?php echo comment_date('c'); ?>"><?php printf(__('%1$s', 'roots'), get_comment_date(),  get_comment_time()); ?></time>
				</div>
				<div class="media-body">
					 <span class="article"><?php comment_text(); ?></span>
				</div>
			</div>
		</div>
 </div>
<?php
}
// end function
?>

<?php if (post_password_required()) { ?>
	<section id="comments">
		<div class="alert alert-block fade in">
			<a class="close" data-dismiss="alert">&times;</a>
			<p><?php _e('This post is password protected. Enter the password to view comments.', 'roots'); ?></p>
		</div>
	</section><!-- /#comments -->
<?php 
	return;
	} ?>

<?php if (have_comments()) : ?>
<?php $comment_number = get_comments_number(); ?>
	<section id="comments">
		<div class="comment-title">
			<h5>
				<span id="textComment">Hide</span><span><?php if( $comment_number == 1 ){ echo ' comment ('.$comment_number.')';}else{echo ' comments ('.$comment_number.')';} ?> </span>
				<a href="javascript:toggle('commentlist', 'leave', 'textComment');" class="leave" id="leave">
					<i class=" icon-minus-sign icon-large"></i>
				</a>
			</h5>
		</div>
		<div class="commentlist" id="commentlist" style="display: block;">
		<?php wp_list_comments(array('callback' => 'roots_comment')); ?>
	</div>

	<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
	<nav id="comments-nav" class="pager">
		<ul class="pager">
		<?php if (get_previous_comments_link()) : ?>
			<li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'roots')); ?></li>
		<?php else: ?>
			<li class="previous disabled"><a><?php _e('&larr; Older comments', 'roots'); ?></a></li>
		<?php endif; ?>
		<?php if (get_next_comments_link()) : ?>
			<li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'roots')); ?></li>
		<?php else: ?>
			<li class="next disabled"><a><?php _e('Newer comments &rarr;', 'roots'); ?></a></li>
		<?php endif; ?>
		</ul>
	</nav>
	<?php endif; // check for comment navigation ?>

	<?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
		<div class="alert alert-block fade in">
			<a class="close" data-dismiss="alert">&times;</a>
			<p><?php _e('Comments are closed.', 'roots'); ?></p>
		</div>
	<?php endif; ?>
</section><!-- /#comments -->
<?php endif; ?>

<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
<section id="comments">
	<div class="alert alert-block fade in">
		<a class="close" data-dismiss="alert">&times;</a>
		<p><?php _e('Comments are closed.', 'roots'); ?></p>
	</div>
</section>
<!-- /#comments -->
<?php endif; ?>
<div class="comment-border"></div>
<?php if (comments_open()) : ?>
<section id="respond" class="contact">
	<div class="comment-title">
		<h5><span><?php comment_form_title(__('Add your comment', 'roots'), __('Leave a Reply to %s', 'roots')); ?></span></h5>
	</div>
	<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="commentform" onsubmit="return submitform()">
			<div class="comment-notice">
				<p><?php _e('Your email address will not be published. Require fields are marked ', 'ya_theme' );?><i class="icon-star-empty"></i></p>
			</div>
			<div class="contact-content">
				<?php if (is_user_logged_in()) : ?>
					<table>
						<tr>
							<td class="left">
								Message
							</td>
							<td class="right">
								<div class="require">
									<textarea name="comment" id="comment" placeholder="Enter your comment here..." id="message" rows="7" tabindex="4" <?php if ($req) echo "aria-required='true'"; ?>><?php _e('', 'roots'); ?></textarea>
									<div id="star3" class="star"><i class="icon-star-empty"></i></div>
								</div>
							</td>
						</tr>
						<tr>
							<td>

							</td>
							<td>
								<p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'roots'), get_option('siteurl'), $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'roots'); ?>"><?php _e('Log out', 'roots'); ?></a></p>
								<div class="submit">
									 <input type="submit" value="Send message" id="submit"/><i class="icon-envelope"></i>
								</div>
							</td>
						</tr>
					</table>
				<?php else : ?>
					<table>
						<tr>
							<td class="left">
								Name
							</td>
							<td class="right">
								<div class="require">
									<input type="text" name="author" id="name" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>>
									<div id="star1" class="star"><i class="icon-star-empty"></i></div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="left">
								URL
							</td>
							<td class="right">
								 <input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="2">
							</td>
						</tr>
						<tr>
							<td class="left">
								Email
							</td>
							<td class="right">
								<div class="require">
									<input type="email"  name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="3" <?php if ($req) echo "aria-required='true'"; ?>>
									<div id="star2" class="star"><i class="icon-star-empty"></i></div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="left" valign="top">
								Message
							</td>
							<td class="right">
								<div class="require">
									<textarea name="comment" id="message" placeholder="Enter your comment here..." id="message" tabindex="4" <?php if ($req) echo "aria-required='true'"; ?>><?php _e('', 'roots'); ?></textarea>
									<div id="star3" class="star"><i class="icon-star-empty"></i></div>
								</div>
							</td>
						</tr>
						<tr>
							<td>

							</td>
							<td>
								<div class="submit">
									 <input type="submit" value="Send message" id="submit"/><i class="icon-envelope"></i>
								</div>
							</td>
						</tr>
					</table>
				<?php endif; ?>
			</div>
			<?php comment_id_fields(); ?>
			<?php do_action('comment_form', $post->ID ); ?>
		</form>

</section><!-- /#respond -->
<?php endif; ?>
<script type="text/javascript">
	function submitform(){
		var nameID = document.commentform.author
		var commentID = document.commentform.comment
		var emailID= document.commentform.email
		
		if ((nameID.value==null)||(nameID.value=="")){
			alert("Please Enter your name!")
			nameID.focus()
			return false
		}
		if ((emailID.value==null)||(emailID.value=="")){
			alert("Please Enter your Email!")
			emailID.focus()
			return false
		}
		if ((commentID.value==null)||(commentID.value=="")){
			alert("Please Enter your message!")
			commentID.focus()
			return false
		}
		return true
	 }
	 function toggle(showHideDiv, switchImgTag, titleText) {
        var ele = document.getElementById(showHideDiv);
		var text = document.getElementById(titleText);
        var imageEle = document.getElementById(switchImgTag);
        if(ele.style.display == "block") {
                ele.style.display = "none";
				text.innerHTML = 'Show';
			imageEle.innerHTML = '<i class=" icon-plus-sign icon-large"></i>';
        }
        else {
                ele.style.display = "block";
				text.innerHTML = "Hide";
                imageEle.innerHTML = '<i class=" icon-minus-sign icon-large"></i>';
        }
}
</script>