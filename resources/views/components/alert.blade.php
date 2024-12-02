@props(["type", "message", "timeout" => 5000])

@if(session()->has($type))
    <div class="w-[90%] mx-auto mt-5 p-4 mb-4 text-sm text-white rounded {{$type === 'success' ? 'bg-green-500' : 'bg-red-500'}}">
        {{$message}} 
    </div>
@endif

