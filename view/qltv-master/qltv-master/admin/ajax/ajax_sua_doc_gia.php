<?php 
	session_start();
	include_once("ajax_config.php");
	function tv_sua_doc_gia($mail, $tt, $ma, $id){
		if (empty($mail)) {
			echo "<script type=\"text/javascript\">khongthanhcong(\"<strong>Chưa lưu</strong> địa chỉ mail không để trống!\")</script>";
			exit();
		}
		// kiem tra ngay sinh
		$ketnoi = new clsKetnoi();
		$conn = $ketnoi->ketnoi();
		$hoi = "
				UPDATE `docgia` 
				SET 
					`MaDG` = '$ma',
					`Mail`='$mail',
					`TrangThai`='$tt' 
				WHERE
					`Id` = '$id'
		";
		if(mysqli_query($conn, $hoi)===TRUE)
			return true;
		else
			return false;
	}
	if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
		if(!qltv_login_tt($_SESSION['username'],$_SESSION['password'])){
			header("Location: ../login.php");
		}
		else{
			if (tv_sua_doc_gia($_POST['mail'],$_POST['tt'],$_POST['ma'],$_POST['id'])) {
				echo "<script type=\"text/javascript\">dongsua();thanhcong(\"<strong>Đã lưu</strong> thông tin độc giả!\");tailai();</script>";
				exit();
			}
			else{
				echo "<script type=\"text/javascript\">khongthanhcong(\"<strong>Chưa lưu</strong> có lỗi trong quá trình lưu!\")</script>";
				exit();
			}
		}
	}
	else{
		echo "<script type=\"text/javascript\">trangdangnhap()</script>";
		exit();
	}
 ?>