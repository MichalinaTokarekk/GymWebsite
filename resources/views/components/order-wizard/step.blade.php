@aware(['step', 'numberOfSteps', 'isFirst', 'isLast'])
<div style="width: {{ (1/ $numberOfSteps) * 100 }}% ">
    <div class="relative mb-2">
        @if ($isFirst === false)
        <div class="align-center absolute flex content-center items-center align-middle"
        style="width: calc(100% - 2.5rem - 1rem)p; top: 50%; transform: translate(-50%, -50%)">
        <div class="align-center w-full flex-1 items-center rounded bg-gray-200 align-middle">
        <div class="w-0 rounded bg-green-300 py-1"
            @if ($step->isPrevious() || $step->iscurrent()) style="width:100%"
            @else
            style="width: 0%" @endif>
        </div>
        </div>
        </div>
        @endif

        <div
            class="{{$step->isPrevious() || $step->iscurrent() ? 'bg-green-500':'bg-white border-2 border-gray-200'}} mx-auto flex h-10 w-10 items-center rounded-full text-lg text-white">
            <x-icon name="{{$step->info['icon']}}" width="24" height="24"
                class="{{$step->isPrevious() || $step->iscurrent() ? 'text-white' : 'text-gray-600'}} w-full text-center"/>
        </div>
    </div>
    <div class="text-center text-xs md:test-base">{{$step->label}} </div>
</div>
