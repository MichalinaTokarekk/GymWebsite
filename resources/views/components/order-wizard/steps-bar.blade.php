@props(['steps'])
<div class="w-full py-6">
    <div class="flex">
        @foreach ($steps as $step)
    <x-order-wizard.step :step="$step" :numberOfSteps="count($steps)" :isFirst="$loop->first" :isLast="$loop->last" />
        
    @endforeach
    </div>
</div>