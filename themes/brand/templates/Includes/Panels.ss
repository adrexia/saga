<% if CurrentPanels %>
<section class="row">
	<div class="columns twelve">
		<div class="panel-container <% if $Content || $Form %>has-contentpanel<% end_if %>">

			<% if $ShowNavigationPanel && $NavigationPosition =='With Panels' %>
				<% include PanelNav %>
			<% end_if %>

			<% loop CurrentPanels %>
			<article class="panel $Width">
				<% if $Type =='News' && $NewsPage.NewsItems() %>

					<div class="panel-block type-{$Type.LowerCase()} $Colour.LowerCase() $FirstLast listing">
						<h3 class="panel-heading">
							<a href="$NewsPage.Link">$Title</a>
						</h3>
						<% include NewsPanel Items=$NewsPage.RecentNews %>
					</div>

				<% else_if $Type == 'HTML' %>

					<div class="panel-block type-{$Type.LowerCase()} $Colour.LowerCase() $FirstLast">
						<% if $Image %>
							<div class="img-wrap">$Image.SetWidth(430)</div>
						<% end_if %>
						<h3 class="panel-heading">
							<% if $Title %>$Title<% end_if %>
							<% if $SubTitle %><span class="subhead meta-data">$SubTitle</span><% end_if %>
						</h3>
						<% if $HTML %>
						<article class="content">
							$HTML
						</article>
						<% end_if %>
					</div>

				<% else_if $Type == 'Content' %>

					<% if $Link %><a href="$Link.Link" class="link<% else %><div class="<% end_if %> panel-block type-{$Type.LowerCase()} $Colour.LowerCase() $FirstLast">
						<% if $Image %>
							<div class="img-wrap">$Image.SetWidth(430)</div>
						<% end_if %>
						<h3 class="panel-heading">
							<% if $Title %>$Title<% end_if %>
						</h3>
						<% if $Content %>
						<article class="content">
							<p>$Content</p>
						</article>
						<% end_if %>

					<% if $Link %></a><% else %></div><% end_if %>
				<% else_if $Type == 'Image' %>

					<% if $Link %><a href="$Link.Link" class="link<% else %><div class="<% end_if %> panel-block type-{$Type.LowerCase()} $Colour.LowerCase() $FirstLast">
						<% if $Image %>
							<div class="img-wrap">$Image.SetWidth(430)</div>
						<% end_if %>
					<% if $Link %></a><% else %></div><% end_if %>

				<% end_if %>
			</article>
			<% end_loop %>
		</div>
	</div>
</section>
<% end_if %>
