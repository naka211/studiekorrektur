<!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

    <script>
        $('#myCarousel').carousel({
            interval: 4000
        });
    </script>

<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            if($(this).attr("value")=="en"){
                $(".en").hide();
                $(".dk").show();
            }
            if($(this).attr("value")=="dk"){
                $(".dk").hide();
                $(".en").show();
            }
        });

        $('.btnChoose').click(function(){
            var $this = $(this);
            $this.toggleClass('Valgt');
            if($this.hasClass('Valgt')){
                $this.text('Vælg');
                $this.addClass('b2ecc71');
            } else {
                $this.text('Valgt');
                $this.addClass('bfff');
            }
        });


    });
</script>