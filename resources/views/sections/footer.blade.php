<footer class="footer">
	<div class="bg-light">
		<div class="__wrapper c-main">
			<div class="__widgets footer-py grid gap-6">
				@for ($i = 1; $i <= 4; $i++)
					@if (is_active_sidebar('sidebar-footer-' . $i))
					<div>@php(dynamic_sidebar('sidebar-footer-' . $i))</div>
			@endif
			@endfor
		</div>
		</div>
	</div>

	<div class="c-main  flex justify-between py-10 footer-bottom">
		<p class="">Copyright ©2025 <?php echo get_bloginfo('name'); ?>. All Rights Reserved</p>
		<p class="flex gap-2">Designed &amp; Developed by
			<a target="_blank" href="https://www.ohsofresh.pl" title="OhSoFresh"><img class="oh" src="/wp-content/themes/shadow/resources/images/ohsofresh.svg"></a>
		</p>
	</div>
	</div>
</footer>