@if( isset( $success ) )
    <div class="alert alert-success">
        <p>{{ $success }}</p>
    </div>
    
@elseif( Session::has('success') )
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    
@elseif( count($errors) > 0 )
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    
@elseif( isset( $error ) )
    <div class="alert alert-danger">
        <p>{{ $error }}</p>
    </div>
    
@elseif( Session::has('message') )
    <div class="alert {{ Session::get('message')['type'] }}">
        <p>{{ Session::get('message')['text'] }}</p>
    </div>
@endif