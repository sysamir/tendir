var elixir = require('laravel-elixir');
require('laravel-elixir-remove');


elixir(function (mix) {
    /* Admin Section */
    mix.styles([
        '../vendor/bootstrap/dist/css/bootstrap.min.css',
        /** Font Awesome **/
        '../vendor/font-awesome/css/font-awesome.min.css',
        /** iCheck **/
        '../vendor/iCheck/skins/flat/green.css',
        /** bootstrap-file-upload **/
        '../vendor/jasny-bootstrap/dist/css/jasny-bootstrap.min.css',
        /** bootstrap-progressbar **/
        '../vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
        /** Sweet Alert **/
        '../vendor/sweetalert/dist/sweetalert.css',
        /** PNotify **/
        '../vendor/pnotify/dist/pnotify.css',
        '../vendor/pnotify/dist/pnotify.buttons.css',
        '../vendor/starrr/dist/starrr.css',

        /** Datatables */
        '../vendor/datatables.net-bs/css/dataTables.bootstrap.min.css',
        '../vendor/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
        '../vendor/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css',
        '../vendor/datatables.net-responsive-bs/css/responsive.bootstrap.min.css',
        '../vendor/datatables.net-scroller-bs/css/scroller.bootstrap.min.css',
        '../vendor/bootstrap-daterangepicker/daterangepicker.css',
        'admin/theme.css',
        'admin/custom.css'

    ], 'public/admin/style.css');


    mix.scripts(
        [
            /*===  jQuery  ===  */
            '../vendor/jquery/dist/jquery.min.js',
            /*===  Bootstrap  ===  */
            '../vendor/bootstrap/dist/js/bootstrap.min.js',
            /*===  FastClick  ===  */
            '../vendor/fastclick/lib/fastclick.js',
            /*===  NProgress  ===  */
            '../vendor/nprogress/nprogress.js',
            /** Sweet Alert **/
            '../vendor/sweetalert/dist/sweetalert.min.js',
            /*===  bootstrap-progressbar  ===  */
            '../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js',
            /*===  bootstrap-file-upload  ===  */
            '../vendor/jasny-bootstrap/js/fileinput.js',
            /*===  bootstrap-inputmask  ===  */
            '../vendor/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js',
            /*===  iCheck  ===  */
            '../vendor/iCheck/icheck.min.js',

            /*===  Datatables  ===  */
            '../vendor/datatables.net/js/jquery.dataTables.min.js',
            '../vendor/datatables.net-bs/js/dataTables.bootstrap.min.js',
            '../vendor/datatables.net-buttons/js/dataTables.buttons.min.js',
            '../vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
            '../vendor/datatables.net-buttons/js/buttons.flash.min.js',
            '../vendor/datatables.net-buttons/js/buttons.html5.min.js',
            '../vendor/datatables.net-buttons/js/buttons.print.min.js',
            '../vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js',
            '../vendor/datatables.net-keytable/js/dataTables.keyTable.min.js',
            '../vendor/datatables.net-responsive/js/dataTables.responsive.min.js',
            '../vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js',
            '../vendor/datatables.net-scroller/js/datatables.scroller.min.js',
            '../vendor/jszip/dist/jszip.min.js',
            '../vendor/pdfmake/build/pdfmake.min.js',
            '../vendor/pdfmake/build/vfs_fonts.js',

            /*===  PNotify  ===  */
            '../vendor/pnotify/dist/pnotify.js',
            '../vendor/pnotify/dist/pnotify.buttons.js',
            '../vendor/pnotify/dist/pnotify.nonblock.js',
            '../vendor/starrr/dist/starrr.js',
            '../vendor/moment/moment.js',
            '../vendor/bootstrap-daterangepicker/daterangepicker.js',

            /*'admin/maps/locationpicker.jquery.min.js',*/
            'admin/custom.js'
        ], 'public/admin/script.js'
    );

    mix.styles([
        'front/pricing.css',
        'front/form.css'

    ], 'public/front/style.css');

    mix.scripts(
        [
            'front/custom.js'
        ], 'public/front/script.js'
    );

    /* Make new version for new changes */
    mix.version(['public/admin/style.css', 'public/admin/script.js', 'public/front/style.css', 'public/front/script.js']);

    /* Copy essential files to min folder  */
    mix.copy('resources/assets/vendor/bootstrap/fonts', 'public/build/fonts');
    mix.copy('resources/assets/vendor/bootstrap-fileinput/img', 'public/build/img');
    mix.copy('resources/assets/vendor/font-awesome/fonts', 'public/build/fonts');
    mix.copy('resources/assets/vendor/iCheck/skins/flat/green.png', 'public/build/admin');
    mix.copy('resources/assets/vendor/iCheck/skins/flat/green@2x.png', 'public/build/admin');

    mix.remove('public/admin');
    mix.remove('public/front');
    /* End Admin Section */

});
