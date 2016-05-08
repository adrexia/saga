<div class="splash-overlay cropped <% if $SplashImage %> has-image<% end_if %>">

	<div class="splash"></div>
	<div class="overlay"></div>

	<header class="page-header">
		<div class="row">
			<div class="eight columns centered">

					<% include Title Title=$Title %>

					<% if $Intro %>
					<p class="lead <% if not $JoinLink.LinkURL %>pbl<% end_if %>">
						$Intro
					</p>
					<% end_if %>

				<% if $JoinLink.LinkURL %>
				<span class="btn large">
					<a href="$JoinLink.LinkURL">Join Now!</a>
				</span>
				<% end_if %>

			</div>
		</div>

	</header>
</div>
