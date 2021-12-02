<script>
    $(document).ready(function() {
        animate();

        function animate() {
            $("#fondo").animate({
                backgroundPositionY: "-450"
            }, 20000);
            window.setTimeout(function() {
                animate()
            }, 500)
        };
    });
</script>
<style>

</style>
<div id="fondo" class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background-image: url(fondo.jpg);
background-repeat: repeat;">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>