{{--
    Blade partial: @include('partials.crop_image', ['crop' => $crop, 'class' => 'w-full h-full object-cover'])
    Variables:
        $crop   - the crop Eloquent model
        $class  - optional CSS classes for the <img> tag
        $alt    - optional alt text (defaults to $crop->name)
--}}
@php
    $imgClass    = $class ?? 'w-full h-full object-cover';
    $imgAlt      = $alt ?? ($crop->name ?? 'Crop');
    $src         = $crop->image_url;
    $fallbackSrc = "https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&q=80&w=800";
@endphp
<img
    src="{{ $src }}"
    alt="{{ $imgAlt }}"
    class="{{ $imgClass }}"
    onerror="this.onerror=null;this.src='{{ $fallbackSrc }}';"
    loading="lazy"
>
