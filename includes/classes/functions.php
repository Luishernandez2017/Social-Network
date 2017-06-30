<?php

function dateAdded($date_time){

				  //Time Frame
				  $date_time_now = date("Y-m-d, H:i:s");

				  $start_date = new DateTime($date_time);//Time post was added
				  $end_date = new DateTime($date_time_now);//current time

				  $interval = $start_date->diff($end_date);//Difference between dates
					$years  = $interval->y;
					$months = $interval->m;
					$days   = $interval->d;
					$hours  = $interval->h;
					$mins   = $interval->i;
					$secs   = $interval->s;

				/********************** YEARs **************************/
				  if($years >= 1){ //if its greater than 1 year

					  if($years == 1){//if it is 1 year
						  $time_message = $years. "year ago";//1 year ago

					  }else{

							$time_message = $years. "years ago";//1+ years ago
						  }
					  /********************** Months **************************/

					  }elseif($months >= 1){// 1+ months
						if($days == 0){// 0 days
								  $days = " ago"; //1 month ago

					/********************** DEFINE DAYS **************************/

					  }elseif($days == 1){
							  $days = $days." day ago"; //1 day ago
						  }else{
							  $days = $days." days ago"; //1+ days ago

						  }

					/******************* MONTH(S) + DAY(S) ************************/
						  if($months ==1){//exactly 1 month
							  $time_message = $months. " month".$days;//1 month + days
						  }else{
							  $time_message = $months. " months".$days;//1+ months + days
						  }

					 /******************* DAY(S) ************************/

					  }elseif($days >= 1){

						  if($days == 1){
							  $time_message = "Yesterday";
						  }else{
							  $time_message = $days." days ago";
						  }
					 /******************* HOUR(S) ************************/

					}elseif($hours >= 1){
					  if($hours ==1){
						  $time_message = $hours. " hour ago";
					  }else{
						  $time_message = $hours. " hours ago";
					  }
				 /*******************MINUTE(S) ************************/
				  }elseif($mins >= 1){
					  if($mins == 1){
						  $time_message = $mins. " minute ago";
					  }else{
						  $time_message = $mins. " minutes ago";
					  }
				/******************* SECONDS OR NOW	 ************************/  
				  }else{
					  if($secs < 30){
						  $time_message = " Now";
					  }else{
						  $time_message = $secs. " seconds ago";

					  }

				  }//end of if Time Block
				  //Time Frame
				  $date_time_now = date("Y-m-d, H:i:s");

				  $start_date = new DateTime($date_time);//Time post was added
				  $end_date = new DateTime($date_time_now);//current time

				  $interval = $start_date->diff($end_date);//Difference between dates
					$years  = $interval->y;
					$months = $interval->m;
					$days   = $interval->d;
					$hours  = $interval->h;
					$mins   = $interval->i;
					$secs   = $interval->s;

				/********************** YEARs **************************/
				  if($years >= 1){ //if its greater than 1 year

					  if($years == 1){//if it is 1 year
						  $time_message = $years. "year ago";//1 year ago

					  }else{

							$time_message = $years. "years ago";//1+ years ago
						  }
					  /********************** Months **************************/

					  }elseif($months >= 1){// 1+ months
						if($days == 0){// 0 days
								  $days = " ago"; //1 month ago

					/********************** DEFINE DAYS **************************/

					  }elseif($days == 1){
							  $days = $days." day ago"; //1 day ago
						  }else{
							  $days = $days." days ago"; //1+ days ago

						  }

					/******************* MONTH(S) + DAY(S) ************************/
						  if($months ==1){//exactly 1 month
							  $time_message = $months. " month".$days;//1 month + days
						  }else{
							  $time_message = $months. " months".$days;//1+ months + days
						  }

					 /******************* DAY(S) ************************/

					  }elseif($days >= 1){

						  if($days == 1){
							  $time_message = "Yesterday";
						  }else{
							  $time_message = $days." days ago";
						  }
					 /******************* HOUR(S) ************************/

					}elseif($hours >= 1){
					  if($hours ==1){
						  $time_message = $hours. " hour ago";
					  }else{
						  $time_message = $hours. " hours ago";
					  }
				 /*******************MINUTE(S) ************************/
				  }elseif($mins >= 1){
					  if($mins == 1){
						  $time_message = $mins. " minute ago";
					  }else{
						  $time_message = $mins. " minutes ago";
					  }
				/******************* SECONDS OR NOW	 ************************/  
				  }else{
					  if($secs < 30){
						  $time_message = " Now";
					  }else{
						  $time_message = $secs. " seconds ago";

					  }

				  }//end of if Time Block

                  return $time_message;

}

?>