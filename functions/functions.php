<?php

//-----------------------------------------------------------------
class herf 
{   
	private $dsn;
	private $user;
	private $pass;
	private $con;
	//$DBname;
	private $state;
	
    public function __construct($dsn,$user,$pass)
		{   
			$this->dsn=$dsn;
			$this->user=$user;
			$this->pass=$pass;
			//$this->DBname=$DBname;  
		} 
	public function connect_to_db()
		{
			$opts=array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8");
			try
			{
				
				$this->con=new PDO($this->dsn,$this->user,$this->pass,$opts);
				$this->state="connect";
				
			}
			catch(PDOEXCEPTION $ex)
			{
				$state="not connect";
				//exit($ex->getmessage());
			}
			return $this->state==="connect";
		}
// ------------ login  --------------------------------	
	public function logins($email,$pass) 
		{
			if($this->connect_to_db())
			{
				$sql="select *  from users where email=:email and activation=1";
				$q=$this->con->prepare($sql);
				$q->execute(array("email"=>$email));
				$rows=$q->fetchall();
					if($q->rowcount()>0)
					{  
						foreach($rows as $row)
						{
							if(password_verify($pass,$row['password']))
							{
								//var_dump($row);
								if($row['role']=='2')
								{//var_dump($row);
									$id=$row['id'];
									$sqln="Select id from users where role=1";
									$qn=$this->con->prepare($sqln);
									$qn->execute(array("id"=>$id));
									$rowsn=$qn->fetchall();
									if($qn->rowcount()>0)
									{
										foreach($rowsn as $rown)
										{
											$admin_id=$rown['id'];
											
											$role=$row['role'];
											$user_name=$row['first_name']." ".$row['last_name'];
											$content=" ($user_name)  سجل كبائع يرجى تنشيط حسابه ";
											$url="../cp/users.php?role=2&name=البائعين";
											$this->notification($admin_id ,$url,$content,0);
											//echo "notification($admin_id ,$url,$content,0)";
										}
									}
								}
								
								$arr=["id"=>$row['id'],"role"=>$row['role'],"profile"=>$row['image_name'],"activation"=>$row['activation']];
								
								return $arr;
							}
							else return "كلمة السر خاطئة ";
						}
					}
				else return "لايوجد ايميل";
			} 
			else echo "no";
			
		}
// ------------ products --------------------------------	
	public function products($users_id,$categories_id,$name,$description,$activation,$price,$add_date,$period,$imagef,$imageb,$imager,$imagel,$id=0,$id_imagef=0,$id_imageb=0,$id_imager=0,$id_imagel=0) 
		{
			if($this->connect_to_db())
			{
				if($id==0)
					{
						$sql="CALL `products_add`(:users_id,:categories_id,:name,:description,:activation,:price,:add_date,:period,:imagef,:imageb,:imager,:imagel);";
						$q=$this->con->prepare($sql);
						$q->execute(array("users_id"=>$users_id,"categories_id"=>$categories_id,"name"=>$name,"period"=>$period,"description"=>$description,"activation"=>$activation,"period"=>$period,"price"=>$price,"add_date"=>$add_date,"imagef"=>$imagef,"imageb"=>$imageb,"imager"=>$imager,"imagel"=>$imagel));
						$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
						 return "تم اضافة منتج جديد"; 
						 
						}
						
						
						
					}
						
						
					
					else
					{
						

						$sql="CALL `products_update`(:id,:categories_id,:users_id,:name,:description,:activation,:price,:add_date,:period,:id_imagef,:imagef,:id_imageb,:imageb,:id_imager,:imager,:id_imagel,:imagel);";
						$q=$this->con->prepare($sql);
						$q->execute(array("id"=>$id,"users_id"=>$users_id,"categories_id"=>$categories_id,"name"=>$name,"description"=>$description,"activation"=>$activation,"price"=>$price,"add_date"=>$add_date,"period"=>$period,"imagef"=>$imagef,"imageb"=>$imageb,"imager"=>$imager,"imagel"=>$imagel,"id_imagef"=>$id_imagef,"id_imageb"=>$id_imageb,"id_imager"=>$id_imager,"id_imagel"=>$id_imagel));
						$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							return " تم تعديل المنتج "; 
						}else
						{                                                                                                                                                                                                                                                                                                                                               
							return "لم يتم تعديل المنتج "; 
						} 
						
					}
				
			
			} 
			else echo false;
			
			
		}
		// ------------ products --------------------------------	
	public function roles($acounts_1,$acounts_2,$acounts_3,$orders_1,$orders_2,$orders_3,$slides_1,$slides_2,$slides_3,$users_1,$users_2,$users_3,$products_1,$products_2,$products_3,$offers_1,$offers_2,$offers_3,$addresses_1,$addresses_2,$addresses_3,$locations_1,$locations_2,$locations_3,$messages_1,$messages_2,$messages_3,$granted_roles_1,$granted_roles_2=0,$granted_roles_3=0) 
	{
		if($this->connect_to_db())
		{
			$sql="update roles set acounts=$acounts_1,orders=$orders_1,slides=$slides_1,users=$users_1,products=$products_1,offers=$offers_1,addresses=$addresses_1,locations=$locations_1,messages=$messages_1,granted_roles=$granted_roles_1 where id =1 ;update roles set acounts=$acounts_2,orders=$orders_2,slides=$slides_2,users=$users_2,products=$products_2,offers=$offers_2,addresses=$addresses_2,locations=$locations_2,messages=$messages_2,granted_roles=$granted_roles_2 where id =2 ;update roles set acounts=$acounts_3,orders=$orders_3,slides=$slides_3,users=$users_3,products=$products_3,offers=$offers_3,addresses=$addresses_3,locations=$locations_3,messages=$messages_3,granted_roles=$granted_roles_3 where id =3 ;";
			$q=$this->con->prepare($sql);
			$q->execute(array());
			$rows=$q->fetchall();
			if($q->rowcount()>0)
			{  
				return " تم "; 
			}else
			{                                                                                                                                                                                                                                                                                                                                               
				return "لم يتم  "; 
			} 
					
				
			
		
		} 
		else echo false;
		
		
	}
