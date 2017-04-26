    	
                </div>
                <!-- END Page Content -->
                <?php if ($_layoutParams['item'] == 'login'): ?>


                <?php else: ?>
                    <!-- Footer -->
                    <footer class="clearfix">
                        <div class="pull-right">
                            Desarrollado por <a href="<?php echo APP_COMPANY_URL; ?>" target="_blank"><?php echo APP_COMPANY; ?></a>
                        </div>
                        <div class="pull-left">
                            <span id="year-copy"></span> &copy; <a href="<?php echo APP_COMPANY_URL; ?>" target="_blank">SITE 0.8</a>
                        </div>
                    </footer>
                    <!-- END Footer -->
                <?php endif ?>
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </div>
    <!-- END Page Wrapper -->

    

        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!--<script>!window.jQuery && document.write(decodeURI('%3Cscript src="<?php echo $_layoutParams['ruta_js']; ?>vendor/jquery-1.11.2.min.js"%3E%3C/script%3E'));</script>-->
        <script src="<?php echo $_layoutParams['ruta_js']; ?>vendor/jquery-1.11.2.min.js"></script>

        <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
        <script src="<?php echo $_layoutParams['ruta_js']; ?>vendor/bootstrap.min.js"></script>
        <script src="<?php echo $_layoutParams['ruta_js']; ?>plugins.js"></script>
        <script src="<?php echo $_layoutParams['ruta_js']; ?>app.js"></script>

        <!-- Load and execute javascript code used only in this page -->
        <script src="<?php echo $_layoutParams['ruta_js']; ?>pages/login.js"></script>
        <script>$(function(){ Login.init(); });</script>

        <!-- JS personalizado para cada controlador -->
        <?php if(isset($_layoutParams['js']) && count($_layoutParams['js'])): ?>
            <?php for($i=0; $i < count($_layoutParams['js']); $i++): ?>
                <script src="<?php echo $_layoutParams['js'][$i] ?>" type="text/javascript"></script>
            <?php endfor; ?>
        <?php endif; ?>
        <!-- Fin JS personalizado  -->

        <script type="text/javascript">
            $(document).ready(function(){
                var getBadges = function(){
                    $.post($("#BASE_URL").val() + 'general/getBadges', function(datos){
                        $("#t_operacion").remove();
                        $("#soat").remove();
                        $("#tecnomecanica").remove();
                        $("#licencia").remove();

                        if (datos.t_operacion > 0) {
                            $("#a_t_operacion").append('<span id="t_operacion" class="badge label-danger">'+ datos.t_operacion+'</span>');
                        }
                        if (datos.soat > 0) {
                            $("#a_soat").append('<span id="soat" class="badge label-danger">'+ datos.soat+'</span>');
                        }
                        if (datos.tecnomecanica > 0) {
                            $("#a_tecnomecanica").append('<span id="tecnomecanica" class="badge label-danger">'+ datos.tecnomecanica+'</span>');
                        }
                        if (datos.licencia > 0) {
                            $("#a_conductores").append('<span id="licencia" class="badge label-danger">'+ datos.licencia+'</span>');
                            $("#a_licencia").append('<span id="licencia" class="badge label-danger">'+ datos.licencia+'</span>');
                        }
                                                
                    }, 'json');
                }
                getBadges();
                var getStats = function(){
                    $.post($("#BASE_URL").val() + 'general/getStats', function(datos){
                        
                                                
                    }, 'json');
                }
                getStats();
            });
        </script>

        
    </body>
</html>