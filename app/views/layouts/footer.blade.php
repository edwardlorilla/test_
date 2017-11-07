<div id="footer">
		<br/>
		<div id="footerBorder">&nbsp;</div>
		<div class="col-lg-12 text-center ilys-footer">
			@if (Auth::check() && (Auth::user()->total_words_written > 0))
			<a href="/recent-autosaves">Recent Autosaves</a>
			&nbsp;&nbsp;&nbsp;
			@endif
			<!--
			<a href="/about">About</a>
			&nbsp;&nbsp;&nbsp;
		-->
			<a href="/testimonials">Testimonials</a>
			&nbsp;&nbsp;&nbsp;
			<a href="/terms-of-service">Terms of Service</a>
			&nbsp;&nbsp;&nbsp;
			<a href="/contact-us">Contact Us</a>
			&nbsp;&nbsp;&nbsp;
			<a href="/help">Help</a>
			<br/><br/>
			<p class="muted credit">&copy; <?php echo date("Y") ?> ilys</p>
		</div>
</div>
