<aside class="menu menu-control" id="menu">
	<h2>$SiteConfig.Title</h2>
	<ul class="nav nav-list">
	<% loop $Menu(1) %>
		<li class="<% if $FirstLast %>nav-$FirstLast<% end_if %> $LinkingMode menu-level1 <% if $LinkingMode = current %> active<% end_if %> <% if $Link = home && $SiteConfig.Logo %> logo<% end_if %>">
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
</aside>
<div class="menu-overlay toggle" data-trigger=".menu-control" data-classname="menu--open"></div>
