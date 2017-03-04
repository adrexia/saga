
<% include Brand %>

<style>

	<% with $Brand %>

		<% if $Brand.BodyFontColour %>
			body,
			.navbar,
			.layout * {
				color: $getHex($BodyFontColour);
			}
			.navbar ul li>a,
			.navbar * {
				color: $getHex($BodyFontColour);
			}
		<% end_if %>

		<% if $MenuBackgroundColour %>

			.navbar {
				background-color: $getHex($MenuBackgroundColour);
			}

		<% end_if %>

		<% if $MenuFontColour %>

			.navbar * {
				color: $getHex($MenuFontColour);
			}

			.navbar ul li>a,
			.navbar * {
				color: $getHex($MenuFontColour);
			}

		<% end_if %>

		<% if $PanelBackgroundColour %>
			.panel-block {
				background: $getHex($PanelBackgroundColour);
				box-shadow: 0 0 1px rgba(0,0,0,0.14),0px 3px 1px rgba(0,0,0,0.14);
			}
		<% end_if %>

		<% if $PanelBackgroundColourHover %>
			.panel a.panel-block:hover,
			.panel a.panel-block:focus,
			.panel .listing-item a:hover,
			.panel .listing-item a:focus {
				background: $getHex($PanelBackgroundColourHover);
			}
		<% end_if %>

		<% if $PanelFontColour %>
			.panel-block * {
				color: $getHex($PanelFontColour);
			}

			.btn.default,
			.skiplink.default,
			.doRegister.default {
				background: transparent;
				border: 1px solid $getHex($PanelFontColour);
				color: $getHex($PanelFontColour);
			}
			.btn.default a,
			.btn.default input {
				color: $getHex($PanelFontColour);
			}
		<% end_if %>

		<% if $BodyLinkColour %>
			.panel-block a span,
			.panel-block a {
				color: $getHex($BodyLinkColour);
			}
		<% end_if %>


		<% if $MenuPanelBackgroundColour %>
			.panel--nav .panel-block {
				background-color: $getHex($MenuPanelBackgroundColour);
			}
		<% end_if %>

		<% if $MenuPanelLinkColour %>
			.panel--nav a span,
			.panel--nav a {
				color: $getHex($MenuPanelLinkColour);
			}

			.panel--nav .nav-level1.active,
			.panel--nav .nav-section {
				border-bottom-color: $getHex($MenuPanelLinkColour);
				border-top-color: $getHex($MenuPanelLinkColour);
			}
		<% end_if %>

		<% if $PanelFontColourHover %>
			.panel a.panel-block:hover *,
			.panel a.panel-block:focus *,
			.panel .listing-item a:hover *,
			.panel .listing-item a:focus * {
				color: $getHex($PanelFontColourHover);
			}
		<% end_if %>

	<% end_with %>


	<% if $ContrastColour %>
		.page-header * {
			color: $Brand.getHex($ContrastColour);
			text-shadow: <% if $Colour %>$Brand.getHex($Colour)<% else %>$Brand.getHex($Level(1).Colour)<% end_if %> 0px 0px 20px;
		}
	<% end_if %>


	<% if $SplashImage %>
		.splash {
			background-image: url($SplashImage.URL);
		}
	<% end_if %>
	<% if $Colour %>
		.overlay {
			background-color: $Brand.getHex($Colour);
		}
	<% else %>
		.overlay {
			background-color: $getHex($MenuBackgroundColour);
		}
	<% end_if %>

	<% if $PanelMargin != 0 %>
		.panel {
			padding: 0px {$PanelMarginHalf}px {$PanelMargin}px {$PanelMarginHalf}px;
		}
	<% end_if %>




</style>
