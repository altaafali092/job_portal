<!DOCTYPE html>
<html class="no-js" lang="en_AU" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>CareerVibe | Find Best Jobs</title>
    <meta name="description" content="" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/asset/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/asset/css/style2.css') }}" />

    <!--texteditor--> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css" integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="#" />
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
</head>

<body data-instant-intensity="mousedown">
   @include('frontend.layouts.header')
   
@yield('content')
   @include('frontend.layouts.footer')
    <script src="{{ asset('assets/frontend/asset/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/asset/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/asset/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/asset/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/asset/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/asset/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/asset/js/custom.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js" integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.textarea').trumbowyg();
    </script>
    <script>
        setTimeout(function() {
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }, 2000); // 2000 milliseconds = 2 seconds
    </script>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>

   tinymce.init({

     selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE

     plugins: 'powerpaste advcode table lists checklist',

     toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'

   });

</script>

</body>
</html>
