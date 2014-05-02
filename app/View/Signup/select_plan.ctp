<h1>Select Your Plan</h1>

<?php 

foreach($plans['products']['product'] as $plan){ ?>

                            [planid] => <?php echo $plan['planid'];?><br>
                            [planprice] => <?php echo $plan['planprice'];?><br>
                            [discountamount] => <?php echo $plan['discountamount'];?><br>
                            [discounttype] => <?php echo $plan['discounttype'];?><br>
                            [sourcecode] => <?php echo $plan['sourcecode'];?><br>
                            [englishsort] => <?php echo $plan['englishsort'];?><br>
                            [spanishsort] => <?php echo $plan['spanishsort'];?><br>
                            [metroupgradeavailable] => <?php echo $plan['metroupgradeavailable'];?><br>
                            [metroupgradeprice] => <?php echo $plan['metroupgradeprice'];?><br>
                            [metroplanid] => <?php echo $plan['metroplanid'];?><br>
                            [metronative] => <?php echo $plan['metronative'];?><br>
                            [providerid] => <?php echo $plan['providerid'];?><br><br>
                            <?php
							foreach($plan['planattributes']['attribute'] as $attribure){ ?>
								
									 [attributename] => <?php echo $attribure['attributename'];?> : 
									 [attributevalue] => <?php echo $attribure['attributevalue'];?><br>
								   
								<?php }
                            ?>
							<br><br>
<?php } 



