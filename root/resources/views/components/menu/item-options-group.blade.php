@props(['group'])
<div class="py-2">
    <h2 class="font-bold text-2xl">{{ $group }}</h2>
    <div>
        {{$slot}}
    </div>
</div>