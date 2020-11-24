@if ($paginator->hasPages())
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="btn btn-secondary btn-block disabled btn-lg for_button" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('next_survey_button')->first()->content}}</a>
            @else
                <a onclick="finish_quiz()" class="btn btn-secondary disabled for_button text-white btn-block btn-lg" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
            @endif
@else
            <a onclick="finish_quiz()" class="btn btn-secondary disabled for_button text-white btn-block btn-lg" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
@endif