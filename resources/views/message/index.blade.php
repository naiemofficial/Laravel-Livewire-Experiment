@php
    $template = session()->get('template');
    $messages = $template ? session()->get($template) : [];
@endphp



@foreach($messages as $index => $data)
    @include("message." . $data['key'], [
        'message' => $data['message'],
        'delay' => $index * 300 // Add a delay for each subsequent message
    ])
@endforeach