// ------------ order --------------------------------	
	public function orders($users_id,$products_id,$add_date,$date_deliver,$role,$sell_date,$addresses_id,$id=0) 
		{
			
			if($this->connect_to_db())
			{
				try
				{
					if($id==0)
					{
						$sql="CALL `orders_add`(:users_id,:products_id,:add_date ,:date_deliver,:role,:sell_date,:addresses_id);";
						$q=$this->con->prepare($sql);
						$q->execute(array("users_id"=>$users_id,"products_id"=>$products_id,"add_date"=>$add_date,"date_deliver"=>$date_deliver,"role"=>$role,"sell_date"=>$sell_date,"addresses_id"=>$addresses_id));
						if($q->rowcount()>0)
						{ 
							$rows=$q->fetchall();
							// return product info 
							$sql="Select p.users_id,p.name,u.first_name,u.last_name from products p join users u where p.users_id=u.id and p.id=:products_id";
							$q=$this->con->prepare($sql);
							$q->execute(array("products_id"=>$products_id));
							$rows=$q->fetchall();
							if($q->rowcount()>0)
							{
								foreach($rows as $row)
								{
									$seller_id=$row['users_id'];
									$product_name=$row['name'];
									$user_name=$row['first_name']." ".$row['last_name'];
									$content="وصل اليك طلب ( $product_name)   ";
									$url='../saller_cp/cp_order.php';
									$this->notification($seller_id ,$url,"$content",0);
									/*var_dump("notification($seller_id ,$url,$content,0)");
									var_dump($rows); */
								}return true;
							}
							
							
						}
						else return "لم يتم ارسال الطلب";
					}
					else
					{
						$sql="CALL `orders_update`(:id,:users_id,:products_id ,:add_date,:date_deliver,:amount,:description,:role,:sell_date,:addresses_id);";
						$q=$this->con->prepare($sql);
						$q->execute(array("id"=>$id,"users_id"=>$users_id,"products_id"=>$products_id,"add_date"=>$add_date,"date_deliver"=>$date_deliver,"amount"=>$amount,"description"=>$description,"role"=>$role,"sell_date"=>$sell_date,"addresses_id"=>$addresses_id));
						if($q->rowcount()>0)
						{  
							 return "تم تعديل طلبك";
						}else
						{
							return "لم يتم تعديل طلبك";
						}
						
					}
				} 
			 
				catch(PDOException $e)
				{
					return $sql . "<br>" . $e->getMessage();
				}
			}
		} 
// ------------ notification --------------------------------	
	 public function notification( $users_id,$url,$content,$seen) 
		{
			if($this->connect_to_db())
			{
				$date=date("Y-m-d");
				$sql="CALL `notifications_add`(:users_id,:url,:content,:seen,:date);";
				$q=$this->con->prepare($sql);
				$q->execute(array("users_id"=>$users_id,"url"=>$url,"content"=>$content,"seen"=>$seen,"date"=>$date));
				$rows=$q->fetchall();
					if($q->rowcount()>0)
					{  
						//echo "CALL `notifications_add`($users_id,'$url','$content',$seen,'$date')";
						return true;
						
					}
				//else return false;
			//echo "CALL `notifications_add`($users_id,'$url','$content',$seen,'$date')";
			} 
			else return false;
			
		} 		
// ------------ offers --------------------------------	
	 public function offers( $products_id,$start_date,$end_date,$new_price,$id=0) 
		{
			if($this->connect_to_db())
			{
				if($id==0)
				{
					$sql="CALL `offers_add`(:products_id,:start_date,:end_date,:new_price);";
					$q=$this->con->prepare($sql);
					$q->execute(array("products_id"=>$products_id,"start_date"=>$start_date,"end_date"=>$end_date,"new_price"=>$new_price));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							return "تم اضافة عرض";
						}
					else return "لم يتم اضافة عرض";
				}
				else{
					$sql="CALL `offers_update`(:id,:products_id,:start_date,:end_date,:new_price);";
					$q=$this->con->prepare($sql);
					$q->execute(array("id"=>$id,"products_id"=>$products_id,"start_date"=>$start_date,"end_date"=>$end_date,"new_price"=>$new_price));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							return " تم تعديل العرض";
						}
					else return "لم يتم تعديل العرض";
				}
			} 
			else return false;
			
		} 			
// ------------ user --------------------------------	
	public function users($fname,$lname,$email,$image,$pass,$role,$activation,$addDate,$phone,$id=0) 
		{
			
			if($this->connect_to_db())
			{
				try
				{
					if($id==0)
					{
						$sql="CALL `users_add`(:fname,:lname,:email ,:image,:pass,:role,:activation,:addDate,:phone);";
						$q=$this->con->prepare($sql);
						$q->execute(array("fname"=>$fname,"lname"=>$lname,"image"=>$image,"email"=>$email,"pass"=>$pass,"activation"=>$activation,"role"=>$role,"addDate"=>$addDate,"phone"=>$phone));
						$rows=$q->fetchall();
						if($q->rowcount()>0)
						{ 
							
							return "تم إضافة مستخدم بنجاح";
						}
						else return "البريد او رقم الهاتف موجود من قبل";
					}
					else
					{
						$sql="CALL `users_update`(:id,:fname,:lname ,:email,:image,:pass,:role,:addDate,:activation,:phone);";
						$q=$this->con->prepare($sql);
						$q->execute(array("id"=>$id,"fname"=>$fname,"lname"=>$lname,"image"=>$image,"email"=>$email,"pass"=>$pass,"role"=>$role,"activation"=>$activation,"addDate"=>$addDate,"phone"=>$phone));
						if($q->rowcount()>0)
						{  
							return "<span style='color:blue;'>تم تعديل معلومات الحساب</span>";
						}else
						{
							return "<span style='color:blue;'> لم يتم تعديل معلومات الحساب </span>";
						}
						
					}
				} 
			 
				catch(PDOException $e)
				{
					return $sql . "<br>" . $e->getMessage();
				}
			}
		} 
