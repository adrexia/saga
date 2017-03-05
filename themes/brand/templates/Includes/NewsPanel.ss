<% loop $Items.Limit($NumberToDisplay) %>
	<div class="listing-item $FirstLast">
		<div class="text-block">
			<a href="<% if $Link %>$Link<% else %>$InternalLink<% end_if %>">
				<h4 class="panel-heading">
					<span class="subhead pb0 meta-data">
						<time datetime="$Created">$Created.Format(d M Y)</time>
					</span>

					<% if $Title %>$Title<% end_if %>
					<span class="subhead ptxs pb0 meta-data">
						<span class="prefix">by </span><% if Author %>$Author<% else %>admin<% end_if %>
						<% if $Tagline %>$Tagline<% end_if %>
					</span>

				</h4>
				<p class="content">$Content.LimitCharacters(80)</p>
			</a>
		</div>
	</div>
<% end_loop %>
