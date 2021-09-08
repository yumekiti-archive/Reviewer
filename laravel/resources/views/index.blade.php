@foreach ($threads as $thread)
    <p>{{ $thread }}</p>
@endforeach

<hr>

<pre>
@php
    var_dump($threads);
@endphp
</pre>