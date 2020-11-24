@if ($paginator->hasPages())
    <nav>
        <div class="">
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="btn btn-secondary btn-block for_button disabled btn-lg" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('next_survey_button')->first()->content}}</a>
            @else
                <a data-toggle="modal" data-target="#finishDialog" class="btn btn-secondary text-white btn-block for_button disabled btn-lg" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
            @endif
        </div>
    </nav>
@else
    <nav>
        <div class="">
            <a data-toggle="modal" data-target="#finishDialog" class="btn btn-secondary text-white btn-block for_button disabled btn-lg" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
        </div>
    </nav>
@endif

<style type="text/css">
    .for_button.disabled {
      pointer-events: none;
      cursor: default;
    }
</style>
