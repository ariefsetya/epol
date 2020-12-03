@if ($paginator->hasPages())
    <nav>
        <div class="text-center">
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a  style="border-radius: 100px;width:60%;" class="button secondary disabled large for_button" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('next_survey_button')->first()->content}}</a>
            @else
                <a  style="border-radius: 100px;width:60%;" onclick="finish_quiz()" class="button secondary disabled for_button text-white large" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
            @endif
        </div>
    </nav>
@else
    <nav>
        <div class="text-center">
            <a  style="border-radius: 100px;width:60%;" onclick="finish_quiz()" class="button secondary disabled for_button text-white large" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
        </div>
    </nav>
@endif