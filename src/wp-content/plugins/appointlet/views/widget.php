<?php if ($instance['user']): ?>
<img src="<?=$instance['button']?>" data-appointlet="<?php if (is_numeric($instance['user'])) echo 'u'; ?><?=$instance['user']?>">
<script>(function(e,t,n,r){if(e)return;t._appt=true;var i=n.createElement(r),s=n.getElementsByTagName(r)[0];i.async=true;i.src='//dje0x8zlxc38k.cloudfront.net/loaders/s-min.js';s.parentNode.insertBefore(i,s)})(window._appt,window,document,"script")</script>
<?php endif; ?>