// ------------ add new category --------------------------------	
	public function categories($name,$addDate,$activation,$id=0) 
		{
			if($this->connect_to_db())
			{
				try
				{
					if($id==0)
					{
						$sql="CALL `categories_add`(:name,:addDate,:activation);";
						$q=$this->con->prepare($sql);
						$q->execute(array("name"=>$name,"addDate"=>$addDate,"activation"=>$activation));
						if($q->rowcount()>0)
						{  
							
							return "<span style='color:blue;'>تم اضافة صنف</span>";
						}else
						{
							return "<span style='color:blue;'> لم يتم اضافة صنف تأكد من  البيانات </span>";
						}
					}
					else{
						$sql="CALL `categories_update`(:id,:name,:addDate,:activation);";
						$q=$this->con->prepare($sql);
						$q->execute(array("id"=>$id,"name"=>$name,"addDate"=>$addDate,"activation"=>$activation));
						if($q->rowcount()>0)
						{  
							return "<span style='color:blue;'>تم تعديل معلومات الصنف</span>";
						}
						else
						{
							
							return "<span style='color:blue;'> لم يتم تعديل معلومات الصنف تأكد من البيانات</span>";
						}
					}
				} 
				catch(PDOException $e)
				{
					return $sql . "<br>" . $e->getMessage();
				}
			}
		}
// ------------ comments --------------------------------	
	 public function comments( $comment,$add_date,$activation,$users_id,$products_id,$id=0) 
		{
			if($this->connect_to_db())
			{
				if($id==0)
				{
					//var_dump("CALL `comments_add`('$comment','$add_date',$activation,$users_id,$products_id)");
					$sql="CALL `comments_add`(:comment,:add_date,:activation,:users_id,:products_id);";
					$q=$this->con->prepare($sql);
					$q->execute(array("comment"=>$comment,"add_date"=>$add_date,"activation"=>$activation,"users_id"=>$users_id,"products_id"=>$products_id));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							
							return "تم اضافة تعليق بنجاح";
							
						}
					else return "لم يتم اضافة تعليق ";
				}
				else{
					$sql="CALL `comments_update`(:id,:users_id,:products_id,:comment,:add_date,:activation);";
					$q=$this->con->prepare($sql);
					$q->execute(array("comment"=>$comment,"id"=>$id,"add_date"=>$add_date,"activation"=>$activation,"users_id"=>$users_id,"products_id"=>$products_id));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							
							return "تم تعديل التعليق بنجاح";
							
						}
					else return "لم يتم تعديل التعليق";
				}
			} 
			else echo "no";
			
		} 
// ------------ evaluations --------------------------------	
	 public function evaluations( $users_id,$products_id,$evaluation,$id=1)// defulte value 1 because this table doesnt have coulmn id 
		{
			if($this->connect_to_db())
			{
				if($id==1)
				{
					$sql="CALL `evaluations_add`(:users_id,:products_id,:evaluation);";
					$q=$this->con->prepare($sql);
					$q->execute(array("evaluation"=>$evaluation,"users_id"=>$users_id,"products_id"=>$products_id));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							
							return "تم اضافة تقييم";
							
						}
					else return "لم تتم اضافة التقييم";
				}
				else{
					$sql="CALL `evaluations_update`(:users_id,:products_id,:evaluation);";
					$q=$this->con->prepare($sql);
					$q->execute(array("evaluation"=>$evaluation,"users_id"=>$users_id,"products_id"=>$products_id));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							
							return "تم تعديل التقييم";
							
						}
					else return "لم يتم تعديل التقييم";
				}
			} 
			else echo "no";
			
		} 	
// ------------ locations --------------------------------	
	 public function locations( $name,$level,$parent,$id=0) 
		{
			if($this->connect_to_db())
			{
				if($id==0)
				{
					$sql="CALL `locations_add`(:name,:level,:parent);";
					$q=$this->con->prepare($sql);
					$q->execute(array("name"=>$name,"level"=>$level,"parent"=>$parent));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							return "تم اضافة موقع";
						}
					else return "لم تتم اضافة موقع";
				}
				else{
					$sql="CALL `locations_update`(:id,:name,:level,:parent);";
					$q=$this->con->prepare($sql);
					$q->execute(array("id"=>$id,"name"=>$name,"level"=>$level,"parent"=>$parent));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							return "تم تعديل الموقع";
						}
					else return "لم يتم تعديل الموقع";
				}
			} 
			else echo "no";
			
		} 	
// ------------ addresses --------------------------------	
	 public function addresses( $first_name,$last_name,$phone,$type,$description,$location_map,$location_id,$users_id,$id=0) 
		{
			if($this->connect_to_db())
			{
				if($id==0)
				{
					$sql="CALL `addresses_add`(:first_name,:last_name,:phone,:type,:location_map,:location_id,:users_id,:description);";
					$q=$this->con->prepare($sql);
					$q->execute(array("first_name"=>$first_name,"last_name"=>$last_name,"phone"=>$phone,"type"=>$type,"description"=>$description,"location_map"=>$location_map,"location_id"=>$location_id,"users_id"=>$users_id));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							
							return "تم اضافة عنوانك";
							
						}
					else return "لم تتم اضافة العنوان";
				}
				else{
					$sql="CALL `addresses_update`(:id,:first_name,:last_name,:phone,:type,:location_map,:location_id,:users_id,:description);";
					$q=$this->con->prepare($sql);
					$q->execute(array("id"=>$id,"first_name"=>$first_name,"last_name"=>$last_name,"phone"=>$phone,"type"=>$type,"description"=>$description,"location_map"=>$location_map,"users_id"=>$users_id,"location_id"=>$location_id,));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							
							return "تم تعديل العنوان";
							
						}
					else return "لم يتم تعديل العنوان";
				}
			} 
			else echo "no";
			
		} 
