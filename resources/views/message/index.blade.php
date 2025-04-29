@php
    $totalMessages = 0; // Initialize message counter
@endphp

@foreach(session()->all() as $key => $message)
    @if(in_array($key, ['success', 'error', 'info', 'warning']))
        @if(is_string($message))
            @php $totalMessages++; @endphp
            @include("message.$key", [
                'message' => $message,
                'animationDelay' => $totalMessages * 500 // Delay based on message count
            ])
        @elseif(is_array($message))
            @foreach($message as $index => $msg)
                @php $totalMessages++; @endphp
                @include("message.$key", [
                    'message' => $msg,
                    'animationDelay' => $totalMessages * 500 // Delay based on message count
                ])
            @endforeach
        @endif
    @endif
@endforeach

{{-- Trigger an animation based on total messages --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let totalMessages = {{ $totalMessages }};
        if (totalMessages > 0) {
            console.log(`Total messages: ${totalMessages}`);
            // Add animation logic here, e.g.:
            for (let i = 1; i <= totalMessages; i++) {
                setTimeout(() => {
                    console.log(`Animating message ${i}`);
                    // Add specific animation logic, e.g., using a library like GSAP
                }, i * 500); // Trigger animations with a delay
            }
        }
    });
</script>
