<div class="main" role="main" id="main">

	<% if $Content || $Form %>
	<div class="row">
		<div class="columns twelve panel panel-content">
			<div class="panel-block">
				<article class="content content--noheader">
					<% if $Content %>
						$Content.RichLinks
					<% end_if %>

					<% if $Form %>
					<div class="main">
						$Form
					</div>
					<% end_if %>
				</article>
			</div>
		</div>
	</div>
	<% end_if %>


	<% if $CurrentPanels %>
		<% include Panels %>
	<% end_if %>
</div>