// ------------ properties --------------------------------	
	 public function properties( $name,$value,$type,$new,$id=0) 
		{
			if($this->connect_to_db())
			{
				if($id==0)
				{
					$sql="CALL `properties_add`(:name,:value,:type,:new);";
					$q=$this->con->prepare($sql);
					$q->execute(array("name"=>$name,"value"=>$value,"type"=>$type,"new"=>$new));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							
							return "تم اضافة خاصية جديدة";
							
						}
					else return "لم تتم اضافة خاصية";
				}
				else{
					$sql="CALL `properties_update`(:id,:name,:value,:type,:new);";
					$q=$this->con->prepare($sql);
					$q->execute(array("name"=>$name,"value"=>$value,"type"=>$type,"new"=>$new,"id"=>$id));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							
							return "تم تعديل الخاصية";
							
						}
					else return "لم يتم تعديل الخاصية";
				}
			} 
			else echo "no";
			
		}
// ------------ used_properties --------------------------------	
	 public function used_properties( $properties_id,$default,$users_id,$products_id=0) // defulte value 1 because this table doesnt have coulmn id 
		{
			if($this->connect_to_db())
			{
				if($products_id==0)
				{
					//$users_id=$_SESSION['id'];
					$sql="CALL `used_properties_add`(:properties_id,:default,:users_id);";
					$q=$this->con->prepare($sql);
					$q->execute(array("properties_id"=>$properties_id,"default"=>$default,"users_id"=>$users_id));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							
							return "تمت الاضافة";
							
						}
					else return "لم تتم الاضافة";
				}
				else{
					$sql="CALL `used_properties_update`(:properties_id,:products_id,:default);";
					$q=$this->con->prepare($sql);
					$q->execute(array("properties_id"=>$properties_id,"default"=>$default,"products_id"=>$products_id));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							
							return "لم يتم التعديل";
							
						}
					else return "تم التعديل";
				}
			} 
			else echo "no";
			
		} 
// ------------ messages -------------------------------	// just add
	 public function messages($message,$users_id) 
		{
			if($this->connect_to_db())
			{
				
					$sql="CALL `messages_add`(:message,:users_id);";
					$q=$this->con->prepare($sql);
					$q->execute(array("message"=>$message,"users_id"=>$users_id));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							
							return "تم ارسال الرسالة";
							
						}
					else return "لم يتم ارسال الرسالة";
				
				
			} 
			else echo "no";
			
		} 	
// ------------ delete_ --------------------------------	
	 public function delete_( $table_name,$id,$id2=0) 
		{
			if($this->connect_to_db())
			{
				    
					if($id2==0){
						$sql="CALL `$table_name"."_delete`(:id);";
						$q=$this->con->prepare($sql);
						$q->execute(array("id"=>$id));
						$rows=$q->fetchall();
							if($q->rowcount()>0)
							{  
								
								return true;
								
							}
						else return false;
					}
				if($table_name=='used_properties' or $table_name=='evaluations' )
					{
						$sql="CALL `$table_name"."_delete`(:id,:id2);";
						$q=$this->con->prepare($sql);
						$q->execute(array("id"=>$id,"id2"=>$id2));
						$rows=$q->fetchall();
							if($q->rowcount()>0)
							{  
								
								return true;
								
							}
						else return false;
					}
				
			} 
			
			
		}	
// ------------ activation --------------------------------	
	 public function activation( $table_name,$id) 
		{
			if($this->connect_to_db())
			{
				  
						$sql="UPDATE `$table_name` SET `activation`=1  WHERE $table_name.id=:id";
						$q=$this->con->prepare($sql);
						$q->execute(array("id"=>$id));
						$rows=$q->fetchall();
							if($q->rowcount()>0)
							{  
								
								return true;
								
							}
						else return false;
					
				
			} 
			
			
		}
// ------------no activation --------------------------------	
	 public function no_activation( $table_name,$id) 
		{
			if($this->connect_to_db())
			{
				$sql="UPDATE `$table_name` SET `activation`=0  WHERE $table_name.id=:id";
				$q=$this->con->prepare($sql);
				$q->execute(array("id"=>$id));
				$rows=$q->fetchall();
					if($q->rowcount()>0)
					{  
						return true;
					}
				else return false;
			} 
		}				
		
//--------------------- order_tracking ------------------------------
public function order_tracking( $id) 
		{
			if($this->connect_to_db())
			{
				$sqlp="Select products_id from orders where id=:id ";
				$qp=$this->con->prepare($sqlp);
				$qp->execute(array("id"=>$id));
				$rowsp=$qp->fetchall();
				if($qp->rowcount()>0){
					$products_id=$rowsp[0][0];
				}
				$sql="UPDATE `orders` SET `role` = role+1 WHERE `orders`.`id` = :id;";
				$q=$this->con->prepare($sql);
				$q->execute(array("id"=>$id));
				$rows=$q->fetchall();
					if($q->rowcount()>0)
					{ 
						$sql="Select o.users_id,p.name ,o.amount
								from products p 
								join users u
								join orders o 
								where o.users_id=u.id and p.id=:products_id ";
								
							$q=$this->con->prepare($sql);
							$q->execute(array("products_id"=>$products_id));
							$rows=$q->fetchall();
							if($q->rowcount()>0)
							{
								foreach($rows as $row)
								{
									$user=$row['users_id'];
									$product_name=$row['name'];
									//$user_name=$row['first_name']." ".$row['last_name'];
									$amount=$row['amount'];
									$content="طلبك قيد التجهيز ($amount $product_name) ";
									$url='../site/myPurchases.php';
									$this->notification($user ,$url,"$content",0);
								}/* var_dump($this->notification($user ,$url,"$content",0));
									var_dump("notification($user ,$url,$content,0)");
									var_dump($rows); */
							return "<h1>تم تعديل حالة الطلب</h1>";
							}
						
					}
				else return "<h1>لم يتم تعديل حالة الطلب</h1>";
			} 
		}
				
//--------------------- update property state ------------------------------
	public function updatePropertyState($value,$id) 
		{
			if($this->connect_to_db())
			{
				if($value==0)
				{
					$sql="UPDATE `properties` SET `new` = 1   WHERE `properties`.`id` = :id;";
					$q=$this->con->prepare($sql);
					$q->execute(array("id"=>$id));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							return true;
						}
					else return false;
				}
				else
				{
					$sql="UPDATE `properties` SET `new` = 0   WHERE `properties`.`id` = :id;";
					$q=$this->con->prepare($sql);
					$q->execute(array("id"=>$id));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							return true;
						}
					else return false;
				}
			} 
		}
