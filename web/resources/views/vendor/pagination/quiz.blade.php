@if ($paginator->hasPages())
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="button secondary col-md-12 disabled large for_button" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('next_survey_button')->first()->content}}</a>
            @else
                <a onclick="finish_quiz()" class="button secondary disabled for_button text-white col-md-12 large" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
            @endif
@else
            <a onclick="finish_quiz()" class="button secondary disabled for_button text-white col-md-12 large" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
@endif