<script>
    $(document).ready(function() {
        function anim() {
            $('#fondo').css({
                backgroundPositionY: 600
            });
            $("#fondo").animate({
                backgroundPositionY: "-600"
            }, 40000, 'linear', function() {
                anim();
            });
        };

        anim();
    });
</script>

<div id="fondo" class="icon min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background-image: url(fondo.jpg);
background-repeat: repeat;">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>