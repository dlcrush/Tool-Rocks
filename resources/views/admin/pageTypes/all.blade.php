{{-- Lists all resources in a table --}}
@extends('admin/layouts/app')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="row">
        <div class="col-md-8">
            @if(isset($filters))
                @if(array_has($filters, 'band'))
                    @include("admin.partials.bandDropdown", ["bands" => array_get($filters, 'band.bands'), "selected" => array_get($filters, 'band.current'), "page" => $page])
                @endif
                @if(array_has($filters, 'tour'))
                    @include("admin.partials.tourDropdown", ["tours" => array_get($filters, 'tour.tours'), "selected" => array_get($filters, 'tour.current'), "page" => $page, "bandId" => array_get($filters, 'tour.bandId')])
                @endif
            @endif
        </div>
        <div class="col-md-4">
            @if(isset($createButton))
                @include("admin.partials.button", [
                    'text' => array_get($createButton, 'text'),
                    'href' => array_get($createButton, 'href'),
                    'type' => 'create',
                    'size' => 'large',
                    'float' => 'right'
                ])
            @endif
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                @foreach(array_get($table, 'columns', []) as $col)
                    <th>
                        @if (array_has($col, 'header'))
                            {{ array_get($col, 'header') }}
                        @endif
                    </th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @foreach(array_get($table, 'data', []) as $entry)
                <tr>
                    @foreach(array_get($table, 'columns', []) as $col)
                        <?php $type = array_get($col, 'type', 'key'); ?>

                        <td>
                            @if ($type == 'key')
                                {{-- This entry has a valueKey value which maps to location within an object --}}
                                @if (array_has($col, 'valueKey'))
                                    {{ $entry->{array_get($col, 'valueKey')} }}
                                @endif
                            @elseif ($type == 'buttons' or $type == 'button')
                                {{-- This is a button or button group --}}
                                @foreach(array_get($col, 'buttons', [array_get($col, 'button')]) as $button)

                                    <?php
                                        $buttonHref = array_get($button, 'href');

                                        if (is_array($buttonHref)) {
                                            $buttonAction = array_get($buttonHref, 'action');
                                            // I'll make this more flexible sometime (or maybe not)
                                            $buttonActionParams = array_get($buttonHref, 'params');
                                            if (is_array($buttonActionParams)) {
                                                $buttonActionParams = [
                                                    'id' => $entry->id
                                                ];
                                            } else {
                                                $buttonActionParams = [];
                                            }
                                            $buttonHref = action($buttonAction, $buttonActionParams);
                                        }
                                     ?>

                                    @include("admin.partials.button", [
                                        'text' => array_get($button, 'text'),
                                        'href' => $buttonHref,
                                        'type' => array_get($button, 'type'),
                                        'full_width' => $type == 'button'
                                    ])
                                @endforeach
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
