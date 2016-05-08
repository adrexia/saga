<nav id="navbar" class="navbar <% if $SplashImage %> has-image<% end_if %>" role="navigation" data-fixed="20">
		<h2 class="nonvisual-indicator">Main navigation</h2>
		<ul class="">

			<li class="nav-first active">
				<a href="#menu" class="toggle" data-trigger=".menu-control" data-classname="menu--open">
					<i class="icon icon-menu"></i>
					<span class="nav-pagetitle">$MenuTitle.XML</span>
				</a>
			</li>

			<li class="item-center <% if $Brand.Logo %>logo<% end_if %>">
				<a href="$BaseHref">
					<% if $Brand.Logo %>
						<img src="$Brand.Logo.URL" alt="$SiteConfig.Title logo" />
					<% end_if %>
					<span class="<% if $Brand.Logo %>sr-only<% end_if %>">
						$SiteConfig.Title
					</span>
				</a>
			</li>

			<li class="pull-right link login">

				<% if $CurrentMember %>
					<span class="login-user">
						$CurrentMember.FirstName
					</span>
					<a href="{$BaseHref}Security/logout?BackURL={$Link}">Log out</a>
				<% else %>
					<a href="{$BaseHref}Security/login?BackURL={$Link}">Login</a>
				<% end_if %>
			</li>

		</ul>
	</div>
</nav>
