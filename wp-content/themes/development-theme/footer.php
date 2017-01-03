<?php
	global $_am;
?>

</div><!--.page-content END-->

<footer id="am-footer">

	<div class="am-wrap">
		<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--12-col">
				<p class="mdl-typography--text-center"><?php echo $_am['opt-company-copyright'] ?></p>
			</div>
		</div>
	</div>

</footer>

		</main>
<?php do_action('before_AM_wrap_ends') ?>
	</div><!--#am-appwrap END-->
<?php wp_footer(); ?>
</body>
</html>