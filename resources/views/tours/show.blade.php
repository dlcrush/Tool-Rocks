@extends('layouts/app')

@section('content')

<div class="container-fluid tour-layout">
    <div class="row">
        <div class="col-xs-12">
            @include('components.prettyHeader', ['text' => 'Tours'])
        </div>
    </div>

    <div class="tour-item">
        <div class="row">
            <div class="col-xs-12">
                <h3>{{ array_get($tour, 'name') }}</h3>

                <div class="shows-collection list-group">
                    @forelse(array_get($tour, 'shows.data') as $show)
                        <a href="{{ action('TourController@getShow', ['tourId' => array_get($tour, 'slug'), 'showId' => array_get($show, 'id'), 'slug' => array_get($show, 'slug')]) }}" class="list-group-item">
                            <div class="show-card">
                                <h4 class="list-group-item-heading" style="display: inline-block">{{ array_get($show, 'name') }}</h4>
                                @if(array_get($show, 'video') != null)
                                    <div class="pull-right watch-link" style="display: inline-block" data-href="{{ array_get($show, 'video.links.web') }}">
                                        <i class="fa fa-video-camera"></i> Watch
                                    </div>
                                @endif
                            </div>
                        </a>
                    @empty
                        <p>Sorry, no shows for this tour. So sad!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function() {
        $('.watch-link').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            window.location = $(this).data('href');
        });
    });
</script>
@endsection