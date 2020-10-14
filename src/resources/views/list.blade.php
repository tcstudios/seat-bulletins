@extends('web::layouts.grids.12')

@section('title', 'Current Bulletins')
@section('page_header', 'Current Bulletins')

@push('head')
    <link href="{{ asset('web/css/bulletins.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('full')
    @if (count($bulletins) === 0)
        <div class="card card-default">
            <div class="card-header error">
                There are currently no available bulletins.
            </div>
        </div>
    @endif
    @foreach ($bulletins as $bulletin)
        <div class="card card-default">
            <div class="card-header">
                <div class="card-tools pull-right">
                    <button type="button" class="btn btn-tool toggle-bulletin" data-id="{{ $bulletin->id }}" data-toggle="tooltip" data-placement="top" title="Toggle Bulletin Visibility">
                        <span class="fas fa-caret-down" id="{{ 'bulletin-'.$bulletin->id.'-down' }}"></span>
                        <span class="fas fa-caret-up" style="display:none" id="{{ 'bulletin-'.$bulletin->id.'-up' }}"></span>
                    </button>
                </div>
                <div class="row">
                    <h3 class="card-title">{{ $bulletin->title }}</h3>
                </div>
                <div class="row author">
                    Created by&nbsp;<strong>{{ $bulletin->character_name }}</strong>&nbsp;on&nbsp;<strong>{{ $bulletin->created_at->format('d M Y \a\t H:i') }}</strong>.
                    @if($bulletin->updated_at != $bulletin->created_at)
                        Last updated at&nbsp;<strong>{{ $bulletin->updated_at->format('d M Y \a\t H:i') }}</strong>.
                    @endif
                </div>
                <div class="row role-badges">
                    @foreach($bulletin->roles as $role)
                        <span class="badge badge-primary spaced-badge">{{ $role->title }}</span>
                    @endforeach
                </div>
            </div>
            <div class="card-body" id="{{ 'bulletin-'.$bulletin->id }}" style="display:none">{!! $bulletin->text !!}</div>
        </div>
    @endforeach
@stop

@push('javascript')
    <script>
        $(document).on('click', '.toggle-bulletin', function() {
            console.log('here');
            let id = $(this).data('id');
            let content_selector = '#bulletin-' + id;
            let up_selector = content_selector + '-up';
            let down_selector = content_selector + '-down';
            let visible = $(content_selector).is(':visible');
            if (visible) {
                $(content_selector).hide();
                $(down_selector).show();
                $(up_selector).hide();
            } else {
                $(content_selector).show();
                $(down_selector).hide();
                $(up_selector).show();
            }
        });
    </script>
@endpush