<!-- <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul>
                            <li>
                                <a href="http://www.linakaloda.com">
                                    Lina Kaloda
                                </a>
                            </li>
                            <li>
                                <a href="http://www.linakaloda.com/%d9%86%d8%a8%d8%b0%d9%87-%d8%b9%d9%86%d9%8a/">
                                    من أنا؟
                                </a>
                            </li>
                            <li>
                                <a href="http://www.linakaloda.com/%d8%a7%d8%aa%d8%b5%d9%84-%d8%a8%d9%8a/">
                                    اتصل بي
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, صنع بكل
                        <i class="now-ui-icons ui-2_favourite-28"></i> من 
                        <a href="http://www.linakaloda.com" target="_blank">لينة كلودة</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<!--<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for LK UI Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/now-ui-dashboard.js?v=1.0.1"></script>
<!-- LK UI Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/demo/demo.js"></script>
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
	
	$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#dynamic').append('<tr id="row'+i+'"><td><input type="text" id="value" name="values[]" ></td><td><button  id="'+i+'" name="remove" value="remove" class="btn_remove btn-info btn">حذف</button></td> </tr>');
	});
	$(document).on('click',".btn_remove",function(){
		var button_id=$(this).attr("id");
		$("#row"+button_id+"").remove();
	});
	$('#send').click(function(){
		$.ajax({
			url:"properties_pro.php",
			method:"POST",
			data:$('#add_name').serialize(),
			success:function(data)
			{
				//alert(data);
				//$('#add_name')[0].reset();
				
			}
		});
	});
});


</script>

</html>