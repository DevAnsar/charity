@if(count($errors) > 0)
    {{--<div class="alert alert-danger">--}}
    <div class="message-light">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif