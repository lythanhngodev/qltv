<?php 
	include_once("admin/config/config.php");
	function tv_get_loai_sach(){
		$ketnoi = new clsKetnoi();
		$conn = $ketnoi->ketnoi();
		$query = "SELECT * FROM `loaisach`";
		$result = mysqli_query($conn, $query);
		return $result;
	}
	function tv_get_khoa(){
		$ketnoi = new clsKetnoi();
		$conn = $ketnoi->ketnoi();
		$query = "SELECT * FROM `khoa`";
		$result = mysqli_query($conn, $query);
		return $result;
	}
 ?>