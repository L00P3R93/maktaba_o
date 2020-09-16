<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4-->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>

<!--InputMask-->
<script src="assets/plugins/moment/moment.min.js"></script>

<!-- SweetAlert2 -->
<script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="assets/plugins/toastr/toastr.min.js"></script>
<!--Bootbox-->
<script src="assets/plugins/bootbox/bootbox.all.min.js"></script>

<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.js"></script>
<script src="assets/js/main.js"></script>

<!-- Page script -->
<script>
    $(function() {
        $("#pickup").datepicker({
            dateFormat: "yy-mm-dd"
        });
        $("#return").datepicker({
            dateFormat: "yy-mm-dd"
        });
        //Initialize Select2 Elements
        $('.select2').select2();
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        //Initialize Datatables
        $("#example1").DataTable({
            "responsive": false,
            "autoWidth": true,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        //Initial alert Toasts
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 9000
        });
        $('.test').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        //Ajax Function
        function action(actionPage, params, feedbackArea='.feedback', processingArea='.processing', processingMessage='Processing'){
            var ico = '<img src="assets/img/loader.gif" title="'+processingMessage+'" height="22px" alt="IMG_PROCESS"/>';
            console.log(params);
            $.ajax({
               method: "POST",
               url: actionPage,
               data: params,
               beforeSend: function(){
                   $(processingArea).html(ico + processingMessage);
                   $(processingArea).show();
               },
                complete: function(){$(processingArea).hide();},
                success: function(data){$(feedbackArea).html(data);},
                error: function(){$(feedbackArea).html('Oops! Something went wrong');}
            });
        }

        function validate_phone(phone){
            var toMatch = /^07\d{8}$/;
            //var test2 = /^254\d{9}$/;
            //console.log(phone);
            var auth = toMatch.test(phone);
            return auth;
        }

        function validate_email(email){
            var toMatch = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var auth = toMatch.test(email);
            return auth;
        }

        $('#phone').bind("keyup change",function (){
            var phone = $('#phone').val();
            if(validate_phone(phone)){
                $('#phone').focus();
                $('#phone').removeClass('is-invalid');
                $('#phone').addClass('is-valid');
                //$('.feed').html('valid');
            }else{
                $('#phone').focus();
                $('#phone').removeClass('is-valid');
                $('#phone').addClass('is-invalid');
                //$('.feed').html('invalid');
            }
        });
        $('#email').bind("keyup change", function (){
            var email = $('#email').val();
            if(validate_email(email)){
                $('#email').focus();
                $('#email').removeClass('is-invalid');
                $('#email').addClass('is-valid');
            }else{
                $('#email').focus();
                $('#email').removeClass('is-valid');
                $('#email').addClass('is-invalid');
            }
        });

        function validate_group($group){
            var group = $('#group :selected').val();
            if(group == ""){return false;}
            else{return true;}
        }

        $(".saveStaff").click(function(){
            var $this = $(this);
            console.log($this.val());
            var sid = $("#sid").val();
            var uid = $("#uid").val();
            var f_name = $("#f_name").val();
            var l_name = $("#l_name").val();
            var username = $("#username").val();
            var email  = $("#email").val();
            var phone = $("#phone").val();
            var id_no = $("#id_no").val();
            var group = $('#group :selected').val();
            var status = $("#stat2 :selected").val();

            if(validate_email(email) && validate_phone(phone)){
                var params = "sid="+sid+"&f_name="+f_name+"&l_name="+l_name+"&username="+username+"&email="+email+"&phone="+phone+"&id_no="+id_no+"&group="+group+"&status="+status+"&uid="+uid;
                console.log(params);
                action('components/save_staff.php',params);
            }else{}
        });

        $(".saveStudent").click(function(){
            var $this = $(this);
            console.log($this.val());
            var sid = $("#sid").val();
            var studid = $("#studid").val();
            var f_name = $("#f_name").val();
            var m_name = $("#m_name").val();
            var l_name = $("#l_name").val();
            var adm_no = $("#adm_no").val();
            var _class = $("#class :selected").val();
            var status = $("#stat1 :selected").val();

            var params = "sid="+sid+"&f_name="+f_name+"&m_name="+m_name+"&l_name="+l_name+"&adm_no="+adm_no+"&class="+_class+"&status="+status+"&studid="+studid;
            console.log(params);
            action('components/save_student.php',params);
        });

        $(".saveBook").click(function(){
            var $this = $(this)
            console.log($this.val());
            var sid = $("#sid").val();
            var bookid = $("#bookid").val();
            var title = $("#title").val();
            var author = $("#author").val();
            var isbn = $("#isbn").val();
            var books = $("#books").val();
            var publisher = $("#publisher").val();
            var category = $("#category :selected").val();
            var status = $("#stat3 :selected").val();

            var params = "sid="+sid+"&title="+title+"&author="+author+"&isbn="+isbn+"&books="+books+"&publisher="+publisher+"&category="+category+"&status="+status+"&bookid="+bookid;
            console.log(params);
            action('components/save_book.php',params);
        });

        $(".saveCategory").click(function(){
            var $this = $(this);
            console.log($this.val());
            var categoryName = $("#category_name").val();
            var categroyId = $("#category_id").val();
            if(categoryName !== ''){
                var params = "categoryName="+categoryName+"&categoryId="+categroyId;
                action('components/save_category.php',params);
            }else{toastr.error('Category Name Cannot be Empty');}
        });
        //Search Functions
        $(document).ready(function() {
            $('#student').bind("keyup click", function(e){
                e.preventDefault();
                e.stopPropagation();
                //return false;
                var value = $(this).val()
                if(value == ""){}
                else{
                    if (value.length>0) {
                        console.log(value);
                        searchData('components/search_student.php',value);
                    }
                    else {$('.results').hide();}
                }
            });

            $(".searchform").bind("keyup click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var searchVal = $(this).val();
                if(searchVal==""){}
                else{
                    if(searchVal.length>3){
                        console.log(searchVal);
                        searchData('components/search.php',searchVal);
                    }
                }
            });
        });

        $(document).click(function(){
            $('.results').hide();
        });

        $("#student").click(function (e){});

        function searchData(actionPage,val){
            $('.results').show();
            $('.results').html('<div><img src="assets/img/loader.gif" width="22px;" height="22px"> <span style="font-size: 20px;">Please Wait...</span></div>');
            $.post(actionPage, {'val': val}, function(data){
                if(data != "")
                    $('.results').html(data);
                else
                    $('.results').html("<li>No Result Found...</li>");
            }).fail(function(xhr, ajaxOptions, thrownError) {
                //any errors?
                alert(thrownError);
                //alert with HTTP error
            });
        }


    })
</script>