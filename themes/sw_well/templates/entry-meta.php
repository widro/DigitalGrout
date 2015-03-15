<div class="meta">
	<span class="hblog-time"><?php echo get_the_time('F j, Y', $post->ID );?></span> - 
	<span class="hblog-comment"><?php if($post->comment_count <= 1){echo $post->comment_count.' Comment';}else{echo $post->comment_count.' Comments';}?></span>
</div>