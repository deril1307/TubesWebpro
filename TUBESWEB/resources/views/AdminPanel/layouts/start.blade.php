<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicon -->
    <link rel="icon" 
          type="image/x-icon" 
          href="{{ !empty($logo_image->value) ? asset('/storage/siteSettings/' . $logo_image->value) : 'favicon.ico' }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $meta_discription->value ?? '' }}">

    

    <!-- Inline CSS -->
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- Global CSS -->
    @foreach (config('dz.admin.global.css') as $item)
        <link rel="stylesheet" crossorigin="anonymous" href="{{ $item }}">
    @endforeach
</head>

<body>
    <!-- Body Content -->
</body>

</html>
