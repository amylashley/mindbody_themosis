@include('header')
		<div class="frame clearfix">
			<div id="get-started">
				<div class="container">
					<h2>{{ __('Get started:', THEMOSIS_TEXTDOMAIN) }}</h2>
					<p>{{ __('Check the documentation and build your next WordPress website/application.', THEMOSIS_TEXTDOMAIN) }}</p>
					<a href="http://framework.themosis.com/docs/" target="_blank" title="{{ __('Themosis framework documentation', THEMOSIS_TEXTDOMAIN) }}">{{ __('View documentation', THEMOSIS_TEXTDOMAIN) }}</a>
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