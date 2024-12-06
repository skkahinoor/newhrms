<script src="{{ asset('assets/recruitment/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/recruitment/js/vendor/bootstrap.min.js') }}"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
    <script src="{{ asset('assets/recruitment/js/easing.min.js') }}"></script>
    <script src="{{ asset('assets/recruitment/js/hoverIntent.js') }}"></script>
    <script src="{{ asset('assets/recruitment/js/superfish.min.js') }}"></script>
    <script src="{{ asset('assets/recruitment/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/recruitment/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/recruitment/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/recruitment/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('assets/recruitment/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/recruitment/js/parallax.min.js') }}"></script>
    <script src="{{ asset('assets/recruitment/js/mail-script.js') }}"></script>
    <script src="{{ asset('assets/recruitment/js/main.js') }}"></script>
    <script>
        var direction_i = 0,
            $window = $(window);

        $(document).scroll(function() {
            hr_scroll();
        });

        hr_scroll();

        function hr_scroll() {
            var scroll_top = $window.scrollTop(),
                direction = (scroll_top > direction_i) ? 'up' : 'down',
                direction_i = scroll_top;

            $('hr').each(function() {
                var $this = $(this),
                    from_top = $this.offset().top - scroll_top - 100,
                    is_activated = $this.hasClass('activated');

                if (from_top < 300 && from_top > 0) {
                    if (is_activated) {
                        $this.removeClass('activated');
                    }
                    $this.css('width', (100 - (from_top / 300) * 100) + '%');
                }


            });
        }
    </script>