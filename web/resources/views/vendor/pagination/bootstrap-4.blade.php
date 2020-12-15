@if ($paginator->hasPages())
    <nav>
        <div class="text-center">
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a  style="padding:0px 25px;color:white;font-family: 'Lato';font-weight: 700;font-size: 17pt;border-radius: 10px;width:60%;margin:0 auto;" class="button secondary for_button disabled large" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('next_survey_button')->first()->content}}</a>
            @else
                <a  style="padding:0px 25px;color:white;font-family: 'Lato';font-weight: 700;font-size: 17pt;border-radius: 10px;width:60%;margin:0 auto;" onclick="finish_polling()" class="button secondary text-white for_button disabled large" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
            @endif
        </div>
    </nav>
@else
    <nav>
        <div class="text-center">
            <a  style="padding:0px 25px;color:white;font-family: 'Lato';font-weight: 700;font-size: 17pt;border-radius: 10px;width:60%;margin:0 auto;" onclick="finish_polling()" class="button secondary text-white large for_button disabled" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
        </div>
    </nav>
@endif

<style type="text/css">
    .for_button.disabled {
      pointer-events: none;
      cursor: default;
    }
</style>
