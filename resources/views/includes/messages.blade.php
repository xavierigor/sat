{{-- @if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class='alert alert-danger'><i class="fas fa-exclamation-circle mr-2 fa-lg"></i>
            {{$error}}
        </div>
    @endforeach
@endif --}}

@if(session('success'))
    <div class='rounded-0 alert alert-success'>
        <i class="fas fa-check-circle mr-1 fa-fw fa-lg"></i>
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class='rounded-0 alert alert-danger'>
        <i class="fas fa-exclamation-circle mr-1 fa-fw fa-lg"></i>
        {{session('error')}}
    </div>
@endif