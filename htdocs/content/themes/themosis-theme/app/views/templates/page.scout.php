@include('header')
    <!--include banner here-->
    @loop

    {{ Loop::content() }}

    @endloop
    <main id="main-content">
        <?php echo $custom_content; ?>
    </main>
@include('footer')
