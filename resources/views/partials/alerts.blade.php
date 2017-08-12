@if(isset($errors) || Session::get('success') || Session::get('error'))
    <section class="error">
        @if($errors->all())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                There seems to be a problem with your submission. Please fix the following errors:
                <ul>
                    @foreach($errors->all() as $message)
                        <li>{{$message}}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @if(session('status'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('status') }}
            </div>
        @endif

        @if(Session::get('success') || isset($success))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @if(isset($success))
                    {!! $success !!}
                @else
                    {!! Session::get('success') !!}
                @endif
            </div>
        @endif

        @if(Session::get('warning') || isset($warning))
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @if(isset($warning))
                    {!! $warning !!}
                @else
                    {!! Session::get('warning') !!}
                @endif
            </div>
        @endif

        @if(Session::get('error') || isset($error))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @if(is_array(Session::get('error')))
                    @foreach(Session::get('error') as $error)
                        {{$error}}
                        <br />
                    @endforeach
                @else
                    @if(isset($error))
                        {{ $error }}
                    @else
                        {!! Session::get('error') !!}
                    @endif
                @endif

            </div>
        @endif
    </section>
@endif