//---------------fill select --------------	
	public function fill_select($table,$dest=0) 
		{
			if($this->connect_to_db())
			{
				if($dest==0)
				{
					$output='';
					$sql="select id,name from $table";
					$q=$this->con->prepare($sql);
					$q->execute();
					$rows=$q->fetchall();
					if($q->rowcount()>0)
						{
							foreach($rows as $row)
							{
								$output.="<option value='".$row['id']."'>".$row['name']."</option>";
							}
						}
				}
				//else
				else if($dest=="1")
				{
					$output='';
					$sql="select  DISTINCT name from $table";
					$q=$this->con->prepare($sql);
					$q->execute();
					$rows=$q->fetchall();
					if($q->rowcount()>0)
						{
							foreach($rows as $row)
							{
								$output.="<option value='".$row['name']."'>".$row['name']."</option>";
							}
						}
				}
				
				else
				{
					$output='';
					$sql="select id,name from $table";
					$q=$this->con->prepare($sql);
					$q->execute();
					$rows=$q->fetchall();
					if($q->rowcount()>0)
						{
							foreach($rows as $row)
							{
								if($dest==$row['id'])$output.="<option value='".$row['id']."'selected>".$row['name']."</option>";
								else $output.="<option value='".$row['id']."' >".$row['name']."</option>";
							}
						}
				}
					
					return $output;
			}
			
			
		}
//---------------display Offers --------------	
	public function displayOffers($all)
	{
		if($this->connect_to_db())
			{
				if(strtolower($all)=="home")
				{
					$today = date("Y-m-d");
						//$enddate = date("Y-m-d",strtotime("+6 days",strtotime("today")));
						$sql="select products.id,name,price,image_name,new_price
								 from products 
						inner join images on products.id=images.products_id 
						inner join offers on products.id=offers.products_id 
						where end_date >= :today and start_date<= :today
						group by products.id order by start_date desc
						limit 7
						";
				}
				else if(strtolower($all)=="all")
				{
					$today = date("Y-m-d");
					//$enddate = date("Y-m-d",strtotime("+6 days",strtotime("today")));
					$sql="select products.id,name,price,image_name,new_price
							from products 
						inner join images on products.id=images.products_id 
						inner join offers on products.id=offers.products_id 
						where end_date >= :today and start_date<= :today
						group by products.id order by start_date desc
						
						";
				}
					
				$q=$this->con->prepare($sql);
				$q->execute(array("today"=>$today));
				$rows=$q->fetchall();
				if($q->rowcount()>0)
				 { //var_dump($rows);
					foreach($rows as $row)
					{
						$id=$row['id'];
						$price=$row['price'];
						$new_price=$row['new_price'];
						$name=$row['name'];
						$image=$row['image_name'];
						echo "
						<div class='col-md-6 col-lg-4 col-xl-3 product-grid' style='margin-bottom: 4%;'>
							<div class='image'>
								<a href='#'>
									<img src='../upload/$image' class='w-100' style='vertical-align: middle;
    width: 100%;
	    min-height: 300px;
   height: 212px;'>
									<div class='overlay'>
										<a href='showDetails.php?id=$id'><div class='detail'>مزيد من التفاصيل</div></a>
									</div>
								</a>
							</div>
							<h4 class='text-center'>$name</h4>
							<h5 class='text-center'>
							  <span class='fa fa-star checked' id='star'></span>
							  
							  </span></h5>
							<h5 class='text-center'><del>$ $price</del></h5>
							<h5 class='text-center'>$ $new_price</h5>
							<a href='showDetails.php?id=$id' class='btn buy' title='اشتري المنتج'> <i class='fa fa-shopping-cart cooffa'  > </i></a><!---->
						</div>
						
						";
						
					}
				}
			}
}
//---------------display New Products --------------	
	public function displayNewProducts($all,$id=0)
	{
		if($this->connect_to_db())
			{
				if($id==0)
				{
					//$startdate = strtotime("Saturday");
					$today = date("Y-m-d");
					
					if(strtolower($all)=="home")
					{	
						$sql="select products.id,name,price,image_name,period,(
							select ROUND(avg(evaluation),2)
							from evaluations 
							where evaluations.products_id=products.id) as evaluation
							from products 
							inner join images on products.id=images.products_id
							where products.id Not in( select products_id 
							from offers 
							where end_date >= :today and start_date<= :today
							) 
							
							group by products.id order by add_date desc limit 7";
					}
					else if(strtolower($all)=="all")
					{
						
						/* $today1 = strtotime("-1 weeks", date("Y-m-d"));//A non well formed numeric value encountered----add_date>=$t and
						$t= date("Y-m-d",$today1); */ 
						$sql="select products.id,name,price,image_name,period,(
							select ROUND(avg(evaluation),2)
							from evaluations 
							where evaluations.products_id=products.id) as evaluation
							from products 
							inner join images on products.id=images.products_id
							where  products.id Not in( select products_id 
							from offers 
							where end_date >= :today and start_date<= :today
							) 
							order by add_date desc limit 50
							";
					}
					
					
						
						$q=$this->con->prepare($sql);
						$q->execute(array("today"=>$today));//group by products.categories_id
						$rows=$q->fetchall();
						if($q->rowcount()>0)
						 { //var_dump($rows);
							foreach($rows as $row)
							{
								if(is_null($row['evaluation'])) $row['evaluation']=0.0;
								$period=$row['period']+2;
								$id=$row['id'];
								$price=$row['price'];
								$evaluation=$row['evaluation'];
								$name=$row['name'];
								$image=$row['image_name'];
								echo "
								<div class='col-md-6 col-lg-4 col-xl-3 product-grid' style='margin-bottom: 4%;'>
									<div class='image' >
										<a href='#' >
											<img src='../upload/$image' class='w-100' style='vertical-align: middle;
    width: 100%;
	    min-height: 300px;
   height: 212px;' >
											<div class='overlay'>
												<a href='showDetails.php?id=$id'><div class='detail'>مزيد من التفاصيل</div></a>
											</div>
										</a>
									</div>
									<h5 class='text-center'>$name</h5>
									<h5 class='text-center'>
									  <span class='text-center'>$evaluation</span>
									  <span class='fa fa-star checked' id='star'></span>
									  
									  </span></h5>
									<h5 class='text-center'>$price ريال</h5>
									<h5 class='text-center'>فترة التجهيز $period  ايام</h5>
									<a href='customize.php?id=$id' class='btn buy' title='اشتري المنتج'> <i class='fa fa-shopping-cart cooffa'> </i></a><!---->
								</div>
								
								";
								
							}
						}
				}
				
				else
				{
					
				}
			}
		
	}
