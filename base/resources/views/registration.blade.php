<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title></title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/set1.css">

  <!--Google Fonts-->
  <link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

</head>

<body>
<div id="main-wrapper">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 left-side">
        <header>
          <span>Need an account?</span>
          <h3>Create your transfer<br>account here.</h3>
        </header>
      </div>
      <div class="col-md-6 right-side">
        {!! Html::ul($errors->all()) !!}
        {!! Form::open(array('url' => 'registration')) !!}
        <span class="input input--hoshi">
          {!! Form::text('name', null, array('class' => 'input__field input__field--hoshi')) !!}
          {!! Form::label('name', 'Your Name', array('class' => 'input__label input__label--hoshi input__label--hoshi-color-3')) !!}
        </span>
        <span class="input input--hoshi">
          {!! Form::text('email', null, array('class' => 'input__field input__field--hoshi')) !!}
          {!! Form::label('email', 'Your Email', array('class' => 'input__label input__label--hoshi input__label--hoshi-color-3')) !!}
        </span>
        <span class="input input--hoshi">
          {!! Form::text('title', null, array('class' => 'input__field input__field--hoshi')) !!}
          {!! Form::label('title', 'Transfer/Project Name', array('class' => 'input__label input__label--hoshi input__label--hoshi-color-3')) !!}
        </span>
        <span class="input input--hoshi">
          {!! Form::text('comment', null, array('class' => 'input__field input__field--hoshi')) !!}
          {!! Form::label('comment', 'Comment (optional)', array('class' => 'input__label input__label--hoshi input__label--hoshi-color-3')) !!}
        </span>
        <div class="cta">
          {{ Form::submit('Create account and send me an email', array('class' => 'btn btn-primary pull-left')) }}
        </div>
        {!! Form::close() !!}
        <ul class="social list-inline">
          <li><a href="#">User Manual</a></li>
          <li><a href="#">transferbox.io</a></li>
        </ul>
      </div>
    </div>
  </div>

</div> <!-- end #main-wrapper -->

<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/scripts.js"></script>
<script src="js/classie.js"></script>
<script>
  (function() {
    // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
    if (!String.prototype.trim) {
      (function() {
        // Make sure we trim BOM and NBSP
        var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
        String.prototype.trim = function() {
          return this.replace(rtrim, '');
        };
      })();
    }

    [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
      // in case the input is already filled..
      if( inputEl.value.trim() !== '' ) {
        classie.add( inputEl.parentNode, 'input--filled' );
      }

      // events:
      inputEl.addEventListener( 'focus', onInputFocus );
      inputEl.addEventListener( 'blur', onInputBlur );
    } );

    function onInputFocus( ev ) {
      classie.add( ev.target.parentNode, 'input--filled' );
    }

    function onInputBlur( ev ) {
      if( ev.target.value.trim() === '' ) {
        classie.remove( ev.target.parentNode, 'input--filled' );
      }
    }
  })();
</script>

</body>
</html>
