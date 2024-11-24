<div class="flex items-center gap-2">

    <img src="{{ $getRecord()->getRaceImageUrl($getRecord()) }}" class="w-6 h-6 rounded-full">
    <img src="{{ $getRecord()->getClassImageUrl($getRecord()) }}" class="w-6 h-6 rounded-full">
    <img src="{{ $getRecord()->getSpecImageUrl($getRecord()) }}" class="w-6 h-6 rounded-full">
  
        <span class="text-sm text-wow-hunter">{{ $getRecord()->level }}</span>
        <span class="text-sm text-wow-{{ $getRecord()->class }}">{{ $getRecord()->name }}</span>
 
</div>