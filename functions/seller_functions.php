<?php
class seller 
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
		
 public function cp_products($user_id) 
	 {
		 if($this->connect_to_db())
			{
			 try
				{
					$sql="select products.id,name,price,image_name,period,(select count(role) from orders WHERE products.id=orders.products_id  ) as sales,(
						select ROUND(avg(evaluation),2)
						from evaluations 
						where evaluations.products_id=products.id) as evaluation
						from products 
						inner join images   WHERE products.id=images.products_id and products.users_id=:user_id
						group by products.name
						order by  products.id desc";
					$q=$this->con->prepare($sql);
					$q->execute(array("user_id"=>$user_id));
					$rows=$q->fetchall();
					return $rows;
				}
			catch(PDOEXCEPTION $ex)
				{
					$state="not connect";
					exit($ex->getmessage());
				}
			}
	 }	 
// ------------ display seller sales --------------------------------	
 public function sellerSales($id ,$role) 
		{
			if($this->connect_to_db())
			{
				if($role==4)
				{
						$sql="select products.name,orders.amount,orders.description,orders.role,image_name,products.price*orders.amount as price,orders.sale_date
								from orders
								inner join products 
								on orders.products_id=products.id
								inner join images 
								on images.products_id=products.id
								where products.users_id= :id 
								group by orders.id
                                order by orders.add_date desc
								";
						
						$q=$this->con->prepare($sql);
						$q->execute(array("id"=>$id));
						$rows=$q->fetchall();
						
						if($q->rowcount()>0)
						{
							foreach($rows as $row)
							{
								$name=$row['name'];
								$img=$row['image_name'];
								$amount=$row['amount'];
								$role=orderType($row['role']);
								$description=$row['description'];
								$price=$row['price'];
								$sale=$row['sale_date'];
								echo "<tr>
											<td class='cart_product_desc' >
												<h5>$name</h5>
											</td>
											<td class='cart_product_img' style='width:200px;text-align:center; vertical-align:middle'>
												<a href='#'><img src='../upload/$img' alt='Product' class='smd' style='max-height:100%; min-width:100px'></a>
											</td>
											
											<td class='price'>
											  <h5>$price</h5>
											</td>
											<td class='qty'>
											   <h5>$amount</h5>
											</td>
											<td class='qty'>
											   <h5>$description</h5>
											</td>
											<td class='price'>
												 <h5>$sale</h5>
											</td>
											<td class='price'>
												 <h5>$role</h5>
											</td>
										
											<!-- <td class='price'>
												<h4><i class='fa fa-remove' id='mc'></i></h4>
											</td>-->
										</tr>";
							}
						}
					}
					else
					{
						$sql="select  orders.products_id ,orders.id,products.name,orders.amount,orders.description,image_name,products.price*orders.amount as price,orders.add_date
								from orders
								inner join products 
								inner join images 
								where images.products_id=products.id and orders.products_id=products.id
								and products.users_id= :id and orders.role=:role
								group by orders.id";
						$q=$this->con->prepare($sql);
						$q->execute(array("id"=>$id,"role"=>$role));
						$rows=$q->fetchall();
						
						if($q->rowcount()>0)
						{
							foreach($rows as $row)
							{
								$id=$row['id'];
								$name=$row['name'];
								$img=$row['image_name'];
								$amount=$row['amount'];
								$description=$row['description'];
								$price=$row['price'];
								$add=$row['add_date'];
								echo "<tr>
                                        
                                        <td class='cart_product_desc'>
                                            <h5>$name</h5>
                                        </td>
										<td class='cart_product_img' style='width:200px;text-align:center; vertical-align:middle'>
                                            <a href='#'><img src='../upload/$img' alt='Product' class='smd' style='max-height:100%; min-width:100px'></a>
                                        </td>
                                        <td class='price'>
                                          <h5>$price</h5>
                                        </td>
										<td class='price'>
                                          <h5>$amount</h5>
                                        </td>
                                        <td class='qty'>
                                           <h5>$description</h5>
                                        </td>
										 <td class='price'>
                                             <h5>$add</h5>
                                        </td>
									
										<td class='price'>
                                            <h4 ><a href='?id=$id&role=:role'><i class='fa fa-check' id='mc'></i></a></h4>
                                        </td>
                                    </tr>";
							}
						}
					}
					 
			} 
		}	
// show offersn
public function cp_offers($user_id) 
	 {
		 if($this->connect_to_db())
			{
			 try
				{
					$sql="select offers.id,name,price,new_price,image_name,start_date,end_date,(select count(role) offers  WHERE products.id=offers.products_id and role=4  ) as sales,(
						select ROUND(avg(evaluation),2)
						from evaluations 
						where evaluations.products_id=products.id) as evaluation
						from products 
						inner join images join orders join offers WHERE products.id=images.products_id and products.users_id=:user_id and products.id=offers.products_id
						group by products.name
						order by  products.id desc";
					$q=$this->con->prepare($sql);
					$q->execute(array("user_id"=>$user_id));
					$rows=$q->fetchall();
					return $rows;
				}
			catch(PDOEXCEPTION $ex)
				{
					$state="not connect";
					exit($ex->getmessage());
				}
			}
	 }	
// ------------ display my Purchases  --------------------------------	
	 public function myPurchases($id ) 
		{
			if($this->connect_to_db())
			{
				
						$sql="select orders.id,products.name,orders.role,image_name,products.price,
						orders.date_deliver,orders.add_date,orders.sale_date
								from orders
								inner join products 
								on orders.products_id=products.id
								inner join images 
								on images.products_id=products.id
								where orders.users_id= :id 
								group by orders.id
                                order by orders.add_date desc
								";
						$q=$this->con->prepare($sql);
						$q->execute(array("id"=>$id));
						$rows=$q->fetchall();
						
						if($q->rowcount()>0)return $rows;
							
				}
					 
			} 
// ------------ Get properties to cp adding  --------------------------------	
	 public function getProperties( ) 
		{
			if($this->connect_to_db())
			{
				$sql="SELECT DISTINCT name from properties ";
				$q=$this->con->prepare($sql);
				$q->execute(array());
				$rows=$q->fetchall();
				$props=[];
				$values=[];
				
				if($q->rowcount()>0)
					{
						foreach($rows as $row)
						{
							$name=$row['name'];
							//echo $name;
							$sqlv="SELECT * from properties where name=:n";
							$qv=$this->con->prepare($sqlv);
							$qv->execute(array("n"=>$name));
							$vals=$qv->fetchall();
							
							if($q->rowcount()>0)
							{
								//var_dump($vals);
								foreach($vals as $val)
								{
									$values[$val['id']]=$val['value'];
								}
							}
							$props[]=$name;
							$props[]=$values;
							$values=null;
						}
						
						
						/* for($index=0;$index<count($rows);$index++)
						{
							$name=$rows[$c]['name'];
							foreach($rows as $row)
							{
								if($name==$row['name'])
								{
									$values[$row['id']]=$row['value'];
									 
								}
							}
							if(!in_array($name,$props))
							{
								$props[$c]=$name;
								echo $name;
								$c=$c+1;
								$props[$c]=$values;
								//var_dump($values) ;
								$c=$c+1;
								$values=null;
							}
						} */
						
				return $props;	
				} 
			
} 
		} 	
	
}
		
function offerType($state)
{
	switch($state)
	{
		case true:
				return  'مستمر';
			break;
		case false:
			return  'منتهي';
			break;
		
	}
}		
		
?>