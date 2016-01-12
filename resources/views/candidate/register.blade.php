@extends('layouts.plane')
@section('body')
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
     <div class="row">
      {!! Form::open(array('route' => 'candidate.register', 'class'=>'col s12', 'id'=>'register_form')) !!}

        <div class="input-field col m6">
          {!! Form::text('first_name', '', ['class'=>'validate', 'required']) !!}
          <label for="first_name">First Name</label>
        </div>        
        <div class="input-field col m6">
          {!! Form::text('last_name', '', ['autocomplete'=>'off', 'class'=>'validate', 'required']) !!}
          <label for="last_name">Last Name</label>
        </div>
        <div class="input-field col m6">
          {!! Form::password('password', ['autocomplete'=>'off', 'class'=>'validate', 'required']) !!}
          <label for="password">Password</label>
        </div>
        <div class="input-field col m6">
          {!! Form::password('password_confirmation', ['autocomplete'=>'off', 'class'=>'validate', 'required']) !!}
          <label for="password_confirmation">Confirm Password</label>
        </div>
        <div class="input-field col m6">
          {!! Form::number('mobile_no', '', ['autocomplete'=>'off', 'class'=>'validate', 'required', 'maxlength'=>'10','data-msg'=>"specify your's POSTAL CODE/ PIN NO ",'data-rule-digits'=> 'true', 'data-rule-minlength'=> '10','data-msg-minlength'=>'Mobile No must be 10 digits','data-msg-maxlength'=>'Mobile NO can not be more than 10 digits']) !!}
                      
          <label for="mobile_no">Mobile No</label>
        </div>
        <div class="input-field col m6">
          {!! Form::email('email', '', ['autocomplete'=>'off', 'class'=>'validate', 'required']) !!}
          <label for="email"> Email Address </label>
        </div>
        <div class="input-field col m6">
            <a class="btn waves-effect waves-light blue" href="{{ route('candidate.login') }}"><i class="fa fa-mail-reply"></i>&nbsp; Already Registered </a>
        </div>
        <div class="input-field col m6">
        <button class="btn waves-effect waves-light blue" style="float: right;" type="submit" name="action">Register
            <i class="material-icons right"> send </i>
        </button>
        
        </div>
        </form>
      </div>
  </div>
</div>  
@stop

@section('page_script')

$("#register_form").validate({
      rules: { mobile_no: { required: true, digits: true, minlength: 10 }}
});

@stop