@if ($paginator->hasPages())
    <nav>
        <div class="">
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="button secondary col-md-12 for_button disabled large" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('next_survey_button')->first()->content}}</a>
            @else
                <a onclick="finish_polling()" class="button secondary text-white col-md-12 for_button disabled large" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
            @endif
        </div>
    </nav>
@else
    <nav>
        <div class="">
            <a onclick="finish_polling()" class="button secondary text-white col-md-12 large for_button disabled" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
        </div>
    </nav>
@endif

<style type="text/css">
    .for_button.disabled {
      pointer-events: none;
      cursor: default;
    }
</style>
