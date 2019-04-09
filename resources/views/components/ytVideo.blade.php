<?php

$queryString = '?enablejsapi=1&origin=' . url("/") . '&rel=0&showinfo=0&playsinline=1';

if (isset($showControls) && $showControls === false) {
    $queryString .= '&controls=0';
}

?>

<iframe
    id="video"
    class="video"
    width="{{ $width }}"
    height="{{ $height }}"
    src="https://www.youtube-nocookie.com/embed/{{ $videoId }}{{ $queryString}}"
    frameborder="0"
    allowfullscreen>
</iframe>
