<!-- File: /app/View/Signup/index.ctp -->
<script type="text/javascript">

   
  
	function toggle_required(id) {
	    var object = document.getElementById(id)
	   
	        object.removeAttribute('required');    
	}
</script>


<h1>Getting Started</h1>

<?php
echo $this->Form->create(false);
echo $this->Form->input('phonenumber', array(
	'label' => 'Phone Number',
	'required'=>true,
	'onchange' => "toggle_required('zipcode')",
	'default' => $_SESSION['phonenumber']
));?>
or
<?php
echo $this->Form->input('zipcode', array(
	'label' => 'Zip Code',
	'required'=>true,
	'onchange' => "toggle_required('phonenumber')",
	'default' => $_SESSION['zipcode']
));
$options = array('R' => 'Residential', 'B' => 'Business');
$attributes = array('label' => 'Service Type','required'=>true,'default' => $_SESSION['servicetype']);
echo $this->Form->radio('servicetype', $options, $attributes);

echo $this->Form->input('promocode', array(
	'label' => 'Promo Code',
	'default' => $_SESSION['promocode']
));
echo $this->Form->end('NEXT');
?>