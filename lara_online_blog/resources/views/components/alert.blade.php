<div {{ $attributes->merge(['class' => 'alert alert-'.$type.' '.$margin,'title'=>'','aa'=>'a']) }}>
    {{ $slot }}

    @if($isCloseAble())

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    @endif

    {{ $getDateTime() }}

</div>
