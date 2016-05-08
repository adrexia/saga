<div class="main-features top-panel">
	<div class="row features">
		<section class="twelve columns">
			<div class="panel-container js-isotope pagination-content" id="news-group">

				<% loop $News %>
					<article class="panel six $EvenOdd $FirstLast panel-seperate" >
						<div class="panel-block" style="border-bottom: 10px solid $Top.Brand.getHex($Colour)">


							<h3 id="ID-{$ID}">
								<% if $Title %>$Title<% end_if %>
								<span class="subhead meta-data">
									<time datetime="$Created">$Created.Format(d M Y)</time><% if $Author %>,
									<span>
										by $Author
									</span>
									<% end_if %>
								</span>

							</h3>
							<div class="content">
								$Content
							</div>
						</div>

					</article>
				<% end_loop %>

			</div>

			<% with News %>
				<div class="row">
					<% include Pagination %>
				</div>
			<% end_with %>
		</section>
	</div>
</div>