//---------------Show Details --------------	
	public function ShowDetails($id)
	{
		if($this->connect_to_db())//DISTINCT
			{
				$sql="select  image_name,products.id,name,price,description,offers.new_price
						from products 
						inner join images on products.id=images.products_id
						left join offers on products.id=offers.products_id
						where products.id= :id ";	
				$q=$this->con->prepare($sql);
				$q->execute(array("id"=>$id));
				$rows=$q->fetchall();
				if($q->rowcount()>0)
				 { //var_dump($rows);
					
						$id=$rows[0]['id'];
						$price=$rows[0]['price'];
						if(isset($rows[0]['new_price']))$price=$rows[0]['new_price'];
						else $price=$rows[0]['price'];
						
						//$evaluation=$row['evaluation'];
						$name=$rows[0]['name'];
						$desc=$rows[0]['description'];
						echo "<div class='row s_product_inner'>
							<div class='col-lg-6'>
								<div class='s_product_img'>
									<div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
										<ol class='carousel-indicators'>
										";
										$a=0;
										foreach($rows as $row)
										{
											$img=$row['image_name'];
											if($a==0)
											echo"
											<li data-target='#carouselExampleIndicators' data-slide-to='$a' class='active'>
												<img  src='../upload/$img'  alt='' >
											</li>
											";
											else{
												echo"
												<li data-target='#carouselExampleIndicators' data-slide-to='$a'>
													<img  src='../upload/$img'  alt=''>
												</li>
												";
											}
											$a=$a+1;
										}
											echo"
										</ol>
										<div class='carousel-inner'>";
										$s=0;
										foreach($rows as $row)
										{
											$img=$row['image_name'];
											//echo $s;
											if($s==0)
											echo"
											<div class='carousel-item active'>
												<img class='d-block w-100'  src='../upload/$img'  alt='' class='w-100' style='height: 424px;'>
											</div>
											";
											else{
												echo"
												<div class='carousel-item'>
													<img class='d-block w-100'  src='../upload/$img'  alt='' class='w-100' style='height: 424px;'>
												</div>
												";
											}
											$s=$s+1;
										}
										
										echo "	
										</div>
									</div>
								</div>
							</div>
							<div class='col-lg-5 offset-lg-1'>
								<div class='s_product_text dirof'>
									<h3>$name </h3>
									<h2>$$price </h2>
									<ul class='list'>
										
										<li>
											<!--<a href='#'>
												<span>Availibility</span> : In Stock</a>-->
										</li>
									</ul>
									<p>$desc </p>
									<div class='product_count'>
										<!--<input type='text' name='qty' id='sst' maxlength='12' value='1' title='Quantity:' class='input-text qty'>
										<button onclick='var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;'
										 class='increase items-count' type='button'>
											<i class='lnr lnr-chevron-up'></i>
										</button>
										<button onclick='var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;'
										 class='reduced items-count' type='button'>
											<i class='lnr lnr-chevron-down'></i>
										</button>-->
										<form class='row ' action='' method='post'  novalidate style='border:none'>
										  <input type='hidden' name='hidden_id' value='$id'>
										  <input type='hidden' name='hidden_name' value='$name'>
										  <input type='hidden' name='hidden_price' value='$price'>
										  <input type='hidden' name='hidden_image' value='$img'>
									</div>
									<div class='card_area'>
									<button class='main_btn' name='add_to_cart'>اضافة الى السلة</button>
									</form>	
									</div>
								</div>
							</div>
						</div>
									
						";
						
					}
				
			}
		
	}
// ------------ show comments --------------------------------	
	 public function displayComments($pro_id ) 
		{
			if($this->connect_to_db())
			{
					$sql="select users.first_name,users.last_name,users.image_name,comments.comment,comments.add_date
							from users
							inner join comments on users.id=comments.users_id
							where comments.products_id= :pro_id";
					$q=$this->con->prepare($sql);
					$q->execute(array("pro_id"=>$pro_id));
					$rows=$q->fetchall();
					
					if($q->rowcount()>0)
					{
						foreach($rows as $row)
						{
							$fname=$row['first_name'];
							$lname=$row['last_name'];
							$image=$row['image_name'];
							$comments=$row['comment'];
							$add_date=date_format(date_create($row['add_date']),"yy-m-d  H:i");
							echo "
							<div class='review_item'>
									<div class='media'>
										<div class='d-flex fflex'>
											<img src='../upload/$image' class='radimg' alt=''>
										</div>
										<div class='media-body'>
											<h4>$fname $lname </h4>
											<h5>$add_date pm</h5>
											<!--<a class='reply_btn' href='#'>Reply</a>-->
										</div>
									</div>
									<p class='rghtte'>$comments</p>
								</div>";
							
						}
					}
					 
			} 
		}
// ------------ show slides --------------------------------	
		public function displaySlides( ) 
		{
			if($this->connect_to_db())
			{
					$sql="select * from slides";
					$q=$this->con->prepare($sql);
					$q->execute(array());
					$rows=$q->fetchall();
					$i=0;
					if($q->rowcount()>0)
					{
						foreach($rows as $row)
						{
							$name=$row['name'];
							if($i==0)
							echo "<div class='carousel-item active' id='intro'>
							<img src='../upload/".$name."' alt='logo' style='height:100%;width:100%;'></div>";
							else echo "<div class='carousel-item ' >
							<img src='../upload/".$name."' alt='logo' style='height:100%;width:100%;'></div>";
							$i++;
						}
					}
					 
			} 
		}
