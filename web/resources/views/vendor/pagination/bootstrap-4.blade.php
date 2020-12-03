
<div style="width: calc(100% - 20px);padding:10px;position: fixed;bottom:0;" class="text-center">
@if ($paginator->hasPages())
    <nav>
        <div class="text-center">
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a  style="border-radius: 100px;width:60%;" class="button secondary for_button disabled large" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('next_survey_button')->first()->content}}</a>
            @else
                <a  style="border-radius: 100px;width:60%;" onclick="finish_polling()" class="button secondary text-white for_button disabled large" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
            @endif
        </div>
    </nav>
@else
    <nav>
        <div class="text-center">
            <a  style="border-radius: 100px;width:60%;" onclick="finish_polling()" class="button secondary text-white large for_button disabled" rel="next" aria-label="@lang('pagination.next')">{{\App\EventDetail::where('event_id',Session::get('event_id'))->whereName('finish_survey_button')->first()->content}}</a>
        </div>
    </nav>
@endif
</div>

<style type="text/css">
    .for_button.disabled {
      pointer-events: none;
      cursor: default;
    }
</style>
