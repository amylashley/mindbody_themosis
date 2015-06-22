@include('header')
		<div class="frame clearfix">
			<div id="get-started">
				<div class="container">
                                    <p><?php print_r($html_result); ?></p>
				</div>
			</div>
			<div id="links">
				<div class="container">
					<h3>{{ __('Links:', THEMOSIS_TEXTDOMAIN) }}</h3>
					<ul>
						<li><a href="http://framework.themosis.com" target="_blank" title="Themosis framework">Themosis framework</a></li>
						<li><a href="https://github.com/themosis" target="_blank" title="GitHub - Themosis">GitHub</a></li>
						<li><a href="https://twitter.com/Themosis" target="_blank" title="Twitter - Themosis">Twitter</a></li>
					</ul>
				</div>
			</div>
		</div>
@include('footer')