// ------------ edit slides --------------------------------	
public function editSlides( $name1,$name2,$name3,$name4) 
{
	if($this->connect_to_db())
	{
		//echo "<br>UPDATE `slides` SET `name` = $name1 WHERE `slides`.`id` = 1; UPDATE `slides` SET `name` = $name2 WHERE `slides`.`id` = 2;UPDATE `slides` SET `name` = $name3 WHERE `slides`.`id` = 3; UPDATE `slides` SET `name` = $name4 WHERE `slides`.`id` = 4;";
		
		$sql="UPDATE `slides` SET `name` ='$name1' WHERE `slides`.`id` = 1; UPDATE `slides` SET `name` ='$name2' WHERE `slides`.`id` = 2;UPDATE `slides` SET `name` = '$name3' WHERE `slides`.`id` = 3; UPDATE `slides` SET `name` = '$name4' WHERE `slides`.`id` = 4;";
		$q=$this->con->prepare($sql);
		$q->execute(array());
		$rows=$q->fetchall();
			if($q->rowcount()>0)
			{  
				return "تم تعديل السلايدر";
				
			}
		else return "لم يتم تعديل السلايدر";
	} 
}				
// ------------ show productEvaluation --------------------------------	
	 public function productEvaluation($pro_id ) 
		{
			if($this->connect_to_db())
			{
					$sql="select ROUND(avg(evaluation),2)as evaluation
							from evaluations
							where products_id= :pro_id";
					$q=$this->con->prepare($sql);
					$q->execute(array("pro_id"=>$pro_id));
					$rows=$q->fetchall();
					
					if($q->rowcount()>0)
					{
						foreach($rows as $row)
						{
							$evaluation=$row['evaluation'];
							
							
						}
					}
					 if(isset($evaluation)) echo $evaluation;
					else echo "0.0";
					 
			} 
		}	
// ------------ properties --------------------------------	
	 public function get_properties($pro_id ) 
		{
			if($this->connect_to_db())
			{
					$sql="SELECT DISTINCT name
							from properties p 
							INNER JOIN used_properties u
							WHERE u.properties_id = p.id
							and u.products_id =:pro_id";
					$q=$this->con->prepare($sql);
					$q->execute(array("pro_id"=>$pro_id));
					$rows=$q->fetchall();
					$values=[];
					if($q->rowcount()>0)
					{
						$c=0;
						$options='';
						foreach($rows as $row)
						{
							$options='';
							
							$name=$row['name'];
							echo "<span class='t'>$name :	</span>";
							echo "<select class='selecting' name='prop[$name]'>";
							
							
							//$prop[]=$name;
							$sql="select value ,p.name,p.id,u.default
									from properties p 
									INNER JOIN used_properties u
									WHERE u.properties_id = p.id
									 and name =:name
									and u.products_id =:pro_id";
							$v=$this->con->prepare($sql);
							$v->execute(array("pro_id"=>$pro_id,"name"=>$name));
							$vals=$v->fetchall();
							if($v->rowcount()>0)
							{
								//$values=null;
								foreach($vals as $val)
								{
									$index=intval($val['id']);
									//$values[$index]=$val['value'];
									$value=$val['value'];
									if( $val['default'])
									$options.="<option value='$value' selected>$value</option>";
									else
									$options.="<option value='$value'>$value</option>";
								}
								
							}
							$c++;
							//$prop[]=$values;
							echo $options;
							echo "</select><br><br>";
						}
					}
					 return $values;
			} 
		}
//---------------Get Categories --------------	
	public function getCategoriesList() 
		{
			if($this->connect_to_db())
			{
					$output='';
					$sql="select id,name from categories";
					$q=$this->con->prepare($sql);
					$q->execute();
					$rows=$q->fetchall();
					if($q->rowcount()>0)
						{
							foreach($rows as $row)
							{
								$id=$row['id'];
								$name=$row['name'];
								$output.="<a class='dropdown-item' href='../site/handscraft.php?p=$id'>$name</a>";
							}
						}
						return $output;
				
				
					
					
			}
			
			
		}
//---------------ٍSearch about products--------------	
	public function getPropertiesOfProduct($products_id)
	{
		if($this->connect_to_db())
			{
				
					$sql="select properties_id from used_properties where products_id=:p_id";
						$q=$this->con->prepare($sql);
						$q->execute(array("p_id"=>$products_id));
						$rows=$q->fetchall();
						
						$ids=[];
						if($q->rowcount()>0)
						 { //var_dump($rows);
							foreach($rows as $row)
							{
								$ids[]=$row['properties_id'];
							}
							return $ids;
						 }
						 else return false;
				
			}
		
	}
//---------------Get Products by categories_id--------------	
	public function getProducts()
	{
		if($this->connect_to_db())
			{
				
					$today = date("Y-m-d");
					//"today"=>$today,
					$sql="select products.id,name,price,image_name,
							(select new_price from offers where offers.products_id=products.id and end_date >= :today and start_date <= :today) as 'new_price'
							from products 
								inner join images on products.id=images.products_id
								group by products.id
								order by add_date desc								
								";
						$q=$this->con->prepare($sql);
						$q->execute(array("today"=>$today));
						$rows=$q->fetchall();
						if($q->rowcount()>0)
						 { //var_dump($rows);
							foreach($rows as $row)
							{
								if(isset($row['new_price']))$price=$row['new_price'];
								else $price=$row['price'];
								$id=$row['id'];
								//$price=$row['price'];
								$name=$row['name'];
								$image=$row['image_name'];
								echo "<!-- Product  -->
								
										<div class='col-md-6 col-lg-4 col-xl-3 product-grid' style='margin-bottom: 4%;'>
										<form action='?id=$id' method='post' class='contform' enctype='multipart/form-data'  style='margin-bottom: 4%;border:none;'>
											<div class='image'>
												<a href='showDetails.php?id=$id'>
													<img src='../upload/$image' class='w-100' style='vertical-align: middle;
    width: 100%;
	    min-height: 300px;
   height: 212px;'>
													<div class='overlay'>
														<div class='detail'>مزيد من التفاصيل</div>
													</div>
												</a>
											</div>
											<h4 class='text-center'>$name</h4>
											
											<h5 class='text-center'>السعر:$price ريال</h5>
											<!-- <a href='#' class='btn buy'> <i class='fa fa-shopping-cart cooffa' > </i></a></input>-->
										
										<input type='text' name='hidden_image' value='$image' hidden> 
										<input type='text' name='hidden_price' value='$price' hidden> 
										<input type='text' name='hidden_name' value='$name' hidden> 
										<input type='text' name='hidden_quantity' value='1' hidden> 
										<input type='text' name='hidden_id' value='$id' hidden> 
										<input type='submit' name='add_to_cart' title='اشتري المنتج' class='btn buy' style='font-family:FontAwesome' value='"."&#xf07a";
										echo"'></input>
									</form>
								</div>
										<!-- ./Product -->";
								
							}
						}
				
			}
		
	}
