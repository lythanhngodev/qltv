<?php 
	session_start();
	include_once("ajax_config.php");
	function qltv_xoa_sach($ma){

		$ketnoi = new clsKetnoi();
		$conn = $ketnoi->ketnoi();
		if (qltv_kiem_tra_ton_tai("SELECT MaL FROM lop l, khoa k WHERE l.MaK = k.MaK AND k.MaK = '$ma'")) {
			echo "<script type=\"text/javascript\">khongthanhcong(\"<strong>Chưa xóa</strong> không thể xóa khoa khi khi còn chứa các lớp!\")</script>";
			exit();
		}
		$hoi = "
				UPDATE `sach` SET `XoaSach`= '1' WHERE `MaS`= '$ma'
		";
		if(mysqli_query($conn, $hoi)===TRUE)
			return true;
		else
			return false;
	}
	if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
		if(!qltv_login($_SESSION['username'],$_SESSION['password'])){
			header("Location: ../login.php");
		}
		else{
			if (qltv_xoa_sach($_POST['ma'])) {
				echo "Sách đã được xóa!";
			}
			else{
				echo "Có lỗi trong quá trình xóa!";
			}
		}
	}
	else
		header("Location: ../login.php");
 ?>