<div class="data-col">
    <div class="left-col">
        {{-- <span class="title">{{ $tradeDataArray['stock_name'] }}</span> --}}
        <span class="title">TINNATFL</span>
        <span class="price">
            {{ $tradeDataArray['tinna']['current_rate'] }}
        </span>
    </div>
    <div class="right-col">
        <span class="up-down-value">{{ $tradeDataArray['tinna']['rate_diff'] }}</span>
        <span class="icon">
            @if ($tradeDataArray['tinna']['direction'] == 'up')
                <img src="{{asset('/website/images/caret-up.svg')}}" alt="Caret up">
            @else
                <img src="{{asset('/website/images/caret-down.svg')}}" alt="Caret down">
            @endif
        </span>
        <span class="up-down-percentage">{{ $tradeDataArray['tinna']['ratePercentage'] }}%</span>
    </div>
</div>


<div class="data-col">
    <div class="left-col">
        {{-- <span class="title">{{ $tradeDataArray['stock_name'] }}</span> --}}
        <span class="title">BSE Sensex</span>
        <span class="price">
            {{ $tradeDataArray['bse']['current_rate'] }}
        </span>
    </div>
    <div class="right-col">
        <span class="up-down-value">{{ $tradeDataArray['bse']['rate_diff'] }}</span>
        <span class="icon">
            @if ($tradeDataArray['bse']['direction'] == 'up')
                <img src="{{asset('/website/images/caret-up.svg')}}" alt="Caret up">
            @else
                <img src="{{asset('/website/images/caret-down.svg')}}" alt="Caret down">
            @endif
        </span>
        <span class="up-down-percentage">{{ $tradeDataArray['bse']['ratePercentage'] }}%</span>
    </div>
</div>
