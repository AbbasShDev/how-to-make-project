
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Uppy</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app-rtl.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom_app_style.css') }}" rel="stylesheet">

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />

    <link href="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.css" rel="stylesheet">
</head>
<body>

<button class="btn btn-info">Click me</button>
<img class="preview" src="" alt="preview">

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.js"></script>
<script>

    $(document).ready(function (){
        var uppy = Uppy.Core()
            .use(Uppy.Dashboard)
            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy.on('complete', (result) => {
            $('.preview').attr('src', result.successful[0].preview)
            console.log(result.successful[0].preview)
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        })

        $('.btn').on('click', function (){

            uppy.getPlugin('Dashboard').openModal()
        })

        const AwsS3 = Uppy.AwsS3

        uppy.use(AwsS3, {
            companionUrl: 'https://uppy-companion.my-app.com/'
        })


        // setTimeout(() => {
        //     uppy.getPlugin('Dashboard').closeModal()
        // }, 5000)
    })



</script>
</body>
</html>
