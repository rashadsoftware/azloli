            </div>
            <!-- /.content-wrapper -->
            
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 1.1.0
                </div>
                <strong>Copyright &copy; 2020-<script>document.write(new Date().getFullYear());</script> </strong>| Bütün hüquqlar müəllif tərəfindən qorunur.
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{asset('back/')}}/plugins/jquery/jquery.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
        <script src="{{asset('back/')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('back/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Laravel toastr This code is download from "https://github.com/yoeunes/toastr" -->
        @toastr_js
        @toastr_render
		<!-- Summernote -->
        <script src="{{asset('back/')}}/plugins/summernote/summernote-bs4.min.js"></script>
		
        <!-- AdminLTE App -->
        <script src="{{asset('back/')}}/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('back/')}}/js/demo.js"></script>
        @yield('js')
    </body>
</html>