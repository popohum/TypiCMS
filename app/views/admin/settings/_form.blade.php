@section('head')

	{{ HTML::script(asset('js/form.js')) }}

@stop

<div class="well">
	@if (count($locales) > 1)
	<ul class="nav nav-tabs">
		@foreach ($locales as $lang)
		<li class="@if ($locale == $lang)active@endif">
			<a href="#{{ $lang }}" data-target="#{{ $lang }}" data-toggle="tab">@lang('global.languages.'.$lang)</a>
		</li>
		@endforeach
	</ul>
	@endif

	<div class="tab-content">

		@foreach ($locales as $lang)

		<div class="tab-pane @if ($locale == $lang)active@endif" id="{{ $lang }}">
			{{ Former::lg_text($lang.'[websiteTitle]')->label('title'); }}
			{{ Former::checkbox($lang.'[status]')->text('Online')->label(''); }}
		</div>

		@endforeach

	</div>
</div>

{{ Former::text('webmasterEmail'); }}
{{ Former::text('typekitCode'); }}
<div class="row">
	<div class="col-sm-6">
	{{ Former::text('googleAnalyticsUniversalCode'); }}
	</div>
	<div class="col-sm-6">
	{{ Former::text('googleAnalyticsCode'); }}
	</div>
</div>
{{ Former::checkbox('langChooser')->label('')->text('langChooser'); }}
{{ Former::checkbox('authPublic')->label('')->text('authPublic'); }}

<div>
	{{ Former::primary_button()->type('submit')->value('save') }}
	{{ Former::link()->class('btn btn-default')->href(route('admin.settings.index'))->value('Annuler') }}
</div>
