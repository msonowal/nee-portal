@extends ('admin.layouts.plane')
@section ('body')
<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <br /><br /><br /><br /><br /><br />
               @section ('login_panel_title','NEE Admin Login Panel')
               @section ('login_panel_body')

               		@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

                        <form role="form" method="POST" action="login">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="form-group">
                                	<button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                                </div>
                            </fieldset>
                        </form>
                    
                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            </div>
        </div>
    </div>
@stop