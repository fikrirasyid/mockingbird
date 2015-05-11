			</div><!-- #content -->
		</div><!-- #app -->		

		<script id="HeaderTemplate" type="text/template">
			<button id="toggle-menu" class="genericon genericon-menu">Toggle Menu</button>
			<h1 id="site-title">
				<a href="<%= URL %>"><%= name %></a>
			</h1>
		</script><!-- #HeaderTemplate -->
		
		<script id="EntryTemplate" type="text/template">
			<div class="entry-meta">
				<div class="entry-avatar">
					<img src="<%= author.avatar.replace( 's=96', 's=40' ) %>" alt="<%= author.name %>">
				</div>
				<h3 class="entry-author"><%= author.name %></h3>
				<p class="entry-time"><%= date %></p>
			</div>
			<div class="entry-content">
				<%= excerpt %>
			</div>	
		</script><!-- #EntryTemplate -->

		<script id="ReadEntryTemplate" type="text/template">
			<div class="read-entry">
				<div class="entry">
					<div class="entry-meta">
						<div class="entry-avatar">
							<img src="<%= author.avatar.replace( 's=96', 's=40' ) %>" alt="<%= author.name %>">
						</div>
						<h3 class="entry-author"><%= author.name %></h3>
						<p class="entry-time"><%= date %></p>
					</div>
					<div class="entry-content">
						<%= content %>
					</div>	
				</div>
				<div class="modal"></div>
			</div>
		</script><!-- #ReadEntryTemplate -->

		<?php wp_footer(); ?>
	</body>
</html>