<?php

function connect(){
	$connection = mysqli_connect('localhost','root','','pagination_db');

	if(!$connection){
		die("Failed To Connect db");
	}

	return $connection;

}

function get_row_count(){
	$connection = connect();
	$sql = "SELECT COUNT(*) AS rows FROM data";
	$result = mysqli_query($connection,$sql);
	if(mysqli_num_rows($result)){
		$row = mysqli_fetch_assoc($result);
		return $row['rows'];
	}
}

function display_content($offset, $total){
	$connection = connect();
	$sql = "SELECT title FROM data LIMIT $offset, $total";
	$result = mysqli_query($connection, $sql);


	if(mysqli_num_rows($result)){
		$html = '';
		$html .= '<div class="content">';
		while($row = mysqli_fetch_assoc($result)){
			$html .= '<p>'.$row['title'].'</p>';
		}
		$html .= '</div>';
		echo $html;
	}else{
		echo "<p>No data exist in database</p>";
	}
}

function pagination(){
	
	$pagination_buttons = 11;
	$page_number = (isset($_GET['page']) AND !empty($_GET['page']))? $_GET['page']:1;

	$per_page_records = 10;
	$rows = get_row_count();

	$last_page = ceil($rows/$per_page_records);
	$pagination = '';
	$pagination .= '<nav aria-label="Page navigation example">';
	$pagination .= 	  '<ul class="pagination">';

	

	if($page_number < 1){
		$page_number = 1;
	}else if($page_number > $last_page){
		$page_number = $last_page;
	}

	echo "Showing Page: ".$page_number." / ".$last_page;
	echo "<hr>";

	display_content(($page_number-1), $per_page_records);
	$half = floor($pagination_buttons/2);
// echo "<br>";
// echo $page_number;
	if($page_number < $pagination_buttons AND ($last_page == $pagination_buttons OR $last_page > $pagination_buttons)){
		for($i=1; $i<=$pagination_buttons; $i++){
			if($i == $page_number){
				$pagination .= '<li class="page-item active"><a class="page-link" href="index.php?page='.$i.'">'.$page_number.'</a></li>';
			}else{
				$pagination .= '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
			}
		}
		if($last_page > $pagination_buttons){
			$pagination .= '<li class="page-item"><a class="page-link" href="index.php?page='.($pagination_buttons+1).'">Next</a></li>';
		}
	}else if($page_number >= $pagination_buttons AND $last_page > $pagination_buttons){
		
		if(($page_number+$half) >= $last_page){

			$pagination .= '<li class="page-item"><a class="page-link" href="index.php?page='.($last_page - $pagination_buttons).'">Prev</a></li>';
			for($i=($last_page-$pagination_buttons)+1; $i<=$last_page; $i++){
				if($i == $page_number){
					$pagination .= '<li class="page-item active"><a class="page-link" href="index.php?page='.$i.'">'.$page_number.'</a></li>';
				}else{
					$pagination .= '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
				}
			}
		}else if(($page_number+$half) < $last_page){
			 $pagination .= '<li class="page-item"><a class="page-link" href="index.php?page='.($page_number - $half-1).'">Prev</a></li>';

			for($i=($page_number-$half); $i<=($page_number+$half); $i++){
				if($i == $page_number){
					$pagination .= '<li class="page-item active"><a class="page-link" href="index.php?page='.$i.'">'.$page_number.'</a></li>';
				}else{
					$pagination .= '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
				}
			}
				$pagination .= '<li class="page-item"><a class="page-link" href="index.php?page='.($page_number + $half+1).'">Next</a></li>';					 
		}


	}



	$pagination .= '</nav></ul>';
	echo $pagination;
}

// 	for($i=1; $i=100; $i++){
// $connection = mysqli_connect('localhost','root','','pagination_db');
// 		$sql = "INSERT INTO data (title)VALUES ('This is paragragh 2')";
// if ($connection->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $connection->error;
// }

// $connection->close();
// }