//---------------ٍGet category name--------------	
	public function getCategoryName($id)
	{
		if($this->connect_to_db())
			{
				
					$sql="select name from categories where id =:id";
						$q=$this->con->prepare($sql);
						$q->execute(array("id"=>$id));
						$rows=$q->fetchall();
						return $rows[0][0];
				
			}
		
	}
//------------reset password-------------------------
 public function update_pass($pass,$code) 
		{
			if($this->connect_to_db())
			{
             $sql="update users set password=:password where reset=:reset";
					$q=$this->con->prepare($sql);
					$q->execute(array("password"=>$pass,"reset"=>$code));
					$rows=$q->fetchall();
						if($q->rowcount()>0)
						{  
							return true;
							
							/* $sqlp="update users set reset=null where reset=$code";
								$qp=$this->con->prepare($sqlp);
								$qp->execute(array("password"=>$pass));
								//$rows=$q->fetchall(); */
						}
					else return false;
			} 
			else return false;
			
		}	
// ------------ code  --------------------------------	
	public function verfy_code($email,$code) 
		{
			if($this->connect_to_db())
			{
				$sql="select reset from users where email=:email";
				$q=$this->con->prepare($sql);
				$q->execute(array("email"=>$email));
				$rows=$q->fetchall();
					if($q->rowcount()>0)
					{  
						foreach($rows as $row)
						{
							if($code==$row['reset'])
							{
								//return true;
						header("location:../site/enterpass.php?code=$code");
							}
							else return false;
						}
					}
				else return "لايوجد ايميل";
			} 
			else echo "no";
			
		}	
//---------------ٍSearch about products--------------	
	public function search($str)
	{
		if($this->connect_to_db())
			{
				
					$sql="select products.id,name,price,image_name
					from products 
					inner join images on products.id=images.products_id WHERE name like '%$str%'";
						$q=$this->con->prepare($sql);
						$q->execute(array());
						$rows=$q->fetchall();
						return $rows;
				
			}
		
	}
//---------------ٍGet Addressess--------------	
	public function getAdressess($user_id)
	{
		if($this->connect_to_db())
			{
				
					$sql="select * from addresses where users_id=:user_id";
						$q=$this->con->prepare($sql);
						$q->execute(array("user_id"=>$user_id));
						$rows=$q->fetchall();
						return $rows;
				
			}
		
	}
	


	
}


//________________________________________________________________________________________________________________________________________________________________

	// to show error messages
	function error_message($value)
	{
		 return "<span class='error-message'>يرجى إدخال  $value  -_-  </span>";
	}

	// type of locaion
	function locationType($value) 
		{
			switch($value)
			{
				case 1: return "منزل"; break;
				case 2: return "مكتب"; break;
				case 3: return "شقة"; break;
			} 
		}
	// type of order
	function orderType($value) 
		{
			switch($value)
			{
				case 1: return "جديد"; break;
				case 2: return "قيد التجهيز"; break;
				case 3: return "مدفوع"; break;
				case 4: return "مكتمل"; break;
			} 
		}
		
	// type of property
	function propertyType($value) 
		{
			switch($value)
			{
				case 0: return "نص عادي"; break;
				case 1: return "مربع الوان"; break;
			}
		}
	// type of property
	function properNew($value) 
		{
			switch($value)
			{
				case 0: return "نعم"; break;
				case 1: return "لا"; break;
			}
		}	

	function right_list($a,$i,$p){
		
		return "<li>
			<a href='$a'>
				<i class='$i'></i>
				<p>$p</p>
			</a>
		  </li>";
	}




/* <h5 class='text-center'>
				  <span class='fa fa-star checked' id='star'></span>
				  <span class='fa fa-star checked' id='star'></span>
				  <span class='fa fa-star checked' id='star'></span>
				  <span class='fa fa-star' id='star'></span>
				  <span class='fa fa-star' id='star'></span>
				  </span></h5> */
				  
				  
				  
				  
				  
				  /* 
$sql="SELECT name,value
							from properties p 
							INNER JOIN used_properties u
							WHERE u.properties_id = p.id
							and u.products_id =:pro_id;";
					$q=$this->con->prepare($sql);
					$q->execute(array("pro_id"=>$pro_id));
					$rows=$q->fetchall();
					
					if($q->rowcount()>0)
					{
						
						
						foreach($rows as $row)
						{
							$name=$rows[0]['name'];
							if($name)
							$prop[]=
							$values[]=$row['value'];
						}
						$prop[]=$values;
					}
					 return $prop;				  */
					 
					 
					 /* 

استرجاع حسب الصنف

select products.id,name,price,image_name,period,new_price,(
						select ROUND(avg(evaluation),2)
						from evaluations 
						where evaluations.products_id=products.id) as evaluation
						from products
                        inner join images on products.id=images.products_id
						inner join offers
							where end_date >= :today  and start_date<= :today and products.id=offers.products_id and products.categories_id=:cat_id 
						order by products.add_date desc					 */
?>