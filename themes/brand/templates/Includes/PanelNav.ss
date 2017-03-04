<aside class="panel panel--nav $NavigationWidth columns <% if $NavigationPosition =='With Content' %>panel-content<% end_if %>">
	<div class="panel-block type-nav $Top.Colour.LowerCase() first">
			<ul class="nav nav-list">
			<% loop $Menu(1) %>
				<li class="<% if $FirstLast %>nav-$FirstLast<% end_if %> nav-$LinkingMode nav-level1 <% if $LinkingMode = current %> active<% end_if %> <% if $Link = home && $SiteConfig.Logo %> logo<% end_if %>">
					<a href="$Link" class="$LinkingMode">
						<span class="">$MenuTitle.XML</span>
					</a>
					<% if $Children %>
						<% if $LinkingMode = current || $LinkingMode = section %>
							<ul class="nav nav-list">
								<% include MenuTwo First=$First, Last=$Last %>
							</ul>
						<% end_if %>
					<% end_if %>
				</li>
			<% end_loop %>
			</ul>
			<p>&nbsp;</p>
	</div>
</aside>
