<?php 
	session_start();
	include_once("ajax_config.php");
	function vlu_sua_ls($loaiold, $ten){
		$ketnoi = new clsKetnoi();
		$conn = $ketnoi->ketnoi();
		$hoi = "
				UPDATE `loaisach` 
				SET 
					`TenLS`='$ten'
				WHERE 
					`MaLS` = '$loaiold'
		";
		if(mysqli_query($conn, $hoi)===TRUE)
			return true;
		else
			return false;
	}
	if (isset($_SESSION['username']) && isset($_SESSION['password'])){
		if(!qltv_login($_SESSION['username'],$_SESSION['password'])){
			header("Location: ../login.php");
		}
		else{
			if (vlu_sua_ls($_POST['loaiold'],$_POST['ten'])){
				echo "Loại sách đã được sửa!";
			}
			else{
				echo "Có lỗi trong quá trình sửa!";
			}
		}
	}
	else
		header("Location: ../login.php");
 ?>