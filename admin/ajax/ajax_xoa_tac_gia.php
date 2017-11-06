<?php 
	session_start();
	include_once("ajax_config.php");
	function qltv_xoa_tg($ma){
		$ketnoi = new clsKetnoi();
		$conn = $ketnoi->ketnoi();
		if (qltv_kiem_tra_ton_tai("SELECT tg.MaTG FROM sach s, tacgia tg WHERE s.MaTG = tg.MaTG AND tg.MaTG = '$ma'")) {
			echo "<script type=\"text/javascript\">khongthanhcong(\"<strong>Chưa xóa</strong> không thể xóa tác giả. Hiện còn sách của tác giả trong thư viện!\")</script>";
			exit();
		}
		$hoi = "
				DELETE FROM `tacgia` WHERE `MaTG` = '$ma'
		";
		// Kiểm tra xem có tồn tại trong bảng sách hay chưa, nếu chưa tồn tại thì không thể xóa
		$kiemtra = "Select count(MaTG) as so from sach where MaTG = '$ma'";
		$kiemtra_ec = mysqli_query($conn, $kiemtra);
		$dem_kiemtra = mysqli_num_rows($kiemtra_ec);
		if ($dem_kiemtra > 0){
			$mang_kiemtra = mysqli_fetch_array($kiemtra_ec);
			if($mang_kiemtra[0] > 0){
				echo "Bạn không thể xóa tác giả này\nĐang có $mang_kiemtra[0] quyển sách thuộc tác giả này trong thư viện!";
				exit();
			}
		}
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
			if (qltv_xoa_tg($_POST['ma'])) {
				echo "<script type=\"text/javascript\">tailai();thanhcong(\"<strong>Đã xóa</strong> tác giả!\")</script>";
				exit();
			}
			else{
				echo "<script type=\"text/javascript\">khongthanhcong(\"<strong>Chưa xóa</strong> có lỗi trong quá trình xóa!\")</script>";
				exit();
			}
		}
	}
	else
		header("Location: ../login.php");
 ?>